<?php
/**
 *
 * Title
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_title($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	    => '',
		'size'	    => 'h1',
		'align'	    => 'left',
		'weight'    => 'normal',
		'monospace' => '',
		'color'		=> '',
		'separator' => ''
		), $atts ) );

	$monospace = ( isset( $monospace ) && $monospace == 'yes' ) ? 'monospace' : 'title';
	$t_color = ( isset( $color ) && ! empty( $color ) ) ? 'style="color: ' . $color . ';"' : '';
	$output = '';

	if ( ! empty( $title ) ) {
		$output .= '<' . $size . ' class="' . $monospace . ' text-' . $align . ' ' . $weight . '" ' . $t_color . '>' . $title . '</' . $size . '>';
	}
	if ( $separator == 'yes' ) {
		$s_color = ( isset( $color ) && ! empty( $color ) ) ? 'style="background-color: ' . $color . ';"' : '';
		$align = ( $align != 'center' ) ? '-' . $align : '';
		$output .= '<p class="separator' . $align . '" ' . $s_color . '></p>';
	}

	return $output;
}
add_shortcode( 'gnoli_title', 'gnoli_title' );
