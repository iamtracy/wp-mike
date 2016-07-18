<?php
/**
 * Custom Page Template
 *
 * @package gnoli
 * @since 1.0
 *
 */
global $gnoli;
get_header();
if ( $gnoli['page_navigation'] == true ) {

    $pages = get_pages_for_navi();

    $current = array_search($post->ID, $pages);

    $prevID = (!empty($pages[$current-1])) ? $pages[$current-1] : $pages[count($pages)-1];

    $nextID = (!empty($pages[$current+1])) ? $pages[$current+1] : '';


    if ( ! empty( $prevID ) ) {
        $prev_post_title = get_the_title( $prevID );
        $prev_title = implode( ' ', preg_split( '//u', $prev_post_title, -1, PREG_SPLIT_NO_EMPTY ) );
        $prev_title = str_replace( "   ", " &nbsp; ", $prev_title );
    ?>
        <a class="side-link left animsition-link" href="<?php echo esc_url( get_page_link($prevID) ); ?>" data-animsition-out="fade-out-right-sm">
            <div class="side-arrow"></div>
            <div class="side-title"><?php echo esc_html( $prev_title ); ?></div>
        </a>
    <?php }

    if ( ! empty( $nextID ) ) {    
        $next_post_title = get_the_title($nextID);
        $next_title = implode( ' ', preg_split( '//u', $next_post_title, -1, PREG_SPLIT_NO_EMPTY ) );
        $next_title = str_replace( "   ", " &nbsp; ", $next_title );
    ?>
        <a class="side-link right animsition-link" href="<?php echo esc_url( get_page_link($nextID) ); ?>" data-animsition-out="fade-out-left-sm">
            <div class="side-arrow"></div>
            <div class="side-title"><?php echo esc_html( $next_title ); ?></div>
        </a>
<?php
    }
}
while ( have_posts() ) : the_post();
$content = get_the_content();
if ( ! strpos( $content, 'vc_' ) ) {
    if ( get_the_title() ) { ?>
        <div class="container equal-height">
            <div class="row">
                <h3 class="no-vc"><?php the_title(); ?></h3>
                <?php the_content(); ?>
            </div>
        </div>
    <?php }
} else { ?>
<div class="hero">
    <?php the_content(); ?>
</div>
<?php } 
if ( comments_open() ) { ?>
    <div class="comments container">
        <?php comments_template( '', true ); ?>
    </div>
<?php } ?>
<?php
endwhile;
get_footer();
?>
