<?php
/**
* Single
*
* @package gnoli
* @since 1.0
*
*/
get_header();
global $gnoli;
$content_size_class = ( ! empty( $gnoli['sidebar'] ) && in_array( 'post', $gnoli['sidebar'] ) ) ? 'col-md-9' : 'col-md-8 col-md-offset-2';
while ( have_posts() ) : the_post();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
    if ( ! empty( $image ) ) {
?>
        <section class="bg-cover bg-fixed pad-top-120 pad-btm-120" style="background-image: url('<?php echo esc_url( $image[0] ); ?>')">
            <div class="overlay overlay-dark-2x"></div>

            <div class="container text-light pad-top-50 pad-btm-50">
                <h2 class="title text-center"><?php the_title(); ?></h2>
                <p class="separator"></p>
            </div>
        </section>
        <div class="container">
            <div class="row mrg-top-70">
                <div class="single-content <?php echo esc_attr( $content_size_class ); ?>">
    <?php } else { ?>
        <div class="container">
            <div class="row mrg-top-10">
                    <div class="single-content <?php echo esc_attr( $content_size_class ); ?>">
                        <h3 class="title"><?php the_title(); ?></h3>
                        <div class="post-info">
                            <span><?php the_date(); ?></span>
                            <span><?php the_category(', '); ?></span>
                            <span><?php the_tags(); ?></span>
                        </div>
    <?php } ?>
                        <?php the_content(); ?>
                        <?php wp_link_pages('before=<div class="post-nav"> <span>Page: </span> &after=</div>'); ?>
                        <?php if($gnoli['gnoli_social_post']){ ?>
                            <div class="ft-part"><ul class="social-list"><li><i><?php _e( 'Share it:', 'gnoli'); ?></i></li>
                                <li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink());?>&amp;title=<?php echo esc_attr(urlencode(the_title('','', false)));?>" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>"  class="pinterest" target="_blank" title="Pin This Post"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink());?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="twitter" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a></li></ul>
                            </div>
                        <?php } ?>
                        
                        <div class="comments">
                            <?php
                            if ( comments_open() || '0' != get_comments_number()  && wp_count_comments( $post->ID ) ) {
                                comments_template( '', true );
                            }
                            ?>
                        </div>
                    </div>
                    <?php if ( ! empty( $gnoli['sidebar'] ) && in_array( 'post', $gnoli['sidebar'] ) ) { ?>
                        <div class="col-md-3 ">
                            <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'sidebar' ) ); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- PAGINATION -->
            <div class="pagination">
                <?php
                $prev_post = get_previous_post();
                if ( ! empty( $prev_post ) ) {
                ?>
                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="prev">
                        <i class="pe-7s-angle-left pe-4x"></i>
                        <span><?php _e( 'prev', 'gnoli' ); ?></span>
                    </a>
                <?php } ?>
                <a href="
                <?php 
                if( get_option( 'show_on_front' ) == 'page' ) {
                    print get_permalink( get_option('page_for_posts' ) );
                } else { 
                    echo esc_url( home_url() );
                }
                ?>
                " class="all">
                    <span><?php _e( 'all', 'gnoli' ); ?></span>
                </a>
                <?php
                $next_post = get_next_post();
                if ( ! empty( $next_post ) ) {
                ?>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next">
                        <span><?php _e( 'next', 'gnoli' ); ?></span>
                        <i class="pe-7s-angle-right pe-4x"></i>
                    </a>
                <?php } ?>
            </div>
            <p class="separator"></p>
<?php
endwhile;
get_footer(); ?>
