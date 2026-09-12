<?php
/**
 * Personalizador: textos das seções, imagens e contatos globais.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valores padrão: o conteúdo do Figma. Imagens são IDs de anexo (0 = arquivo em assets/seed/).
 *
 * @return array
 */
function mse_mod_defaults() {
	return array(
		'header_cta_texto'      => 'Fale conosco',
		'header_cta_link'       => '#contato',

		'hero_titulo'           => 'MS Equipaseg soluções em dispositivos para controle de acesso: Torniquetes e Dilaceradores',
		'hero_subtitulo'        => 'Soluções inteligentes em dispositivos para controle de acesso e segurança. Fabricamos torniquetes, dilaceradores de pneus e desenvolvemos projetos personalizados, entregando qualidade, inovação e agilidade para proteger sua empresa.',
		'hero_imagem'           => 0,
		'hero_cta_texto'        => 'Solicitar cotação',
		'hero_cta_link'         => '',

		'clientes_titulo'       => 'Nossos clientes',
		'produtos_titulo'       => 'Produtos',

		'projetos_titulo_secao' => 'Projetos especiais',
		'projetos_titulo'       => 'Conheça os projetos',
		'projetos_texto'        => 'Nossos dilaceradores de pneus garantem proteção máxima para o controle de veículos em fábricas, centros de distribuição, portos, aeroportos e ambientes de alta segurança. de alto risco. Com tecnologia de ponta e acionamento inteligente, é a solução ideal para evitar acessos não autorizados com eficiência e confiabilidade.',
		'projetos_itens'        => "Lorem ipsum dolor sit amet\nLorem ipsum dolor sit amet\nLorem ipsum dolor sit amet",
		'projetos_imagem'       => 0,
		'projetos_cta_texto'    => 'Saber mais sobre',
		'projetos_cta_link'     => '#projetos',

		'sobre_titulo'          => 'Sobre nós',
		'sobre_texto'           => "Com 18 anos de história, a MS Equipaseg é **referência nacional** na fabricação de torniquetes, dilaceradores de pneus e projetos personalizados.\n\nNascemos para atender demandas com soluções de alta qualidade, **tecnologia de ponta e compromisso absoluto** com nossos clientes.",
		'sobre_imagem'          => 0,
		'sobre_cta_texto'       => 'Saber mais sobre nós',
		'sobre_cta_link'        => '#sobre',

		'numeros_titulo'        => 'Nossos números',
		'numeros_1_destaque'    => '+18 anos',
		'numeros_1_texto'       => 'de experiência',
		'numeros_2_destaque'    => '+100.000 produtos',
		'numeros_2_texto'       => 'fabricados',
		'numeros_3_destaque'    => '+20  estados',
		'numeros_3_texto'       => 'atendidos',

		'depoimentos_titulo'    => 'Clientes que confiam e recomendam',
		'depoimentos_texto'     => 'A confiança dos nossos clientes é o que impulsiona a MS Equipaseg a inovar e entregar sempre o melhor',

		'cta_titulo'            => 'Fale agora com um consultor',
		'cta_texto'             => 'Fale com o nosso time e encontre as melhores soluções para o seu negócio.',
		'cta_imagem'            => 0,
		'cta_botao_texto'       => 'Solicitar cotação',
		'cta_botao_link'        => '',

		'contato_whatsapp'      => '11 99999-8989',
		'contato_telefone'      => '11 3333-4444',
		'contato_email'         => 'email@exemplo.com.br',
		'contato_endereco'      => 'Rua José André Pattini, 250 – Terceira Divisão de Interlagos – CEP 04809-260 São Paulo / SP',

		'social_instagram'      => '#',
		'social_facebook'       => '#',
		'social_youtube'        => '#',
		'social_linkedin'       => '#',

		'footer_texto'          => 'Eget cursus nec vehicula, convallis. tincidunt Ut enim. Nunc placerat nisi non vitae Donec faucibus vehicula, sapien scelerisque Donec Nunc Lorem.',
		'footer_cta_texto'      => 'Solicitar cotação',
		'footer_cta_link'       => '',
		'footer_copyright'      => 'MS Equipaseg. Todos os direitos reservados.',
	);
}

/**
 * Seções e campos: id da seção => [título, descrição, campos]. Campo: chave => [rótulo, tipo, descrição].
 * Tipos: text, plain (preserva espaços), textarea, link, email, image.
 *
 * @return array
 */
function mse_customizer_schema() {
	$link_whatsapp = 'Vazio: abre o WhatsApp do contato.';
	$link_help     = 'Endereço completo ou âncora da página (ex.: #contato).';

	return array(
		'mse_cabecalho'   => array(
			'Cabeçalho',
			'',
			array(
				'header_cta_texto' => array( 'Texto do botão', 'text' ),
				'header_cta_link'  => array( 'Link do botão', 'link', $link_help ),
			),
		),
		'mse_hero'        => array(
			'Destaque (topo)',
			'',
			array(
				'hero_titulo'    => array( 'Título', 'textarea' ),
				'hero_subtitulo' => array( 'Texto', 'textarea' ),
				'hero_imagem'    => array( 'Imagem de fundo', 'image', 'Foto horizontal. O lado esquerdo fica escurecido para o texto.' ),
				'hero_cta_texto' => array( 'Texto do botão', 'text' ),
				'hero_cta_link'  => array( 'Link do botão', 'link', $link_whatsapp ),
			),
		),
		'mse_clientes'    => array(
			'Nossos clientes',
			'Os logos são cadastrados no menu Clientes.',
			array(
				'clientes_titulo' => array( 'Título', 'text' ),
			),
		),
		'mse_produtos'    => array(
			'Produtos',
			'Os cards são cadastrados no menu Produtos.',
			array(
				'produtos_titulo' => array( 'Título da seção', 'text' ),
			),
		),
		'mse_projetos'    => array(
			'Projetos especiais',
			'',
			array(
				'projetos_titulo_secao' => array( 'Título da seção', 'text' ),
				'projetos_titulo'       => array( 'Título do card', 'text' ),
				'projetos_texto'        => array( 'Texto', 'textarea' ),
				'projetos_itens'        => array( 'Itens', 'textarea', 'Um item por linha.' ),
				'projetos_imagem'       => array( 'Imagem', 'image', 'Sem imagem, o card mostra um bloco escuro.' ),
				'projetos_cta_texto'    => array( 'Texto do botão', 'text' ),
				'projetos_cta_link'     => array( 'Link do botão', 'link', $link_help ),
			),
		),
		'mse_sobre'       => array(
			'Sobre nós',
			'',
			array(
				'sobre_titulo'    => array( 'Título', 'text' ),
				'sobre_texto'     => array( 'Texto', 'textarea', 'Deixe uma linha em branco entre parágrafos. Use **assim** para negrito.' ),
				'sobre_imagem'    => array( 'Imagem', 'image' ),
				'sobre_cta_texto' => array( 'Texto do botão', 'text' ),
				'sobre_cta_link'  => array( 'Link do botão', 'link', $link_help ),
			),
		),
		'mse_numeros'     => array(
			'Nossos números',
			'',
			array(
				'numeros_titulo'     => array( 'Título', 'text' ),
				'numeros_1_destaque' => array( 'Número 1: destaque', 'plain' ),
				'numeros_1_texto'    => array( 'Número 1: complemento', 'plain' ),
				'numeros_2_destaque' => array( 'Número 2: destaque', 'plain' ),
				'numeros_2_texto'    => array( 'Número 2: complemento', 'plain' ),
				'numeros_3_destaque' => array( 'Número 3: destaque', 'plain' ),
				'numeros_3_texto'    => array( 'Número 3: complemento', 'plain' ),
			),
		),
		'mse_depoimentos' => array(
			'Depoimentos',
			'Os depoimentos são cadastrados no menu Depoimentos.',
			array(
				'depoimentos_titulo' => array( 'Título', 'text' ),
				'depoimentos_texto'  => array( 'Texto de apoio', 'textarea' ),
			),
		),
		'mse_cta'         => array(
			'Chamada final',
			'',
			array(
				'cta_titulo'      => array( 'Título', 'text' ),
				'cta_texto'       => array( 'Texto', 'textarea' ),
				'cta_imagem'      => array( 'Imagem', 'image' ),
				'cta_botao_texto' => array( 'Texto do botão', 'text' ),
				'cta_botao_link'  => array( 'Link do botão', 'link', $link_whatsapp ),
			),
		),
		'mse_contato'     => array(
			'Contato',
			'Aparece no rodapé. Campos vazios não são exibidos.',
			array(
				'contato_whatsapp' => array( 'WhatsApp', 'text' ),
				'contato_telefone' => array( 'Telefone', 'text' ),
				'contato_email'    => array( 'E-mail', 'email' ),
				'contato_endereco' => array( 'Endereço', 'textarea' ),
			),
		),
		'mse_redes'       => array(
			'Redes sociais',
			'Endereço completo do perfil. Deixe vazio para ocultar.',
			array(
				'social_instagram' => array( 'Instagram', 'link' ),
				'social_facebook'  => array( 'Facebook', 'link' ),
				'social_youtube'   => array( 'YouTube', 'link' ),
				'social_linkedin'  => array( 'LinkedIn', 'link' ),
			),
		),
		'mse_rodape'      => array(
			'Rodapé',
			'',
			array(
				'footer_texto'     => array( 'Texto institucional', 'textarea' ),
				'footer_cta_texto' => array( 'Texto do botão', 'text' ),
				'footer_cta_link'  => array( 'Link do botão', 'link', $link_whatsapp ),
				'footer_copyright' => array( 'Texto após "© ano"', 'text' ),
			),
		),
	);
}

add_action( 'customize_register', 'mse_customize_register' );

/**
 * Registra painel, seções, settings e controles.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function mse_customize_register( $wp_customize ) {
	$defaults = mse_mod_defaults();

	$wp_customize->add_panel(
		'mse',
		array(
			'title'    => 'MS Equipaseg',
			'priority' => 30,
		)
	);

	$priority = 10;
	foreach ( mse_customizer_schema() as $section_id => $section ) {
		list( $title, $description, $fields ) = $section;

		$wp_customize->add_section(
			$section_id,
			array(
				'title'       => $title,
				'description' => $description,
				'panel'       => 'mse',
				'priority'    => $priority,
			)
		);
		$priority += 10;

		foreach ( $fields as $key => $field ) {
			$label      = $field[0];
			$type       = $field[1];
			$help       = isset( $field[2] ) ? $field[2] : '';
			$setting_id = 'mse_' . $key;

			$wp_customize->add_setting(
				$setting_id,
				array(
					'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
					'sanitize_callback' => mse_sanitize_callback( $type ),
				)
			);

			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'       => $label,
							'description' => $help,
							'section'     => $section_id,
							'mime_type'   => 'image',
						)
					)
				);
				continue;
			}

			$wp_customize->add_control(
				$setting_id,
				array(
					'label'       => $label,
					'description' => $help,
					'section'     => $section_id,
					'type'        => 'textarea' === $type ? 'textarea' : ( 'email' === $type ? 'email' : 'text' ),
				)
			);
		}
	}
}

/**
 * Sanitização por tipo de campo.
 *
 * @param string $type Tipo.
 * @return callable
 */
function mse_sanitize_callback( $type ) {
	switch ( $type ) {
		case 'link':
			return 'mse_sanitize_link';
		case 'email':
			return 'sanitize_email';
		case 'image':
			return 'absint';
		case 'textarea':
			return 'sanitize_textarea_field';
		case 'plain':
			return 'mse_sanitize_plain';
		default:
			return 'sanitize_text_field';
	}
}

/**
 * Link absoluto ou âncora (#secao).
 *
 * @param string $value Valor.
 * @return string
 */
function mse_sanitize_link( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value || 0 === strpos( $value, '#' ) ) {
		return sanitize_text_field( $value );
	}
	return esc_url_raw( $value );
}

/**
 * Texto de uma linha sem tags, preservando espaços (o Figma usa "+20  estados").
 *
 * @param string $value Valor.
 * @return string
 */
function mse_sanitize_plain( $value ) {
	return preg_replace( '/[\r\n\t]+/', ' ', wp_strip_all_tags( (string) $value ) );
}
