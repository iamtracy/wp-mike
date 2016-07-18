<?php

/*
    Template Name: DNU Demo Reel
*/
?>
<?php 
/*
You may want to use oEmbed discovery instead of hard-coding the oEmbed endpoint.
*/
$oembed_endpoint = 'http://vimeo.com/api/oembed';
// Grab the video url from the url, or use default
$video_url1 = ($_GET['url']) ? $_GET['url'] : 'https://vimeo.com/126499890';
$video_url2 = ($_GET['url']) ? $_GET['url'] : 'https://vimeo.com/78818245';
$video_url3 = ($_GET['url']) ? $_GET['url'] : 'https://vimeo.com/94876670';
$video_url4 = ($_GET['url']) ? $_GET['url'] : 'https://vimeo.com/41850184';
$video_url5 = ($_GET['url']) ? $_GET['url'] : 'https://vimeo.com/68421447';
// Create the URLs
$json_url1 = $oembed_endpoint . '.json?url=' . rawurlencode($video_url1) . '&width=640&color=ff0000';
$json_url2 = $oembed_endpoint . '.json?url=' . rawurlencode($video_url2) . '&width=640';
$json_url3 = $oembed_endpoint . '.json?url=' . rawurlencode($video_url3) . '&width=640';
$json_url4 = $oembed_endpoint . '.json?url=' . rawurlencode($video_url4) . '&width=640';
$json_url5 = $oembed_endpoint . '.json?url=' . rawurlencode($video_url5) . '&width=640';
// Curl helper function
function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}
// Load in the oEmbed XML
$oembed1 = json_decode(curl_get($json_url1));
$oembed2 = json_decode(curl_get($json_url2));
$oembed3 = json_decode(curl_get($json_url3));
$oembed4 = json_decode(curl_get($json_url4));
$oembed5 = json_decode(curl_get($json_url5));
/*
    An alternate approach would be to load JSON,
    then use json_decode() to turn it into an array.
*/
?>

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
            <div class="blog">
                    <div class="post col-md-12 col-sm-12">
                        <!-- <h1 class="logo"><?php echo $oembed->title ?></h1>
                        <h2 class="logo">by <a href="<?php echo $oembed->author_url ?>"><?php echo $oembed->author_name ?></a></h2> -->
                    <?php echo html_entity_decode($oembed1->html) ?>
                    </div>
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
        <div class="row">
            <div class="blog">
                    <div class="post col-md-6 col-sm-12">
                        <?php echo html_entity_decode($oembed2->html) ?>
                    </div>
                    <div class="post col-md-6 col-sm-12">
                        <?php echo html_entity_decode($oembed3->html) ?>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="blog">
                    <div class="post col-md-6 col-sm-12">
                        <?php echo html_entity_decode($oembed4->html) ?>
                    </div>
                    <div class="post col-md-6 col-sm-12">
                        <?php echo html_entity_decode($oembed5->html) ?>
                    </div>
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



