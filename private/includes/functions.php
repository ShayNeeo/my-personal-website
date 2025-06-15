<?php
/**
 * Common helper functions for sgn.is-a.dev
 * Created: June 15, 2025
 */

// Include the config file
require_once dirname(dirname(__DIR__)) . '/config/config.php';

/**
 * Get the URL for an asset file
 * 
 * @param string $path Path relative to the assets directory
 * @return string URL to the asset
 */
function asset($path) {
    return '/assets/' . ltrim($path, '/');
}

/**
 * Get the absolute path to an image
 * 
 * @param string $image Image filename
 * @return string Absolute path to the image
 */
function get_image_path($image) {
    return ASSETS_DIR . '/images/' . basename($image);
}

/**
 * Load links from JSON file
 * 
 * @param string $filePath Path to the JSON file
 * @return array Array of links
 */
function getLinks($filePath) {
    if (!file_exists($filePath)) {
        return [];
    }
    $json_data = file_get_contents($filePath);
    $links = json_decode($json_data, true);
    return is_array($links) ? $links : [];
}

/**
 * Include a template file with variables
 * 
 * @param string $template Path to template file relative to includes directory
 * @param array $vars Variables to extract into template scope
 * @return void
 */
function include_template($template, $vars = []) {
    if (!empty($vars)) {
        extract($vars);
    }
    include INCLUDES_DIR . '/' . ltrim($template, '/');
}

/**
 * Load Composer autoloader with fallback paths
 * 
 * @return bool True if autoloader was loaded successfully, false otherwise
 */
function load_composer_autoloader() {
    $autoloader_paths = [
        ROOT_DIR . '/vendor/autoload.php',
        dirname(ROOT_DIR) . '/vendor/autoload.php',
        dirname(dirname(__FILE__)) . '/../vendor/autoload.php',
        // Additional fallback for deployed environments
        '/home/shayneeo_isadev/htdocs/sgn.is-a.dev/vendor/autoload.php'
    ];
    
    foreach ($autoloader_paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
    }
    
    return false;
}

/**
 * Debug function to display path information
 * Only use for development/debugging
 * 
 * @return string Debug information about paths
 */
function debug_paths() {
    if (!defined('DEBUG_MODE') || !DEBUG_MODE) {
        return '';
    }
    
    $info = [
        'ROOT_DIR' => ROOT_DIR,
        'PUBLIC_DIR' => PUBLIC_DIR,
        'Current working directory' => getcwd(),
        '__FILE__' => __FILE__,
        '__DIR__' => __DIR__,
        'Vendor autoloader paths checked' => [
            ROOT_DIR . '/vendor/autoload.php',
            dirname(ROOT_DIR) . '/vendor/autoload.php',
            dirname(dirname(__FILE__)) . '/../vendor/autoload.php'
        ]
    ];
    
    return '<pre>' . print_r($info, true) . '</pre>';
}
