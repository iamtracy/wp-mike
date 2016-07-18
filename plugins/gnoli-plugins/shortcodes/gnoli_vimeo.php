<?php
/**
 *
 * Video
 * @since 1.0.0
 * @version 1.1.0
 * @
 */
function gnoli_vimeo($atts, $content = '', $id = '') {

	extract( shortcode_atts( array(
		'url'	   => '',
		'autoplay' => ''
		), $atts ) );

	$containment = "containment:'self'";
	$autoplay = ( $autoplay == 'yes' ) ? "autoPlay:true" : "autoPlay:false";
	$url = $url;
	

			//autoplay
	if($autoplay === 'autoPlay:true'){
			$autoplay = 'autoplay=1';
		}else{$autoplay = 'autoplay=0';}
		
	$output = '<iframe class="vimeo-video" src="https://player.vimeo.com/video/' . $url . '?' . $autoplay . '" width="500" height="269" frameborder="0" autoplay webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

	return $output;

}
add_shortcode( 'gnoli_vimeo', 'gnoli_vimeo' );