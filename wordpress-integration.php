<?php
/**
 * Simple WordPress Integration for Vite React App
 */

define('VITE_APP_PATH', get_stylesheet_directory_uri() . '/vite-app/assets/');

/**
 * Add modulepreload for App.js in the head
 */
function vite_add_modulepreload() {
    echo '<link rel="modulepreload" crossorigin href="' . VITE_APP_PATH . 'App.js">';
}
add_action('wp_head', 'vite_add_modulepreload');

/**
 * Add the CSS file and shared App.js file
 */
function vite_enqueue_common_assets() {
    wp_enqueue_style('vite-app-css', VITE_APP_PATH . 'style.css');
    
    wp_enqueue_script('vite-app-js', VITE_APP_PATH . 'App.js', [], null, true);
    
    // Add script type="module" attribute to App.js
    add_filter('script_loader_tag', function($tag, $handle) {
        if ('vite-app-js' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' type="module" crossorigin src', $tag);
    }, 10, 2);
}

/**
 * Stores Page Shortcode
 * Usage: [vite_stores]
 */
function vite_stores_shortcode() {
    vite_enqueue_common_assets();
    
    wp_enqueue_script('vite-stores-js', VITE_APP_PATH . 'stores.js', ['vite-app-js'], null, true);
    
    add_filter('script_loader_tag', function($tag, $handle) {
        if ('vite-stores-js' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' type="module" crossorigin src', $tag);
    }, 10, 2);
    
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
    vite_enqueue_common_assets();
    
    wp_enqueue_script('vite-quiz-js', VITE_APP_PATH . 'quiz.js', ['vite-app-js'], null, true);
    
    add_filter('script_loader_tag', function($tag, $handle) {
        if ('vite-quiz-js' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' type="module" crossorigin src', $tag);
    }, 10, 2);
    
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
    
    vite_enqueue_common_assets();
    
    wp_enqueue_script('vite-' . $page . '-js', VITE_APP_PATH . $page . '.js', ['vite-app-js'], null, true);
    
    add_filter('script_loader_tag', function($tag, $handle) use ($page) {
        if ('vite-' . $page . '-js' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' type="module" crossorigin src', $tag);
    }, 10, 2);
    
    return '
    <div class="vite-app ' . $page . '-app">
        <div id="' . $page . '-root"></div>
    </div>';
}
add_shortcode('vite_app', 'vite_app_shortcode');

