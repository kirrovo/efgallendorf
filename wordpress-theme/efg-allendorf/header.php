<?php
/**
 * Header – Navigation (entspricht nav.js renderNav()).
 *
 * @package EFG_Allendorf
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="color-scheme" content="light" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<header id="site-header">
	<div class="nav-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				printf(
					'<img src="%s" alt="%s" />',
					esc_url( get_template_directory_uri() . '/assets/img/logo.png' ),
					esc_attr( get_bloginfo( 'name' ) )
				);
			}
			?>
		</a>

		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => 'nav',
				'menu_class'     => 'primary-menu',
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'    => 'efga_default_menu',
				'depth'          => 1,
			) );
		} else {
			efga_default_menu();
		}
		?>
	</div>
</header>
