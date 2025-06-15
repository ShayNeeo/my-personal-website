// Enhanced Portfolio JavaScript functionality
// Updated: 2025-06-15 - Modern interactions and animations

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links with easing
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight - 20;
                
                // Enhanced smooth scrolling with custom easing
                const startPosition = window.pageYOffset;
                const distance = targetPosition - startPosition;
                const duration = 800;
                let start = null;
                
                function animation(currentTime) {
                    if (start === null) start = currentTime;
                    const timeElapsed = currentTime - start;
                    const run = easeInOutCubic(timeElapsed, startPosition, distance, duration);
                    window.scrollTo(0, run);
                    if (timeElapsed < duration) requestAnimationFrame(animation);
                }
                
                function easeInOutCubic(t, b, c, d) {
                    t /= d/2;
                    if (t < 1) return c/2*t*t*t + b;
                    t -= 2;
                    return c/2*(t*t*t + 2) + b;
                }
                
                requestAnimationFrame(animation);
            }
        });
    });
    
    // Enhanced Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -80px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Add staggered animation for project cards
                if (entry.target.classList.contains('project-card')) {
                    const cards = document.querySelectorAll('.project-card');
                    const index = Array.from(cards).indexOf(entry.target);
                    entry.target.style.animationDelay = `${index * 0.1}s`;
                }
            }
        });
    }, observerOptions);

    // Observe all animated elements
    const animatedElements = document.querySelectorAll('.project-card, .skill-category, .hero-text, .hero-image');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(element);
    });

    // Add CSS for animate-in class
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);    
    // Enhanced typing effect with better performance
    const heroTitle = document.querySelector('.hero-text h1');
    if (heroTitle) {
        const fullText = "Hi, I'm ShayNeeo";
        const highlightWord = "ShayNeeo";
        
        // Store original content
        const originalContent = heroTitle.innerHTML;
        heroTitle.style.opacity = '0';
        heroTitle.innerHTML = '';
        
        let currentIndex = 0;
        
        function typeCharacter() {
            if (currentIndex <= fullText.length) {
                const currentText = fullText.substring(0, currentIndex);
                
                // Apply highlighting to ShayNeeo if it's been typed
                if (currentText.includes(highlightWord)) {
                    const highlightedText = currentText.replace(highlightWord, `<span class="highlight">${highlightWord}</span>`);
                    heroTitle.innerHTML = highlightedText;
                } else {
                    heroTitle.innerHTML = currentText;
                }
                
                currentIndex++;
                
                // Variable typing speed for more natural feel
                const baseSpeed = 100;
                const variance = Math.random() * 50;
                setTimeout(typeCharacter, baseSpeed + variance);
            } else {
                // Add cursor blink effect briefly
                heroTitle.innerHTML += '<span class="cursor">|</span>';
                setTimeout(() => {
                    const cursor = heroTitle.querySelector('.cursor');
                    if (cursor) cursor.remove();
                }, 1000);
            }
        }
        
        // Start typing effect after hero section is visible
        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    heroTitle.style.opacity = '1';
                    setTimeout(typeCharacter, 800);
                    heroObserver.unobserve(entry.target);
                }
            });
        });
        
        heroObserver.observe(heroTitle);
    }
    
    // Add parallax effect to hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        });
    }
    
    // Add dynamic header background on scroll
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            if (scrolled > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.backdropFilter = 'blur(25px)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(20px)';
            }
        });
    }
    
    // Add hover effects for interactive elements
    const interactiveElements = document.querySelectorAll('.btn, .project-card, .skill, .tech-tag');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = this.style.transform.replace('scale(1)', '') + ' scale(1.02)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = this.style.transform.replace(/scale\([^)]*\)/, '');
        });
    });
    
    // Add loading states for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        if (!img.complete) {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.5s ease';
            
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        }
    });
    
    console.log('Enhanced Portfolio.js loaded - Modern animations and interactions active');
});
