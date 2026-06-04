<?php
/**
 * Standard-Seitentemplate (für Seiten ohne eigenes Template).
 *
 * @package EFG_Allendorf
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/page-hero', null, array(
		'title'  => get_the_title(),
		'crumbs' => array( array( 'label' => get_the_title() ) ),
	) );
	?>

	<section class="section">
		<div class="section-inner">
			<div class="legal-body">
				<?php the_content(); ?>
			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
