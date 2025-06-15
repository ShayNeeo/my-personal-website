<?php
/**
 * QR Code Viewer
 */

// Include helper functions
require_once dirname(dirname(__DIR__)) . '/private/includes/functions.php';

// Get the requested QR code filename
$qr_file = isset($_GET['file']) ? basename($_GET['file']) : '';

// Validate filename pattern (should match our generated pattern)
if (preg_match('/^(link|file_dl)_qr_\d+_[a-f0-9]+\.png$/', $qr_file)) {
    $file_path = QR_GENERATED_DIR . '/' . $qr_file;
    
    if (file_exists($file_path)) {
        // Output the image
        header('Content-Type: image/png');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}

// If we get here, the file doesn't exist or is invalid
header('HTTP/1.0 404 Not Found');
echo 'QR code not found.';
