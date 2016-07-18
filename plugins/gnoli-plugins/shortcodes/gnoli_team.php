<?php
/**
 *
 * Team
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function gnoli_team($atts, $content = '', $id = '') {

	extract( shortcode_atts( array(
		'name'	    => '',
		'position'  => '',
		'image'	    => '',
		'social_fb'	=> '',
		'social_dr'	=> '',
		'social_tw'	=> '',
		'controls'  => ''
		), $atts ) );

	$img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';


	$output  = '<div class="pad-30">';
	$output .= '<div class="team-member">';
	$output .= '<div class="avatar">';
	$output .= '<img src="' . $img . '">';
	if ( ! empty( $social_fb ) || ! empty( $social_dr ) || ! empty( $social_tw ) ) {
		$output .= '<div class="social">';
		$output .= ( ! empty( $social_fb ) ) ? '<a href="' . $social_fb . '" target="_blank"><i class="fa fa-facebook"></i></a>' : '';
		$output .= ( ! empty( $social_dr ) ) ? '<a href="' . $social_dr . '" target="_blank"><i class="fa fa-dribbble"></i></a>' : '';
		$output .= ( ! empty( $social_tw ) ) ? '<a href="' . $social_tw . '" target="_blank"><i class="fa fa-twitter"></i></a>' : '';
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '<div class="info">';
	$output .= '<h5 class="title bold mrg-top-20">' . $name . '</h4>';
	$output .= '<h6 class="monospace uppercase">' . $position . '</h6>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'gnoli_team', 'gnoli_team' );
