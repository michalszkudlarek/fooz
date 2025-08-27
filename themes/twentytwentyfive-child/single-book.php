<?php
/**
 * The template for displaying a single Book post type.
 *
 * @package TwentyTwentyFive_Child
 */
get_header(); ?>
    <div class="single-book-main container">
        <main>
            <?php
            while ( have_posts() ) {
                the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <div>
                        <?php
                        if ( has_post_thumbnail() ) { ?>
                            <div>
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div><?php
                        } ?>

                        <div>
                            <p>
                                <strong>Publication Date:</strong> <?php echo get_the_date(); ?>
                            </p>

                            <?php
                            $genres = get_the_terms( get_the_ID(), 'genre' );
                            if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
                                echo '<p><strong>' . _x('Genre:', 'Genre title on single book view.', 'twentytwentyfive-child') . '</strong> ';
                                $genre_links = array();
                                foreach ( $genres as $genre ) {
                                    $genre_links[] = '<a href="' . esc_url( get_term_link( $genre ) ) . '">' . esc_html( $genre->name ) . '</a>';
                                }
                                echo implode( ', ', $genre_links );
                                echo '</p>';
                            }
                            ?>
                        </div>

                        <?php the_content(); ?>

                    </div>
                </article><?php
            } // End the loop. ?>

            <section class="mt-5">
                <h2><?php echo _x('Other Books', 'Header for other books on single book view.', 'twentytwentyfive-child'); ?></h2>
                <div id="related-books-container">
                    <p><?php echo _x('Loading books...', 'Loading more books text on single book view.', 'twentytwentyfive-child'); ?></p>
                </div>
            </section>
        </main>
    </div>
<?php get_footer(); ?>