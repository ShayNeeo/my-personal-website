// QR Code Generator JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.option-tab');
    const forms = document.querySelectorAll('.form-container');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and forms
            tabs.forEach(t => t.classList.remove('active'));
            forms.forEach(f => f.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding form
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });
    
    // File input validation
    const fileInput = document.getElementById('file');
    if(fileInput) {
        fileInput.addEventListener('change', function() {
            const maxSize = 10 * 1024 * 1024; // 10MB
            
            if(this.files[0].size > maxSize) {
                alert('File is too large. Maximum size is 10MB.');
                this.value = '';
            }
        });
    }
});
