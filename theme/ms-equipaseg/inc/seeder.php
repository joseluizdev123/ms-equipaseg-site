<?php
/**
 * Importador do conteúdo inicial (Aparência > Conteúdo inicial).
 *
 * Cria a página inicial, os menus, os clientes, os produtos e os depoimentos do Figma e importa as
 * imagens de assets/seed/ para a Biblioteca de Mídia. Pode rodar de novo: o que já existe é mantido.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'mse_seeder_menu' );

/**
 * Página do importador.
 */
function mse_seeder_menu() {
	add_theme_page( 'Conteúdo inicial MS Equipaseg', 'Conteúdo inicial', 'manage_options', 'mse-seeder', 'mse_seeder_page' );
}

add_action( 'after_switch_theme', 'mse_seeder_flag' );

/**
 * Ao ativar o tema, lembra de importar o conteúdo.
 */
function mse_seeder_flag() {
	if ( ! get_option( 'mse_seeded' ) ) {
		set_transient( 'mse_seeder_notice', 1, WEEK_IN_SECONDS );
	}
}

add_action( 'admin_notices', 'mse_seeder_notice' );

/**
 * Aviso com link para o importador.
 */
function mse_seeder_notice() {
	if ( ! get_transient( 'mse_seeder_notice' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p>Tema MS Equipaseg ativado. <a href="%s">Importe o conteúdo inicial</a> para montar a página inicial igual ao layout.</p></div>',
		esc_url( admin_url( 'themes.php?page=mse-seeder' ) )
	);
}

/**
 * Tela do importador.
 */
function mse_seeder_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$log = array();
	if ( isset( $_POST['mse_seed'] ) ) {
		check_admin_referer( 'mse_seed' );
		$log = mse_seed_run();
	}
	?>
	<div class="wrap">
		<h1>Conteúdo inicial MS Equipaseg</h1>
		<p>Cria a página inicial, os menus, os clientes, os produtos e os depoimentos do layout e importa as imagens para a Biblioteca de Mídia. Itens que já existem não são duplicados nem sobrescritos.</p>
		<?php if ( $log ) : ?>
			<div class="notice notice-success"><ul>
				<?php foreach ( $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul></div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'mse_seed' ); ?>
			<?php submit_button( get_option( 'mse_seeded' ) ? 'Importar novamente' : 'Importar conteúdo', 'primary', 'mse_seed' ); ?>
		</form>
	</div>
	<?php
}

/**
 * Executa a importação.
 *
 * @return string[] Registro do que foi feito.
 */
function mse_seed_run() {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$log = array();

	// Imagens.
	$files = array(
		'hero.jpg'                => '',
		'sobre.jpg'               => '',
		'cta.jpg'                 => '',
		'produto-dilacerador.jpg' => 'Dilacerador de pneus MS Equipaseg',
		'produto-torniquete.png'  => 'Torniquete Linha MD 200',
		'cliente-avantia.png'     => 'Avantia',
		'cliente-azul.png'        => 'Azul',
		'cliente-baumer.png'      => 'Baumer',
		'cliente-daesp.png'       => 'DAESP',
		'cliente-itau.png'        => 'Itaú',
		'cliente-prosegur.png'    => 'Prosegur',
	);
	$ids   = array();
	foreach ( $files as $file => $alt ) {
		$ids[ $file ] = mse_seed_attachment( $file, $alt );
	}
	$log[] = sprintf( 'Imagens na Mídia: %d de %d.', count( array_filter( $ids ) ), count( $files ) );

	foreach ( array( 'hero_imagem' => 'hero.jpg', 'sobre_imagem' => 'sobre.jpg', 'cta_imagem' => 'cta.jpg' ) as $mod => $file ) {
		if ( $ids[ $file ] && ! get_theme_mod( 'mse_' . $mod ) ) {
			set_theme_mod( 'mse_' . $mod, $ids[ $file ] );
		}
	}

	// Clientes: nome, arquivo e altura exibida (Figma).
	$clientes = array(
		array( 'Avantia', 'cliente-avantia.png', 34 ),
		array( 'Azul', 'cliente-azul.png', 28 ),
		array( 'Baumer', 'cliente-baumer.png', 20 ),
		array( 'DAESP', 'cliente-daesp.png', 40 ),
		array( 'Itaú', 'cliente-itau.png', 40 ),
		array( 'Prosegur', 'cliente-prosegur.png', 24 ),
	);
	foreach ( $clientes as $ordem => $cliente ) {
		list( $nome, $arquivo, $altura ) = $cliente;
		$post_id                         = mse_seed_post( 'mse_cliente', $nome, sanitize_title( $nome ), $ordem, array( '_mse_logo_altura' => (string) $altura ) );
		if ( $post_id && $ids[ $arquivo ] && ! has_post_thumbnail( $post_id ) ) {
			set_post_thumbnail( $post_id, $ids[ $arquivo ] );
		}
	}
	$log[] = 'Clientes: ' . count( $clientes ) . '.';

	// Produtos.
	mse_seed_post(
		'mse_produto',
		'Dilacerador de Pneus',
		'dilacerador-de-pneus',
		0,
		array(
			'_mse_descricao'       => 'Nossos dilaceradores de pneus garantem proteção máxima para o controle de veículos em fábricas, centros de distribuição, portos, aeroportos e ambientes de alta segurança. Com tecnologia de ponta e Software integrado, é a solução ideal para evitar acessos não autorizados com eficiência e confiabilidade.',
			'_mse_caracteristicas' => implode(
				"\n",
				array(
					'Acionamento por botoeira,|Controle de acesso, remotamente',
					'Integração com portão,|cancela e laço indutivo',
					'Equipamento fabricado em módulos|de 1,0 e 0,5 metros, facilitando a|instalação e o transporte.',
					'Farol verde e vermelho.|Opcional: Aviso sonoro.',
				)
			),
			'_mse_galeria'         => (string) $ids['produto-dilacerador.jpg'],
			'_mse_estilo_midia'    => 'foto',
			'_mse_lado_imagem'     => 'esquerda',
			'_mse_selo'            => '',
			'_mse_cta_texto'       => 'Consulte os modelos',
			'_mse_cta_link'        => '',
			'_mse_cta_degrade'     => '1',
		)
	);
	mse_seed_post(
		'mse_produto',
		'Torniquete',
		'torniquete',
		1,
		array(
			'_mse_descricao'       => 'Desenvolvemos torniquetes robustos e de alta durabilidade para garantir o acesso seguro em centros logísticos, indústrias, estádios, escolas, edifícios comerciais e muito mais. Nossos modelos oferecem integração completa com qualquer hardware de controle de acesso.',
			'_mse_caracteristicas' => implode(
				"\n",
				array(
					'Estrutura resistente, fabricado|em Aço carbono ou Alumínio',
					'Mecanismo robusto|com anti-retorno',
					'Passagem confortável',
					'Integração com qualquer tipo|de controle de acesso',
					'Opções de cores',
					'Fácil instalação e manutenção',
				)
			),
			'_mse_galeria'         => (string) $ids['produto-torniquete.png'],
			'_mse_estilo_midia'    => 'recorte',
			'_mse_lado_imagem'     => 'direita',
			'_mse_selo'            => 'Linha MD 200',
			'_mse_cta_texto'       => 'Consulte os modelos',
			'_mse_cta_link'        => '',
			'_mse_cta_degrade'     => '',
		)
	);
	$log[] = 'Produtos: 2.';

	// Depoimentos (textos provisórios do layout).
	for ( $i = 1; $i <= 4; $i++ ) {
		mse_seed_post(
			'mse_depoimento',
			'Nome cliente',
			'depoimento-' . $i,
			$i - 1,
			array(
				'_mse_citacao' => "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.\n\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatu",
				'_mse_cargo'   => 'Cargo/Empresa',
			)
		);
	}
	$log[] = 'Depoimentos: 4 (textos provisórios do layout).';

	// Página inicial.
	$home_id = mse_seed_post( 'page', 'Página inicial', 'pagina-inicial', 0, array() );
	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		$log[] = 'Página inicial definida em Configurações > Leitura.';
	}

	// Menus.
	$home = home_url( '/' );
	mse_seed_menu(
		'Menu principal',
		'primary',
		array(
			array( 'Página inicial', $home ),
			array( 'Quem somos', $home . '#sobre' ),
			array(
				'Produtos',
				$home . '#produtos',
				array(
					array( 'Dilacerador de Pneus', $home . '#produtos' ),
					array( 'Torniquete', $home . '#produtos' ),
				),
			),
			array( 'Projetos', $home . '#projetos' ),
		)
	);
	mse_seed_menu(
		'Navegação',
		'footer-navegacao',
		array(
			array( 'Página inicial', $home ),
			array( 'Quem somos', $home . '#sobre' ),
			array( 'Contato', $home . '#contato' ),
		)
	);
	mse_seed_menu(
		'Produtos',
		'footer-produtos',
		array(
			array( 'Dilacerador de Pneus', $home . '#produtos' ),
			array( 'Torniquete', $home . '#produtos' ),
			array( 'Projetos especiais', $home . '#projetos' ),
		)
	);
	mse_seed_menu(
		'Políticas',
		'footer-politicas',
		array(
			array( 'Política de Cookies', '#' ),
			array( 'Política de Privacidade', get_privacy_policy_url() ? get_privacy_policy_url() : '#' ),
			array( 'Termos e condições', '#' ),
		)
	);
	$log[] = 'Menus criados e atribuídos.';

	update_option( 'mse_seeded', MSE_VERSION );
	delete_transient( 'mse_seeder_notice' );

	return $log;
}

/**
 * Importa um arquivo de assets/seed/ para a Mídia (uma vez só).
 *
 * @param string $file Arquivo.
 * @param string $alt  Texto alternativo.
 * @return int ID do anexo ou 0.
 */
function mse_seed_attachment( $file, $alt ) {
	$found = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'numberposts' => 1,
			'fields'      => 'ids',
			'meta_key'    => '_mse_seed_file', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'  => $file, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);
	if ( $found ) {
		return (int) $found[0];
	}

	$source = MSE_DIR . '/assets/seed/' . $file;
	if ( ! file_exists( $source ) ) {
		return 0;
	}

	// media_handle_sideload() move o arquivo; trabalha numa cópia temporária.
	$tmp = wp_tempnam( $file );
	if ( ! $tmp || ! copy( $source, $tmp ) ) {
		return 0;
	}

	$attachment_id = media_handle_sideload(
		array(
			'name'     => $file,
			'tmp_name' => $tmp,
		),
		0
	);
	if ( is_wp_error( $attachment_id ) ) {
		wp_delete_file( $tmp );
		return 0;
	}

	update_post_meta( $attachment_id, '_mse_seed_file', $file );
	if ( $alt ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt );
	}
	return (int) $attachment_id;
}

/**
 * Cria um post publicado se o slug ainda não existir.
 *
 * @param string $post_type Tipo.
 * @param string $title     Título.
 * @param string $slug      Slug.
 * @param int    $order     menu_order.
 * @param array  $meta      Metadados.
 * @return int ID do post (novo ou existente) ou 0.
 */
function mse_seed_post( $post_type, $title, $slug, $order, $meta ) {
	$existing = get_page_by_path( $slug, OBJECT, $post_type );
	if ( $existing ) {
		return (int) $existing->ID;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => $post_type,
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_status' => 'publish',
			'menu_order'  => $order,
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		return 0;
	}

	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
	return (int) $post_id;
}

/**
 * Cria um menu (se não existir) e o atribui a um local.
 *
 * @param string $name     Nome do menu.
 * @param string $location Local.
 * @param array  $items    Itens: array( rótulo, url, filhos? ).
 */
function mse_seed_menu( $name, $location, $items ) {
	$menu    = wp_get_nav_menu_object( $name );
	$menu_id = $menu ? (int) $menu->term_id : wp_create_nav_menu( $name );
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	if ( ! $menu ) {
		foreach ( $items as $item ) {
			$parent_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $item[0],
					'menu-item-url'    => $item[1],
					'menu-item-type'   => 'custom',
					'menu-item-status' => 'publish',
				)
			);
			if ( empty( $item[2] ) || is_wp_error( $parent_id ) ) {
				continue;
			}
			foreach ( $item[2] as $child ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $child[0],
						'menu-item-url'       => $child[1],
						'menu-item-type'      => 'custom',
						'menu-item-status'    => 'publish',
						'menu-item-parent-id' => $parent_id,
					)
				);
			}
		}
	}

	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
