# Install Composer dependencies in Slim_Test_V1.

USER_ROOT='root';
GROUP='www-data';

# Configuring site in NGiNX server.

ETC_FILE='/etc';
NGINX_SITE_AVAILABLE=${ETC_FILE}'/nginx/sites-available';
NGINX_SITE_ENABLE=${ETC_FILE}'/nginx/sites-enabled';
NGINX_WWW_FOLDER='/var/www/html';

rm ${NGINX_SITE_ENABLE}/default

# BEGIN - Multi NGiNX configuration files.

cd ${NGINX_SITE_AVAILABLE}

for FILE in $(ls *.conf)
do

    ln -s ${NGINX_SITE_AVAILABLE}/${FILE} ${NGINX_SITE_ENABLE}/${FILE}

done

ln -s ${NGINX_SITE_AVAILABLE}/${VIRTUAL_TYPE}.docker ${NGINX_SITE_ENABLE}/site.docker.conf

# END - Multi NGiNX configuration files.

echo "${SERVER_ADDR} DB_MARIA_DB_LOCAL" >> ${ETC_FILE}/hosts
echo "${SERVER_ADDR} SERVER_HOSTNAME" >> ${ETC_FILE}/hosts
echo "127.0.0.1 ${VIRTUAL_HOST}" >> ${ETC_FILE}/hosts

# Run NGiNX and PHP services.

service php7.4-fpm start
service nginx start

# BEGIN IMPORTANT - SET PERMISIONS, USER, GROUPS IN SITE FILES.

# CUSTOM CODE HERE!!!!

# END IMPORTANT - SET PERMISIONS, USER, GROUPS IN SITE FILES.

# Uncomment for open depuration terminal.

# /bin/bash

# Uncomment for show NGiNX access logs.

tail -f /var/log/nginx/access.log /var/log/nginx/error.log | ccze
