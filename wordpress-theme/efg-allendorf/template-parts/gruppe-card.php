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
?>
<a href="<?php the_permalink(); ?>" class="gruppe-card">
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
