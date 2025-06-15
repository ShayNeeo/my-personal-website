<?php
/**
 * Main configuration file for sgn.is-a.dev
 * Created: June 15, 2025
 */

// Define base paths with fallback for different environments
$possible_root_dirs = [
    dirname(__DIR__),
    '/home/shayneeo_isadev/htdocs/sgn.is-a.dev',
    realpath(dirname(__DIR__))
];

$root_dir = null;
foreach ($possible_root_dirs as $dir) {
    if (is_dir($dir) && file_exists($dir . '/vendor/autoload.php')) {
        $root_dir = $dir;
        break;
    }
}

// Fallback to the standard relative path if we can't find vendor
if (!$root_dir) {
    $root_dir = dirname(__DIR__);
}

define('ROOT_DIR', $root_dir);
define('PUBLIC_DIR', ROOT_DIR . '/public');
define('PRIVATE_DIR', ROOT_DIR . '/private');
define('DATA_DIR', PRIVATE_DIR . '/data');
define('INCLUDES_DIR', PRIVATE_DIR . '/includes');
define('ASSETS_DIR', PUBLIC_DIR . '/assets');

// QR code generator paths
define('QR_GENERATED_DIR', DATA_DIR . '/qr-generated');
define('QR_UPLOADS_DIR', DATA_DIR . '/qr-uploads');

// Site information
define('SITE_NAME', 'ShayNeeo\'s Portfolio');
define('SITE_URL', 'https://sgn.is-a.dev');

// Debug mode (set to true for development, false for production)
define('DEBUG_MODE', false);

// Allowed images for get_image.php
$allowed_images = [
    'scene.jpg',
    'blogger.jpg',
    'logo.jpg',
    'facebook.jpg',
    'instagram.jpg',
    'github.jpg',
    'x.jpg',
    'reddit.jpg'
];

// Database configuration if needed
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'your_db_name');
// define('DB_USER', 'your_db_user');
// define('DB_PASS', 'your_db_password');
