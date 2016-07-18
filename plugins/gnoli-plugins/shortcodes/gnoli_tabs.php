<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_tabs($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'style'	   => 'classic',
		'title'	   => '',
		'image'	   => ''
	), $atts ) );

	$output = '';
	
	if ( $style == 'modern') {
		$img_url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
		$output .= '<div class="pad-80 modern-tabs text-center" style="background-image:url(' . $img_url . ')" data-stellar-background-ratio=".2">';
		$output .= '<div class="overlay overlay-light-3x"></div>';
		$output .= '<h1 class="uppercase">' . $title . '</h1>';
		$output .= '<p class="separator"></p>';
		$output .= '<div class="container">';
		$output .= '<div class="row">';
		$output .= '<div class="col-md-6 col-md-offset-3">';
	}

	$output .= '<div class="tabs this-tabs">' . gnoli_tabs_parser( $content, 'gnoli_tabs_item' ) . '</div>';

	if ( $style == 'modern') {
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	}
	return $output;
}
add_shortcode( 'gnoli_tabs', 'gnoli_tabs' );
