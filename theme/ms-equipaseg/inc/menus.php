<?php
/**
 * Menus: classes do tema no menu principal e listas padrão enquanto nada foi atribuído.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

/**
 * O item é link para uma âncora da página (ex.: /#sobre)?
 *
 * @param WP_Post $item Item de menu.
 * @return bool
 */
function mse_menu_item_is_anchor( $item ) {
	return false !== strpos( (string) $item->url, '#' );
}

add_filter( 'nav_menu_css_class', 'mse_nav_item_classes', 10, 4 );

/**
 * Classes do item no menu principal. Âncoras nunca ficam marcadas como atuais: o WordPress
 * ignora o fragmento e marcaria todas as âncoras da home.
 *
 * @param string[] $classes Classes.
 * @param WP_Post  $item    Item.
 * @param stdClass $args    Argumentos do wp_nav_menu().
 * @param int      $depth   Profundidade.
 * @return string[]
 */
function mse_nav_item_classes( $classes, $item, $args, $depth ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location || 0 !== $depth ) {
		return $classes;
	}
	$classes[] = 'site-nav__item';
	$current   = array_intersect( array( 'current-menu-item', 'current_page_item', 'current-menu-ancestor', 'current-page-ancestor' ), $classes );
	if ( $current && ! mse_menu_item_is_anchor( $item ) ) {
		$classes[] = 'is-current';
	}
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'mse_nav_link_attributes', 10, 4 );

/**
 * Classe do link no menu principal.
 *
 * @param array    $atts  Atributos.
 * @param WP_Post  $item  Item.
 * @param stdClass $args  Argumentos.
 * @param int      $depth Profundidade.
 * @return array
 */
function mse_nav_link_attributes( $atts, $item, $args, $depth ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $atts;
	}
	if ( mse_menu_item_is_anchor( $item ) ) {
		unset( $atts['aria-current'] );
	}
	if ( 0 === $depth ) {
		$atts['class'] = trim( ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . 'site-nav__link' );
	}
	return $atts;
}

add_filter( 'nav_menu_item_title', 'mse_nav_item_caret', 10, 4 );

/**
 * Seta do Figma nos itens do menu principal que têm submenu.
 *
 * @param string   $title Título.
 * @param WP_Post  $item  Item.
 * @param stdClass $args  Argumentos.
 * @param int      $depth Profundidade.
 * @return string
 */
function mse_nav_item_caret( $title, $item, $args, $depth ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location || 0 !== $depth ) {
		return $title;
	}
	if ( in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
		$title .= mse_caret_html();
	}
	return $title;
}

/**
 * HTML da seta do menu.
 *
 * @return string
 */
function mse_caret_html() {
	return '<span class="site-nav__caret" aria-hidden="true"><img src="' . esc_url( mse_asset( 'images/icon-caret-down.svg' ) ) . '" alt=""></span>';
}

/**
 * Menu principal padrão (o do Figma) quando nenhum menu foi atribuído.
 */
function mse_menu_fallback_primary() {
	$items = array(
		array( 'Página inicial', home_url( '/' ), is_front_page(), false ),
		array( 'Quem somos', home_url( '/#sobre' ), false, false ),
		array( 'Produtos', home_url( '/#produtos' ), false, true ),
		array( 'Projetos', home_url( '/#projetos' ), false, false ),
	);

	echo '<ul class="site-nav__list">';
	foreach ( $items as $item ) {
		list( $label, $url, $current, $caret ) = $item;
		printf(
			'<li class="site-nav__item%1$s"><a class="site-nav__link" href="%2$s"%3$s>%4$s%5$s</a></li>',
			$current ? ' is-current' : '',
			esc_url( $url ),
			$current ? ' aria-current="page"' : '',
			esc_html( $label ),
			$caret ? mse_caret_html() : '' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
	echo '</ul>';
}

/**
 * Coluna de menu do rodapé. O título é o nome do menu atribuído ao local.
 *
 * @param string $location       Local do menu.
 * @param string $fallback_title Título quando não há menu.
 * @param array  $fallback_items Rótulo => URL quando não há menu.
 */
function mse_footer_menu( $location, $fallback_title, $fallback_items ) {
	$title    = wp_get_nav_menu_name( $location );
	$title    = $title ? $title : $fallback_title;
	$title_id = 'rodape-' . sanitize_title( $location );

	printf( '<nav class="footer-col" aria-labelledby="%1$s"><h2 class="footer-col__title" id="%1$s">%2$s</h2>', esc_attr( $title_id ), esc_html( $title ) );

	if ( has_nav_menu( $location ) ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => 'footer-col__list',
				'depth'          => 1,
			)
		);
	} else {
		echo '<ul class="footer-col__list">';
		foreach ( $fallback_items as $label => $url ) {
			printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
		}
		echo '</ul>';
	}

	echo '</nav>';
}
