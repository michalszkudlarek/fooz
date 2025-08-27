<?php
//Function that saves acf fields added in an admin panel to proper folders
function custom_acf_json_save_paths($paths, $post)
{
    //Path for all acf fields for option pages
    if (isset($post['title']) && str_contains($post['title'], 'Blok -')) {
        $paths = [get_stylesheet_directory() . '/inc/acf-fields/blocks'];
    }
    //Path for all other acf's
    else {
        $paths = [get_stylesheet_directory() . '/inc/acf-fields'];
    }

    return $paths;
}

add_filter('acf/json/save_paths', 'custom_acf_json_save_paths', 10, 2);

//Changes the name of a saved file from "key" to "title" of acf field
function custom_acf_json_filename($filename, $post, $load_path): string
{
    $filename = str_replace([' ', '_'], ['-', '-'], $post['title']);

    return strtolower($filename) . '.json';
}

add_filter('acf/json/save_file_name', 'custom_acf_json_filename', 10, 3);

//Load acf fields from custom folder
function my_acf_json_load_point($paths)
{
    // Remove the original path (optional).
    unset($paths[0]);

    // Append the new path and return it.
    $paths[] = get_stylesheet_directory() . '/inc/acf-fields';
    $paths[] = get_stylesheet_directory() . '/inc/acf-fields/blocks';

    return $paths;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
