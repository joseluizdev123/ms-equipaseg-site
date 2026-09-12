<?php
/**
 * Nossos clientes (Figma 5051:163). Logos do tipo de post mse_cliente.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_clientes = get_posts(
	array(
		'post_type'        => 'mse_cliente',
		'numberposts'      => 24,
		'orderby'          => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
		'suppress_filters' => false,
	)
);

if ( ! $mse_clientes ) {
	return;
}
?>
<section class="clientes" aria-labelledby="clientes-titulo">
	<div class="clientes__inner container">
		<h2 class="clientes__title" id="clientes-titulo"><?php echo esc_html( mse_mod( 'clientes_titulo' ) ); ?></h2>
		<ul class="clientes__logos">
			<?php
			foreach ( $mse_clientes as $mse_cliente ) :
				$mse_logo_id = get_post_thumbnail_id( $mse_cliente );
				$mse_src     = $mse_logo_id ? wp_get_attachment_image_src( $mse_logo_id, 'full' ) : false;
				if ( ! $mse_src || empty( $mse_src[2] ) ) {
					continue;
				}
				$mse_altura  = absint( get_post_meta( $mse_cliente->ID, '_mse_logo_altura', true ) );
				$mse_altura  = $mse_altura ? $mse_altura : 40;
				$mse_largura = (int) round( $mse_src[1] * $mse_altura / $mse_src[2] );
				?>
				<li>
					<?php
					echo wp_get_attachment_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$mse_logo_id,
						array( $mse_largura, $mse_altura ),
						false,
						array(
							'alt'     => get_the_title( $mse_cliente ),
							'loading' => 'lazy',
						)
					);
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
