<?php
/**
 * Template Name: Interner Bereich
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Interner Bereich',
	'subtitle' => 'Formulare, Protokolle, Predigten-Archiv und mehr – nur für angemeldete Mitglieder.',
	'badge'    => '🔒 Für Gemeindeglieder',
	'gradient' => 'linear-gradient(135deg, #1a1a2e 0%, #1e4b8a 100%)',
	'crumbs'   => array( array( 'label' => 'Interner Bereich' ) ),
) );
?>

<section class="section">
	<div class="section-inner">
		<?php if ( is_user_logged_in() ) : ?>
			<div class="legal-body">
				<p style="text-align:center;">Willkommen, <strong><?php echo esc_html( wp_get_current_user()->display_name ); ?></strong>!</p>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo apply_filters( 'the_content', get_the_content() ); // phpcs:ignore
					endwhile;
				endif;
				?>
				<p style="text-align:center;margin-top:24px;"><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn-blau">Abmelden</a></p>
			</div>
		<?php else : ?>
			<div class="intern-banner">
				<div class="intern-icon-big">🔒</div>
				<div class="intern-text">
					<h3>Mitglieder-Login</h3>
					<p>Im internen Bereich findest du Predigten-Archiv, Gemeindeformulare, Protokolle und passwortgeschützte Inhalte.</p>
					<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn btn-white" style="width:fit-content;">Zum Login →</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
