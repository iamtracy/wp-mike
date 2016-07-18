<?php
/**
 *
 * Quote
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function gnoli_quote($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'author'	=> '',
		'monospace' => '',
		'tcolor'	=> '',
		'qcolor'	=> ''
		), $atts ) );

	$qcolor = ( isset( $qcolor ) && ! empty( $qcolor ) ) ? 'style="color: ' . $qcolor . ';"' : '';
	$tcolor = ( isset( $tcolor ) && ! empty( $tcolor ) ) ? 'style="color: ' . $tcolor . ';"' : '';
	$monospace = ( isset( $monospace ) && $monospace == 'yes' ) ? 'class="monospace"' : '';

	$output  = '<blockquote ' . $qcolor . ' ' . $monospace . '>';
	$output .= $content;
	if ( ! empty( $author ) ) {
		$output .= '<footer ' . $tcolor . '>' . $author . '</footer>';
	}
	$output .= '</blockquote>';

	return $output;
}
add_shortcode( 'gnoli_quote', 'gnoli_quote' );
