<?php
/** Metadata, visitor answers and responsive theme images. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function efga_site_config() {
 static $config = null;
 if ( null === $config ) { $config = json_decode( file_get_contents( __DIR__ . '/site.json' ), true ); }
 return $config;
}
function efga_seo_plugin_active() { return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ); }
function efga_seo_page_data() {
 $config = efga_site_config();
 $key = is_front_page() ? 'index.html' : ( is_post_type_archive( 'gruppe' ) ? 'gruppen.html' : '' );
 if ( is_singular() && ! is_front_page() ) {
  $post = get_queried_object();
  $key = ( 'gruppe' === $post->post_type ? 'gruppen/' : '' ) . $post->post_name . '.html';
 }
 $data = $config['pages'][ $key ] ?? array();
 $data['title'] = $data['title'] ?? ( wp_strip_all_tags( is_post_type_archive( 'gruppe' ) ? 'Gruppen und Kreise' : get_the_title( get_queried_object_id() ) ) . ' | EFG Allendorf' );
 if ( empty( $data['description'] ) ) {
  $data['description'] = is_singular() ? wp_trim_words( wp_strip_all_tags( strip_shortcodes( get_post_field( 'post_content', get_queried_object_id() ) ) ), 26, '…' ) : 'Gruppen, Gottesdienst und Gemeinschaft bei der EFG Allendorf in Greifenstein.';
 }
 return $data;
}
add_filter( 'document_title_parts', function ( $parts ) {
 if ( ! efga_seo_plugin_active() && ( is_singular() || is_front_page() || is_post_type_archive( 'gruppe' ) ) ) {
  $parts = array( 'title' => efga_seo_page_data()['title'] );
 }
 return $parts;
}, 20 );
function efga_seo_head() {
 if ( efga_seo_plugin_active() || is_404() || is_search() || is_feed() ) { return; }
 $config = efga_site_config(); $data = efga_seo_page_data();
 $home = home_url( '/' );
 $url = is_front_page() ? $home : ( is_singular() ? get_permalink() : get_post_type_archive_link( 'gruppe' ) );
 if ( ! $url ) { return; }
 $image = get_template_directory_uri() . '/assets/img/gemeinde-aktuell.webp';
 if ( is_singular() && has_post_thumbnail() ) { $image = get_the_post_thumbnail_url( null, 'full' ); }
 $address = array( '@type'=>'PostalAddress', 'streetAddress'=>$config['street'], 'postalCode'=>$config['postalCode'], 'addressLocality'=>$config['locality'], 'addressCountry'=>'DE' );
 $org = array( '@type'=>'Organization', '@id'=>$home.'#gemeinde', 'name'=>$config['name'], 'alternateName'=>$config['shortName'], 'url'=>$home, 'email'=>$config['email'], 'address'=>$address, 'sameAs'=>array($config['youtube']), 'logo'=>get_template_directory_uri().'/assets/img/logo.png' );
 $graph = array( $org, array( '@type'=>'WebSite', '@id'=>$home.'#website', 'url'=>$home, 'name'=>$config['name'], 'inLanguage'=>'de-DE', 'publisher'=>array('@id'=>$org['@id']) ), array( '@type'=>'WebPage', '@id'=>$url.'#webpage', 'url'=>$url, 'name'=>$data['title'], 'description'=>$data['description'], 'inLanguage'=>'de-DE', 'isPartOf'=>array('@id'=>$home.'#website'), 'about'=>array('@id'=>$org['@id']) ) );
 if ( is_front_page() ) {
  $graph[] = array( '@type'=>'Church', '@id'=>$home.'#gemeindehaus', 'name'=>'Gemeindehaus der EFG Allendorf', 'address'=>$address );
  $graph[] = array( '@type'=>'FAQPage', '@id'=>$home.'#fragen', 'mainEntity'=>array_map( function($f){ return array('@type'=>'Question','name'=>$f['question'],'acceptedAnswer'=>array('@type'=>'Answer','text'=>$f['answer'])); }, $config['faq'] ) );
 } else {
  $items = array( array('@type'=>'ListItem','position'=>1,'name'=>'Startseite','item'=>$home) );
  if ( is_singular('gruppe') ) { $items[] = array('@type'=>'ListItem','position'=>2,'name'=>'Gruppen und Kreise','item'=>get_post_type_archive_link('gruppe')); }
  $items[] = array('@type'=>'ListItem','position'=>count($items)+1,'name'=>wp_strip_all_tags(get_the_title(get_queried_object_id())) ?: 'Gruppen und Kreise','item'=>$url);
  $graph[] = array('@type'=>'BreadcrumbList','itemListElement'=>$items);
 }
 echo '<meta name="description" content="'.esc_attr($data['description']).'" />' . "\n";
 if ( ! is_singular() ) { echo '<link rel="canonical" href="'.esc_url($url).'" />'."\n"; }
 foreach ( array('og:type'=>'website','og:locale'=>'de_DE','og:site_name'=>$config['name'],'og:title'=>$data['title'],'og:description'=>$data['description'],'og:url'=>$url,'og:image'=>$image) as $key=>$value ) {
  echo '<meta property="'.esc_attr($key).'" content="'.esc_attr($value).'" />'."\n";
 }
 echo '<meta name="twitter:card" content="summary_large_image" />'."\n";
 echo '<script type="application/ld+json">'.wp_json_encode(array('@context'=>'https://schema.org','@graph'=>$graph),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE).'</script>'."\n";
}
add_action( 'wp_head', 'efga_seo_head', 5 );
function efga_faq_link( $link ) {
 if ( 0 === strpos($link,'mailto:') ) { return $link; }
 $slug = basename($link,'.html');
 if ( 'gruppen' === $slug ) { return get_post_type_archive_link('gruppe'); }
 $post = get_page_by_path($slug,OBJECT,0===strpos($link,'gruppen/')?'gruppe':'page');
 return $post ? get_permalink($post) : home_url('/');
}
function efga_visitor_questions() {
 echo '<section class="section" id="fragen"><div class="section-inner besucher-fragen"><h2>Gut zu wissen</h2>';
 foreach(efga_site_config()['faq'] as $faq) {
  echo '<details><summary>'.esc_html($faq['question']).'</summary><p>'.esc_html($faq['answer']).'</p><a href="'.esc_url(efga_faq_link($faq['link'])).'">'.esc_html($faq['label']).'</a></details>';
 }
 echo '</div></section>';
}
function efga_responsive_attrs( $url, $sizes = '(max-width: 1240px) calc(100vw - 40px), 1160px' ) {
 $prefix = get_template_directory_uri().'/assets/img/';
 if ( 0 !== strpos($url,$prefix) || '.webp' !== substr($url,-5) ) { return; }
 $relative = substr($url,strlen($prefix));
 $widths = 0 === strpos($relative,'angebote/') ? array(480,960,1400) : array(640,1024,1672);
 $entries = array();
 foreach($widths as $width) {
  $name = substr($relative,0,-5).($width===end($widths)?'':'-'.$width).'.webp';
  if(file_exists(get_template_directory().'/assets/img/'.$name)) { $entries[]=$prefix.$name.' '.$width.'w'; }
 }
 if(count($entries)>1) { echo ' srcset="'.esc_attr(implode(', ',$entries)).'" sizes="'.esc_attr($sizes).'"'; }
}
