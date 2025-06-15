<?php
/**
 * Common header template
 * Include with: include_template('header.php', ['title' => 'Page Title']);
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ShayNeeo - Full Stack Developer & Creative Problem Solver. Passionate about creating beautiful, functional web experiences.">
    <meta name="keywords" content="ShayNeeo, Full Stack Developer, Web Developer, PHP, JavaScript, Portfolio">
    <meta name="author" content="ShayNeeo">
    <meta name="theme-color" content="#667eea">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($title) ? $title . ' - ' . SITE_NAME : SITE_NAME; ?>">
    <meta property="og:description" content="Full Stack Developer & Creative Problem Solver">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo asset('images/logo.jpg'); ?>">
    
    <title><?php echo isset($title) ? $title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@400;700;800&display=swap" as="style">
      <link rel="stylesheet" href="<?php echo asset('css/styles.css'); ?>">
    <?php if (isset($additional_css) && !empty($additional_css)): ?>
        <?php 
        $css_files = explode(',', $additional_css);
        foreach ($css_files as $css_file): 
            $css_file = trim($css_file);
        ?>
            <link rel="stylesheet" href="<?php echo asset('css/' . $css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Favicon links for various platforms -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/jpeg" href="<?php echo asset('images/logo.jpg'); ?>">
    <link rel="apple-touch-icon" href="<?php echo asset('images/logo.jpg'); ?>">
    
    <!-- Font loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <a href="/" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
                <img src="<?php echo asset('images/logo.jpg'); ?>" alt="<?php echo SITE_NAME; ?> Logo">
                <?php echo SITE_NAME; ?>
            </a>
        </div>        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about-me.php">About</a></li>
                <li><a href="/#projects">Projects</a></li>
                <li><a href="/qr-code/">QR Generator</a></li>
                <li><a href="/shorts/">Short Links</a></li>
            </ul>
        </nav>
    </header>
    <main>
