<?php
/**
 * Gruppen-Karte (für das Gruppen-Archiv).
 * Erwartet den globalen Post im Loop.
 *
 * @package EFG_Allendorf
 */

$icon     = efga_get( 'efga_icon', 'personen' );
$badge    = efga_get( 'efga_badge' );
$schedule = efga_get( 'efga_schedule' );
$short    = efga_get( 'efga_short', wp_trim_words( get_the_excerpt(), 20 ) );
$card_bild = '';
$card_slug = get_post_field( 'post_name' );
if ( in_array( $card_slug, array( 'gottesdienst', 'glv', 'bibelstunde', 'hauskreise', 'kindergottesdienst', 'knallerbsen', 'wilde-fuechse', 'biblischer-unterricht', 'crossroad', 'kreisjugend' ), true ) ) {
	$card_bild_slug = 'kreisjugend' === $card_slug ? 'crossroad' : $card_slug;
	$card_bild = has_post_thumbnail()
		? get_the_post_thumbnail_url( null, 'medium_large' )
		: get_template_directory_uri() . '/assets/img/angebote/' . $card_bild_slug . '.webp';
}
?>
<a href="<?php the_permalink(); ?>" class="gruppe-card<?php echo $card_bild ? ' gruppe-card--mit-bild' : ''; ?>">
	<?php if ( $card_bild ) : ?>
	<img class="gruppe-card-fadebild" src="<?php echo esc_url( $card_bild ); ?>"<?php efga_responsive_attrs( $card_bild, '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
	<?php endif; ?>
	<div class="gruppe-card-header">
		<?php efga_ico( $icon ); ?>
		<h3><?php the_title(); ?></h3>
		<?php if ( $badge ) : ?><span class="tag"><?php echo esc_html( $badge ); ?></span><?php endif; ?>
	</div>
	<div class="gruppe-card-body">
		<p><?php echo esc_html( $short ); ?></p>
		<?php if ( $schedule ) : ?>
		<div class="gruppe-card-meta">
			<div class="gruppe-card-meta-item">
				<?php efga_ico( 'uhr', 'ico-sm' ); ?>
				<?php echo esc_html( $schedule ); ?>
			</div>
		</div>
		<?php endif; ?>
		<span class="gruppe-card-link">Mehr erfahren <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
	</div>
</a>
