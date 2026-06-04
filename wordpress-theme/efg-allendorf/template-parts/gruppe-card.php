<?php
/**
 * Gruppen-Karte (für Startseite & Gruppen-Archiv).
 * Erwartet den globalen Post im Loop.
 *
 * @package EFG_Allendorf
 */

$emoji    = efga_get( 'efga_emoji', '📌' );
$badge    = efga_get( 'efga_badge' );
$from     = efga_get( 'efga_gradient_from', '#1e4b8a' );
$to       = efga_get( 'efga_gradient_to', '#2d6cc0' );
$schedule = efga_get( 'efga_schedule' );
$short    = efga_get( 'efga_short', wp_trim_words( get_the_excerpt(), 18 ) );
?>
<a href="<?php the_permalink(); ?>" class="gruppe-card">
	<div class="gruppe-card-header" style="background:linear-gradient(135deg,<?php echo esc_attr( $from ); ?>,<?php echo esc_attr( $to ); ?>);">
		<div class="gruppe-card-emoji"><?php echo esc_html( $emoji ); ?></div>
		<h3><?php the_title(); ?></h3>
		<?php if ( $badge ) : ?><span class="tag"><?php echo esc_html( $badge ); ?></span><?php endif; ?>
	</div>
	<div class="gruppe-card-body">
		<p><?php echo esc_html( $short ); ?></p>
		<?php if ( $schedule ) : ?>
		<div class="gruppe-card-meta">
			<div class="gruppe-card-meta-item">
				<svg width="14" height="14" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
				<?php echo esc_html( $schedule ); ?>
			</div>
		</div>
		<?php endif; ?>
		<span class="gruppe-card-link">Mehr erfahren →</span>
	</div>
</a>
