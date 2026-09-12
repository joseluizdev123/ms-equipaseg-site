<?php
/**
 * Modelo genérico (páginas internas e fallback).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="conteudo" class="page-content container">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'page-content__article' ); ?>>
				<?php the_title( '<h1 class="section-title page-content__title">', '</h1>' ); ?>
				<div class="page-content__body">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
	else :
		?>
		<h1 class="section-title page-content__title">Nada encontrado</h1>
		<?php
	endif;
	?>
</main>

<?php
get_footer();
