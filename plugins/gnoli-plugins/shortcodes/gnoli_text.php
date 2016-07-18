<?php
/**
 *
 * Team
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_text($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'monospace'	=> '',
		'color'	    => ''
		), $atts ) );

	$class = ( $monospace == 'yes' ) ? 'monospace' : '';
	$class .= ( ! empty( $color ) ) ? 'abs' : '';
	$color = ( isset( $color ) && ! empty( $color ) ) ? 'style="color: ' . $color . ';"' : '';

	return '<div class="' . $class . '" ' . $color . '><p>' . $content . '</p></div>';
}
add_shortcode( 'gnoli_text', 'gnoli_text' );
