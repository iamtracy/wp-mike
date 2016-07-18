<?php
/**
 *
 * Skills
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_skills($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	  => '',
		'percent' => ''
		), $atts ) );

	$output  = '<div class="skill">';
	$output .= '<h6 class="skill-title">' . $title . '</h6>';
	$output .= '<div class="skill-bar" data-perc="' . $percent . '"><span>' . $percent . '%</span></div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'gnoli_skills', 'gnoli_skills' );
