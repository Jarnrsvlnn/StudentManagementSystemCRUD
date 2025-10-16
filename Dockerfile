# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install the PDO MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (useful for routing)
RUN a2enmod rewrite

# Copy your app into the container (optional if mounted by volume)
WORKDIR /var/www

# Set the document root to public (if that's where index.php is)
WORKDIR /var/www/html

# Expose port 80 for the web server
EXPOSE 80
