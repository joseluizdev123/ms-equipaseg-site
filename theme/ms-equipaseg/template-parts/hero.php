<?php
/**
 * Hero (Figma 5051:133).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="hero" aria-labelledby="hero-titulo">
	<div class="hero__media" aria-hidden="true">
		<?php
		mse_image(
			mse_mod( 'hero_imagem' ),
			'hero.jpg',
			array(
				'class'         => 'hero__bg',
				'alt'           => '',
				'width'         => 1392,
				'height'        => 752,
				'loading'       => false,
				'fetchpriority' => 'high',
			)
		);
		?>
	</div>

	<div class="hero__container container">
		<div class="hero__content">
			<div class="hero__text">
				<h1 class="hero__title" id="hero-titulo"><?php echo esc_html( mse_mod( 'hero_titulo' ) ); ?></h1>
				<p class="hero__subtitle"><?php echo esc_html( mse_mod( 'hero_subtitulo' ) ); ?></p>
			</div>

			<a class="cta" href="<?php echo esc_url( mse_link( 'hero_cta_link' ) ); ?>">
				<img class="cta__icon" src="<?php echo esc_url( mse_asset( 'images/icon-whatsapp-dark.svg' ) ); ?>" alt="" width="20" height="20">
				<span><?php echo esc_html( mse_mod( 'hero_cta_texto' ) ); ?></span>
			</a>
		</div>
	</div>

	<img class="hero__shape" src="<?php echo esc_url( mse_asset( 'images/hero-shape.svg' ) ); ?>" alt="" width="485" height="59">
</section>
