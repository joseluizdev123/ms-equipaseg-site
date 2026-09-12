<?php
/**
 * Card de produto (Figma 5051:235 com imagem à esquerda, 5275:756 com imagem à direita).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_post = isset( $args['produto'] ) ? $args['produto'] : null;
if ( ! $mse_post instanceof WP_Post ) {
	return;
}

$mse_id        = $mse_post->ID;
$mse_heading   = 'produto-' . $mse_post->post_name;
$mse_esquerda  = 'direita' !== get_post_meta( $mse_id, '_mse_lado_imagem', true );
$mse_recorte   = 'recorte' === get_post_meta( $mse_id, '_mse_estilo_midia', true );
$mse_descricao = get_post_meta( $mse_id, '_mse_descricao', true );
$mse_itens     = mse_lines( get_post_meta( $mse_id, '_mse_caracteristicas', true ) );
$mse_galeria   = array_values( array_filter( array_map( 'absint', explode( ',', (string) get_post_meta( $mse_id, '_mse_galeria', true ) ) ) ) );
$mse_selo      = get_post_meta( $mse_id, '_mse_selo', true );
$mse_cta_texto = get_post_meta( $mse_id, '_mse_cta_texto', true );
$mse_cta_texto = $mse_cta_texto ? $mse_cta_texto : 'Consulte os modelos';
$mse_cta_link  = get_post_meta( $mse_id, '_mse_cta_link', true );
$mse_cta_link  = $mse_cta_link ? $mse_cta_link : mse_default_link();
$mse_degrade   = '1' === get_post_meta( $mse_id, '_mse_cta_degrade', true );

$mse_card_class  = $mse_esquerda ? 'feature-card feature-card--media-left' : 'feature-card feature-card--media-right feature-card--bordered';
$mse_media_class = $mse_recorte ? 'feature-media feature-media--cutout' : 'feature-media feature-media--photo';
?>
<article class="<?php echo esc_attr( $mse_card_class ); ?>" aria-labelledby="<?php echo esc_attr( $mse_heading ); ?>">
	<div class="feature-card__content">
		<div class="feature-card__body">
			<div class="feature-card__text">
				<h3 class="feature-card__title" id="<?php echo esc_attr( $mse_heading ); ?>"><?php echo esc_html( get_the_title( $mse_post ) ); ?></h3>
				<?php if ( $mse_descricao ) : ?>
					<p class="feature-card__desc"><?php echo esc_html( $mse_descricao ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( $mse_itens && $mse_esquerda ) : ?>
				<ul class="feature-list feature-list--grid">
					<?php
					foreach ( $mse_itens as $mse_item ) {
						echo mse_feature_item( $mse_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</ul>
			<?php elseif ( $mse_itens ) : ?>
				<div class="feature-list feature-list--columns">
					<?php foreach ( array_chunk( $mse_itens, (int) ceil( count( $mse_itens ) / 2 ) ) as $mse_coluna ) : ?>
						<ul class="feature-list__col">
							<?php
							foreach ( $mse_coluna as $mse_item ) {
								echo mse_feature_item( $mse_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</ul>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<a class="cta cta--67<?php echo $mse_degrade ? ' cta--degrade' : ''; ?>" href="<?php echo esc_url( $mse_cta_link ); ?>"><span><?php echo esc_html( $mse_cta_texto ); ?></span></a>
	</div>

	<div class="<?php echo esc_attr( $mse_media_class ); ?>"<?php echo $mse_galeria ? ' data-gallery' : ''; ?>>
		<?php if ( $mse_recorte ) : ?>
			<img class="feature-media__pattern" src="<?php echo esc_url( mse_asset( 'images/pattern-elipses.svg' ) ); ?>" alt="" width="1338" height="960">
		<?php endif; ?>

		<?php
		foreach ( $mse_galeria as $mse_i => $mse_imagem_id ) {
			echo wp_get_attachment_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$mse_imagem_id,
				'full',
				false,
				array(
					'class'   => 'feature-media__slide' . ( 0 === $mse_i ? ' is-active' : '' ),
					'loading' => 'lazy',
				)
			);
		}

		if ( $mse_galeria ) {
			mse_arrow_button( 'prev', 'Imagem anterior', 'escuro', true, 'feature-media__nav feature-media__nav--prev' );
			mse_arrow_button( 'next', 'Próxima imagem', 'escuro', false, 'feature-media__nav feature-media__nav--next' );
		}
		?>

		<?php if ( $mse_selo ) : ?>
			<span class="feature-media__tag"><?php echo esc_html( $mse_selo ); ?></span>
		<?php endif; ?>
	</div>
</article>
