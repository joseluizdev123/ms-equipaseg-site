<?php
/**
 * Chamada final (Figma 5235:1048).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="cta-final" id="contato" aria-labelledby="cta-titulo">
	<div class="container">
		<div class="cta-final__content">
			<div class="cta-final__text">
				<h2 class="cta-final__title" id="cta-titulo"><?php echo esc_html( mse_mod( 'cta_titulo' ) ); ?></h2>
				<p class="cta-final__desc"><?php echo esc_html( mse_mod( 'cta_texto' ) ); ?></p>
			</div>
			<a class="cta cta--dark" href="<?php echo esc_url( mse_link( 'cta_botao_link' ) ); ?>">
				<img class="cta__icon" src="<?php echo esc_url( mse_asset( 'images/icon-whatsapp-light.svg' ) ); ?>" alt="" width="20" height="20">
				<span><?php echo esc_html( mse_mod( 'cta_botao_texto' ) ); ?></span>
			</a>
		</div>
	</div>

	<div class="cta-final__media" aria-hidden="true">
		<?php
		mse_image(
			mse_mod( 'cta_imagem' ),
			'cta.jpg',
			array(
				'alt'     => '',
				'width'   => 1430,
				'height'  => 1072,
				'loading' => 'lazy',
			)
		);
		?>
		<span class="cta-final__square cta-final__square--1"></span>
		<span class="cta-final__square cta-final__square--2"></span>
		<span class="cta-final__square cta-final__square--3"></span>
		<span class="cta-final__square cta-final__square--4"></span>
	</div>
</section>
