<?php
/**
 * QR Code Generator main file
 */

// Include helper functions
require_once dirname(dirname(__DIR__)) . '/private/includes/functions.php';

// Load Composer autoloader
if (!load_composer_autoloader()) {
    $error_msg = 'Error: Could not find Composer autoloader. Please run "composer install" in the project root.';
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        $error_msg .= debug_paths();
    }
    die($error_msg);
}

// Check if QR code library classes are available
if (!class_exists('chillerlan\QRCode\QRCode')) {
    die('Error: QR Code library not found. Please run "composer install" to install dependencies.');
}

// Use the QR code library
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

// Page-specific variables
$title = 'QR Code Generator';
$additional_css = 'qr-code.css,modern-effects.css';
$additional_js = 'qr-code.js';

// Include header
include_template('header.php', [
    'title' => $title,
    'additional_css' => $additional_css
]);

// Handle form submission
$qrImageUrl = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    // Generate QR for link
    if ($action === 'generate_link_qr') {
        $link = isset($_POST['link']) ? trim($_POST['link']) : '';
        
        if (empty($link)) {
            $error = 'Please enter a valid URL.';
        } else {
            try {
                // Create options with correct paths
                $options = new QROptions([
                    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                    'eccLevel' => QRCode::ECC_L,
                    'scale' => 10,
                    'imageBase64' => false,
                ]);
                
                // Generate unique filename
                $timestamp = time();
                $random_suffix = bin2hex(random_bytes(4));
                $qr_filename = "link_qr_{$timestamp}_{$random_suffix}.png";
                $qr_path = QR_GENERATED_DIR . '/' . $qr_filename;
                
                // Generate QR code and save to file
                $qrcode = new QRCode($options);
                $qrcode->render($link, $qr_path);
                
                $qrImageUrl = '/qr-code/view-qr.php?file=' . $qr_filename;
                $success = 'QR code generated successfully!';
            } catch (Exception $e) {
                $error = 'Error generating QR code: ' . $e->getMessage();
            }
        }
    } 
    // Upload file and generate QR
    elseif ($action === 'generate_file_qr') {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $error = 'Please upload a valid file.';
        } else {
            try {
                $uploaded_file = $_FILES['file'];
                $file_name = $uploaded_file['name'];
                $file_tmp = $uploaded_file['tmp_name'];
                
                // Generate unique filename for uploaded file
                $timestamp = time();
                $random_suffix = bin2hex(random_bytes(4));
                $unique_filename = "{$timestamp}_{$random_suffix}_{$file_name}";
                $upload_path = QR_UPLOADS_DIR . '/' . $unique_filename;
                
                // Move uploaded file
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    // Create QR code for file download link
                    $options = new QROptions([
                        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                        'eccLevel' => QRCode::ECC_L,
                        'scale' => 10,
                        'imageBase64' => false,
                    ]);
                    
                    // Generate QR code filename
                    $qr_filename = "file_dl_qr_{$timestamp}_{$random_suffix}.png";
                    $qr_path = QR_GENERATED_DIR . '/' . $qr_filename;
                    
                    // The download URL for the file
                    $file_url = SITE_URL . '/qr-code/download.php?file=' . $unique_filename;
                    
                    // Generate QR code and save to file
                    $qrcode = new QRCode($options);
                    $qrcode->render($file_url, $qr_path);
                    
                    $qrImageUrl = '/qr-code/view-qr.php?file=' . $qr_filename;
                    $success = 'File uploaded and QR code generated successfully!';
                } else {
                    $error = 'Error uploading file.';
                }
            } catch (Exception $e) {
                $error = 'Error processing file: ' . $e->getMessage();
            }
        }
    }
}
?>

<div class="qr-container">
    <h1>QR Code Generator</h1>
    
    <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="success-message">
            <?php echo htmlspecialchars($success); ?>
            <div class="qr-result">
                <img src="<?php echo htmlspecialchars($qrImageUrl); ?>" alt="Generated QR Code">
                <a href="<?php echo htmlspecialchars($qrImageUrl); ?>" target="_blank">Open QR Code</a>
                <a href="<?php echo htmlspecialchars($qrImageUrl); ?>" download>Download QR Code</a>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="qr-options">
        <div class="option-tab active" data-target="link-qr">Generate QR for Link</div>
        <div class="option-tab" data-target="file-qr">Generate QR for File Upload</div>
    </div>
    
    <div class="qr-forms">
        <div class="form-container active" id="link-qr">
            <form method="post" action="">
                <input type="hidden" name="action" value="generate_link_qr">
                <div class="form-group">
                    <label for="link">Enter URL:</label>
                    <input type="url" id="link" name="link" required placeholder="https://example.com">
                </div>
                <button type="submit">Generate QR Code</button>
            </form>
        </div>
        
        <div class="form-container" id="file-qr">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="generate_file_qr">
                <div class="form-group">
                    <label for="file">Upload File:</label>
                    <input type="file" id="file" name="file" required>
                    <p class="form-hint">Max file size: 10MB</p>
                </div>
                <button type="submit">Upload & Generate QR Code</button>
            </form>
        </div>
    </div>
</div>

<?php
// Include footer
include_template('footer.php', [
    'additional_js' => $additional_js
]);
?>
