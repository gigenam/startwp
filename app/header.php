<?php
/**
 * Cabecera principal del sitio
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package startwp
 * @since   1.0.0
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/img/apple-touch-icon.png' ); ?>?ver=<?php echo esc_html( $GLOBALS['startwp_theme_version'] ); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/img/favicon.png' ); ?>?ver=<?php echo esc_html( $GLOBALS['startwp_theme_version'] ); ?>">
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_template_directory_uri() . '/img/favicon.svg' ); ?>?ver=<?php echo esc_html( $GLOBALS['startwp_theme_version'] ); ?>">
	<?php wp_head(); ?>
</head>

<?php $startwp_post_thumbnail = has_post_thumbnail() ? ' single-post-thumbnail' : ''; ?>
<body <?php body_class( 'flexrow cols-1 cross-start margin-bottom-none' . $startwp_post_thumbnail ); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'startwp' ); ?>
	</a>

	<header id="site-header" class="site-header flexrow main-between padding has-background-color has-foreground-background-color">
		<div class="site-branding">
			<?php
			/**
			 * Logo personalizado
			 *
			 * @see /inc/setup/class-general.php#L62
			 */
			Startwp_General_Setup::custom_logo();

			$startwp_site_title_tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';
			?>
			<<?php echo esc_html( $startwp_site_title_tag ); ?> class="site-title margin-bottom-none">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</<?php echo esc_html( $startwp_site_title_tag ); ?>>
			<?php

			if ( get_bloginfo( 'description', 'display' ) || is_customize_preview() ) :
				?>
				<p class="site-description margin-bottom-none">
					<?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?>
				</p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php
		/**
		 * Navegación principal
		 *
		 * @see /inc/core/class-menus.php
		 */
		Startwp_menus::render(
			array(
				'nav_type'         => 'primary',
				'nav_wrap_classes' => 'flexrow margin-bottom-none',
				'has_button'       => true,
				'submenu'          => 'hover',
			)
		);
		?>
	</header><!-- #site-header -->
