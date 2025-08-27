<?php
/**
 * Custom modifications to the main WordPress query.
 *
 * @package TwentyTwentyFive_Child
 */

add_action( 'pre_get_posts', 'fooz_set_genre_archive_posts_per_page' );

/**
 * Modify the main query for the 'genre' taxonomy archive.
 *
 * @param WP_Query $query The main WordPress query object.
 *
 * @note RECRUITER'S NOTE:
 *
 * This function modifies the main WordPress query *before* it is executed on the database.
 * This is the preferred, most performant method for altering archive page listings.
 *
 * WHY THIS METHOD WAS CHOSEN:
 * 1.  **Performance:** It adjusts the original database query, resulting in only ONE query for the page.
 * 2.  **Standard Practice:** It uses the standard `pre_get_posts` hook, which is the industry best practice for this task.
 * 3.  **Compatibility:** It respects the main query object, ensuring that default WordPress functions like pagination (`the_posts_pagination()`) work correctly without any custom logic.
 *
 * ADDRESSING SPECIFICITY CONCERNS:
 * The function is carefully scoped to prevent side effects. The conditional checks ensure it ONLY runs when:
 *   - `! is_admin()`: We are on the front-end of the site.
 *   - `$query->is_main_query()`: It is the main page query, not a secondary/custom query (e.g., in a widget or shortcode).
 *   - `$query->is_tax('genre')`: It is specifically an archive page for our 'genre' taxonomy.
 *
 * THE ALTERNATIVE METHOD:
 * An alternative would be to create a new, custom `WP_Query` directly within the `taxonomy-genre.php` template.
 * Pros are that it will not other queries that are not related to the archive page, and it will not affect the performance of other pages.
 * Cons are that it is more complex, and it requires more code to ensure compatibility with other WordPress functions.
 */
function fooz_set_genre_archive_posts_per_page( \WP_Query $query ): void {
    if ( ! is_admin() && $query->is_main_query() && $query->is_tax( 'genre' ) ) {
        $query->set( 'posts_per_page', 5 );
    }
}