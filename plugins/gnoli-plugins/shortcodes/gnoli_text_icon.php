<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_text_icon($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	      => '',
		'icon'	      => '',
		'column_size' => '12'
		), $atts ) );
	
	$output  = '<div class="col-md-' . $column_size . '">';
	$output .= '<div class="icon-box">';
	$output .= '<i class="' . $icon . '"></i>';
	$output .= '<div class="box-details">';
	$output .= '<h4>' . $title . '</h4>';
	$output .= '<p class="separator"></p>';
	$output .= '<p>' . $content . '</p>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'gnoli_text_icon', 'gnoli_text_icon' );
