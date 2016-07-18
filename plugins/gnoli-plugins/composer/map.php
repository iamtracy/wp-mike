<?php
/**
  * WPBakery Visual Composer Shortcodes settings
  *
  * @package VPBakeryVisualComposer
  *
 */

include_once( EF_ROOT . '/composer/params.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

function vc_remove_elements( $e = array() ) {
    if ( ! empty( $e ) ) {
        foreach ( $e as $key => $r_this ) {
            vc_remove_element( 'vc_' . $r_this );
        }
    }
}

add_action( 'admin_init', 'vc_remove_elements', 10);

$s_elements = array( 'round_chart', 'tta_tabs', 'tta_tour', 'tta_accordion', 'raw_js', 'line_chart', 'cta', 'tabs', 'tab', 'accordion', 'accordion_tab', 'custom_heading', 'clients', 'column_text', 'widget_sidebar', 'toggle', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'button', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'pie', 'wp_search', 'wp_meta', 'wp_recentcomments', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss', 'basic_grid', 'media_grid', 'masonry_grid', 'masonry_media_grid', 'icon', 'wp_tagcloud' );
vc_remove_element( 'client', 'testimonial' );
vc_remove_elements( $s_elements );
// ==========================================================================================
// SLIDER                                                                                   -
// ==========================================================================================
vc_map( 
    array(
        'name'                    => __( 'Modern image slider', 'js_composer' ),
        'base'                    => 'gnoli_modern_slider',
        'category'                => __( 'Media', 'js_composer' ),
        'as_parent'               => array('only' => 'gnoli_slider_item'),
        'content_element'         => true,
        'show_settings_on_create' => false,
        'description'             => __( 'Accordians Wrapper', 'js_composer'),
        'js_view'                 => 'VcColumnView',
        'params'                  => array()
    )
);
vc_map(
    array(
        'name'            => __( 'Slider item', 'js_composer'),
        'base'            => 'gnoli_slider_item',
        'as_child'        => array('only' => 'gnoli_modern_slider'),
        'params'          => array(
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Image', 'js_composer' ),
                'param_name'  => 'image'
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Text style', 'js_composer' ),
                'param_name'  => 'text_style',
                'value'       => array(
                    'Light'    => 'dark',
                    'Dark'     => 'light'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Image title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Image text', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
        )
    )
);

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Gnoli_Modern_Slider extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Gnoli_Slider_Item extends WPBakeryShortCode {}
}

// ==========================================================================================
// YOUTUBE                                                                                    -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'YouTube', 'js_composer' ),
        'base'            => 'gnoli_youtube',
        'description'     => __( 'YouTube video player', 'js_composer' ),
        'category'        => __( 'Media', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'YouTube Video ID', 'js_composer' ),
                'param_name'  => 'url',
                'description' => __( 'Add youtube link', 'js_composer' )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background image', 'js_composer' ),
                'param_name'  => 'image'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Autoplay video?', 'js_composer' ),
                'param_name' => 'autoplay',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Mute?', 'js_composer' ),
                'param_name' => 'mute',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Show play/pause button?', 'js_composer' ),
                'param_name' => 'controls',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            )
        )
    )
);

// ==========================================================================================
// VIMEO                                                                                  -
// ==========================================================================================
vc_map(
array(
        'name'            => __( 'Vimeo', 'js_composer' ),
        'base'            => 'gnoli_vimeo',
        'description'     => __( 'Vimeo video player', 'js_composer' ),
        'category'        => __( 'Media', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Vimeo Video ID', 'js_composer' ),
                'param_name'  => 'url',
                'description' => __( 'Add vimeo video id e.g 87701971', 'js_composer' )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Autoplay video?', 'js_composer' ),
                'param_name' => 'autoplay',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            )
        )
    )
);

// ==========================================================================================
// BANNER                                                                                   -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Image banner', 'js_composer' ),
        'base'            => 'gnoli_banner',
        'description'     => __( 'Image with text', 'js_composer' ),
        'category'        => __( 'Media', 'js_composer' ),
        'params'          => array(
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Heading', 'js_composer' ),
                  'param_name'  => 'size',
                  'value'       => array(
                      'H1'        =>  'h1',
                      'H2'        =>  'h2',
                      'H3'        =>  'h3',
                      'H4'        =>  'h4',
                      'H5'        =>  'h5',
                      'H6'        =>  'h6'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background image', 'js_composer' ),
                'param_name'  => 'image'
            ),
        )
    )
);

// ==========================================================================================
// COUNTER                                                                                  -
// ==========================================================================================
vc_map( 
    array(
        'name'                    => __( 'Counter', 'js_composer' ),
        'base'                    => 'gnoli_counter_wrapper',
        'category'                => __( 'Media', 'js_composer' ),
        'as_parent'               => array('only' => 'gnoli_counter'),
        'content_element'         => true,
        'show_settings_on_create' => true,
        'description'             => __( 'Counter Wrapper', 'js_composer'),
        'js_view'                 => 'VcColumnView',
        'params'                  => array(
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background image', 'js_composer' ),
                'param_name'  => 'image'
            ),
        )
    )
);
vc_map( 
    array(
        'name'            => __( 'Counter item', 'js_composer' ),
        'base'            => 'gnoli_counter',
        'description'     => __( 'Counter with text', 'js_composer' ),
        'as_child'        => array('only' => 'gnoli_counter_wrapper'),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Heading', 'js_composer' ),
                'param_name'  => 'size',
                'value'       => array(
                    'H1'        =>  'h1',
                    'H2'        =>  'h2',
                    'H3'        =>  'h3',
                    'H4'        =>  'h4',
                    'H5'        =>  'h5',
                    'H6'        =>  'h6'
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Text style', 'js_composer' ),
                'param_name'  => 'style',
                'value'       => array(
                    'Light'     =>  'light',
                    'Dark'      =>  'dark'
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Column size', 'js_composer' ),
                'param_name'  => 'column_size',
                'value'       => array(
                    'Full width' =>  '12',
                    'Half width' =>  '6',
                    '1/3'        =>  '4',
                    '1/4'        =>  '3',
                    '1/6'        =>  '2'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Count', 'js_composer' ),
                'param_name'  => 'number'
            )
        )
    )
);
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Gnoli_Counter_Wrapper extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Gnoli_Counter extends WPBakeryShortCode {}
}

// ==========================================================================================
// CUSTOM TITLE                                                                             -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Custom title', 'js_composer' ),
        'base'            => 'gnoli_title',
        'description'     => __( 'Can use as separator', 'js_composer' ),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Heading', 'js_composer' ),
                  'param_name'  => 'size',
                  'value'       => array(
                      'H1'        =>  'h1',
                      'H2'        =>  'h2',
                      'H3'        =>  'h3',
                      'H4'        =>  'h4',
                      'H5'        =>  'h5',
                      'H6'        =>  'h6'
                )
            ),
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Text align', 'js_composer' ),
                  'param_name'  => 'align',
                  'value'       => array(
                      'Left'     => 'left',
                      'Center'   => 'center',
                      'Right'    => 'right'
                )
            ),
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Font weight', 'js_composer' ),
                  'param_name'  => 'weight',
                  'value'       => array(
                      'Normal'   => 'normal',
                      'Bold'     => 'bold',
                      'Italic'   => 'italic'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Add text separator?', 'js_composer' ),
                'param_name' => 'separator',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Monospace text', 'js_composer' ),
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
                'param_name' => 'monospace'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Font color', 'js_composer' ),
                'param_name' => 'color',
                'description' => __( 'Choose text color', 'js_composer' )
            ),
        )
    )
);

// ==========================================================================================
// TEAM                                                                                     -
// ==========================================================================================
vc_map(
    array(
        'name'        => __( 'Team', 'js_composer' ),
        'base'        => 'gnoli_team',
        'description' => __( 'My team', 'js_composer' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Name', 'js_composer' ),
                'param_name'  => 'name'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Position', 'js_composer' ),
                'param_name'  => 'position'
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Photo', 'js_composer' ),
                'param_name'  => 'image'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Facebook', 'js_composer' ),
                'param_name'  => 'social_fb',
                'value'       => '#',
                'description' => __( 'Enter facebook social link url.', 'js_composer' ),
                'group'       => 'Social URL'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Dribbble', 'js_composer' ),
                'param_name'  => 'social_dr',
                'value'       => '#',
                'description' => __( 'Enter dribbble social link url.', 'js_composer' ),
                'group'       => 'Social URL'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Twitter', 'js_composer' ),
                'param_name'  => 'social_tw',
                'value'       => '#',
                'description' => __( 'Enter twitter social link url.', 'js_composer' ),
                'group'       => 'Social URL'
            )
        )
    )
);

// ==========================================================================================
// CUSTOM TEXT BLOCK                                                                        -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Custom text block', 'js_composer' ),
        'base'            => 'gnoli_text',
        'description'     => __( 'Simple text', 'js_composer' ),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(//monospace
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Image text', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Add letter spacing?', 'js_composer' ),
                'param_name' => 'monospace',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Font color', 'js_composer' ),
                'param_name' => 'color',
                'description' => __( 'Choose text color', 'js_composer' )
            ),
        )
    )
);

// ==========================================================================================
// SKILLS                                                                                   -
// ==========================================================================================
vc_map(
    array(
        'name'            => __( 'Skills', 'js_composer' ),
        'base'            => 'gnoli_skills',
        'description'     => __( 'Level of knowledge', 'js_composer' ),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title',
                'value'       => ''
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Percent of knowledge', 'js_composer' ),
                'param_name'  => 'percent',
                'value'       => ''
            )
        )
    )
);

// ==========================================================================================
// TEXT WITH ICON                                                                                -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Text with icon', 'js_composer' ),
        'base'            => 'gnoli_text_icon',
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Icon class', 'js_composer' ),
                'description' => 'Use <a href="http://themes-pixeden.com/font-demos/7-stroke/" target="_blank">Pe icon 7 stroke</a> classes.',
                'param_name'  => 'icon'
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Column size', 'js_composer' ),
                'param_name'  => 'column_size',
                'value'       => array(
                    'Full width' =>  '12',
                    'Half width' =>  '6',
                    '1/3'        =>  '4',
                    '1/4'        =>  '3',
                    '1/6'        =>  '2'
                )
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Image text', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
        )
    )
);

// ==========================================================================================
// LOGO LINE                                                                                -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Logo line', 'js_composer' ),
        'base'            => 'gnoli_logo_line',
        'category'        => __( 'Media', 'js_composer' ),
        'description'     => __( 'Logo images list', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'attach_images',
                'heading'     => __( 'Slides', 'js_composer' ),
                'param_name'  => 'images',
                'description' => __( 'Images for sliding.', 'js_composer' ),
                'value'       => ''
            )
        )
    )
);

// ==========================================================================================
// CUSTOM BANNER                                                                            -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Custom banner', 'js_composer' ),
        'base'            => 'gnoli_custom_banner',
        'description'     => __( 'Image with text and button', 'js_composer' ),
        'category'        => __( 'Media', 'js_composer' ),
        'params'          => array(
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Heading', 'js_composer' ),
                  'param_name'  => 'size',
                  'value'       => array(
                      'H1'        =>  'h1',
                      'H2'        =>  'h2',
                      'H3'        =>  'h3',
                      'H4'        =>  'h4',
                      'H5'        =>  'h5',
                      'H6'        =>  'h6'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background image', 'js_composer' ),
                'param_name'  => 'image'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Link text', 'js_composer' ),
                'param_name'  => 'link_text'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Link url', 'js_composer' ),
                'param_name'  => 'link_url'
            )
        )
    )
);

// ==========================================================================================
// SIMPLE SLIDER                                                                                -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Simple slider', 'js_composer' ),
        'base'            => 'gnoli_simple_slider',
        'category'        => __( 'Media', 'js_composer' ),
        'description'     => __( 'Image slider', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'attach_images',
                'heading'     => __( 'Slides', 'js_composer' ),
                'param_name'  => 'images',
                'description' => __( 'Images for sliding.', 'js_composer' ),
                'value' => ''
            )
        )
    )
);

// ==========================================================================================
// ACCORDIAN                                                                                -
// ==========================================================================================
vc_map( 
    array(
        'name'                    => __( 'Accordian', 'js_composer' ),
        'base'                    => 'gnoli_accordian',
        'category'                => __( 'Content', 'js_composer' ),
        'as_parent'               => array('only' => 'gnoli_accordian_item'),
        'content_element'         => true,
        'show_settings_on_create' => false,
        'description'             => __( 'Accordian Wrapper', 'js_composer'),
        'js_view'                 => 'VcColumnView',
        'params'                  => array()
    )
);
vc_map( 
    array(
        'name'            => __( 'Accordian item', 'js_composer' ),
        'base'            => 'gnoli_accordian_item',
        'as_child'        => array('only' => 'gnoli_accordian'),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Content', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Show expanded?', 'js_composer' ),
                'param_name' => 'expanded',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
        )
    )
);

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Gnoli_Accordian extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Gnoli_Accordian_Item extends WPBakeryShortCode {}
}

// ==========================================================================================
// QUOTE                                                                            -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Quote', 'js_composer' ),
        'base'            => 'gnoli_quote',
        'description'     => __( 'Quote text', 'js_composer' ),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Author', 'js_composer' ),
                'param_name'  => 'author'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Font color', 'js_composer' ),
                'param_name' => 'tcolor',
                'description' => __( 'Choose text color', 'js_composer' )
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Quote text', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Monospace text', 'js_composer' ),
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
                'param_name' => 'monospace'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Quote color', 'js_composer' ),
                'param_name' => 'qcolor',
                'description' => __( 'Choose text color', 'js_composer' )
            ),
        )
    )
);

// ==========================================================================================
// MAP                                                                                      -
// ==========================================================================================
vc_map(
    array(
        'name'        => __( 'Map', 'js_composer' ),
        'base'        => 'gnoli_map',
        'icon'        => 'icon-wpb-map-pin',
        'description' => __( 'Google maps block', 'js_composer' ),
        'params'      => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Latitude', 'js_composer' ),
                'param_name'  => 'latitude',
                'value'       => '51.5255069'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Longitude', 'js_composer' ),
                'param_name'  => 'longitude',
                'value'       => '-0.0836207'
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Marker', 'js_composer' ),
                'param_name'  => 'marker',
                'description' => 'Map marker image.'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Map zoom', 'js_composer' ),
                'param_name'  => 'zoom',
                'description' => 'Map zooming value. Max - 19, min - 0.',
                'value'       => 14
            ),
            array(
                'type'        => 'textarea',
                'heading'     => __( 'Marker text', 'js_composer' ),
                'param_name'  => 'marker_text'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 't1_title',
                'value'       => 'Office',
                'group'       => 'Office'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Icon class', 'js_composer' ),
                'description' => 'Use <a href="http://themes-pixeden.com/font-demos/7-stroke/" target="_blank">Pe icon 7 stroke</a> classes.',
                'param_name'  => 't1_icon',
                'value'       => 'pe-7s-map-2',
                'group'       => 'Office'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'First text line', 'js_composer' ),
                'param_name'  => 't1_text1',
                'value'       => 'UK, London',
                'group'       => 'Office'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Second text line', 'js_composer' ),
                'param_name'  => 't1_text2',
                'value'       => 'Paul Street 86-90',
                'group'       => 'Office'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 't2_title',
                'value'       => 'Phone',
                'group'       => 'Phone'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Icon class', 'js_composer' ),
                'description' => 'Use <a href="http://themes-pixeden.com/font-demos/7-stroke/" target="_blank">Pe icon 7 stroke</a> classes.',
                'param_name'  => 't2_icon',
                'value'       => 'pe-7s-phone',
                'group'       => 'Phone'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'First text line', 'js_composer' ),
                'param_name'  => 't2_text1',
                'value'       => '+987 123 456',
                'group'       => 'Phone'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Second text line', 'js_composer' ),
                'param_name'  => 't2_text2',
                'value'       => '+123 976 432',
                'group'       => 'Phone'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 't3_title',
                'value'       => 'Email',
                'group'       => 'Email'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Icon class', 'js_composer' ),
                'description' => 'Use <a href="http://themes-pixeden.com/font-demos/7-stroke/" target="_blank">Pe icon 7 stroke</a> classes.',
                'param_name'  => 't3_icon',
                'value'       => 'pe-7s-mail',
                'group'       => 'Email'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'First text line', 'js_composer' ),
                'param_name'  => 't3_text1',
                'value'       => 'mail@example.com',
                'group'       => 'Email'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Second text line', 'js_composer' ),
                'param_name'  => 't3_text2',
                'value'       => 'support@mail.com',
                'group'       => 'Email'
            )
        )
    )
);

// ==========================================================================================
// TABS                                                                                     -
// ==========================================================================================
vc_map( 
    array(
        'name'                    => __( 'Tabs', 'js_composer' ),
        'base'                    => 'gnoli_tabs',
        'category'                => __( 'Content', 'js_composer' ),
        'as_parent'               => array('only' => 'gnoli_tabs_item'),
        'content_element'         => true,
        'show_settings_on_create' => true,
        'description'             => __( 'Tabs Wrapper', 'js_composer'),
        'js_view'                 => 'VcColumnView',
        'params'                  => array(
            /**/
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Style', 'js_composer' ),
                'param_name'  => 'style',
                'value'       => array(
                    'Classic'  =>  'classic',
                    'Modern'   =>  'modern'
                )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Background image', 'js_composer' ),
                'param_name'  => 'image',
                'dependency'  => array( 'element' => 'style', 'value' => array('modern') )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title',
                'dependency'  => array( 'element' => 'style', 'value' => array('modern') )
            )
        )
    )
);
vc_map( 
    array(
        'name'            => __( 'Tabs item', 'js_composer' ),
        'base'            => 'gnoli_tabs_item',
        'as_child'        => array('only' => 'gnoli_tabs'),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Title', 'js_composer' ),
                'param_name'  => 'title'
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => __( 'Content', 'js_composer' ),
                'holder'      => 'div',
                'param_name'  => 'content'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Add button?', 'js_composer' ),
                'param_name' => 'btn',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Button text', 'js_composer' ),
                'param_name'  => 'btntext',
                'dependency'  => array( 'element' => 'btn', 'value' => array('yes') )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Button link', 'js_composer' ),
                'param_name'  => 'btnlink',
                'dependency'  => array( 'element' => 'btn', 'value' => array('yes') )
            )
        )
    )
);
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Gnoli_Tabs extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Gnoli_Tabs_Item extends WPBakeryShortCode {}
}

// ==========================================================================================
// PORTFOLIO LIST                                                                           -
// ==========================================================================================
vc_map( 
    array(
        'name'            => __( 'Portfolio list', 'js_composer' ),
        'base'            => 'gnoli_portfolio_list',
        'description'     => __( 'List of portfolio items', 'js_composer' ),
        'category'        => __( 'Content', 'js_composer' ),
        'params'          => array(
            array(
                'type'          => 'vc_efa_chosen',
                'heading'       => __( 'Select Categories', 'js_composer' ),
                'param_name'    => 'cats',
                'placeholder'   => __( 'Select category', 'js_composer' ),
                'value'         => gnoli_element_values( 'categories', array(
                  'sort_order'  => 'ASC',
                  'taxonomy'    => 'portfolio-category',
                  'hide_empty'  => false,
                ) ),
                'std'         => '',
                'description' => __( 'you can choose spesific categories for portfolio, default is all categories', 'js_composer' ),
            ),
            array(
                  'type'        => 'dropdown',
                  'heading'     => __( 'Style', 'js_composer' ),
                  'param_name'  => 'style',
                  'value'       => array(
                      'Simple'     => 'sim',
                      'Classic'    => 'cla',
                      'Full width' => 'ful',
                      'Big spaces' => 'big',
                      '2 cols'     => '2co',
                      '3 cols'     => '3co',
                      '4 cols'     => '4co',
                      'Wide'       => 'wid'
                )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Add category filter?', 'js_composer' ),
                'param_name' => 'filter',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Pagination', 'js_composer' ),
                'param_name'  => 'pagination',
                'value'       => array(
                    'Off'  => 'off',
                    'On' => 'on'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Count items', 'js_composer' ),
                'param_name'  => 'count'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Make as gallery?', 'js_composer' ),
                'param_name' => 'lightbox',
                'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
            )
        )
    )
);

vc_map( array(
    'name' => __( 'Row', 'js_composer' ),
    'base' => 'vc_row',
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'show_settings_on_create' => false,
    'category' => __( 'Content', 'js_composer' ),
    'description' => __( 'Place content elements inside the row', 'js_composer' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'js_composer' ),
            'param_name' => 'full_width',
            'value' => array(
                __( 'Default', 'js_composer' ) => '',
                __( 'Stretch row', 'js_composer' ) => 'stretch_row',
                __( 'Stretch row and content', 'js_composer' ) => 'stretch_row_content',
                __( 'Stretch row and content (no paddings)', 'js_composer' ) => 'stretch_row_content_no_spaces',
            ),
            'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'js_composer' )
        ),
        array(
            'type' => 'el_id',
            'heading' => __( 'Row ID', 'js_composer' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => __( 'Make all columns height equal?', 'js_composer' ),
            'param_name' => 'equal_height',
            'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' )
        ),
    ),
    'js_view' => 'VcRowView'
) );