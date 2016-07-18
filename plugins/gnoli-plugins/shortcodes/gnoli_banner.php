<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_banner($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	   => '',
		'image'	   => '',
		'size'	   => 'h1'
		), $atts ) );
	
	$img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';

	$output = '';
	if ( ! empty( $img ) ) {
		$output  = '<div class="container bg-cover bg-fixed pad-top-120 pad-btm-120" style="background-image:url(' . $img . ')">';
		$output .= '<div class="overlay overlay-dark-2x"></div>';
		if ( ! empty( $title ) ) {
			$output .= '<div class="row text-light text-center pad-30">';
			$output .= '<' . $size . ' class="title">' . $title . '</' . $size . '>';
			$output .= '<p class="separator"></p>';
			$output .= '</div>';
		}
		$output .= '</div>';
	}


	return $output;
}
add_shortcode( 'gnoli_banner', 'gnoli_banner' );
