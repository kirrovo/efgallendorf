<?php
/**
 * Generischer Fallback (Blog, Suche, Archive).
 *
 * @package EFG_Allendorf
 */

get_header();

$hero_title = is_search()
	? sprintf( 'Suche: %s', get_search_query() )
	: ( is_archive() ? get_the_archive_title() : 'Beiträge' );

get_template_part( 'template-parts/page-hero', null, array(
	'title'  => wp_strip_all_tags( $hero_title ),
	'crumbs' => array( array( 'label' => 'Übersicht' ) ),
) );
?>

<section class="section">
	<div class="section-inner">
		<?php if ( have_posts() ) : ?>
			<div class="predigten-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="predigt-row" style="text-decoration:none;color:inherit;">
						<div class="predigt-info">
							<strong><?php the_title(); ?></strong>
							<span><?php echo esc_html( get_the_date() ); ?></span>
						</div>
					</a>
				<?php endwhile; ?>
			</div>
			<div style="text-align:center;margin-top:32px;"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p style="text-align:center;color:var(--grau-mittel);">Keine Beiträge gefunden.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
