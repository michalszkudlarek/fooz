<?php
/**
 * Twenty Twenty-Five Child Theme Functions
 *
 * @package TwentyTwentyFive_Child
 */

// Add "type": "module" to the main script tag
add_filter('script_loader_tag', 'add_type_attribute_to_script', 10, 3);
function add_type_attribute_to_script($tag, $handle, $src)
{
    if ('twenty-twenty-five-child-scripts' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}

add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_assets');

function twentytwentyfive_child_enqueue_assets()
{
    // Enqueue the parent theme's stylesheet.
    wp_enqueue_style('twenty-twenty-five-parent-style', get_template_directory_uri() . '/style.css');

    // Enqueue child theme's stylesheet.
    wp_enqueue_style(
        'twenty-twenty-five-child-style',
        get_stylesheet_directory_uri() . '/assets/styles/main.css',
        ['twenty-twenty-five-parent-style'],
        wp_get_theme()->get('Version'),
    );

    wp_enqueue_script(
        'twenty-twenty-five-child-scripts',
        get_stylesheet_directory_uri() . '/assets/js/scripts.js',
        [],
        wp_get_theme()->get('Version'),
        true, // Load in footer
    );

    if (is_singular('book')) {
        wp_localize_script(
            'twenty-twenty-five-child-scripts',
            'bookLoaderAjax', // The name of the global JS object to create
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('related_books_nonce'),
                'current_book_id' => get_the_ID(),
            ],
        );
    }
}

/**
 * Include files
 */
// Add all additional modules here
$includes = [
    '/post-types.php',
    '/ajax-handlers.php',
    '/query-modifications.php',
    '/acf-fields.php',
    '/blocks/faq.php' // Normally, this would probably be one consolidated file for all blocks. Simplification
];

// Load all declared modules
foreach ($includes as $file) {
    $filepath = locate_template('inc' . $file);
    if (!$filepath) {
        trigger_error(sprintf('Error locating /inc%s for inclusion', $file), E_USER_ERROR);
    }
    require_once $filepath;
}
