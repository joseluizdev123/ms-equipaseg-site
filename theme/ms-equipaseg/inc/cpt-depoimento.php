<?php
/**
 * Tipo de post Depoimentos: carrossel "Clientes que confiam e recomendam" (Figma 5060:1948).
 * Título = nome; imagem destacada = foto (opcional, sem ela aparece o ícone do layout).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'mse_register_depoimento' );

/**
 * Registra o tipo de post.
 */
function mse_register_depoimento() {
	$labels = array_merge(
		mse_cpt_labels( 'Depoimento', 'Depoimentos', 'depoimento', 'depoimentos' ),
		array(
			'featured_image'        => 'Foto',
			'set_featured_image'    => 'Definir foto',
			'remove_featured_image' => 'Remover foto',
			'use_featured_image'    => 'Usar como foto',
		)
	);

	register_post_type(
		'mse_depoimento',
		array(
			'labels'        => $labels,
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'menu_position' => 22,
			'menu_icon'     => 'dashicons-format-quote',
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);
}

mse_register_meta_box(
	'mse_depoimento',
	'Depoimento',
	array(
		'_mse_citacao' => array(
			'label' => 'Texto do depoimento',
			'type'  => 'textarea',
			'help'  => 'Deixe uma linha em branco entre parágrafos.',
		),
		'_mse_cargo'   => array(
			'label' => 'Cargo / empresa',
			'type'  => 'text',
		),
	)
);
