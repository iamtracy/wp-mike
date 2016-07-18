<?php
/**
*
* Portfolio list
* @since 1.0.0
* @version 1.1.0
*
*/
function gnoli_portfolio_list( $atts, $content = '', $id = '' ) {
    global $gnoli;

    extract( shortcode_atts( array(
        'cats'     => '',
        'style'    => 'sim',
        'filter'   => '',
        'pagination'=>'',
        'count'    => '',
        'lightbox' => ''
        ), $atts ) );


    $sizes = array(
        'sim' => array( 'tall', '', '', 'wide-tall', 'tall', 'wide', '', 'tall', 'tall', '', ),
        'ful' => array( 'tall', '', '', 'wide-tall', 'tall', 'wide', '', 'tall', 'tall', '', ),
        'big' => array( 'tall', '', '', 'wide-tall', 'tall', 'wide', '', 'tall', 'tall', '', ),
        '2co' => array( 'tall', '', '', 'tall', 'tall', 'wide', '', 'tall', 'tall', '', ),
        '4co' => array( 'tall', '', '', 'wide-tall', 'tall', 'tall', 'tall', '', '', ),
        'cla' => array( '', '', '', '', '', '', '', '', '' ),
        '3co' => array( 'tall', '', '', 'wide-tall', 'tall', 'wide', 'tall', 'tall', '', '' ),
        'wid' => array( 'wide', 'wide', 'wide', 'wide', 'wide', 'wide', 'wide', 'wide', 'wide', )
    );

    $classes = array(
        'sim' => array( 'with-borders', 'col-3', '', ),
        'ful' => array( 'fullwidth', 'col-3', '', ),
        'big' => array( 'container', 'col-3', '50', ),
        '2co' => array( 'container', 'col-2', '10', ),
        '4co' => array( 'fullwidth', 'col-4', '', ),
        'cla' => array( 'container', 'col-3', '20', ),
        '3co' => array( 'container', 'col-3', '20', ),
        'wid' => array( 'container', 'col-2', '', ),
    );

    $data = ( ! empty( $classes[$style][2] ) ) ? 'data-space=' . $classes[$style][2] . '' : '';
    $count = ( ! empty( $count ) && is_numeric( $count ) ) ? $count : 9;
    $pagination = ( ! empty( $pagination ) && $pagination == 'off' ) ? '' : $pagination;
    $category = '';
    $tax_query = array();
    if ( ! empty( $cats) ) {
        $tax_query =  array(
            array(
                'taxonomy'  => 'portfolio-category',
                'field'     => 'term_id',
                'terms'     => explode( ',', $cats ),
            )
        );
    }

       $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
       $args['paged'] = $paged; 

    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $count,
        'paged'     =>  $paged,
        'tax_query' => $tax_query
    );

    if( $filter == 'yes' ) {
    ?>
        <div class="filter">
            <ul>
                <li data-group="all" class="active">all</li>
                <?php
                $categories = get_terms( 'portfolio-category', '' );
                foreach ( $categories as $category ) {
                    if ( ! empty( $cats ) ) {
                        if ( in_array( $category->term_id, explode( ',', $cats ) ) !== false ) {
                            print '<li data-group="' . $category->slug . '">' . $category->name . '</li>';
                        }
                    } else {
                        print '<li data-group="' . $category->slug . '">' . $category->name . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    <?php } ?>
        <div class="portfolio-wrapper <?php echo esc_html( $classes[$style][0] ); ?>">
            <div class="portfolio <?php echo esc_html( $classes[$style][1] ); ?>" <?php echo esc_html( $data ); ?>>
    <?php

    $counter = 0;
    $post = new WP_Query( $args );
    ob_start();
    $q = new WP_Query( $args );
    if ( $q->have_posts() ) while ( $q->have_posts() ) : $q->the_post();

        if ( $counter == count( $sizes[$style] ) ) {
            $counter = 0;
        }

        $portfolio_category = '';
        $categories = get_the_terms( $q->ID , 'portfolio-category' );
        if( $categories ) {
            foreach ( $categories as $categorsy ) {
                $portfolio_category .= $categorsy->slug . ' ';
            }
        }

        $img_url = ( get_post_thumbnail_id( $q->ID ) ) ? wp_get_attachment_url( get_post_thumbnail_id( $q->ID ) ) : $gnoli['default_portfolio_image'];
        $gallery = ( ! empty( $lightbox ) && $lightbox == 'yes' ) ? 'gallery-item' : '';
        $permalink = ( $gallery != 'gallery-item' ) ? get_the_permalink() : $img_url;
        ?>
            <div class="item <?php echo esc_attr( $sizes[$style][$counter] ); ?>" data-groups="<?php echo esc_attr( trim( $portfolio_category ) ); ?>">
                <a href="<?php echo esc_url( $permalink ); ?>" class="item-link <?php echo esc_attr( $gallery ); ?>">
                    <div class="item-img" style="background-image: url('<?php echo esc_url( $img_url ); ?>')"></div>
                    <div class="item-overlay">
                        <h5><?php the_title(); ?></h5>
                    </div>
                </a>
            </div>
        <?php $counter++;
        endwhile; ?>
        <?php wp_reset_query(); ?>       
    </div>
</div>
<?php if( $pagination == 'on' ) {?>
<div class="pagination clearfix simple-block cs-pager">
    <?php 
    $big = 999999999;
    echo paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?page=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $post->max_num_pages,
        'prev_text' => '',
        'next_text' => ''
    ) ); 
}?>
</div>
<?php return ob_get_clean();
}

add_shortcode( 'gnoli_portfolio_list', 'gnoli_portfolio_list' );
