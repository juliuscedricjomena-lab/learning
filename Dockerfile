FROM php:8.2-apache

RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

RUN echo '<Directory /var/www/html/>' > /etc/apache2/conf-available/learning.conf && \
    echo '    Options Indexes FollowSymLinks' >> /etc/apache2/conf-available/learning.conf && \
    echo '    AllowOverride All' >> /etc/apache2/conf-available/learning.conf && \
    echo '    Require all granted' >> /etc/apache2/conf-available/learning.conf && \
    echo '</Directory>' >> /etc/apache2/conf-available/learning.conf && \
    a2enconf learning

EXPOSE 80

CMD ["apache2-foreground"]
