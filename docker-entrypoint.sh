# Install Composer dependencies in slim_test_v1.

USER_ROOT='root';
GROUP='www-data';

cd slim_test_v1

composer install
composer clear-cache
composer dump-autoload

# Configuring site in NGiNX server.

rm /etc/nginx/sites-enabled/default

ln -s /etc/nginx/sites-available/slim.conf /etc/nginx/sites-enabled/slim.conf

# Run NGiNX and PHP services.
service php7.3-fpm start
service nginx start

# Uncomment for open depuration terminal.
# /bin/bash

# Uncomment for show NGiNX access logs.
tail -f /var/log/nginx/access.log /var/log/nginx/error.log | ccze
