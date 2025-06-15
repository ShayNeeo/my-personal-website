<?php
/**
 * Main index file for ShayNeeo's Portfolio
 */

// Include helper functions
require_once dirname(__DIR__) . '/private/includes/functions.php';

// Page-specific variables
$title = 'Home';
$additional_css = 'portfolio.css,modern-effects.css';
$additional_js = 'portfolio.js';

// Include header
include_template('header.php', [
    'title' => $title,
    'additional_css' => $additional_css
]);
?>

<div class="hero-section">
    <div class="hero-content">        <div class="hero-text">            <h1>Hi, I'm <span class="highlight">ShayNeeo</span></h1>
            <h2 class="subtitle">Full Stack Developer & Creative Problem Solver</h2>
            <p class="hero-description">Passionate about creating beautiful, functional, and user-friendly web experiences. I specialize in modern web technologies and love turning ideas into reality.</p>
            <div class="hero-buttons">
                <a href="#projects" class="btn btn-primary">View My Work</a>
                <a href="/about-me.php" class="btn btn-secondary">About Me</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="<?php echo asset('images/blogger.jpg'); ?>" alt="ShayNeeo's Photo" class="profile-photo">
        </div>
    </div>
</div>

<section id="projects" class="projects-section">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>        <div class="projects-grid">
            <div class="project-card stagger-item">
                <div class="project-image">
                    <img src="<?php echo asset('images/scene.jpg'); ?>" alt="QR Code Generator" loading="lazy">
                </div>
                <div class="project-content">
                    <h3>QR Code Generator</h3>
                    <p>A comprehensive QR code generation tool with file upload capabilities and multiple format support.</p>
                    <div class="project-tech">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">CSS</span>
                    </div>
                    <div class="project-links">
                        <a href="/qr-code/" class="project-link btn-hover-lift">View Project</a>
                    </div>
                </div>
            </div>
            
            <div class="project-card stagger-item">
                <div class="project-image">
                    <img src="<?php echo asset('images/logo.jpg'); ?>" alt="URL Shortener" loading="lazy">
                </div>
                <div class="project-content">
                    <h3>URL Shortener</h3>
                    <p>Clean and efficient URL shortening service with analytics and custom link management.</p>
                    <div class="project-tech">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">JSON</span>
                        <span class="tech-tag">AJAX</span>
                    </div>
                    <div class="project-links">
                        <a href="/shorts/" class="project-link btn-hover-lift">View Project</a>
                    </div>
                </div>
            </div>
            
            <div class="project-card stagger-item">
                <div class="project-image">
                    <img src="<?php echo asset('images/scene.jpg'); ?>" alt="Portfolio Website" loading="lazy">
                </div>
                <div class="project-content">
                    <h3>Portfolio Website</h3>
                    <p>This very website! A modern, responsive portfolio showcasing my projects and skills.</p>
                    <div class="project-tech">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">CSS3</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">Responsive</span>
                    </div>
                    <div class="project-links">
                        <a href="#" class="project-link btn-hover-lift">You're Here!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="skills-section">
    <div class="container">
        <h2 class="section-title">Skills & Technologies</h2>
        <div class="skills-grid">
            <div class="skill-category">
                <h3>Frontend</h3>
                <div class="skills-list">
                    <span class="skill">HTML5</span>
                    <span class="skill">CSS3</span>
                    <span class="skill">JavaScript</span>
                    <span class="skill">Responsive Design</span>
                    <span class="skill">UI/UX Design</span>
                </div>
            </div>
            <div class="skill-category">
                <h3>Backend</h3>
                <div class="skills-list">
                    <span class="skill">PHP</span>
                    <span class="skill">MySQL</span>
                    <span class="skill">RESTful APIs</span>
                    <span class="skill">Server Management</span>
                </div>
            </div>
            <div class="skill-category">
                <h3>Tools & Technologies</h3>
                <div class="skills-list">
                    <span class="skill">Docker</span>
                    <span class="skill">Nginx</span>
                    <span class="skill">Git</span>
                    <span class="skill">Linux</span>
                    <span class="skill">Composer</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_template('footer.php', [
    'additional_js' => $additional_js
]);
?>
