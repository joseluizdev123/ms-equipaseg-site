<?php
/**
 * Produtos (Figma 5275:717 + cards). Cards do tipo de post mse_produto.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_produtos = get_posts(
	array(
		'post_type'        => 'mse_produto',
		'numberposts'      => 24,
		'orderby'          => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
		'suppress_filters' => false,
	)
);

if ( ! $mse_produtos ) {
	return;
}
?>
<section class="produtos" id="produtos" aria-labelledby="produtos-titulo">
	<div class="produtos__head container">
		<h2 class="section-title" id="produtos-titulo"><?php echo esc_html( mse_mod( 'produtos_titulo' ) ); ?></h2>
	</div>

	<div class="produtos__list container">
		<?php
		foreach ( $mse_produtos as $mse_produto ) {
			get_template_part( 'template-parts/produto-card', null, array( 'produto' => $mse_produto ) );
		}
		?>
	</div>
</section>
