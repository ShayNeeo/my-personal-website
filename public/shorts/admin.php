<?php
/**
 * URL Shortener - Admin Panel
 */

// Include helper functions
require_once dirname(dirname(__DIR__)) . '/private/includes/functions.php';

// Path to the links JSON file
$links_file_path = dirname(dirname(__DIR__)) . '/private/data/links.json';

// Include header
include_template('header.php', [
    'title' => 'Manage Short URLs',
    'additional_css' => 'shorts.css,modern-effects.css'
]);

// Process actions
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($action === 'delete' && isset($_POST['code'])) {
        $code_to_delete = $_POST['code'];
        
        // Load links
        $links = getLinks($links_file_path);
          // Remove the link with the given code
        if (isset($links[$code_to_delete])) {
            unset($links[$code_to_delete]);
            
            // Save the updated links
            $json_data = json_encode($links, JSON_PRETTY_PRINT);
            
            if (file_put_contents($links_file_path, $json_data)) {
                $message = 'Short URL deleted successfully.';
            } else {
                $error = 'Error deleting the short URL. Please try again.';
            }
        } else {
            $error = 'Short URL not found.';
        }
    }
}

// Load links for display
$links = getLinks($links_file_path);
?>

<div class="shorts-admin-container">
    <h1>Manage Short URLs</h1>
    
    <?php if (!empty($message)): ?>
        <div class="success-message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (empty($links)): ?>
        <p>No short URLs found. <a href="/shorts/">Create one now</a>.</p>
    <?php else: ?>
        <table class="links-table">
            <thead>
                <tr>
                    <th>Short Code</th>
                    <th>Original URL</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>            <tbody>
                <?php foreach ($links as $code => $url): ?>
                    <tr>
                        <td>
                            <a href="/shorts/<?php echo htmlspecialchars($code); ?>" target="_blank">
                                <?php echo htmlspecialchars($code); ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo htmlspecialchars($url); ?>" target="_blank">
                                <?php echo htmlspecialchars(strlen($url) > 50 ? substr($url, 0, 50) . '...' : $url); ?>
                            </a>
                        </td>
                        <td>
                            N/A
                        </td>
                        <td>
                            <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete this short URL?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="code" value="<?php echo htmlspecialchars($code); ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <p><a href="/shorts/">Create New Short URL</a></p>
</div>

<?php
// Include footer
include_template('footer.php');
?>
