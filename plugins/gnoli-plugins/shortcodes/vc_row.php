<?php

function vc_row( $atts, $content = '', $id = '', $full_width = '' ) {

	$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $full_width = $el_id = $parallax_image = $parallax = '';
	extract( shortcode_atts( array(
		'el_class' => '',
		'bg_image' => '',
		'bg_color' => '',
		'bg_image_repeat' => '',
		'font_color' => '',
		'padding' => '',
		'margin_bottom' => '',
		'full_width' => false,
		'parallax' => false,
		'parallax_image' => false,
		'css' => '',
		'equal_height' => '',
		'el_id' => '',
	), $atts ) );
	$parallax_image_id = '';
	$parallax_image_src = '';

	// wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	// wp_enqueue_style('js_composer_custom_css');


	// extra class
	$el_class = ( ! empty( $el_class ) ) ? ' ' . $el_class : '';

	$equal_height = ( isset( $equal_height ) && ! empty( $equal_height ) && $equal_height == 'yes' ) ? 'equal-height' : '';

	//inline css
	$first = strpos($css, "{");
	$second = substr($css, $first+1);
	$styles = explode("}", $second);
	if (!empty($css)){ $styles = 'style="'.$styles[0].'"';} else {$styles = '';}

	?>
		<div <?php echo isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : ""; ?> <?php
	?>class="vc_row wpb_row vc_row-fluid <?php echo esc_attr( $equal_height ); ?><?php echo esc_attr( $el_class ); ?><?php if ( $full_width == 'stretch_row_content_no_spaces' ): echo ' vc_row-no-padding'; endif; ?>"<?php if ( ! empty( $full_width ) ) {
		echo ' data-vc-full-width="true" data-vc-full-width-init="false" ';
		if ( $full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces' ) {
			echo ' data-vc-stretch-content="true"';
		}
	} ?>
	<?php echo $styles; ?>><?php
	echo wpb_js_remove_wpautop( $content );
	?></div><?php
	if ( ! empty( $full_width ) ) {
		echo '<div class="vc_row-full-width ' . $equal_height . '"></div>';
	}
}
add_shortcode( 'vc_row', 'vc_row' );