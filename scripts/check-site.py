"""Check published HTML, local resources, canonical/schema consistency and FAQ parity."""
from pathlib import Path
from html.parser import HTMLParser
from urllib.parse import urlsplit,unquote
import json,xml.etree.ElementTree as ET
ROOT=Path(__file__).resolve().parents[1]
site=json.loads((ROOT/'data/site.json').read_text())
class Page(HTMLParser):
 def __init__(self,text):
  super().__init__(convert_charrefs=True);self.tags=[];self.ids=[];self.scripts=[];self.json_text=None;self.feed(text)
 def handle_starttag(self,tag,attrs):
  d=dict(attrs);self.tags.append((tag,d))
  if 'id' in d:self.ids.append(d['id'])
  if tag=='script' and d.get('type')=='application/ld+json':self.json_text=''
 def handle_data(self,data):
  if self.json_text is not None:self.json_text+=data
 def handle_endtag(self,tag):
  if tag=='script' and self.json_text is not None:self.scripts.append(json.loads(self.json_text));self.json_text=None
count=0
for file in site['pages']:
 p=ROOT/file;text=p.read_text();doc=Page(text)
 assert len(doc.ids)==len(set(doc.ids)),(file,'duplicate IDs')
 assert sum(t=='h1' for t,a in doc.tags)==1,(file,'h1')
 last_heading=0
 for tag,attrs in doc.tags:
  if len(tag)==2 and tag[0]=='h' and tag[1] in '123456':
   level=int(tag[1]);assert level<=last_heading+1,(file,'skipped heading level',last_heading,level)
   last_heading=level
 for name in ['description','robots']:
  assert sum(t=='meta' and a.get('name')==name for t,a in doc.tags)==1,(file,name)
 expected=site['url']+('/' if file=='index.html' else '/'+file)
 canon=[a.get('href') for t,a in doc.tags if t=='link' and a.get('rel')=='canonical']
 assert canon==[expected],(file,canon)
 assert len(doc.scripts)==1,(file,'schema')
 graph=doc.scripts[0]['@graph'];page=next(n for n in graph if n['@type'] in ['WebPage','AboutPage','CollectionPage'])
 assert page['url']==expected
 assert all(x in text for x in ['data-rendered="true"','mailto:info@eg-allendorf.de','Erstellt von kirrovo']),file
 for tag,attrs in doc.tags:
  targets=[attrs.get(k,'') for k in ['src','href']]
  if 'srcset' in attrs:targets += [part.strip().split()[0] for part in attrs['srcset'].split(',')]
  if tag=='img':assert all(k in attrs for k in ['alt','width','height']),(file,attrs)
  for target in targets:
   u=urlsplit(target)
   if not target or u.scheme or u.netloc or not u.path:continue
   local=ROOT/u.path.lstrip('/') if u.path.startswith('/') else p.parent/unquote(u.path)
   assert local.exists(),(file,target)
   count+=1
 if file=='index.html':
  faq=next(n for n in graph if n['@type']=='FAQPage')['mainEntity']
  assert len(faq)==len(site['faq'])
  for question in faq:assert question['name'] in text and question['acceptedAnswer']['text'] in text
urls={node.text for node in ET.parse(ROOT/'sitemap.xml').iter('{http://www.sitemaps.org/schemas/sitemap/0.9}loc')}
assert urls=={site['url']+('/' if p=='index.html' else '/'+p) for p in site['pages']}
for p in ROOT.rglob('*.webmanifest'):
 if 'node_modules' in p.parts:continue
 for icon in json.loads(p.read_text())['icons']:assert (p.parent/icon['src']).is_file()
print(f'20 pages, {count} local references, responsive images, canonical/schema, sitemap and visible FAQ checked.')
