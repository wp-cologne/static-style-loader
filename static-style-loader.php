<?php

/**
 * Plugin Name: Static Style Loader
 * Description: Keep ACSS styles alive even after removing ACSS
 * Version: 0.2
 */

if (! defined('ABSPATH')) exit;

function add_acss_static_files()
{
    $upload_dir_info = wp_get_upload_dir();
    $base_url = $upload_dir_info['baseurl'];
    $acss_url = $base_url . '/automatic-css/';


    $files = [
        'automatic-variables'           => 'automatic-variables.css',
        'automatic'                     => 'automatic.css',
        'automatic-bricks'              => 'automatic-bricks.css',
        'automatic-custom-css'          => 'automatic-custom-css.css',
        'automatic-gutenberg'           => 'automatic-gutenberg.css',
    ];

    foreach ($files as $handle => $filename) {
        $file_path = $upload_dir_info['basedir'] . '/automatic-css/' . $filename;
        if (file_exists($file_path)) {
            wp_enqueue_style($handle, $acss_url . $filename, [], null);
        }
    }
}
add_action('wp_enqueue_scripts', 'add_acss_static_files');

function add_acss_to_bricks_editor()
{
    if (! function_exists('bricks_is_builder_main') || ! bricks_is_builder_main()) {
        return;
    }

    $upload_dir_info = wp_get_upload_dir();
    $acss_url = $upload_dir_info['baseurl'] . '/automatic-css/';

    wp_enqueue_style('automatic-bricks-in-builder', $acss_url . 'automatic-bricks-in-builder.css', [], null);
}
add_action('wp_enqueue_scripts', 'add_acss_to_bricks_editor');
