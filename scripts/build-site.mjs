/** Compile crawlable shared chrome, metadata and responsive images. Run: node scripts/build-site.mjs */
import fs from 'node:fs';
import path from 'node:path';
import vm from 'node:vm';
import {createHash} from 'node:crypto';
import {transformSync} from 'esbuild';
import {fileURLToPath} from 'node:url';
const root=path.resolve(path.dirname(fileURLToPath(import.meta.url)),'..');
process.chdir(root);
const site=JSON.parse(fs.readFileSync('data/site.json','utf8'));
// These files are build output. Content hashes permit safe long-lived browser caches.
fs.mkdirSync('assets',{recursive:true});
const bundles={};
for(const name of ['style.css','nav.js','effekte.js','predigten.js']){
 const loader=name.endsWith('.css')?'css':'js';
 const {code}=transformSync(fs.readFileSync(name,'utf8'),{loader,minify:true,target:'es2020',legalComments:'none'});
 const hash=createHash('sha256').update(code).digest('hex').slice(0,12);
 const asset=`assets/${name.replace(/\.(css|js)$/,'')}.${hash}.${loader}`;
 fs.writeFileSync(asset,code);bundles[name]=asset;
}
for(const name of fs.readdirSync('assets')){
 if(/^(style|nav|effekte|predigten)\.[a-f0-9]{12}\.(css|js)$/.test(name)&&!Object.values(bundles).includes('assets/'+name))fs.unlinkSync('assets/'+name);
}

const escape=s=>String(s).replaceAll('&','&amp;').replaceAll('"','&quot;').replaceAll('<','&lt;').replaceAll('>','&gt;');
const plain=s=>s.replace(/<[^>]*>/g,'').replace(/\s+/g,' ').trim();
const absolute=file=>site.url+(file==='index.html'?'/':'/'+file);
const address={'@type':'PostalAddress',streetAddress:site.street,postalCode:site.postalCode,addressLocality:site.locality,addressCountry:'DE'};
const org={'@type':'Organization','@id':site.url+'/#gemeinde',name:site.name,alternateName:site.shortName,url:site.url+'/',email:site.email,address,logo:site.url+'/efga-logo_new-e1520008237499.png',sameAs:[site.youtube]};
const files=Object.keys(site.pages);
const fakeNodes={'site-header':{innerHTML:'',dataset:{}},'site-footer':{innerHTML:'',dataset:{}},'efga-icons':{}};
const context=vm.createContext({document:{getElementById:id=>fakeNodes[id],querySelector:()=>null,querySelectorAll:()=>[],addEventListener:()=>{}},window:{},Date});
vm.runInContext(fs.readFileSync('nav.js','utf8'),context);
const sprite=vm.runInContext('EFGA_ICON_SPRITE',context);
function contacts(s) {
 return s.replace(/<(a|span)([^>]*\bdata-(em|tel)="([^"]+)"[^>]*)>([\s\S]*?)<\/\1>/g,(all,tag,attrs,kind,encoded,inner)=>{
   const value=Buffer.from(encoded,'base64').toString('utf8');
   if(tag==='a') attrs=attrs.replace(/href="[^"]*"/,`href="${kind==='em'?'mailto:':'tel:'}${escape(kind==='em'?value:value.replace(/[\s/]/g,''))}"`);
   if(!attrs.includes('data-label-behalten')&&!attrs.includes('data-nur-icon')) inner=inner.replace(/(<svg[\s\S]*?<\/svg>)|[^<]+(?=<|$)/g,(m,svg)=>svg||'')+' '+escape(value);
   return `<${tag}${attrs}>${inner.trim()}</${tag}>`;
 });
}
const faq='<section class="section" id="fragen"><div class="section-inner besucher-fragen"><h2>Gut zu wissen</h2>'+site.faq.map(f=>`<details><summary>${escape(f.question)}</summary><p>${escape(f.answer)}</p><a href="${escape(f.link)}">${escape(f.label)}</a></details>`).join('')+'</div></section>';
for(const file of files){
 let html=fs.readFileSync(file,'utf8');
 const depth=file.includes('/')?1:0,r=depth?'../':'';
 const state=html.match(/renderNav\('([^']*)'/)?.[1]??html.match(/data-nav-active="([^"]*)"/)?.[1]??'';
 html=html.replace(/<body[^>]*>/,`<body data-nav-active="${state}" data-nav-depth="${depth}">`);
 vm.runInContext(`renderNav(${JSON.stringify(state)},${depth}); renderFooter(${depth});`,context);
 html=html.replace(/<header id="site-header"[^>]*>[\s\S]*?<\/header>/,`<header id="site-header" data-rendered="true">${fakeNodes['site-header'].innerHTML}</header>`);
 html=html.replace(/<footer id="site-footer"[^>]*>[\s\S]*?<\/footer>/,`<footer id="site-footer" data-rendered="true">${fakeNodes['site-footer'].innerHTML}</footer>`);
 html=html.replace(/<script>renderNav\([\s\S]*?<\/script>\s*/,'');
 html=html.replace(/<script src="([^"]*(?:nav|effekte)\.js)"\s*>/g,'<script src="$1" defer>');
 html=html.replace(/<!-- ICONS START -->[\s\S]*?<!-- ICONS END -->\s*/,'');
 html=html.replace(/(<body[^>]*>)/,`$1\n<!-- ICONS START -->${sprite}<!-- ICONS END -->`);
 html=contacts(html);
 if(file==='index.html'){
  html=html.replace(/<section class="section" id="fragen">[\s\S]*?<\/section>\s*/,'');
  html=html.replace(/(<section class="section section-alt" id="kontakt">)/,faq+'\n$1');
  html=html.replace('Heimlingstraße 3, Greifenstein','Heimlingstraße 3, 35753 Greifenstein-Allendorf');
 }
 html=html.replace(/<img\b[^>]*>/g,tag=>{
  const src=tag.match(/src="([^"]+)"/)?.[1];if(!src)return tag;
  if(src.includes('bilder/angebote/')&&src.endsWith('.webp')){
   const base=src.slice(0,-5);
   const sizes=tag.includes('woche-karte-bild')||tag.includes('gruppe-card-fadebild')?'(max-width: 620px) 180px, 280px':file.startsWith('gruppen/')?'(max-width: 1240px) calc(100vw - 40px), 1160px':tag.includes('width="400"')?'320px':'(max-width: 700px) calc(100vw - 40px), 380px';
   tag=tag.replace(/ (?:srcset|sizes)="[^"]*"/g,'').replace(/\s*\/?>$/,` srcset="${base}-480.webp 480w, ${base}-960.webp 960w, ${src} 1400w" sizes="${sizes}" />`);
  }else if(/(?:gemeinde-aktuell|livestream-bibel)\.webp$/.test(src)){
   const base=src.slice(0,-5);
   tag=tag.replace(/ (?:srcset|sizes)="[^"]*"/g,'').replace(/\s*\/?>$/,` srcset="${base}-640.webp 640w, ${base}-1024.webp 1024w, ${src} 1672w" sizes="(max-width: 1240px) calc(100vw - 40px), ${file==='index.html'?'980':'1160'}px" />`);
  }
  if(!tag.includes('decoding='))tag=tag.replace(/\s*\/?>$/,' decoding="async" />');
  return tag;
 });
 let title=site.pages[file].title||plain(html.match(/<title>([\s\S]*?)<\/title>/)[1]);
 const description=site.pages[file].description;
 const url=absolute(file);
 const h1=plain(html.match(/<h1[^>]*>([\s\S]*?)<\/h1>/)[1]);
 const image=file.startsWith('gruppen/')&&fs.existsSync(`bilder/angebote/${path.basename(file,'.html')}.webp`)?`bilder/angebote/${path.basename(file,'.html')}.webp`:file==='gottesdienst-live.html'?'bilder/livestream-bibel.webp':'bilder/gemeinde-aktuell.webp';
 html=html.replace(/<title>[\s\S]*?<\/title>/,`<title>${escape(title)}</title>`).replace(/\s*<meta name="description"[^>]*>/,'');
 html=html.replace(/<!-- SEO START -->[\s\S]*?<!-- SEO END -->\s*/,'');
 const crumbs=[{name:'Startseite',item:site.url+'/'}];
 if(file.startsWith('gruppen/'))crumbs.push({name:'Gruppen und Kreise',item:site.url+'/gruppen.html'});
 if(file!=='index.html')crumbs.push({name:h1,item:url});
 const page={'@type':file==='wer-wir-sind.html'?'AboutPage':file==='gruppen.html'?'CollectionPage':'WebPage','@id':url+'#webpage',url,name:title,description,inLanguage:'de-DE',isPartOf:{'@id':site.url+'/#website'},about:{'@id':org['@id']},publisher:{'@id':org['@id']},primaryImageOfPage:{'@type':'ImageObject',url:site.url+'/'+image}};
 const graph=[org,{'@type':'WebSite','@id':site.url+'/#website',url:site.url+'/',name:site.name,alternateName:site.shortName,inLanguage:'de-DE',publisher:{'@id':org['@id']}},page];
 if(crumbs.length>1)graph.push({'@type':'BreadcrumbList','@id':url+'#breadcrumb',itemListElement:crumbs.map((c,i)=>({'@type':'ListItem',position:i+1,...c}))});
 if(file==='index.html'){
  graph.push({'@type':'Church','@id':site.url+'/#gemeindehaus',name:'Gemeindehaus der EFG Allendorf',address,url:site.url+'/gruppen/gottesdienst.html'});
  graph.push({'@type':'FAQPage','@id':url+'#fragen',mainEntity:site.faq.map(f=>({'@type':'Question',name:f.question,acceptedAnswer:{'@type':'Answer',text:f.answer}}))});
 }
 const seo=`<!-- SEO START -->\n<meta name="description" content="${escape(description)}" />\n<link rel="canonical" href="${url}" />\n<meta name="robots" content="index, follow, max-image-preview:large" />\n<meta property="og:locale" content="de_DE" />\n<meta property="og:type" content="website" />\n<meta property="og:site_name" content="${escape(site.name)}" />\n<meta property="og:title" content="${escape(title)}" />\n<meta property="og:description" content="${escape(description)}" />\n<meta property="og:url" content="${url}" />\n<meta property="og:image" content="${site.url}/${image}" />\n<meta property="og:image:alt" content="${file==='gottesdienst-live.html'?'Offene Bibel im Morgenlicht':file.startsWith('gruppen/')?'Symbolbild zum Gruppenangebot':'Gruppenfoto der EFG Allendorf'}" />\n<meta name="twitter:card" content="summary_large_image" />\n<script type="application/ld+json">${JSON.stringify({'@context':'https://schema.org','@graph':graph}).replaceAll('<','\\u003c')}</script>\n<!-- SEO END -->`;
 html=html.replace('</head>',seo+'\n</head>');
 for(const [name,asset] of Object.entries(bundles)){
  const stem=name.replace(/\.(css|js)$/,'');
  const ext=name.split('.').pop();
  const re=new RegExp(`(href|src)="(?:\\.\\./)?(?:${name.replace('.', '\\.')}|assets/${stem}\\.[a-f0-9]{12}\\.${ext})"`,'g');
  html=html.replace(re,`$1="${r}${asset}"`);
 }
 fs.writeFileSync(file,html);
}
fs.writeFileSync('sitemap.xml','<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n'+files.map(f=>`  <url><loc>${absolute(f)}</loc></url>`).join('\n')+'\n</urlset>\n');
fs.writeFileSync('robots.txt',`User-agent: *\nAllow: /\nDisallow: /api/\nDisallow: /wordpress-theme/\nDisallow: /scripts/\nDisallow: /tests/\nDisallow: /lib/\nDisallow: /data/\n\nSitemap: ${site.url}/sitemap.xml\n`);
fs.copyFileSync('data/site.json','wordpress-theme/efg-allendorf/inc/site.json');
console.log(`Built ${files.length} crawlable pages, metadata and sitemap.`);

const wp='wordpress-theme/efg-allendorf';
fs.mkdirSync(wp+'/assets/css',{recursive:true});
fs.writeFileSync(wp+'/assets/css/site.min.css',transformSync(fs.readFileSync(wp+'/style.css','utf8'),{loader:'css',minify:true,target:'es2020'}).code);
for(const name of ['nav','contacts','effekte','predigten']){
 fs.writeFileSync(`${wp}/assets/js/${name}.min.js`,transformSync(fs.readFileSync(`${wp}/assets/js/${name}.js`,'utf8'),{loader:'js',minify:true,target:'es2020'}).code);
}
