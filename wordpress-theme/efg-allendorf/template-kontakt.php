<?php
/**
 * Template Name: Kontakt & Anfahrt
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Kontakt & Anfahrt',
	'subtitle' => 'Wir freuen uns, von dir zu hören.',
	'badge'    => 'Kontakt',
	'crumbs'   => array( array( 'label' => 'Kontakt' ) ),
) );
?>

<section class="section">
	<div class="section-inner">
		<?php get_template_part( 'template-parts/kontakt', null, array( 'kopf' => false ) ); ?>
	</div>
</section>

<?php
get_footer();
