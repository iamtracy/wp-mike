<?php
/**
 *
 * Footer
 * @since 1.0.0
 * @version 1.0.0
 *
 */
global $gnoli;
$hidden_class = ( isset( $gnoli['sticky_footer'] ) && $gnoli['sticky_footer'] == true ) ? 'hidden-xs' : '';
?>
			<?php if ( $gnoli['scroll_top'] == true && ! $gnoli['sticky_footer'] ) { ?>
				<a class="to-top" href="#">
					<i class="pe-7s-angle-up"></i>
				</a>
			<?php } ?>
			<footer id="footer" <?php if ( $gnoli['sticky_footer'] ) { print 'class="fixed"'; }?>>
				<?php if ( $gnoli['scroll_top'] == true && $gnoli['sticky_footer'] ) { ?>
					<a class="to-top" href="#">
						<i class="pe-7s-angle-up"></i>
					</a>
				<?php } ?>
				<?php if ( ! empty( $gnoli['footer_social'] ) ) { ?>
					<div class="social-links <?php echo esc_attr( $hidden_class ); ?>">
					<h4>mike.zorbas@gmail.com</h4>
						<?php foreach ( $gnoli['footer_social'] as $link ) { ?>
							<a href="<?php echo esc_url( $link['footer_social_link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $link['footer_social_icon'] ); ?>"></i></a>

						<?php } ?>
						<a href="https://www.linkedin.com/in/mikezorbas" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="mailto:mike.zorbas@gmail.com"><i class="fa fa-envelope"></i></a>
					</div>

				<?php } ?>
				<div class="copyright <?php echo esc_attr( $hidden_class ); ?>">
					<?php
						$footer_text = ( ! empty( $gnoli['footer_text'] ) ) ? $gnoli['footer_text'] : ' ';
						echo esc_html( $footer_text ); 
					?>
				</div>
			</footer>
		</div>	
		<?php wp_footer(); ?>
	</body>
</html>