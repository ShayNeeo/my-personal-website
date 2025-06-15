<?php
/**
 * File Download Handler for QR Code Generator
 */

// Include helper functions
require_once dirname(dirname(__DIR__)) . '/private/includes/functions.php';

// Get the requested file name
$file = isset($_GET['file']) ? basename($_GET['file']) : '';

// Validate filename format (timestamp_random_originalname)
if (preg_match('/^\d+_[a-f0-9]+_/', $file)) {
    $file_path = QR_UPLOADS_DIR . '/' . $file;
    
    if (file_exists($file_path)) {
        // Get original filename (remove timestamp and random part)
        $original_name = preg_replace('/^\d+_[a-f0-9]+_/', '', $file);
        
        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $original_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        
        // Output the file
        readfile($file_path);
        exit;
    }
}

// If we get here, the file doesn't exist or is invalid
header('HTTP/1.0 404 Not Found');
echo 'File not found.';
