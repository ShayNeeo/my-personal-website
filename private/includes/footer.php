<?php
/**
 * Common footer template
 */
?>    </main>
    <footer>
        <div class="social-links social-links-enhanced">
            <a href="https://www.facebook.com/pqt05" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-link facebook" data-platform="Facebook">
                <img src="<?php echo asset('images/facebook.jpg'); ?>" alt="Facebook" class="social-icon">
            </a>
            <a href="https://www.instagram.com/shay._.neeo/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-link instagram" data-platform="Instagram">
                <img src="<?php echo asset('images/instagram.jpg'); ?>" alt="Instagram" class="social-icon">
            </a>
            <a href="https://github.com/ShayNeeo" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="social-link github" data-platform="GitHub">
                <img src="<?php echo asset('images/github.jpg'); ?>" alt="GitHub" class="social-icon">
            </a>
            <a href="https://x.com/Shay_Neeo" target="_blank" rel="noopener noreferrer" aria-label="X (formerly Twitter)" class="social-link twitter" data-platform="X (Twitter)">
                <img src="<?php echo asset('images/x.jpg'); ?>" alt="X (formerly Twitter)" class="social-icon">
            </a>
            <a href="https://www.reddit.com/user/Shay_Neeo/" target="_blank" rel="noopener noreferrer" aria-label="Reddit" class="social-link reddit" data-platform="Reddit">
                <img src="<?php echo asset('images/reddit.jpg'); ?>" alt="Reddit" class="social-icon">
            </a>
        </div>
        <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
        <p class="footer-tagline">Built with ❤️ and modern web technologies</p>
    </footer>
    <script src="<?php echo asset('js/scripts.js'); ?>"></script>
    <?php if (isset($additional_js) && !empty($additional_js)): ?>
        <script src="<?php echo asset('js/' . $additional_js); ?>"></script>
    <?php endif; ?>
</body>
</html>
