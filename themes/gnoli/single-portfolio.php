<?php
/**
* Single portfolio
*
* @package gnoli
* @since 1.0
*
*/
get_header();
global $gnoli;
$portfolio_meta = get_post_meta( $post->ID, 'gnoli_portfolio_options' );
while ( have_posts() ) : the_post();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
	$image = ( ! empty( $image ) ) ? $image[0] : $gnoli['default_portfolio_image'];
	$cats = get_the_category_list( ', ' );
	print_r($cats);
?>
	<section class="bg-cover bg-fixed pad-top-120 pad-btm-120" style="background-image: url('<?php echo esc_url( $image ); ?>')">
		<div class="overlay overlay-dark"></div>
		<div class="container text-light pad-top-50 pad-btm-50">
			<h2 class="title text-center"><?php the_title(); ?></h2>
			<p class="separator"></p>
		</div>
	</section>
	<div class="container">
		<div class="row mrg-top-70">
			<div class="col-md-4">
			<!-- PROJECT INFO -->
				<?php
                    $terms = get_the_terms( $post->ID , 'portfolio-category' );
                    if( ! empty( $terms ) ) {
                        print '<h6 class="title bold">' . __( 'Category', 'gnoli' ) . '</h6><p>';
                        $cats = array();
                        foreach ( $terms as $term ) {
                            $cats[] = $term->name;
                        }
                        $cat = implode( ', ', $cats);
                        print $cat . '</p>';
                    }
                ?>
				<h6 class="title bold"><?php _e( 'Date', 'gnoli' ); ?></h6>
				<p class="small"><?php echo esc_html( get_the_date() ); ?></p>
				<?php if( $gnoli['portfolio_tags'] ) { ?>
					<?php 
						$terms = get_the_terms( $post->ID , 'portfolio-tag' );
		                if( ! empty( $terms ) ) {
		                    print '<h6 class="title bold">' . __( 'Tags', 'gnoli' ) . '</h6><p class="small">';
		                    $cats = array();
		                    foreach ( $terms as $term ) {
		                    	$term_link = get_term_link( $term );
		                        $cats[] = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
		                        //$cats[] = $term->name;
				            }
		                    $cat = implode( ', ', $cats);
		                    print $cat . '</p>';
	                   	}
					?>
				<?php } ?>
				<?php if ( ! empty( $portfolio_meta[0]['portfolio_customer'] )) { ?>
					<h6 class="title bold"><?php _e( 'Client', 'gnoli' ); ?></h6>
					<p class="small"><?php echo esc_html( $portfolio_meta[0]['portfolio_customer'] );?></p>
				<?php } ?>
				<?php if($gnoli['gnoli_social_portfolio']){ ?>
                        <?php { ?><h6 class="title bold">Share it:</h6><?php } ?>
                        <div class="ft-part-portfolio"><ul class="social-list-portfolio">
                            <li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink());?>&amp;title=<?php echo esc_attr(urlencode(the_title('','', false)));?>" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						    <li><a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>"  class="pinterest" target="_blank" title="Pin This Post"><i class="fa fa-pinterest"></i></a></li>
						    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink());?>&amp;t=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
						    <li><a href="http://twitter.com/home?status=<?php echo esc_url(urlencode(the_title('', '', false))); ?><?php esc_url(the_permalink()); ?>" class="twitter" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a></li>
						    <li><a href="http://plus.google.com/share?url=<?php esc_url(the_permalink()); ?>&amp;title=<?php echo esc_attr(urlencode(the_title('', '', false))); ?>" target="_blank" class="gplus"><i class="fa fa-google-plus"></i></a></li></ul>
                        </div>
                <?php } ?>
				<!-- /PROJECT INFO -->
			</div>
			<div class="col-md-8">
				<!-- PROJECT INFO -->
				<h6 class="title bold"><?php _e( 'About', 'gnoli' ); ?></h6>
				<?php the_content(); ?>
				<!-- /PROJECT INFO -->
			</div>
		</div>
		<div class="row mrg-top-70 portfolio-gallery">
			<?php 
			if ( ! empty( $portfolio_meta[0]['slider'] ) ) { 
				$sizes = array( 6, 6, 12 );
				$images = explode( ',', $portfolio_meta[0]['slider'] );
				$counter = 0;
				$output = '';
				foreach ( $images as $image ) {
					$counter = ( $counter > 2 ) ? 0 : $counter;
					$counter = ( $counter == count( $images ) ) ? 0 : $counter;
					$url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
					$title = get_post_meta( $image, '_wp_attachment_image_alt', true );

					$output .= '<div class="col-md-' . $sizes[$counter] . ' pad-20">';
					$output .= '<a href="' . $url . '" class="gallery-item" title="' . $title . '">';
					$output .= '<img src="' . $url . '" alt="">';
					$output .= '</a>';
					$output .= '</div>';
					$counter++;
				}
				print $output;
			}
			?>
		</div>
	</div>
	<!-- PAGINATION -->
	<div class="pagination">
		<?php
        $prev_post = get_previous_post(  );
        if ( ! empty( $prev_post ) ) {
        ?>
            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="prev">
	            <i class="pe-7s-angle-left pe-4x"></i>
	            <span><?php _e( 'prev', 'gnoli' ); ?></span>
            </a>
        <?php } 
        if ( ! empty( $gnoli['portfolio_list_page'] ) ) { ?>
			<a href="<?php echo esc_url( $gnoli['portfolio_list_page'] ); ?>" class="all">
				<span><?php _e( 'all', 'gnoli'); ?></span>
			</a>
		<?php } 
        $next_post = get_next_post( );
        if ( ! empty( $next_post ) ) {
        ?>
            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next">
                <span><?php _e( 'next', 'gnoli' ); ?></span>
                <i class="pe-7s-angle-right pe-4x"></i>
            </a>
        <?php } ?>
	</div>
	<p class="separator"></p>
	<!-- /PAGINATION -->
<?php 
endwhile;
get_footer(); 
?>