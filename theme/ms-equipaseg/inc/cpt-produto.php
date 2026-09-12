<?php
/**
 * Tipo de post Produtos: cards da seção Produtos (Figma 5051:235 e 5275:756).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'mse_register_produto' );

/**
 * Registra o tipo de post.
 */
function mse_register_produto() {
	register_post_type(
		'mse_produto',
		array(
			'labels'        => mse_cpt_labels( 'Produto', 'Produtos', 'produto', 'produtos' ),
			'public'        => false,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'menu_position' => 20,
			'menu_icon'     => 'dashicons-shield',
			'supports'      => array( 'title', 'page-attributes' ),
		)
	);
}

/**
 * Campos do produto.
 *
 * @return array
 */
function mse_produto_fields() {
	return array(
		'_mse_descricao'       => array(
			'label' => 'Descrição',
			'type'  => 'textarea',
		),
		'_mse_caracteristicas' => array(
			'label' => 'Características',
			'type'  => 'textarea',
			'help'  => 'Uma por linha. Use | para quebrar a linha dentro do item. Ex.: Mecanismo robusto|com anti-retorno',
		),
		'_mse_galeria'         => array(
			'label' => 'Imagens',
			'type'  => 'gallery',
			'help'  => 'Com duas ou mais imagens, as setas passam a navegar entre elas.',
		),
		'_mse_estilo_midia'    => array(
			'label'   => 'Estilo da imagem',
			'type'    => 'select',
			'options' => array(
				'foto'    => 'Foto preenchendo o quadro',
				'recorte' => 'Produto recortado (PNG) sobre fundo escuro',
			),
			'default' => 'foto',
		),
		'_mse_lado_imagem'     => array(
			'label'   => 'Lado da imagem',
			'type'    => 'select',
			'options' => array(
				'esquerda' => 'Esquerda',
				'direita'  => 'Direita',
			),
			'default' => 'esquerda',
		),
		'_mse_selo'            => array(
			'label' => 'Selo sobre a imagem',
			'type'  => 'text',
			'help'  => 'Opcional. Ex.: Linha MD 200',
		),
		'_mse_cta_texto'       => array(
			'label'   => 'Texto do botão',
			'type'    => 'text',
			'default' => 'Consulte os modelos',
		),
		'_mse_cta_link'        => array(
			'label' => 'Link do botão',
			'type'  => 'url',
			'help'  => 'Vazio: abre o WhatsApp do contato.',
		),
		'_mse_cta_degrade'     => array(
			'label' => 'Botão com degradê',
			'type'  => 'checkbox',
		),
	);
}

mse_register_meta_box( 'mse_produto', 'Conteúdo do card', mse_produto_fields() );
