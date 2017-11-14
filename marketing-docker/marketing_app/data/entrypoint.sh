#!/bin/bash

# Update vendoer of marketing_app
cd /var/www/marketing-rest-api
/usr/local/bin/composer/composer.phar install

# Clean all caches
php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev
php bin/console cache:clear --env=test

# Apply all rights on cache folder again
chmod o+rwx /var/www/marketing-rest-api/var/cache -R
chmod o+rwx /var/www/marketing-rest-api/var/logs -R
chmod o+rwx /var/www/marketing-rest-api/var/sessions -R

# Startup
/etc/init.d/cron start
/etc/init.d/php7.1-fpm restart
/etc/init.d/nginx restart

# Keep container alive
top -bc