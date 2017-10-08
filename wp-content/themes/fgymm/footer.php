			<a href="#" class="scrollup"></a>
			<footer id="footer-main">
				<div id="footer-content-wrapper">

					<?php get_sidebar('footer'); ?>

					<div class="clear">
						<div id="fsocial">
							<ul class="footer-social-widget">
								<?php fgymm_show_social_sites(); ?>
							</ul>
						</div>
					</div>
					<div id="copyright">
					<p>
						 <?php fgymm_show_copyright_text(); ?> <a href="<?php echo esc_url( 'https://tishonator.com/product/fgymm' ); ?>" title="<?php esc_attr_e( 'fgymm Theme', 'fgymm' ); ?>">
				fGymm Theme</a> <?php esc_attr_e( 'powered by', 'fgymm' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'fgymm' ); ?>">
				WordPress</a>
						</p>
					</div>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>