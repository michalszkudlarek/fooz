<?php
/**
 * Handles the registration of the Book custom post type and Genre taxonomy.
 *
 * @package TwentyTwentyFive_Child
 */

add_action('init', 'fooz_register_custom_post_types');

/**
 * Register Custom Post Type: Book
 * Register Custom Taxonomy: Genre
 */
function fooz_register_custom_post_types() {
    // REGISTER CUSTOM POST TYPE: BOOK
    $book_labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'twentytwentyfive-child' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'twentytwentyfive-child' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'twentytwentyfive-child' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'twentytwentyfive-child' ),
        'add_new'               => __( 'Add New', 'twentytwentyfive-child' ),
        'add_new_item'          => __( 'Add New Book', 'twentytwentyfive-child' ),
        'new_item'              => __( 'New Book', 'twentytwentyfive-child' ),
        'edit_item'             => __( 'Edit Book', 'twentytwentyfive-child' ),
        'view_item'             => __( 'View Book', 'twentytwentyfive-child' ),
        'all_items'             => __( 'All Books', 'twentytwentyfive-child' ),
        'search_items'          => __( 'Search Books', 'twentytwentyfive-child' ),
        'parent_item_colon'     => __( 'Parent Books:', 'twentytwentyfive-child' ),
        'not_found'             => __( 'No books found.', 'twentytwentyfive-child' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'twentytwentyfive-child' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type.', 'twentytwentyfive-child' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type.', 'twentytwentyfive-child' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type.', 'twentytwentyfive-child' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type.', 'twentytwentyfive-child' ),
        'archives'              => _x( 'Book Archives', 'The post type archive label used in nav menus.', 'twentytwentyfive-child' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post).', 'twentytwentyfive-child' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post).', 'twentytwentyfive-child' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen.', 'twentytwentyfive-child' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'twentytwentyfive-child' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen.', 'twentytwentyfive-child' ),
    );

    $book_args = array(
        'labels'             => $book_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'library' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'book', $book_args );


    // REGISTER CUSTOM TAXONOMY: GENRE
    $genre_labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name', 'twentytwentyfive-child' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'twentytwentyfive-child' ),
        'search_items'      => __( 'Search Genres', 'twentytwentyfive-child' ),
        'all_items'         => __( 'All Genres', 'twentytwentyfive-child' ),
        'parent_item'       => __( 'Parent Genre', 'twentytwentyfive-child' ),
        'parent_item_colon' => __( 'Parent Genre:', 'twentytwentyfive-child' ),
        'edit_item'         => __( 'Edit Genre', 'twentytwentyfive-child' ),
        'update_item'       => __( 'Update Genre', 'twentytwentyfive-child' ),
        'add_new_item'      => __( 'Add New Genre', 'twentytwentyfive-child' ),
        'new_item_name'     => __( 'New Genre Name', 'twentytwentyfive-child' ),
        'menu_name'         => __( 'Genre', 'twentytwentyfive-child' ),
    );

    $genre_args = array(
        'hierarchical'      => true,
        'labels'            => $genre_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'book-genre' ), // Requirement: Custom slug
        'show_in_rest'      => true,
    );

    register_taxonomy( 'genre', array( 'book' ), $genre_args );
}
add_action( 'init', 'fooz_register_custom_post_types' );