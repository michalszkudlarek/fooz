<?php
/**
 * The template for displaying the Genre taxonomy archive page.
 *
 * @package TwentyTwentyFive_Child
 */

get_header(); ?>
    <div class="genre-main container">
        <main class="row">
            <?php
            if ( have_posts() ) { ?>
                <div class="col-12">
                    <header>
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header>
                </div>
                <div class="col-12">
                    <?php
                    while ( have_posts() ) {
                        the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                            <header>
                                <?php the_title(sprintf('<h2 class="genre__book-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                            </header>

                            <div class="entry-summary">
                                <p><strong>Publication Date:</strong> <?php echo get_the_date(); ?></p>
                                <?php the_excerpt(); ?>
                            </div>
                        </article><?php
                    } ?>
                </div>
                <?php
                // Display the pagination links.
                the_posts_pagination(
                        array(
                                'prev_text' => __('&laquo; Previous', 'twentytwentyfive-child'),
                                'next_text' => __('Next &raquo;', 'twentytwentyfive-child'),
                        )
                );

            } else {
                // If no content, include the "No posts found" template.
                echo _x('<p>No books found in this genre.</p>', 'No books found message, on taxonomy page.', 'twentytwentyfive-child');
            } ?>
        </main>
    </div>
<?php get_footer(); ?>