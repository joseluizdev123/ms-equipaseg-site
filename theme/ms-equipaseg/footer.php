<?php
/**
 * Rodapé (Figma 5235:1049).
 *
 * @package ms-equipaseg
 */

defined( 'ABSPATH' ) || exit;

$mse_whatsapp = mse_mod( 'contato_whatsapp' );
$mse_telefone = mse_mod( 'contato_telefone' );
$mse_email    = mse_mod( 'contato_email' );
$mse_endereco = mse_mod( 'contato_endereco' );
$mse_redes    = mse_redes_sociais();
?>

<footer class="site-footer">
	<div class="site-footer__inner container">
		<div class="site-footer__top">
			<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' — página inicial' ); ?>">
				<img src="<?php echo esc_url( mse_asset( 'images/logo-ms-equipaseg-footer.svg' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="73" height="49">
			</a>

			<?php if ( $mse_redes ) : ?>
				<ul class="social">
					<?php foreach ( $mse_redes as $mse_rede ) : ?>
						<li><a class="social__link" href="<?php echo esc_url( $mse_rede['url'] ); ?>" rel="noopener"><?php echo esc_html( $mse_rede['nome'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="site-footer__main">
			<div class="site-footer__about">
				<p class="site-footer__desc"><?php echo esc_html( mse_mod( 'footer_texto' ) ); ?></p>
				<a class="cta cta--sm" href="<?php echo esc_url( mse_link( 'footer_cta_link' ) ); ?>">
					<img class="cta__icon" src="<?php echo esc_url( mse_asset( 'images/icon-whatsapp-dark.svg' ) ); ?>" alt="" width="20" height="20">
					<span><?php echo esc_html( mse_mod( 'footer_cta_texto' ) ); ?></span>
				</a>
			</div>

			<div class="site-footer__cols">
				<?php
				mse_footer_menu(
					'footer-navegacao',
					'Navegação',
					array(
						'Página inicial' => home_url( '/' ),
						'Quem somos'     => home_url( '/#sobre' ),
						'Contato'        => home_url( '/#contato' ),
					)
				);
				mse_footer_menu(
					'footer-produtos',
					'Produtos',
					array(
						'Dilacerador de Pneus' => home_url( '/#produtos' ),
						'Torniquete'           => home_url( '/#produtos' ),
						'Projetos especiais'   => home_url( '/#projetos' ),
					)
				);
				mse_footer_menu(
					'footer-politicas',
					'Políticas',
					array(
						'Política de Cookies'     => '#',
						'Política de Privacidade' => get_privacy_policy_url() ? get_privacy_policy_url() : '#',
						'Termos e condições'      => '#',
					)
				);
				?>

				<div class="footer-col">
					<h2 class="footer-col__title">Contato</h2>
					<ul class="footer-contact">
						<?php if ( $mse_whatsapp ) : ?>
							<li class="footer-contact__item">
								<span class="footer-contact__icon"><img src="<?php echo esc_url( mse_asset( 'images/icon-contato-whatsapp.svg' ) ); ?>" alt="WhatsApp" width="36" height="36"></span>
								<a class="footer-contact__text" href="<?php echo esc_url( mse_whatsapp_url( $mse_whatsapp ) ); ?>"><?php echo esc_html( $mse_whatsapp ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( $mse_telefone ) : ?>
							<li class="footer-contact__item">
								<span class="footer-contact__icon"><img src="<?php echo esc_url( mse_asset( 'images/icon-contato-telefone.svg' ) ); ?>" alt="Telefone" width="36" height="36"></span>
								<a class="footer-contact__text" href="<?php echo esc_url( mse_tel_url( $mse_telefone ) ); ?>"><?php echo esc_html( $mse_telefone ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( $mse_email ) : ?>
							<li class="footer-contact__item">
								<span class="footer-contact__icon"><img src="<?php echo esc_url( mse_asset( 'images/icon-contato-email.svg' ) ); ?>" alt="E-mail" width="36" height="36"></span>
								<a class="footer-contact__text" href="<?php echo esc_url( 'mailto:' . antispambot( $mse_email ) ); ?>"><?php echo esc_html( antispambot( $mse_email ) ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( $mse_endereco ) : ?>
							<li class="footer-contact__item footer-contact__item--endereco">
								<span class="footer-contact__icon"><img src="<?php echo esc_url( mse_asset( 'images/icon-contato-endereco.svg' ) ); ?>" alt="Endereço" width="36" height="36"></span>
								<span class="footer-contact__text"><?php echo esc_html( $mse_endereco ); ?></span>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="site-footer__credits">
			<p>© <?php echo esc_html( wp_date( 'Y' ) . ' ' . mse_mod( 'footer_copyright' ) ); ?></p>
			<p class="site-footer__dev">Desenvolvido por <strong>Artemis</strong></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
