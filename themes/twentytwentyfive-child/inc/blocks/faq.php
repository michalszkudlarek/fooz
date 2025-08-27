<?php
/**
 * Handles the registration of ACF Blocks.
 *
 * @package TwentyTwentyFive_Child
 */
if ( !class_exists('ACF') ) {
    add_action('admin_notices', 'my_theme_missing_acf_notice');
    return;
}

/**
 * Shows an admin notice if the ACF plugin is not active.
 */
function my_theme_missing_acf_notice(): void { ?>
    <div class="notice notice-error is-dismissible">
        <p>
            <?php
            esc_html_e('Warning: The theme requires the Advanced Custom Fields (ACF) plugin to be installed and activated for the FAQ block to function.', 'twentytwentyfive-child');
            ?>
        </p>
    </div>
    <?php
}


add_action('acf/init', 'my_theme_register_acf_blocks');

function my_theme_register_acf_blocks(): void {
    // Check if function exists.
    if ( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name' => 'Faq accordion',
            'title' => __('Faq accordion', 'twentytwentyfive-child'),
            'description' => __('Block displaying accordion for FAQ questions', 'twentytwentyfive-child'),
            'render_template' => 'template-parts/blocks/accordion.php',
            'category' => 'fooz-blocks',
            'mode' => 'edit',
            'icon' => 'screenoptions',
            'keywords' => array('header', 'text', 'accordion', 'question', 'answer', 'faq'),
            'supports' => array('anchor' => true)
        ));
    }
}