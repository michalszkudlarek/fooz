<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
/**
     * Only for a simple grid and simplicity. Normally it would be added via npm and conditionally loaded with the appropriate, necessary modules.
     */
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap-grid.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page">
    <header>
        <div class="site-branding">
            <?php if (has_custom_logo()) {
                // Echo the entire HTML string for the logo
                echo '<div class="site-logo">' . get_custom_logo() . '</div>';
            } else {
                // Use printf for cleaner string formatting with variables
                printf(
                    '<h1 class="site-title"><a href="%s" rel="home">%s</a></h1>',
                    esc_url(home_url('/')),
                    esc_html(get_bloginfo('name')),
                );
                printf('<p class="site-description">%s</p>', esc_html(get_bloginfo('description')));
            } ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php wp_nav_menu([
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
            ]); ?>
        </nav>
    </header>

    <div id="content" class="site-content">