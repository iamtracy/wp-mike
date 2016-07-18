<?php
/**
 * Requried functions for theme backend.
 *
 * @package gnoli
 * @subpackage Template
 */

/**
*
* @return array of icon
* @param  none
* returns array of icons
*
**/
function get_icons() {
  $icons = array('map', 'winner', 'time', 'pig', 'adjust', 'team', 'works', 'chat', 'notes', 'camera', 'illustration', 'social', 'vector', 'commerce', 'search', 'like', 'share', 'apple', 'balance', 'beaker', 'beer', 'books', 'box', 'cake', 'calculator', 'cd', 'champagne', 'chart', 'cheese', 'court', 'delivery', 'dvd', 'eco', 'film', 'grape', 'hot', 'house', 'icecream', 'joystick', 'keynote', 'link', 'magic', 'mail', 'microphone', 'network', 'palette', 'plaster', 'player', 'player', 'polaroid', 'printer', 'pluse', 'quote', 'radio', 'recorder', 'scissors', 'select', 'serving', 'share', 'shop', 'shopping', 'smartphone', 'sofa', 'syringe', 'tape', 'target', 'television', 'video', 'walkman', 'zoom', 'tags');
  return array_combine($icons, $icons);
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'gnoli_element_values' ) ) {
  function gnoli_element_values(  $type = '', $query_args = array() ) {
 
    $options = array();
     
    switch( $type ) {
     
      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;
       
      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->post_title);
        }
      }
      break;
       
      case 'tags':
      case 'tag':

      $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
        if ( !empty($tags) ) {
          foreach ( $tags as $tag ) {
            $options[$tag->name] = $tag->term_id;
        }
      }
      break;
       
      case 'categories':
      case 'category':

      $categories = get_categories( $query_args );

      if ( !empty($categories) ) {

        if(is_array($categories)){
          foreach ( $categories as $category ) {
            $options[$category->name] = $category->term_id;
          }
        }
        
      }
      break;
       
      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }
   
    return $options;
    
  }
}

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( !function_exists( 'gnoli_the_post_thumbnail' ) ) {
  function gnoli_the_post_thumbnail() {
    the_post_thumbnail( 'full' );
    get_post_format();
  }
}

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( !function_exists( 'gnoli_get_options' ) ) {
  function gnoli_get_options() {
    global $gnoli;
    $gnoli = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );
  }
  add_action( 'wp', 'gnoli_get_options' );
}

/**
*
* @return Social icon links
* @param  none
*
**/
if (! function_exists('gnoli_social') ) {
  function gnoli_social() { ?>
    <div class="ft-part"><ul class="social-list"><li><i><?php _e( 'Share it:', 'gnoli'); ?></i></li>
    <li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink());?>&amp;title=<?php echo esc_attr(urlencode(the_title('','', false)));?>" target="_blank" class="linkedin"></a></li>
    <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>"  class="pinterest" title="Pin This Post"></a></li>
    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink());?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="facebook" target="_blank"></a></li>
    <li><a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="twitter" target="_blank"></a></li>
    <li><a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" target="_blank" class="gplus"></a></li></ul></div>
  <?php }
}

/**
 * 
 * Get first "url" from post content or string
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'gnoli_get_first_url_from_string' ) ) {
  function gnoli_get_first_url_from_string( $string ) {
    $pattern  = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    preg_match( $pattern, $string, $link );
    return ( !empty( $link[0] ) ) ? $link[0] : false;
  }
}

/**
 * 
 * Custom Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('gnoli_get_shortcode_regex') ) {
  function gnoli_get_shortcode_regex( $tagregexp = '' ) {
    // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
    // Also, see shortcode_unautop() and shortcode.js.
    return
      '\\['                                // Opening bracket
      . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
      . "($tagregexp)"                     // 2: Shortcode name
      . '(?![\\w-])'                       // Not followed by word character or hyphen
      . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
      .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
      .     '(?:'
      .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
      .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
      .     ')*?'
      . ')'
      . '(?:'
      .     '(\\/)'                        // 4: Self closing tag ...
      .     '\\]'                          // ... and closing bracket
      . '|'
      .     '\\]'                          // Closing bracket
      .     '(?:'
      .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
      .             '[^\\[]*+'             // Not an opening bracket
      .             '(?:'
      .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
      .                 '[^\\[]*+'         // Not an opening bracket
      .             ')*+'
      .         ')'
      .         '\\[\\/\\2\\]'             // Closing shortcode tag
      .     ')?'
      . ')'
      . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
  }
}

/**
 * 
 * Tag Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'gnoli_tagregexp' ) ) {
  function gnoli_tagregexp() {
    return apply_filters( 'artis_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|cs_media' );
  }
}

/**
 *
 * POST FORMAT: VIDEO & AUDIO
 *
 */
if( ! function_exists( 'gnoli_post_media' ) ) {
  function gnoli_post_media( $content ) {
    $result = strpos ($content, 'iframe');
    if ($result === FALSE) {
      $media = gnoli_get_first_url_from_string( $content );
      if( ! empty( $media ) ) {
        global $wp_embed;
        $content  = do_shortcode( $wp_embed->run_shortcode( '[embed]'. $media .'[/embed]' ) );
      } else {
        $pattern = gnoli_get_shortcode_regex( gnoli_tagregexp() );
        preg_match( '/'.$pattern.'/s', $content, $media );
        if ( ! empty( $media[2] ) ) {
          if( $media[2] == 'embed' ) {
            global $wp_embed;
            $content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
          } else {
            $content = do_shortcode( $media[0] );
          }
        }
      }
      if( ! empty( $media ) ) {
        $output = $content;
        return $output;
      }
      return false;
    } else {
      return $content;
    }
  }
}

/**
 *
 * Create custom html structure for comments
 *
 */
function gnoli_comment( $comment, $args, $depth ) {

  $GLOBALS['comment'] = $comment;

  $reply_class = ( $comment->comment_parent ) ? 'indented' : '';
  switch ( $comment->comment_type ):
    case 'pingback':
    case 'trackback':
      ?>
        <p>
          <?php _e( 'Pingback:', 'gnoli' ); ?> <?php comment_author_link(); ?>
          <?php edit_comment_link( __( '(Edit)', 'gnoli' ), '<span class="edit-link">', '</span>' ); ?>
        </p>
      <?php
      break;
    default:
      // generate comments
      ?>
        <li <?php comment_class('ct-part'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
          <p class="comment-title <?php print $reply_class; ?>">
            <strong><?php comment_author_link(); ?></strong>
            <sub><i>
              <?php
                printf( '%3$s', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( get_comment_date(), get_comment_time() )); print '&nbsp;';
                comment_reply_link(
                  array_merge( $args,
                    array(
                      'reply_text' => __( 'Reply &raquo;', 'gnoli' ),
                      'after' => '',
                      'depth' => $depth,
                      'max_depth' => $args['max_depth']
                    )
                  )
                );
              ?>
            </i></sub>
          </p>
          <?php comment_text(); ?>
        </div>
      <?php
      break;
  endswitch;
}

/*
 * Site logo function.
 */
function gnoli_site_logo() {
  global $gnoli;
  $output = '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo">';

  if ( $gnoli['site_logo'] == 'txtlogo' ) {
    $output .= $gnoli['text_logo'];
  } else {
    $output .= '<img src="' . $gnoli['image_logo'] . '" alt="LOGO">';
  }
  $output .= '</a>';
  print $output;
}

/*
 * Blog item header.
 */
function gnoli_blog_item_hedeader( $option, $post_id ) {
  global $gnoli;
  $format = get_post_format( $post_id );
  if ( isset( $option[0]['post_preview_style'] ) ) {
    switch ( $option[0]['post_preview_style'] ) {
      case 'image':
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        if ( empty( $image ) && ($format != 'quote') ) {
          $image[0] = $gnoli['default_post_image'];
        }
        $output  = '<div class="post-media">';
        $output .= '<img src="' . $image[0] . '">';
        $output .= '</div>';
        break;
      case 'video':
        $output  = '<div class="post-media video-container">';
        $output .= gnoli_post_media($option[0]['post_preview_video']);
        $output .= '</div>';
        break;
      case 'slider':
        $output  = '<div class="post-media">';
        $output .= '<div class="img-slider">';
        $output .= '<ul class="slides">';
        $images = explode( ',' , $option[0]['post_preview_slider'] );
        foreach ( $images as $image ) {
          $url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
          if( ! empty( $url ) ) {
            $output .= '<li><img src="' . $url . '" alt=""></li>';
          }
        }
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        break;
      case 'text':
        $output   = '<i class="fa fa-quote-right fa-2x"></i><blockquote>';
        $output  .= $option[0]['post_preview_text'];
        $output  .= '</blockquote>';
        break;
      case 'audio':
        $output  = '<div class="post-media">';
        $output .= gnoli_post_media($option[0]['post_preview_audio']);
        $output .= '</div>';
        break;
    }

    if ($format == 'quote') {
      $post_preview_text = $option[0]['post_preview_text'] ? $option[0]['post_preview_text'] : get_the_excerpt();
      $output   = '<i class="fa fa-quote-right fa-2x"></i><blockquote>';
      $output  .= $post_preview_text;
      $output  .= '</blockquote>';
    }

  } else {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
    if ( empty( $image ) ) {
      $image[0] = $gnoli['default_post_image'];
    }
    $output  = '<div class="post-media">';
    $output .= '<img src="' . $image[0] . '">';
    $output .= '</div>';
  }
  print $output;
}


/*
* Get Page For Navi
*/
function get_pages_for_navi(){
  $posts = get_posts("post_type=page&post_status=publish&numberposts=99999&orderby=menu_order");
  $pages = get_page_hierarchy($posts);
  $pages = array_keys($pages);
  return $pages;
}
/*
 * Helper function for shortcode Tabs.
 */
function gnoli_tabs_parser( $str, $cs_name ) {

  $title = '<ul class="tab-nav">';
  $content = '<div class="tab-panels">';

  $s = str_replace( $cs_name . ' ' , '' , $str );
  $a = explode( '[/' . $cs_name . ']', $s );
  $n = array();
  $content_array = array();
  foreach ( $a as $value ) {
    if ( ! empty( $value ) ) {
      $value2 = explode( ']', $value );
      $content_array[] = $value2[1]; 
      $value2[0] = substr( $value2[0], 1 );
      $value2[0] = str_replace( '&#8243;' , '&#8221;' , $value2[0]);
      $val = explode( '&#8221; ', $value2[0] );
      $u = array();
      foreach ( $val as $v ) {
        $v = explode( '=&#8221;', $v);
        $u[] = $v;
      }
      $n[] = $u;
    }
  }

  $tab_class = 'class="active"';
  $counter = 1;

  foreach ( $n as $tab ) {
    $tab_class = ( $counter != 1 ) ? '' : $tab_class;
    $content_array[$counter - 1] = ( $tab[0][1] == 'yes' ) ? '<p>' . $content_array[$counter - 1] . '</p><a href="' . $tab[4][1] . '" class="button outline">' . $tab[3][1] . '</a>' : '<p>' . $content_array[$counter - 1] . '</p>';
    $content_array[$counter - 1] = '<div id="tab' . $counter . '" ' . $tab_class . '>' . $content_array[$counter - 1] . '</div>';
    foreach ( $tab as $element ) {
      $title .= ( $element[0] == 'title' ) ? '<li ' . $tab_class . ' data-tabpanel="#tab' . $counter . '"><a href="#' . $element[1] . '" class="click-on-this">' . $element[1] . '</a></li>' : '';
    }
    $counter++;
  }

  $content_str = implode( ' ', $content_array );
  $title .= '</ul>';
  $content .= $content_str . '</div>';

  $output = $title . $content;
  $output = str_replace( '&#8221;' , '' , $output);
  return  $output;
}