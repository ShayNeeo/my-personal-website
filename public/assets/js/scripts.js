// Main JavaScript for the website

document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if(targetId !== '#') {
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Mobile menu toggle (if needed)
    const menuToggle = document.querySelector('.menu-toggle');
    if(menuToggle) {
        const navMenu = document.querySelector('nav ul');
        
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('show');
        });
    }
});
