# 🌐 Personal Portfolio & Web Tools

A modern, feature-rich personal portfolio website with integrated web tools including QR code generation and URL shortening capabilities. Built with PHP and modern web technologies, featuring a clean design and responsive layout.

## ✨ Features

### 🏠 Portfolio Website
- **Modern responsive design** with smooth animations and effects
- **About page** with personal information and social links
- **Project showcase** with detailed descriptions and technologies used
- **Mobile-friendly** interface that works on all devices

### 🔗 QR Code Generator
- **Link-to-QR conversion** - Generate QR codes for any URL
- **File upload QR codes** - Upload files and generate QR codes for download links
- **Multiple image formats** supported (PNG, JPG, GIF, etc.)
- **Automatic file management** with secure upload handling
- **Download functionality** for generated QR codes

### 📎 URL Shortener
- **Custom short URLs** - Create memorable short links
- **Link management** - Admin interface for managing shortened URLs
- **Analytics ready** - Track link usage (extendable)
- **Secure redirect system** with 404 handling

## � Quick Start

### Prerequisites
- **PHP 7.4+** (PHP 8.0+ recommended)
- **Web server** (Apache/Nginx)
- **Composer** for dependency management
- **Write permissions** for data directories

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/portfolio-web-tools.git
   cd portfolio-web-tools
   ```

2. **Install dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Configure your web server**
   - Point your domain/subdomain to the `public/` directory
   - Ensure `.htaccess` files are processed (Apache) or configure URL rewriting (Nginx)

4. **Set permissions** (Linux/Unix)
   ```bash
   find . -type d -exec chmod 755 {} \;
   find . -type f -exec chmod 644 {} \;
   chmod -R 777 private/data/qr-generated
   chmod -R 777 private/data/qr-uploads
   ```

5. **Access your site**
   - Homepage: `https://yourdomain.com/`
   - QR Generator: `https://yourdomain.com/qr-code/`
   - URL Shortener: `https://yourdomain.com/shorts/`

## 📁 Project Structure

```
portfolio-web-tools/
├── 📂 public/                  # Web-accessible files (document root)
│   ├── 📂 assets/
│   │   ├── 📂 css/            # Stylesheets
│   │   ├── 📂 js/             # JavaScript files
│   │   └── 📂 images/         # Image assets
│   ├── 📂 qr-code/            # QR code generator
│   │   ├── index.php          # Main QR generator interface
│   │   ├── download.php       # File download handler
│   │   └── view-qr.php        # QR code display
│   ├── 📂 shorts/             # URL shortener
│   │   ├── index.php          # URL redirect handler
│   │   └── admin.php          # Link management
│   ├── index.php              # Portfolio homepage
│   ├── about-me.php           # About page
│   └── get_image.php          # Image serving utility
│
├── 📂 private/                 # Non-web-accessible files
│   ├── 📂 data/
│   │   ├── 📂 qr-generated/   # Generated QR code images
│   │   ├── 📂 qr-uploads/     # Uploaded files
│   │   └── links.json         # URL shortener database
│   └── 📂 includes/
│       ├── functions.php      # Helper functions
│       ├── header.php         # Common header template
│       └── footer.php         # Common footer template
│
├── 📂 config/                  # Configuration files
│   └── config.php             # Main configuration
│
├── 📂 vendor/                  # Composer dependencies
│   └── chillerlan/php-qrcode/ # QR code generation library
│
├── composer.json              # Composer configuration
├── README.md                  # This file
└── DEPLOYMENT.md             # Deployment guide
```

## 🛠️ Configuration

### Basic Setup
1. **Edit `config/config.php`** to customize paths and settings
2. **Customize `private/includes/header.php`** with your information
3. **Update social links** in the about page
4. **Replace images** in `public/assets/images/` with your own

### Advanced Configuration
- **URL Shortener**: Edit the admin interface in `public/shorts/admin.php`
- **QR Code Settings**: Modify QR generation options in the QR code files
- **Styling**: Customize CSS files in `public/assets/css/`

## 🔧 Dependencies

This project uses the following main dependencies:

- **[chillerlan/php-qrcode](https://github.com/chillerlan/php-qrcode)** - QR code generation library
- **[chillerlan/php-settings-container](https://github.com/chillerlan/php-settings-container)** - Settings management

All dependencies are managed via Composer and included in the `vendor/` directory.

## 🌐 Web Server Configuration

### Apache
The project includes `.htaccess` files for clean URLs. Ensure `mod_rewrite` is enabled.

### Nginx
Example configuration:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/portfolio-web-tools/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Security: Block access to private directories
    location ~ ^/(private|config|vendor) {
        deny all;
        return 404;
    }
}
```

## 🚀 Deployment Guide

### For Production Deployment

1. **Upload to your web server**
   ```bash
   # Using SCP/SFTP
   scp -r portfolio-web-tools/ user@yourserver:/path/to/web/root/
   
   # Or using FTP client like FileZilla
   ```

2. **Set up web server** to point to the `public/` directory as document root

3. **Set proper permissions**
   ```bash
   cd /path/to/portfolio-web-tools/
   find . -type d -exec chmod 755 {} \;
   find . -type f -exec chmod 644 {} \;
   chmod -R 777 private/data/qr-generated
   chmod -R 777 private/data/qr-uploads
   ```

4. **Test your deployment**
   - Visit your homepage to ensure it loads correctly
   - Test QR code generation functionality
   - Test URL shortener functionality

### For Development

1. **Local development server**
   ```bash
   # Using PHP built-in server
   cd public/
   php -S localhost:8000
   ```

2. **Or use XAMPP/WAMP/MAMP**
   - Place the project in your htdocs/www folder
   - Access via `http://localhost/portfolio-web-tools/public/`

## 🔒 Security Considerations

- **Private directories** are protected from web access
- **File uploads** are validated and stored securely
- **Input sanitization** is implemented for all user inputs
- **Error handling** prevents sensitive information disclosure

## 🎨 Customization

### Personalizing the Portfolio

1. **Update personal information**
   - Edit `public/index.php` for homepage content
   - Edit `public/about-me.php` for about page
   - Replace images in `public/assets/images/`

2. **Customize styling**
   - Modify CSS files in `public/assets/css/`
   - Update color schemes, fonts, and layouts
   - Add your own animations and effects

3. **Add new features**
   - Extend the QR code generator with new options
   - Add analytics to the URL shortener
   - Create additional pages or tools

### Social Media Integration

Update the social media links in your templates:
- GitHub profile
- LinkedIn profile
- Twitter/X profile
- Instagram profile
- Facebook profile

## 🤝 Contributing

If you'd like to contribute to this project:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-feature`)
3. **Commit your changes** (`git commit -m 'Add some amazing feature'`)
4. **Push to the branch** (`git push origin feature/amazing-feature`)
5. **Open a Pull Request**

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support & Troubleshooting

### Common Issues

**1. 500 Internal Server Error**
- Check PHP error logs
- Verify file permissions are correct
- Ensure all required directories exist
- Check that Composer dependencies are installed

**2. QR Code Generation Fails**
- Verify `vendor/` directory exists and is complete
- Check write permissions on `private/data/qr-generated/`
- Ensure PHP GD extension is enabled
- Run `composer install` if dependencies are missing

**3. File Upload Issues**
- Check write permissions on `private/data/qr-uploads/`
- Verify PHP upload settings (`upload_max_filesize`, `post_max_size`)
- Ensure sufficient disk space

**4. URL Shortener Not Working**
- Check write permissions on `private/data/links.json`
- Verify web server URL rewriting is configured
- Check that the shorts directory is accessible

### Getting Help

If you encounter issues not covered here:

1. **Check the logs** - PHP error logs will often show the exact problem
2. **Verify requirements** - Ensure your server meets all prerequisites
3. **Test step by step** - Isolate the problem by testing individual components
4. **Create an issue** - If you believe there's a bug, create a GitHub issue with:
   - Detailed description of the problem
   - Steps to reproduce
   - Server environment details (PHP version, web server, etc.)
   - Any error messages from logs

## 🔗 Useful Links

- [PHP Official Documentation](https://www.php.net/docs.php)
- [Composer Documentation](https://getcomposer.org/doc/)
- [chillerlan/php-qrcode Library](https://github.com/chillerlan/php-qrcode)

## 📊 Features Roadmap

Future enhancements being considered:

- [ ] **Analytics Dashboard** - Track QR code scans and short link clicks
- [ ] **User Authentication** - Multi-user support with login system
- [ ] **API Endpoints** - REST API for programmatic access
- [ ] **Bulk Operations** - Generate multiple QR codes at once
- [ ] **Custom Domains** - Support for custom short link domains
- [ ] **Database Support** - MySQL/PostgreSQL option instead of JSON files
- [ ] **Dark Mode** - Theme switching capability
- [ ] **Multi-language** - Internationalization support

---

**⭐ If you find this project useful, please consider giving it a star on GitHub!**

Built with ❤️ using PHP, JavaScript, and modern web technologies.
