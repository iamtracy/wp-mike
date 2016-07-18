<?php
/**
 *
 * Video
 * @since 1.0.0
 * @version 1.1.0
 * @
 */
function gnoli_youtube($atts, $content = '', $id = '') {

	extract( shortcode_atts( array(
		'url'	   => '',
		'image'	   => '',
		'autoplay' => '',
		'mute'	   => '',
		'controls' => ''
		), $atts ) );

	$containment = "containment:'self'";
	$autoplay = ( $autoplay == 'yes' ) ? "autoPlay:true" : "autoPlay:false";
	$mute = ( $mute == 'yes' ) ? "mute:true" : "mute:false";
	$controls = ( $controls == 'yes' ) ? "showControls:true" : "showControls:false";

	$img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
	$url = "'" . $url . "'";


	$output = '<div class="hero-inner ytbg bg-cover" data-property="{videoURL:' . $url . ',' . $containment . ',' . $autoplay . ',' . $mute . ',' . $controls . '}" style="background-image: url(' . $img . ') !important"></div>';


	return $output;
}
add_shortcode( 'gnoli_youtube', 'gnoli_youtube' );
