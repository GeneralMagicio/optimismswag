<?php

if (!session_id()) {
    session_start();
}

if( function_exists('current_user_can') && current_user_can('manage_options') ){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

/* Main global variables */
define('TEMPLATEDIR', get_template_directory_uri());

/* Enable post thumbnails */
add_theme_support('post-thumbnails');

/* Define WPML home url */
$wpml_home_url = apply_filters('wpml_home_url', get_option('home'));
define('WPML_HOME_URL', $wpml_home_url);

/* manage thumbs */
add_image_size('theme-thumb-1', 1512, 633, TRUE);
add_image_size('theme-thumb-2', 976, 651, TRUE);
add_image_size('theme-thumb-3', 375, 735, TRUE);
add_image_size('theme-thumb-4', 631, 620, TRUE);


/* enable scripts - jquery */
function add_theme_js_scripts()
{
    wp_enqueue_script('jquery');
}

/* Image compression */
add_filter('jpeg_quality', function ($arg) {
    return 100;
});

add_action('wp_enqueue_scripts', 'add_theme_js_scripts', 1);

/*-----------------------------------------------------------------------------------*/
/* Theme settings data
/*-----------------------------------------------------------------------------------*/

//include ('admin-theme/admin/settings-api.php');

include('admin-theme/forms/set-crypto-address.php');

include('admin-theme/forms/set-ntfs.php');

/*-----------------------------------------------------------------------------------*/
/* Menus */
/*-----------------------------------------------------------------------------------*/

include('admin-theme/menu/menus.php');
include('admin-theme/menu/wp_bootstrap_navwalker.php');

/*-----------------------------------------------------------------------------------*/
/* Post types
/*-----------------------------------------------------------------------------------*/

include('admin-theme/post-types/post-page-post-type.php');
include('admin-theme/post-types/product-post-type.php');

/*-----------------------------------------------------------------------------------*/
/* Woocommerce
/*-----------------------------------------------------------------------------------*/

include('admin-theme/woocommerce/woocommerce.php');


/**
 * Get specific post data by selected gallery,
 * choose image thumbnail...
 *
 * @param string $postType
 * @param int $categoryId
 * @param string $imageThumb
 *
 * @return array
 */
function getSpecificPostDataByCategory($postType = 'post', $categoryId = 0, $imageThumb = 'full')
{

    $returnData = [];

    if (function_exists('wpml_object_id_filter') && $categoryId > 0) {
        $categoryId = wpml_object_id_filter($categoryId, 'category', false);
    }

    $queryArgs = array(
        'post_type' => $postType,
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 1,
    );

    if ($categoryId > 0) {
        $queryArgs['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categoryId,
                'include_children' => false,
            ]
        ];
    }

    $query = new WP_Query($queryArgs);

    if ($query->have_posts()) {

        while ($query->have_posts()) {
            $query->the_post();

            $postID = get_the_ID();

            $returnData['post_id'] = $postID;
            $returnData['post_title'] = get_the_title();
            $returnData['post_content'] = get_the_content();
            $returnData['post_excerpt'] = get_the_excerpt();
            $returnData['image'] = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageThumb);
            $returnData['permalink'] = esc_url(get_permalink($postID));
            $returnData['icon'] = get_post_meta($postID, 'icon', TRUE);
        }

    }

    wp_reset_postdata();

    return $returnData;
}

/**
 * Get post category tag
 *
 * @param array $postTags
 *
 * @return string
 */
function getFirstCategoryTag($postCategories)
{

    $count = 0;

    if ($postCategories) {

        foreach ($postCategories as $tag) {

            $count++;

            if (1 == $count) {
                return $tag->name;
            }

        }
    }

    return '';

}

/**
 * Get post category tag ID
 *
 * @param array $postTags
 *
 * @return string
 */
function getFirstCategoryID($postCategories)
{

    $count = 0;

    if ($postCategories) {

        foreach ($postCategories as $tag) {

            $count++;

            if (1 == $count) {
                return $tag->term_id;
            }

        }
    }

    return '';

}


/**
 * Disable showing author page in RSS and og meta tags
 */
add_filter( 'oembed_response_data', 'disable_embeds_filter_oembed_response_data_' );
function disable_embeds_filter_oembed_response_data_( $data ) {
    unset($data['author_url']);
    unset($data['author_name']);
    return $data;
}

function disable_author_page() {
    global $wp_query;

    // If an author page is requested, redirects to the home page
    if ( $wp_query->is_author ) {
        wp_safe_redirect( get_bloginfo( 'url' ), 301 );
        exit;
    }

}
add_action( 'wp', 'disable_author_page' );