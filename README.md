# ShayNeeo's Portfolio - Production Version

## 🚀 Deployment Instructions

1. **Upload entire folder** to your web server
2. **Point domain** to the `public/` directory  
3. **Set permissions** (Linux/Unix only):
   ```bash
   find . -type d -exec chmod 755 {} \;
   find . -type f -exec chmod 644 {} \;
   chmod -R 777 private/data/qr-generated
   chmod -R 777 private/data/qr-uploads
   ```

## 📋 Requirements

- PHP 7.4+
- Web server (Apache/Nginx)
- Write permissions for data directories

## 🌐 Live URLs

- Homepage: `/`
- About: `/about-me.php` 
- QR Generator: `/qr-code/`
- URL Shortener: `/shorts/`

---
**Ready for production! Upload and go live.** 🎯

1. Connect to your server using FTP/SFTP or your preferred file transfer method
2. Upload the entire contents of this folder to `/home/shayneeo_isadev/htdocs/sgn.is-a.dev/`
   - **IMPORTANT**: Make sure to include the `vendor` directory, which contains required PHP libraries
3. Ensure proper permissions are set:
   ```bash
   # Navigate to your website root
   cd /home/shayneeo_isadev/htdocs/sgn.is-a.dev/
   
   # Set permissions for directories
   find . -type d -exec chmod 755 {} \;
   
   # Set permissions for files
   find . -type f -exec chmod 644 {} \;
   
   # Set writable permissions for data directories
   chmod -R 777 private/data/qr-generated
   chmod -R 777 private/data/qr-uploads
   ```

4. After uploading, visit `https://sgn.is-a.dev/test-system.php` to verify everything works
5. If you encounter issues with the QR Code Generator, see `TROUBLESHOOTING-QR-GENERATOR.md` or visit `https://sgn.is-a.dev/fix-qr-generator.php`
6. If all tests pass, your site should be fully functional!

## Directory Structure

```
/home/shayneeo_isadev/htdocs/sgn.is-a.dev/
├── public/                 # Web-accessible files
│   ├── assets/
│   │   ├── css/            # All stylesheets
│   │   ├── js/             # All JavaScript
│   │   └── images/         # All images
│   ├── qr-code/            # QR code generator
│   ├── shorts/             # URL shortener
│   ├── index.php           # Main homepage
│   ├── about-me.php        # About me page
│   └── get_image.php       # Image handler
│
├── private/                # Not web-accessible
│   ├── data/
│   │   ├── qr-generated/   # QR code images
│   │   ├── qr-uploads/     # Uploaded files
│   │   └── links.json      # URL shortener data
│   └── includes/
│       ├── functions.php   # Helper functions
│       ├── header.php      # Common header
│       └── footer.php      # Common footer
│
├── config/                 # Configuration files
│   └── config.php          # Main configuration
│
├── vendor/                 # PHP libraries (required)
│   ├── autoload.php        # Composer autoloader
│   ├── chillerlan/         # QR code library
│   └── composer/           # Composer files
│       └── footer.php      # Common footer
│
├── config/
│   └── config.php          # Main configuration
│
└── vendor/                 # Composer dependencies
```

## Nginx Configuration

If you have access to your Nginx configuration, upload the `nginx-vhost-with-favicon` file to replace your current Nginx configuration.

## Troubleshooting

If you encounter any issues:

1. **500 Internal Server Error**:
   - Check the PHP error logs
   - Verify file permissions
   - Make sure all directories exist
   - Try accessing `https://sgn.is-a.dev/test-system.php` for detailed diagnostics

2. **Missing files or 404 errors**:
   - Verify that all files were uploaded successfully
   - Check that paths in `config.php` are correct
   - Ensure Nginx/Apache is configured correctly

3. **Permission issues**:
   - Make sure the data directories are writable
   - Command: `chmod -R 777 private/data`

## Important Files

- `public/test-system.php`: Run this first to check if everything works
- `config/config.php`: Main configuration file
- `private/includes/functions.php`: Common helper functions
- `nginx-vhost-with-favicon`: Nginx configuration (if applicable)

## Delete After Setup

After confirming everything works, you should delete these files:
- `public/test-system.php`
- `public/phpinfo.php`
- `create-favicon.sh` (after running it)
- This README file

## Questions?

If you have any questions or encounter issues not covered in this guide, please reach out to the developer who provided this reorganized structure.
