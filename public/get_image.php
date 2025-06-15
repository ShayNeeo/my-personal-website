<?php
/**
 * Image Handler - Serves images from the assets directory
 */

// Include helper functions
require_once dirname(__DIR__) . '/private/includes/functions.php';

// Get the requested image filename from the query string
$image = isset($_GET['img']) ? basename($_GET['img']) : '';

// Check if the image is allowed
if (in_array($image, $allowed_images)) {
    $file_path = ASSETS_DIR . '/images/' . $image;

    // Check if the file exists
    if (file_exists($file_path)) {
        // Set the appropriate MIME type
        $mime_type = mime_content_type($file_path);
        header("Content-Type: $mime_type");
        header("Content-Length: " . filesize($file_path));
        
        // Output the image
        readfile($file_path);
        exit;
    }
}

// If we get here, the image wasn't found or isn't allowed
header("HTTP/1.0 404 Not Found");
echo "Image not found.";
