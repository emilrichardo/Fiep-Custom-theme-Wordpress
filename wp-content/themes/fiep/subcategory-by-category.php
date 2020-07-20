<?php
/**
 * The template for displaying search form.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Support for custom search post type.
$sinatra_post_type = apply_filters( 'sinatra_search_post_type', 'all' );
$sinatra_post_type = 'all' !== $sinatra_post_type ? '<input type="hidden" name="post_type" value="' . esc_attr( $sinatra_post_type ) . '" />' : '';
?>
 
 <?php
    $term = get_queried_object();
    $children = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => false
    ) );

    if ( $children ) { 
        foreach( $children as $subcat )
        {
            echo '<li><a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
        }
    }
?>