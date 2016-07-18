<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();
// -----------------------------------------
// POST PREVIEW OPTIONS                    -
// -----------------------------------------
$options[]    = array(
    'id'        => 'gnoli_post_options',
    'title'     => 'Post preview settings',
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'   => 'section_3',
            'fields' => array(
                array(
                    'id'          => 'post_preview_style',
                    'type'        => 'select',
                    'title'       => 'Preview style',
                    'options'     => array(
                        'image'    => 'Post image',
                        'text'     => 'Quote',
                        'audio'    => 'Soundcloud audio',
                        'video'    => 'Video',
                        'slider'   => 'Image slider'
                    ),
                    'default'     => array( 'image' )
                ),
                array(
                    'id'         => 'post_preview_text',
                    'type'       => 'wysiwyg',
                    'title'      => 'Post preview text',
                    'dependency' => array( 'post_preview_style', '==', 'text' )
                ),
                array(
                    'id'         => 'post_preview_audio',
                    'type'       => 'wysiwyg',
                    'title'      => 'Soundcloud iframe',
                    'dependency' => array( 'post_preview_style', '==', 'audio' )
                ),
                array(
                    'id'         => 'post_preview_video',
                    'type'       => 'wysiwyg',
                    'title'      => 'Video iframe code',
                    'dependency' => array( 'post_preview_style', '==', 'video' )
                ),
                array(
                    'id'          => 'post_preview_slider',
                    'type'        => 'gallery',
                    'title'       => 'Slider images',
                    'add_title'   => 'Add Images',
                    'edit_title'  => 'Edit Images',
                    'clear_title' => 'Remove Images',
                    'dependency' => array( 'post_preview_style', '==', 'slider' )
                )
            )
        )
    )
);
// -----------------------------------------
// Portfolio Options                       -
// -----------------------------------------
$options[]    = array(
    'id'        => 'gnoli_portfolio_options',
    'title'     => 'Portfolio details',
    'post_type' => 'portfolio',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(
        array(
            'name'   => 'section_4',
            'fields' => array(
                array(
                    'id'          => 'slider',
                    'type'        => 'gallery',
                    'title'       => 'Image gallery',
                    'add_title'   => 'Add Images',
                    'edit_title'  => 'Edit Images',
                    'clear_title' => 'Remove Images',
                ),
                array(
                    'id'    => 'portfolio_customer',
                    'type'  => 'text',
                    'title' => 'Project customer'
                )
            )
        )
    )
);

CSFramework_Metabox::instance( $options );
