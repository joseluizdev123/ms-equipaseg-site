<?php
/**
 * Depoimentos (Figma 5060:1948). Carrossel do tipo de post mse_depoimento.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_depoimentos = get_posts(
	array(
		'post_type'        => 'mse_depoimento',
		'numberposts'      => 24,
		'orderby'          => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
		'suppress_filters' => false,
	)
);

if ( ! $mse_depoimentos ) {
	return;
}

$mse_total = count( $mse_depoimentos );
?>
<section class="depoimentos" aria-labelledby="depoimentos-titulo">
	<div class="depoimentos__inner container" data-carousel>
		<div class="depoimentos__head">
			<h2 class="depoimentos__title" id="depoimentos-titulo"><?php echo esc_html( mse_mod( 'depoimentos_titulo' ) ); ?></h2>
			<p class="depoimentos__intro"><?php echo esc_html( mse_mod( 'depoimentos_texto' ) ); ?></p>
		</div>

		<div class="depoimentos__track" data-carousel-track>
			<?php
			foreach ( $mse_depoimentos as $mse_depoimento ) :
				$mse_foto  = get_post_thumbnail_id( $mse_depoimento );
				$mse_cargo = get_post_meta( $mse_depoimento->ID, '_mse_cargo', true );
				?>
				<figure class="depoimento">
					<blockquote class="depoimento__quote"><?php echo mse_paragraphs( get_post_meta( $mse_depoimento->ID, '_mse_citacao', true ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></blockquote>
					<div class="depoimento__divisor" aria-hidden="true"></div>
					<figcaption class="depoimento__cliente">
						<span class="depoimento__avatar">
							<?php if ( $mse_foto ) : ?>
								<?php
								echo wp_get_attachment_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									$mse_foto,
									array( 136, 136 ),
									false,
									array(
										'class'   => 'depoimento__foto',
										'alt'     => '',
										'loading' => 'lazy',
									)
								);
								?>
							<?php else : ?>
								<img class="depoimento__avatar-icon" src="<?php echo esc_url( mse_asset( 'images/icon-user.svg' ) ); ?>" alt="" width="22" height="24">
							<?php endif; ?>
						</span>
						<span class="depoimento__id">
							<span class="depoimento__nome"><?php echo esc_html( get_the_title( $mse_depoimento ) ); ?></span>
							<?php if ( $mse_cargo ) : ?>
								<span class="depoimento__cargo"><?php echo esc_html( $mse_cargo ); ?></span>
							<?php endif; ?>
						</span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>

		<?php if ( $mse_total > 1 ) : ?>
			<div class="depoimentos__nav">
				<div class="carousel-dots">
					<?php for ( $mse_i = 0; $mse_i < $mse_total; $mse_i++ ) : ?>
						<button class="carousel-dots__dot<?php echo 0 === $mse_i ? ' is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr( 'Depoimento ' . ( $mse_i + 1 ) ); ?>"<?php echo 0 === $mse_i ? ' aria-current="true"' : ''; ?> data-carousel-dot></button>
					<?php endfor; ?>
				</div>
				<div class="carousel-arrows">
					<?php
					mse_arrow_button( 'prev', 'Depoimento anterior', 'claro', true, '', 'data-carousel-prev' );
					mse_arrow_button( 'next', 'Próximo depoimento', 'claro', false, '', 'data-carousel-next' );
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
