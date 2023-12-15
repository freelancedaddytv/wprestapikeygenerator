<?php
/**
 * Plugin Name: REST API Key Generator
 * Description: Generates and displays a REST API key for administrators.
 * Version: 1.0
 * Author: Your Name
 */

// Add a menu item under the "Settings" menu in the admin dashboard
function rest_api_key_menu() {
    add_submenu_page(
        'options-general.php',
        'REST API Key',
        'REST API Key',
        'manage_options',
        'rest-api-key',
        'generate_rest_api_key'
    );
}

add_action('admin_menu', 'rest_api_key_menu');

// Function to generate and display the API key
function generate_rest_api_key() {
    if (current_user_can('manage_options')) {
        $api_key = wp_generate_password(32); // Generate a random 32-character key

        echo '<div class="wrap">';
        echo '<h2>REST API Key</h2>';
        echo '<p>Here is your REST API key:</p>';
        echo '<input type="text" value="' . esc_attr($api_key) . '" readonly="readonly" style="width: 100%; font-size: 14px; padding: 10px; margin-bottom: 20px;">';
        echo '</div>';
    }
}
