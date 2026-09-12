<?php
/**
 * Página inicial (Figma 3047:6). Mesma estrutura do index.html estático.
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="conteudo">
	<?php
	get_template_part( 'template-parts/hero' );
	get_template_part( 'template-parts/clientes' );
	get_template_part( 'template-parts/produtos' );
	get_template_part( 'template-parts/projetos' );
	get_template_part( 'template-parts/sobre' );
	get_template_part( 'template-parts/depoimentos' );
	get_template_part( 'template-parts/cta' );
	?>
</main>

<?php
get_footer();
