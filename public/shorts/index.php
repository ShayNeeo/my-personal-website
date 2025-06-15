<?php
/**
 * URL Shortener - Main Handler
 */

// Include helper functions
require_once dirname(dirname(__DIR__)) . '/private/includes/functions.php';

// Path to the links JSON file
$links_file_path = dirname(dirname(__DIR__)) . '/private/data/links.json';

// Get the requested short code from the URL
$request_uri = $_SERVER['REQUEST_URI'];
$base_path_for_shorts = '/shorts/';

if (strpos($request_uri, $base_path_for_shorts) === 0) {
    $short_code_plus_query = substr($request_uri, strlen($base_path_for_shorts));
    // Remove query string if present
    $short_code = strtok($short_code_plus_query, '?');
} else {
    // Fallback
    $short_code = basename(strtok($request_uri, '?'));
}

// Load the links data
$links = getLinks($links_file_path);

// Check if this is the admin page or a short link
if ($short_code === 'admin.php') {
    // This request should be handled by admin.php
    include __DIR__ . '/admin.php';
    exit;
} else if (!empty($short_code) && $short_code !== 'index.php') {
    // Look for the short code in our links
    if (isset($links[$short_code])) {
        // Found a match - redirect
        header('Location: ' . $links[$short_code]);
        exit;
    }
    
    // If we get here, the short code wasn't found
    http_response_code(404);
      // Include header
    include_template('header.php', [
        'title' => 'Link Not Found',
        'additional_css' => 'modern-effects.css'
    ]);
    
    echo '<div class="error-container">';
    echo '<h1>Link Not Found</h1>';
    echo '<p>The requested short link "' . htmlspecialchars($short_code) . '" does not exist.</p>';
    echo '<p><a href="/shorts/">Create a new short link</a></p>';
    echo '</div>';
    
    // Include footer
    include_template('footer.php');
    exit;
}

// Default page - show form to create new short link
$title = 'URL Shortener';
$additional_css = 'shorts.css,modern-effects.css';

// Include header
include_template('header.php', [
    'title' => $title,
    'additional_css' => $additional_css
]);

// Process form submission
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';
    $custom_code = isset($_POST['custom_code']) ? trim($_POST['custom_code']) : '';
    
    if (empty($url)) {
        $error = 'Please enter a valid URL.';
    } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $error = 'Please enter a valid URL including http:// or https://';
    } else {
        // Generate a short code if not provided
        if (empty($custom_code)) {
            $custom_code = substr(md5(uniqid(rand(), true)), 0, 6);
        }
          // Check if code already exists
        if (isset($links[$custom_code])) {
            $error = 'This short code is already in use. Please choose another one.';
        } else {
            // Add the new link
            $links[$custom_code] = $url;
            
            // Save the updated links
            $json_data = json_encode($links, JSON_PRETTY_PRINT);
            
            // Ensure the directory exists
            $links_dir = dirname($links_file_path);
            if (!is_dir($links_dir)) {
                mkdir($links_dir, 0755, true);
            }
            
            if (file_put_contents($links_file_path, $json_data)) {
                $short_url = SITE_URL . '/shorts/' . $custom_code;
                $message = 'Short URL created: <a href="' . htmlspecialchars($short_url) . '">' . htmlspecialchars($short_url) . '</a>';
            } else {
                $error = 'Error saving the short URL. Please try again.';
            }
        }
    }
}
?>

<div class="shorts-container">
    <h1>URL Shortener</h1>
    
    <?php if (!empty($message)): ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="url">Enter URL:</label>
            <input type="url" id="url" name="url" required placeholder="https://example.com">
        </div>
        
        <div class="form-group">
            <label for="custom_code">Custom Short Code (optional):</label>
            <input type="text" id="custom_code" name="custom_code" placeholder="Leave empty for random code">
            <p class="form-hint">Only letters, numbers, and hyphens allowed</p>
        </div>
        
        <button type="submit">Create Short URL</button>
    </form>
    
    <p class="admin-link"><a href="/shorts/admin.php">Manage Short URLs</a></p>
</div>

<?php
// Include footer
include_template('footer.php');
?>
