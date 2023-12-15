<?php
/**
 * Plugin Name: REST API Key Generator
 * Description: Generates and displays a REST API key for administrators.
 * Version: 1.0
 * Author: Freelance Daddy
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
        $api_key = get_option('rest_api_key'); // Get the stored API key

        // Check if the form has been submitted
        if (isset($_POST['save_api_key'])) {
            $new_api_key = sanitize_text_field($_POST['api_key']); // Get the user-inputted API key
            update_option('rest_api_key', $new_api_key); // Save the new API key to the database
            $api_key = $new_api_key; // Update the displayed API key
        }

        echo '<div class="wrap">';
        echo '<h2>REST API Key</h2>';
        echo '<form method="post">';
        echo '<p>Here is your REST API key:</p>';
        echo '<input type="text" name="api_key" value="' . esc_attr($api_key) . '" style="width: 100%; font-size: 14px; padding: 10px; margin-bottom: 20px;" readonly="readonly">';
        echo '<input type="submit" name="save_api_key" value="Save API Key">';
        echo '</form>';
        echo '</div>';
    }
}
