<?php
/**
 * Simple WordPress Integration for Vite React App
 * Add this to your theme's functions.php
 */

// Path to your React app files in WordPress
// Change this if you put your files in a different location
define('VITE_APP_PATH', get_stylesheet_directory_uri() . '/vite-app/assets/');

/**
 * Add the CSS file and shared App.js file
 */
function vite_enqueue_common_assets() {
    // Add CSS
    wp_enqueue_style('vite-app-css', VITE_APP_PATH . 'style.css');
    
    // Add the shared App.js file that contains most of the code
    // This is needed because the page JS files import from it
    wp_enqueue_script('vite-app-js', VITE_APP_PATH . 'App.js', [], null, true);
}

/**
 * Stores Page Shortcode
 * Usage: [vite_stores]
 */
function vite_stores_shortcode() {
    // Add common assets
    vite_enqueue_common_assets();
    
    // Add the page-specific JavaScript file
    wp_enqueue_script('vite-stores-js', VITE_APP_PATH . 'stores.js', ['vite-app-js'], null, true);
    
    // Return the HTML container
    return '
    <div class="vite-app stores-app">
        <div id="stores-root"></div>
    </div>';
}
add_shortcode('vite_stores', 'vite_stores_shortcode');

/**
 * Quiz Page Shortcode
 * Usage: [vite_quiz]
 */
function vite_quiz_shortcode() {
    // Add common assets
    vite_enqueue_common_assets();
    
    // Add the page-specific JavaScript file
    wp_enqueue_script('vite-quiz-js', VITE_APP_PATH . 'quiz.js', ['vite-app-js'], null, true);
    
    // Return the HTML container
    return '
    <div class="vite-app quiz-app">
        <div id="quiz-root"></div>
    </div>';
}
add_shortcode('vite_quiz', 'vite_quiz_shortcode');

/**
 * Generic App Shortcode
 * Usage: [vite_app page="stores"]
 * or: [vite_app page="quiz"]
 */
function vite_app_shortcode($atts) {
    // Get the page name from shortcode
    $atts = shortcode_atts([
        'page' => 'stores' // Default to stores page if none specified
    ], $atts);
    
    $page = $atts['page'];
    
    // Add common assets
    vite_enqueue_common_assets();
    
    // Add the page-specific JavaScript file
    wp_enqueue_script('vite-' . $page . '-js', VITE_APP_PATH . $page . '.js', ['vite-app-js'], null, true);
    
    // Return the HTML container
    return '
    <div class="vite-app ' . $page . '-app">
        <div id="' . $page . '-root"></div>
    </div>';
}
add_shortcode('vite_app', 'vite_app_shortcode');

