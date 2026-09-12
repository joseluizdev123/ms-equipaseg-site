<?php
/**
 * Cabeçalho (Figma 7020:1080).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

<header class="site-header">
	<div class="site-header__inner container">
		<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — página inicial' ); ?>">
			<img src="<?php echo esc_url( mse_asset( 'images/logo-ms-equipaseg.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="111" height="48">
		</a>

		<nav class="site-nav" aria-label="Menu principal">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'depth'          => 2,
					'fallback_cb'    => 'mse_menu_fallback_primary',
				)
			);
			?>
		</nav>

		<a class="btn-outline" href="<?php echo esc_url( mse_link( 'header_cta_link' ) ); ?>">
			<img src="<?php echo esc_url( mse_asset( 'images/icon-chat.svg' ) ); ?>" alt="" width="20" height="20">
			<span><?php echo esc_html( mse_mod( 'header_cta_texto' ) ); ?></span>
		</a>
	</div>
</header>
