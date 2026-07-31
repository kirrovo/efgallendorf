<?php
/**
 * Termin-Übersicht.
 *
 * Zeigt die nächsten Veranstaltungen aus dem CPT "veranstaltung".
 * Es werden bewusst keine Platzhalter-Termine erfunden: Ist nichts gepflegt,
 * erscheint ein Hinweis statt eines gefüllten Monatsrasters.
 *
 * Ein echter Kalender (z. B. Google-Kalender-Embed) gehört in den Container
 * <div class="kalender-embed"> ... </div> unterhalb dieser Liste.
 *
 * @package EFG_Allendorf
 */

$termine = new WP_Query( array(
	'post_type'      => 'veranstaltung',
	'posts_per_page' => 8,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
) );
?>

<?php if ( $termine->have_posts() ) : ?>
	<div class="termine-liste">
		<?php
		while ( $termine->have_posts() ) :
			$termine->the_post();
			$day   = efga_get( 'efga_date_day' );
			$month = efga_get( 'efga_date_month' );
			$time  = efga_get( 'efga_time' );
			?>
			<a href="<?php the_permalink(); ?>" class="termin-zeile">
				<div class="termin-datum">
					<span class="tag"><?php echo esc_html( $day ); ?></span>
					<span class="monat"><?php echo esc_html( $month ); ?></span>
				</div>
				<div class="termin-text">
					<strong><?php the_title(); ?></strong>
					<?php if ( $time ) : ?><span><?php echo esc_html( $time ); ?></span><?php endif; ?>
				</div>
				<?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?>
			</a>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
		<div class="termine-fuss">
			<span>Der Gottesdienst findet jeden Sonntag um 10:00 Uhr statt.</span>
			<a href="<?php echo esc_url( home_url( '/#kalender' ) ); ?>" class="text-link">
				Wochenrhythmus ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?>
			</a>
		</div>
	</div>
<?php else : ?>
	<div class="archive-hint">
		<strong>Zurzeit sind keine Termine eingetragen.</strong>
		Neue Veranstaltungen legst du im WordPress-Admin unter <strong>Veranstaltungen</strong> an.
	</div>
<?php endif; ?>
