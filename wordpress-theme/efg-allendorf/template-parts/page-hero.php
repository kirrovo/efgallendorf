<?php
/**
 * Breadcrumb + Page-Hero für Unterseiten.
 * Erwartet $args: title, subtitle, badge, gradient, crumbs (array of [label,url]).
 *
 * @package EFG_Allendorf
 */

$title    = isset( $args['title'] ) ? $args['title'] : get_the_title();
$subtitle = isset( $args['subtitle'] ) ? $args['subtitle'] : '';
$badge    = isset( $args['badge'] ) ? $args['badge'] : '';
$gradient = isset( $args['gradient'] ) ? $args['gradient'] : 'linear-gradient(135deg, #1e4b8a 0%, #2d6cc0 100%)';
$crumbs   = isset( $args['crumbs'] ) ? $args['crumbs'] : array();
?>
<div class="breadcrumb">
	<div class="breadcrumb-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Startseite</a>
		<?php foreach ( $crumbs as $c ) : ?>
			<span>›</span>
			<?php if ( ! empty( $c['url'] ) ) : ?>
				<a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['label'] ); ?></a>
			<?php else : ?>
				<span><?php echo esc_html( $c['label'] ); ?></span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>

<div class="page-hero" style="background: <?php echo esc_attr( $gradient ); ?>;">
	<div class="page-hero-inner">
		<?php if ( $badge ) : ?><div class="page-hero-badge"><?php echo esc_html( $badge ); ?></div><?php endif; ?>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
	</div>
</div>
