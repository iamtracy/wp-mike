<?php
/**
 *
 * Video
 * @since 1.0.0
 * @version 1.1.0
 * @
 */
function gnoli_counter_wrapper($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'image'	   => ''
		), $atts ) );

	$url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';

	$output  = '';
	if ( ! empty( $url ) ) {
		$output .= '<div class="pad-100 mrg-top-50" style="background-image:url(' . $url . ')" data-stellar-background-ratio=".2">';
		$output .= '<div class="overlay overlay-dark-3x"></div>';
		$output .= '<div class="row text-light">';		
	}

	$output .= do_shortcode( $content );		

	if ( ! empty( $url ) ) {
		$output .= '</div>';		
		$output .= '</div>';		
	}

	return $output;
}
add_shortcode( 'gnoli_counter_wrapper', 'gnoli_counter_wrapper' );


function gnoli_counter($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'size'	      => 'h1',
		'title'	      => '',
		'style'	      => 'light',
		'number'      => '',
		'column_size' => '12'
		), $atts ) );

	$style = ( $style == 'light' ) ? '' : '';
	//$style = ( $style == 'light' ) ? 'text-light' : '';

	$output  = '<div class="counter col-md-' . $column_size . ' text-center ' . $style . '">';
	$output .= '<h1 class="counter-num" data-to="' . $number . '"></h1>';
	$output .= '<p class="spacer-small separator"></p>';
	$output .= '<' . $size . '>' . $title . '</' . $size . '>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'gnoli_counter', 'gnoli_counter' );
