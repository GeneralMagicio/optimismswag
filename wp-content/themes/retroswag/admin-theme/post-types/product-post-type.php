<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
/* Add new taxonomy: BRAND */
function brand_category() {

    $labels = array(
        'name'              => _x( 'Brands', 'taxonomy general name' ),
        'singular_name'     => _x( 'Brands Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Brands' ),
        'all_items'         => __( 'All Brands' ),
        'parent_item'       => __( 'Parent Brand' ),
        'parent_item_colon' => __( 'Parent Brand:' ),
        'edit_item'         => __( 'Edit Brand' ),
        'update_item'       => __( 'Update Brand' ),
        'add_new_item'      => __( 'Add New Brand' ),
        'new_item_name'     => __( 'New Brand Name' ),
        'menu_name'         => __( 'Brands' ),
    );

    $args = array(
        'labels'            =>  $labels,
        'hierarchical'      =>  true,
        'show_admin_column' =>  true,
    );
    register_taxonomy( 'brand', 'product', $args );
}

add_action( 'init', 'brand_category', 0 );

/**
 * Show brand name with link on product single page
 */
function brand_category_product_display() {

    global $product;

    if( $firstCategory = getFirstBrandCategory( $product->get_id() ) ){

        echo '
			<span class="brand-name">
				Brand: <a href="' . esc_url( get_term_link( $firstCategory->term_id ) )  . '" title="' . $firstCategory->name . '">' . $firstCategory->name . '</a>
			</span>
		';

    }

}

add_action( 'woocommerce_product_meta_end', 'brand_category_product_display' );

/**
 * Get first brand category
 *
 * @param int $postID
 *
 * @return string|boolean
 */
function getFirstBrandCategory($postID){

    $categories = get_the_terms( $postID, 'brand' );

    if($categories){

        foreach ( $categories AS $category ){

            return $category;

        }

    }

    return FALSE;

}
