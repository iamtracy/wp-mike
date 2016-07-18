<?php
/**
 * Index Page
 *
 * @package gnoli
 * @since 1.0
 *
 */
global $gnoli;
$content_size_class = ( ! empty( $gnoli['sidebar'] ) && in_array( 'blog', $gnoli['sidebar'] ) ) ? ' col-md-9' : '';
$post_size_class = ( ! empty( $gnoli['sidebar'] ) && in_array( 'blog', $gnoli['sidebar'] ) ) ? 6 : 4;
get_header(); ?>
<?php if ( have_posts() ) : ?>
    <div class="container">
        <div class="row">
            <div class="blog<?php echo esc_attr( $content_size_class ); ?>">
                <?php while ( have_posts() ) : the_post(); 
                    $post_options = get_post_meta( $post->ID, 'gnoli_post_options' ); ?>
                    <div class="post col-md-<?php echo esc_attr( $post_size_class ); ?> col-sm-6">
                        <a href="<?php the_permalink(); ?>">
                            <?php if( isset( $post_options[0]['post_preview_style'] ) && $post_options[0]['post_preview_style'] != 'text' &&  (get_post_format( $post->ID ) != 'quote') || ! isset( $post_options[0]['post_preview_style'] ) ) { gnoli_blog_item_hedeader( $post_options, $post->ID ); } ?>
                            <div <?php post_class('post-content'); ?>>
                                <h5 class="title"><?php the_title(); ?></h5>
                                <p class="date"><?php the_time( get_option( 'date_format' ) ); ?></p>
                                <?php if( isset( $post_options[0]['post_preview_style'] ) && $post_options[0]['post_preview_style'] == 'text' || (get_post_format( $post->ID ) == 'quote') ) { gnoli_blog_item_hedeader( $post_options, $post->ID ); } ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php if ( ! empty( $gnoli['sidebar'] ) && in_array( 'blog', $gnoli['sidebar'] ) ) { ?>
                <div class="col-md-3">
                    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar' ) ); ?>
                </div>
            <?php } ?>
            <div id="pager">
                <?php print paginate_links(); ?>
            </div>
        </div>
    </div>
    <?php else : ?>
        <div class="empty-post-list">
            <?php _e('Sorry, no posts matched your criteria.', 'gnoli' ); ?>
            <?php get_search_form( true ); ?>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>
