<?php
/**
 * Sobre nós + Nossos números (Figma 5060:357).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_icones = array(
	1 => 'icon-numero-experiencia.svg',
	2 => 'icon-numero-produtos.svg',
	3 => 'icon-numero-estados.svg',
);
?>
<section class="sobre" id="sobre" aria-labelledby="sobre-titulo">
	<div class="sobre__media" aria-hidden="true">
		<?php
		mse_image(
			mse_mod( 'sobre_imagem' ),
			'sobre.jpg',
			array(
				'alt'     => '',
				'width'   => 1626,
				'height'  => 1312,
				'loading' => 'lazy',
			)
		);
		?>
	</div>

	<div class="sobre__container container">
		<div class="sobre__content">
			<div class="sobre__text">
				<h2 class="sobre__title" id="sobre-titulo"><?php echo esc_html( mse_mod( 'sobre_titulo' ) ); ?></h2>
				<div class="sobre__body"><?php echo mse_paragraphs( mse_mod( 'sobre_texto' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			</div>
			<a class="cta cta--67" href="<?php echo esc_url( mse_link( 'sobre_cta_link' ) ); ?>"><span><?php echo esc_html( mse_mod( 'sobre_cta_texto' ) ); ?></span></a>
		</div>

		<div class="numeros">
			<h3 class="numeros__title"><?php echo esc_html( mse_mod( 'numeros_titulo' ) ); ?></h3>
			<ul class="numeros__list">
				<?php
				foreach ( $mse_icones as $mse_n => $mse_icone ) :
					$mse_destaque = mse_mod( 'numeros_' . $mse_n . '_destaque' );
					$mse_texto    = mse_mod( 'numeros_' . $mse_n . '_texto' );
					if ( '' === trim( $mse_destaque . $mse_texto ) ) {
						continue;
					}
					?>
					<li class="numeros__item">
						<span class="numeros__icon"><img src="<?php echo esc_url( mse_asset( 'images/' . $mse_icone ) ); ?>" alt="" width="20" height="20"></span>
						<span class="numeros__text"><strong><?php echo esc_html( $mse_destaque ); ?></strong> <?php echo esc_html( $mse_texto ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
