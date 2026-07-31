<?php
/**
 * Breadcrumb + Seitenkopf für Unterseiten.
 * Erwartet $args: title, subtitle, badge, crumbs (array of [label,url]).
 *
 * @package EFG_Allendorf
 */

$title    = isset( $args['title'] ) ? $args['title'] : get_the_title();
$subtitle = isset( $args['subtitle'] ) ? $args['subtitle'] : '';
$badge    = isset( $args['badge'] ) ? $args['badge'] : '';
$crumbs   = isset( $args['crumbs'] ) ? $args['crumbs'] : array();
?>
<div class="breadcrumb">
	<div class="breadcrumb-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Startseite</a>
		<?php foreach ( $crumbs as $c ) : ?>
			<span aria-hidden="true">›</span>
			<?php if ( ! empty( $c['url'] ) ) : ?>
				<a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['label'] ); ?></a>
			<?php else : ?>
				<span><?php echo esc_html( $c['label'] ); ?></span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>

<div class="page-hero">
	<div class="page-hero-inner">
		<?php if ( $badge ) : ?><div class="page-hero-badge"><?php echo esc_html( $badge ); ?></div><?php endif; ?>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
	</div>
</div>
