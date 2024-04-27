# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Update the default apache site with the config we created
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Set the include_path
RUN echo 'include_path = ".:/usr/local/lib/php:/var/www/html:/var/www"' > /usr/local/etc/php/conf.d/custom.ini

# Expose port 80 for the web server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
