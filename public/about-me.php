<?php
/**
 * About Me page for ShayNeeo's Portfolio
 */

// Include helper functions
require_once dirname(__DIR__) . '/private/includes/functions.php';

// Page-specific variables
$title = 'About Me';
$additional_css = 'about-me.css,modern-effects.css';
$additional_js = '';

// Include header
include_template('header.php', [
    'title' => $title,
    'additional_css' => $additional_css
]);
?>

<div class="about-container">
    <section class="about-header">
        <h1>About ShayNeeo</h1>
        <div class="profile-section">
            <div class="profile-image">
                <img src="<?php echo asset('images/blogger.jpg'); ?>" alt="ShayNeeo's Profile Picture">
            </div>
            <div class="profile-intro">
                <h2>Full Stack Developer & Problem Solver</h2>
                <p>I'm a passionate developer who loves creating innovative web solutions and turning complex problems into elegant, user-friendly applications.</p>
            </div>
        </div>
    </section>

    <section class="about-content">
        <div class="content-grid">
            <div class="about-text">
                <h2>My Story</h2>
                <p>Hello! I'm ShayNeeo, a dedicated full-stack developer with a passion for creating exceptional digital experiences. My journey in web development started with curiosity and has evolved into a career focused on building robust, scalable, and beautiful web applications.</p>
                
                <p>I believe in the power of clean code, thoughtful design, and user-centered development. Whether I'm working on a complex backend system or crafting an intuitive user interface, I always strive for excellence and attention to detail.</p>
                
                <h2>What I Do</h2>
                <p>I specialize in full-stack web development, with expertise in both frontend and backend technologies. I enjoy working on projects that challenge me to learn new technologies and solve complex problems.</p>
                
                <div class="specialties">
                    <div class="specialty">
                        <h3>🎨 Frontend Development</h3>
                        <p>Creating responsive, interactive user interfaces with modern web technologies</p>
                    </div>
                    <div class="specialty">
                        <h3>⚙️ Backend Development</h3>
                        <p>Building robust server-side applications and RESTful APIs</p>
                    </div>
                    <div class="specialty">
                        <h3>🚀 System Architecture</h3>
                        <p>Designing scalable applications with optimal performance</p>
                    </div>
                </div>
            </div>
            
            <div class="skills-sidebar">
                <h2>Technical Skills</h2>
                <div class="skill-group">
                    <h3>Languages</h3>
                    <div class="skill-list">
                        <span class="skill-item">PHP</span>
                        <span class="skill-item">JavaScript</span>
                        <span class="skill-item">HTML5</span>
                        <span class="skill-item">CSS3</span>
                        <span class="skill-item">SQL</span>
                    </div>
                </div>
                
                <div class="skill-group">
                    <h3>Frameworks & Libraries</h3>
                    <div class="skill-list">
                        <span class="skill-item">jQuery</span>
                        <span class="skill-item">Bootstrap</span>
                        <span class="skill-item">Composer</span>
                    </div>
                </div>
                
                <div class="skill-group">
                    <h3>Tools & Technologies</h3>
                    <div class="skill-list">
                        <span class="skill-item">Docker</span>
                        <span class="skill-item">Nginx</span>
                        <span class="skill-item">Linux</span>
                        <span class="skill-item">Git</span>
                        <span class="skill-item">MySQL</span>
                    </div>
                </div>
                  <div class="contact-info">
                    <h3>Let's Connect</h3>
                    <p>I'm always interested in new opportunities and collaborations. Feel free to reach out!</p>
                    <div class="contact-links">
                        <a href="mailto:admin@pt.io.vn" class="contact-link email-link" target="_blank" rel="noopener noreferrer">
                            📧 Email Me
                        </a>
                        <a href="https://www.linkedin.com/in/shayneeo/" class="contact-link linkedin-link" target="_blank" rel="noopener noreferrer">
                            💼 LinkedIn
                        </a>
                        <a href="https://github.com/ShayNeeo" class="contact-link github-link" target="_blank" rel="noopener noreferrer">
                            🐙 GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
// Include footer
include_template('footer.php', [
    'additional_js' => $additional_js
]);
?>
