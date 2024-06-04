<?php
/**
 * Plugin Name: View Debug Log
 * Description: A simple plugin to view the debug.log file from the WordPress admin.
 * Version: 1.0
 * Author: pbrocks
 */

// require __DIR__ . '/local-image-filters.php';

if (! function_exists('write_to_log')) {
    function write_to_log($log)
    {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

// Hook to add admin menu item
add_action('admin_menu', 'vdl_add_admin_menu');

// Function to add admin menu item
function vdl_add_admin_menu()
{
    add_menu_page(
        'View Debug Log',
        'Debug Log',
        'manage_options',
        'view-debug-log',
        'vdl_display_debug_log',
        'dashicons-media-text',
        3
    );
}

// Function to display the debug log file
function vdl_display_debug_log()
{
    // Check user capabilities
    if (! current_user_can('manage_options')) {
        return;
    }
    if (function_exists('write_to_log')) {
        $location_for_error_log = basename(__FILE__) . ':' . __LINE__;
        // write_to_log( $location_for_error_log );
    }

    // Path to the debug.log file
    $debug_log_path = WP_CONTENT_DIR . '/debug.log';

    echo '<style>pre {white-space:pre-wrap;padding:1rem;border:3px solid white;background:aliceblue;}li{margin-left:2rem;}</style>';
    echo '<div class="wrap">';
    echo '<h1>Debug Log</h1>';

    echo '<h2>esc_html($log_contents)</h2>';
    echo '<ul>';
    echo '<li>WP_DEBUG = <strong>' . ( WP_DEBUG ? 'true' : 'false' ) . '</strong></li>';
    echo '<li>WP_DEBUG_LOG = <strong>' . ( WP_DEBUG_LOG ? 'true' : 'false' ) . '</strong></li>';
    echo '<li>WP_DEBUG_DISPLAY = <strong>' . ( WP_DEBUG_DISPLAY ? 'true' : 'false' ) . '</strong></li>';
    echo '</ul>';

    // Check if the file exists
    if (file_exists($debug_log_path)) {
        // Read the file contents
        $log_contents = explode("\n", file_get_contents($debug_log_path));

        echo '<pre>' . esc_html(print_r($log_contents, true)) . '</pre>';
    } else {
        echo '<p>Debug log file not found.</p>';
    }

    echo '</div>';
}
