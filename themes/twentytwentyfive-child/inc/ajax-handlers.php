<?php
/**
 * Handles AJAX requests for the theme.
 *
 * @package TwentyTwentyFive_Child
 */
add_action('wp_ajax_load_related_books', 'fooz_load_related_books');
add_action('wp_ajax_nopriv_load_related_books', 'fooz_load_related_books');

function fooz_load_related_books() {
    // 1. Security Check: Verify the nonce
    check_ajax_referer('related_books_nonce', 'security');

    // 2. Get the ID of the current book from the AJAX request
    $current_book_id = isset($_POST['current_book_id']) ? intval($_POST['current_book_id']) : 0;

    // 3. Set up the WP_Query arguments
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 20,
        'post__not_in' => array($current_book_id), // Exclude the current book
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $related_books_query = new WP_Query($args);

    $books_data = array();

    // 4. Loop through the query results and build the data array
    if ( $related_books_query->have_posts() ) {
        while ( $related_books_query->have_posts() ) {
            $related_books_query->the_post();

            $book_id = get_the_ID();
            $genres = get_the_terms($book_id, 'genre');
            $genre_data = array();

            if ( !empty($genres) && !is_wp_error($genres) ) {
                foreach ( $genres as $genre ) {
                    $genre_data[] = array(
                        'name' => esc_html( $genre->name ),
                        'link' => esc_url( get_term_link( $genre ) ),
                    );
                }
            }

            $books_data[] = array(
                'title' => get_the_title(),
                'date' => get_the_date(),
                'genres' => $genre_data,
                'excerpt' => get_the_excerpt(),
                'permalink' => get_the_permalink(),
            );
        }
    }

    wp_reset_postdata();

    if ( !empty($books_data) ) {
        wp_send_json_success($books_data);
    } else {
        wp_send_json_error(array('message' => 'No other books found.'));
    }
}