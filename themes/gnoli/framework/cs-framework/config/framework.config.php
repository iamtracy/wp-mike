<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings      = array(
  'menu_title' => 'Theme Options',
  'menu_type'  => 'add_menu_page',
  'menu_slug'  => 'cs-framework',
  'ajax_save'  => false,
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// general option section
// ----------------------------------------
$options[]      = array(
  'name'        => 'general',
  'title'       => 'General',
  'icon'        => 'fa fa-globe',
  'fields'      => array(
    array(
        'id'      => 'page_navigation',
        'type'    => 'switcher',
        'title'   => 'Page navigation',
        'default' => false
    ),
    array(
        'id'       => 'sidebar',
        'type'     => 'checkbox',
        'title'    => 'Show sidebar on pages:',
        'options'  => array(
            'post'  => 'Post',
            'blog'  => 'Blog'
        )
    ),
    //Site logo
    array(
        'id'          => 'site_logo',
        'type'        => 'radio',
        'title'       => 'Type of site logo',
        'options'     => array(
            'txtlogo'  => 'Text Logo',
            'imglogo'  => 'Image Logo',
        ),
        'default'     => array('imglogo'),
    ),
    array(
        'id'         => 'text_logo',
        'type'       => 'text',
        'title'      => 'Text Logo',
        'default'    => 'Gnoli',
        'dependency' => array( 'site_logo_txtlogo', '==', 'true' ),
    ),
    array(
        'id'          => 'text_logo_style',
        'type'        => 'radio',
        'title'       => 'Text logo style',
        'options'     => array(
            'default'  => 'Default',
            'custom'   => 'Custom',
        ),
        'default'     => array('default'),
        'dependency'  => array( 'site_logo_txtlogo', '==', 'true' )
    ),
    array(
        'id'         => 'text_logo_width',
        'type'       => 'text',
        'title'      => 'Max width logo section',
        'default'    => '70px',
        'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
    ),
    array(
        'id'         => 'text_logo_color',
        'type'       => 'color_picker',
        'title'      => 'Text Logo Color',
        'default'    => '#fff',
        'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
    ),
    array(
        'id'         => 'text_logo_font_size',
        'type'       => 'text',
        'title'      => 'Text logo font size',
        'desc'       => 'By default the logo have 20px font size',
        'default'    => '20px',
        'dependency' => array( 'text_logo_style_custom|site_logo_txtlogo', '==|==', 'true|true' )
    ),
    array(
        'id'         => 'image_logo',
        'type'       => 'upload',
        'title'      => 'Site Logo',
        'default'    => get_template_directory_uri().'/assets/images/logo.png',
        'desc'       => 'Upload any media using the WordPress Native Uploader.',
        'dependency' => array( 'site_logo_imglogo', '==', 'true' ),
    ),
    array(
        'id'          => 'img_logo_style',
        'type'        => 'radio',
        'title'       => 'Image logo style',
        'options'     => array(
            'default'  => 'Default',
            'custom'   => 'Custom',
        ),
        'default'     => array('default'),
        'dependency'  => array( 'site_logo_imglogo', '==', 'true' )
    ),
    array(
        'id'         => 'img_logo_width',
        'type'       => 'text',
        'title'      => 'Site Logo Width Size*',
        'desc'       => 'By default the logo have 60px width size',
        'dependency' => array( 'img_logo_style_custom|site_logo_imglogo', '==|==', 'true|true' )
    ),
    array(
        'id'         => 'img_logo_height',
        'type'       => 'text',
        'title'      => 'Site Logo Height Size*',
        'desc'       => 'By default the logo have 52px height size',
        'dependency' => array( 'img_logo_style_custom|site_logo_imglogo', '==|==', 'true|true' )
    ),

    //Favicon
    array(
        'id'         => 'site_favicon',
        'type'       => 'upload',
        'title'      => 'Browser Favicon (16x16)*',
        'desc'       => 'Upload Favicon icon of size 16x16',
        'default'    => get_template_directory_uri().'/assets/images/favicon.png',
    ),

  ) // end: fields
);
// ----------------------------------------
// Blog option section
// ----------------------------------------
$options[]      = array(
  'name'        => 'blog',
  'title'       => 'Blog',
  'icon'        => 'fa fa-newspaper-o',
  'fields'      => array(
    array(
        'id'      => 'gnoli_social_post',
        'type'    => 'switcher',
        'title'   => 'Social sharing in posts',
        'default' => false
    ),
    array(
        'id'         => 'default_post_image',
        'type'       => 'upload',
        'title'      => 'Default post preview image',
        'default'    => get_template_directory_uri().'/assets/images/post.jpg'
    ),

  ) // end: fields
);
// ----------------------------------------
// Portfolio option section
// ----------------------------------------
$options[]      = array(
  'name'        => 'portfolio',
  'title'       => 'Portfolio',
  'icon'        => 'fa fa-file-text-o',
  'fields'      => array(
    array(
        'id'      => 'gnoli_social_portfolio',
        'type'    => 'switcher',
        'title'   => 'Social sharing in portfolio',
        'default' => false
    ),
    array(
        'id'      => 'portfolio_tags',
        'type'    => 'switcher',
        'title'   => 'Show Portfolio tags',
        'default' => false
    ),
    array(
        'id'         => 'default_portfolio_image',
        'type'       => 'upload',
        'title'      => 'Default portfolio image',
        'default'    => get_template_directory_uri().'/assets/images/portfolio.jpg'
    ),
    array(
        'id'          => 'portfolio_list_page',
        'type'        => 'text',
        'title'       => 'Portfolio list page URL',
        'options'     => 'pages'
    ),

  ) // end: fields
);

// ----------------------------------------
// Footer option section                  -
// ----------------------------------------
$options[]      = array(
    'name'        => 'footer',
    'title'       => 'Footer',
    'icon'        => 'fa fa-copyright',
    'fields'      => array(
        array(
            'id'      => 'scroll_top',
            'type'    => 'switcher',
            'title'   => 'Scroll top button',
            'default' => true
        ),
        array(
            'id'      => 'sticky_footer',
            'type'    => 'switcher',
            'title'   => 'Sticky footer',
            'default' => false
        ),
        // Footer left side.
        array(
            'id'         => 'footer_text',
            'type'       => 'text',
            'title'      => 'Footer text',
            'default' => '&copy; 2015 Gnoli. By AchtungStudio.'
        ),
        // Footer right side.
        array(
            'id'           => 'footer_social',
            'type'         => 'group',
            'title'        => 'Footer social links',
            'button_title' => 'Add New',
            'fields'       => array(
                array(
                    'id'          => 'footer_social_link',
                    'type'        => 'text',
                    'title'       => 'Link'
                ),
                array(
                    'id'          => 'footer_social_icon',
                    'type'        => 'icon',
                    'title'       => 'Icon'
                )
            ),
            'default' => array(
                array(
                    'footer_social_link' => 'https://www.facebook.com/',
                    'footer_social_icon' => 'fa fa-facebook'
                ),
                array(
                    'footer_social_link' => 'https://www.linkedin.com/',
                    'footer_social_icon' => 'fa fa-linkedin'
                ),
                array(
                    'footer_social_link' => 'https://instagram.com/',
                    'footer_social_icon' => 'fa fa-instagram'
                ),
                array(
                    'footer_social_link' => 'https://twitter.com/',
                    'footer_social_icon' => 'fa fa-twitter'
                ),
            )
        )
    ) // end: fields
);

// ----------------------------------------
// Custom CSS section
// ----------------------------------------
$options[]  = array(
    'name'      => 'custom-css-header',
    'title'     => 'Сustom CSS',
    'icon'      => 'fa fa-cog',
    'fields'    => array(

        array(
            'title'     => 'Сustom CSS',
            'id'        => 'custom-css',
            'type'      => 'textarea',
            'attributes'    => array(
                'placeholder' => 'Insert CSS Code',
                'rows'        => 20,
              ),
        ),
    ),
);
// ----------------------------------------
// 404 Page                               -
// ----------------------------------------
$options[]      = array(
  'name'        => 'error_page',
  'title'       => '404 Page',
  'icon'        => 'fa fa-bolt',

  // begin: fields
  'fields'      => array(
    array(
        'id'      => 'error_title',
        'type'    => 'text',
        'title'   => 'Error Title',
        'default' => 'Page not found',
    ),
    array(
        'id'      => 'error_btn_text',
        'type'    => 'textarea',
        'title'   => 'Error button text',
        'default' => 'Go home',
    ),   
    array(
        'id'         => 'image_404',
        'type'       => 'upload',
        'title'      => '404 page background',
        'default'    => get_template_directory_uri().'/assets/images/404.jpg'
    ),
  ) // end: fields
);
// ------------------------------
// a separator                  -
// ------------------------------
$options[]  = array(
    'name'      => 'separator_2',
    'title'     => '',
    'icon'      => ''
);
// ----------------------------------------
// Backup
// ----------------------------------------
$options[]   = array(
  'name'     => 'backup_section',
  'title'    => 'Backup',
  'icon'     => 'fa fa-shield',

  // begin: fields
  'fields'   => array(

    array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => 'You can save your current options. Download a Backup and Import.',
    ),
    
    array(
        'type'    => 'backup',
    ),

  )  // end: fields
);

CSFramework::instance( $settings, $options );
