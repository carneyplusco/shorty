<?php
/**
 * Post Type
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/*
 * Remove single view for shortocdes
 */
add_filter( 'post_row_actions', function( $actions ) {

    if ( get_post_type() === 'shortcode' )
        unset( $actions['view'] );
    return $actions;

}, 10, 1 );

/*
 * Add shortcode to admin columns
 */
add_filter('manage_shortcode_posts_columns', 'shorty_extend_columns', 10);
add_action('manage_shortcode_posts_custom_column', 'shorty_extend_columns_content', 10, 2);

// ADD NEW COLUMN
function shorty_extend_columns($defaults) {

    $defaults['shorty_shortcode_tag'] = __( 'Shortcode', 'sinclair-pharma' );

    return $defaults;
}

// SHOW THE FEATURED IMAGE
function shorty_extend_columns_content($column_name, $post_ID) {
    if ($column_name == 'shorty_shortcode_tag') {

        $post = get_post($post_ID);
        $slug = $post->post_name;

        $slug = apply_filters( 'shorty_admin_display_shortcode', $slug );

        echo '[' . $slug . ']';
    }
}