<?php
/**
 * MS Equipaseg: configuração do tema.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

define( 'MSE_VERSION', '0.1.0' );
define( 'MSE_DIR', get_template_directory() );
define( 'MSE_URI', get_template_directory_uri() );

require_once MSE_DIR . '/inc/helpers.php';
require_once MSE_DIR . '/inc/menus.php';
require_once MSE_DIR . '/inc/customizer.php';
require_once MSE_DIR . '/inc/meta-fields.php';
require_once MSE_DIR . '/inc/cpt-produto.php';
require_once MSE_DIR . '/inc/cpt-cliente.php';
require_once MSE_DIR . '/inc/cpt-depoimento.php';
require_once MSE_DIR . '/inc/seeder.php';

add_action( 'after_setup_theme', 'mse_setup' );

/**
 * Suportes do tema e locais de menu.
 */
function mse_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus(
		array(
			'primary'          => 'Menu principal',
			'footer-navegacao' => 'Rodapé: Navegação',
			'footer-produtos'  => 'Rodapé: Produtos',
			'footer-politicas' => 'Rodapé: Políticas',
		)
	);
}

add_action( 'wp_enqueue_scripts', 'mse_enqueue_assets' );

/**
 * Fontes, CSS e JS do front-end (os mesmos arquivos do index.html estático).
 */
function mse_enqueue_assets() {
	wp_enqueue_style(
		'mse-fonts',
		'https://fonts.googleapis.com/css2?family=Exo:wght@400;600;700&family=Inter:wght@400;600;700&family=Montserrat&family=Work+Sans:wght@400;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'mse-main', MSE_URI . '/assets/css/main.css', array( 'mse-fonts' ), MSE_VERSION );
	wp_enqueue_script(
		'mse-main',
		MSE_URI . '/assets/js/main.js',
		array(),
		MSE_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}

add_filter( 'wp_resource_hints', 'mse_resource_hints', 10, 2 );

/**
 * Preconnect para o Google Fonts.
 *
 * @param array  $urls     URLs de dica.
 * @param string $relation Tipo de dica.
 * @return array
 */
function mse_resource_hints( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
