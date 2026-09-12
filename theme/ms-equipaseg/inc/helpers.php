<?php
/**
 * Funções utilitárias do tema.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valor de uma opção do Personalizador. O padrão é o conteúdo do Figma (ver mse_mod_defaults()).
 *
 * @param string $key Chave sem o prefixo mse_.
 * @return mixed
 */
function mse_mod( $key ) {
	$defaults = mse_mod_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'mse_' . $key, $default );
}

/**
 * Link de um botão: o valor salvo ou, vazio, o WhatsApp do contato.
 *
 * @param string $key Chave do link no Personalizador.
 * @return string
 */
function mse_link( $key ) {
	$link = trim( (string) mse_mod( $key ) );
	return '' !== $link ? $link : mse_default_link();
}

/**
 * Destino padrão dos botões de cotação: WhatsApp do contato ou a seção de contato.
 *
 * @return string
 */
function mse_default_link() {
	$whatsapp = mse_whatsapp_url( mse_mod( 'contato_whatsapp' ) );
	return $whatsapp ? $whatsapp : '#contato';
}

/**
 * URL de um arquivo em assets/.
 *
 * @param string $path Caminho relativo a assets/.
 * @return string
 */
function mse_asset( $path ) {
	return MSE_URI . '/assets/' . ltrim( $path, '/' );
}

/**
 * Imprime uma imagem da Mídia ou, sem anexo, o arquivo equivalente em assets/seed/.
 *
 * @param int    $attachment_id ID do anexo (0 usa o arquivo semente).
 * @param string $seed_file     Arquivo em assets/seed/ ('' não imprime nada sem anexo).
 * @param array  $attrs         Atributos do <img>. width/height só se aplicam ao arquivo semente.
 */
function mse_image( $attachment_id, $seed_file, $attrs = array() ) {
	$attachment_id = absint( $attachment_id );
	if ( $attachment_id && wp_attachment_is_image( $attachment_id ) ) {
		unset( $attrs['width'], $attrs['height'] );
		echo wp_get_attachment_image( $attachment_id, 'full', false, $attrs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}
	if ( '' === $seed_file ) {
		return;
	}

	$attrs = array_merge(
		array(
			'src' => mse_asset( 'seed/' . $seed_file ),
			'alt' => '',
		),
		$attrs
	);

	$html = '<img';
	foreach ( $attrs as $name => $value ) {
		if ( false === $value || null === $value ) {
			continue;
		}
		$html .= sprintf( ' %s="%s"', esc_attr( $name ), 'src' === $name ? esc_url( $value ) : esc_attr( $value ) );
	}
	echo $html . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Linhas não vazias de um texto (um item por linha).
 *
 * @param string $text Texto.
 * @return string[]
 */
function mse_lines( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}

/**
 * Texto de uma linha com quebras manuais: "|" vira <br>. Retorna HTML escapado.
 *
 * @param string $text Texto.
 * @return string
 */
function mse_breaks( $text ) {
	return implode( '<br>', array_map( 'esc_html', array_map( 'trim', explode( '|', (string) $text ) ) ) );
}

/**
 * Item de lista com ícone de check (cards de produto e projetos). "|" força quebra de linha.
 *
 * @param string $item Texto do item.
 * @return string HTML.
 */
function mse_feature_item( $item ) {
	$manual = false !== strpos( $item, '|' );
	return sprintf(
		'<li class="feature-list__item"><span class="feature-list__icon"><img src="%1$s" alt="" width="20" height="20"></span><span class="feature-list__text%2$s">%3$s</span></li>',
		esc_url( mse_asset( 'images/icon-check.svg' ) ),
		$manual ? ' feature-list__text--nowrap' : '',
		mse_breaks( $item )
	);
}

/**
 * Parágrafos separados por linha em branco; **trecho** vira negrito. Retorna HTML escapado.
 *
 * @param string $text Texto.
 * @return string
 */
function mse_paragraphs( $text ) {
	$blocks = preg_split( '/(?:\r\n|\r|\n)\s*(?:\r\n|\r|\n)/', trim( (string) $text ) );
	$html   = '';
	foreach ( $blocks as $block ) {
		$block = trim( preg_replace( '/\s*(?:\r\n|\r|\n)\s*/', ' ', $block ) );
		if ( '' === $block ) {
			continue;
		}
		$html .= '<p>' . preg_replace( '/\*\*(.+?)\*\*/', '<strong>$1</strong>', esc_html( $block ) ) . '</p>';
	}
	return $html;
}

/**
 * Só dígitos, com DDI 55 quando o número vier sem ele.
 *
 * @param string $number Telefone.
 * @return string
 */
function mse_phone_digits( $number ) {
	$digits = preg_replace( '/\D/', '', (string) $number );
	if ( '' !== $digits && strlen( $digits ) <= 11 ) {
		$digits = '55' . $digits;
	}
	return $digits;
}

/**
 * Link do WhatsApp.
 *
 * @param string $number Telefone.
 * @return string
 */
function mse_whatsapp_url( $number ) {
	$digits = mse_phone_digits( $number );
	return $digits ? 'https://wa.me/' . $digits : '';
}

/**
 * Link tel:.
 *
 * @param string $number Telefone.
 * @return string
 */
function mse_tel_url( $number ) {
	$digits = mse_phone_digits( $number );
	return $digits ? 'tel:+' . $digits : '';
}

/**
 * Redes sociais preenchidas no Personalizador, na ordem do Figma.
 *
 * @return array[] Itens com 'nome' e 'url'.
 */
function mse_redes_sociais() {
	$redes = array(
		'instagram' => 'Instagram',
		'facebook'  => 'Facebook',
		'youtube'   => 'YouTube',
		'linkedin'  => 'LinkedIn',
	);
	$itens = array();
	foreach ( $redes as $key => $nome ) {
		$url = trim( (string) mse_mod( 'social_' . $key ) );
		if ( '' !== $url ) {
			$itens[] = array(
				'nome' => $nome,
				'url'  => $url,
			);
		}
	}
	return $itens;
}

/**
 * Botão de seta com ícones de ativo e inativo.
 *
 * @param string $direction  'prev' ou 'next'.
 * @param string $label      Rótulo acessível.
 * @param string $variant    'escuro' (fundo #2d2d2d, cards) ou 'claro' (fundo branco, depoimentos).
 * @param bool   $disabled   Estado inicial inativo.
 * @param string $class      Classes extras.
 * @param string $data_attr  Atributo data-* extra (sem valor).
 */
function mse_arrow_button( $direction, $label, $variant, $disabled = false, $class = '', $data_attr = '' ) {
	$icons = 'claro' === $variant
		? array( 'icon-chevron-left-light.svg', 'icon-chevron-right-dark.svg' )
		: array( 'icon-chevron-left.svg', 'icon-chevron-right.svg' );
	printf(
		'<button class="%1$s" type="button" aria-label="%2$s"%3$s%4$s><img class="arrow-btn__off" src="%5$s" alt="" width="24" height="24"><img class="arrow-btn__on" src="%6$s" alt="" width="48" height="48"></button>',
		esc_attr( trim( 'arrow-btn arrow-btn--' . $direction . ' ' . $class ) ),
		esc_attr( $label ),
		$disabled ? ' aria-disabled="true"' : '',
		$data_attr ? ' ' . esc_attr( $data_attr ) : '',
		esc_url( mse_asset( 'images/' . $icons[0] ) ),
		esc_url( mse_asset( 'images/' . $icons[1] ) )
	);
}
