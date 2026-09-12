<?php
/**
 * Projetos especiais (Figma 5275:793 + 5275:796). Conteúdo do Personalizador.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_itens  = mse_lines( mse_mod( 'projetos_itens' ) );
$mse_imagem = absint( mse_mod( 'projetos_imagem' ) );
?>
<section class="projetos" id="projetos" aria-labelledby="projetos-titulo">
	<div class="projetos__head container">
		<h2 class="section-title" id="projetos-titulo"><?php echo esc_html( mse_mod( 'projetos_titulo_secao' ) ); ?></h2>
	</div>

	<div class="projetos__body container">
		<article class="feature-card feature-card--media-right" aria-labelledby="projetos-card-titulo">
			<div class="feature-card__content">
				<div class="feature-card__body">
					<div class="feature-card__text">
						<h3 class="feature-card__title" id="projetos-card-titulo"><?php echo esc_html( mse_mod( 'projetos_titulo' ) ); ?></h3>
						<p class="feature-card__desc"><?php echo esc_html( mse_mod( 'projetos_texto' ) ); ?></p>
					</div>

					<?php if ( $mse_itens ) : ?>
						<ul class="feature-list feature-list--stack">
							<?php
							foreach ( $mse_itens as $mse_item ) {
								echo mse_feature_item( $mse_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</ul>
					<?php endif; ?>
				</div>

				<a class="cta cta--67" href="<?php echo esc_url( mse_link( 'projetos_cta_link' ) ); ?>"><span><?php echo esc_html( mse_mod( 'projetos_cta_texto' ) ); ?></span></a>
			</div>

			<?php if ( $mse_imagem && wp_attachment_is_image( $mse_imagem ) ) : ?>
				<div class="feature-media feature-media--photo">
					<?php
					echo wp_get_attachment_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$mse_imagem,
						'full',
						false,
						array(
							'class'   => 'feature-media__slide is-active',
							'loading' => 'lazy',
						)
					);
					?>
				</div>
			<?php else : ?>
				<div class="feature-media feature-media--placeholder" aria-hidden="true"></div>
			<?php endif; ?>
		</article>
	</div>
</section>
