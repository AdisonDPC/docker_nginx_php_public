FROM debian:buster-slim

ENV DEBIAN_FRONTEND noninteractive

WORKDIR /var/www/html

ENV PHP_VERSION 8.0

RUN apt update && apt upgrade -y && apt install -y \
    build-essential \
    wget \
    vim
    git \
    unzip \
    ccze \
    nginx \
    pkg-config \
    libpng-dev \
    libjpeg-dev \
    lsb-release \
    apt-transport-https \
    ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    set -ex; \
        echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt update && apt install -y \
    php$PHP_VERSION-fpm \
    php$PHP_VERSION-cli \
    php$PHP_VERSION-common \
    # php$PHP_VERSION-json \
    php$PHP_VERSION-opcache \
    php$PHP_VERSION-mysql \
    php$PHP_VERSION-phpdbg \
    php$PHP_VERSION-mbstring \
    php$PHP_VERSION-gd \
    php$PHP_VERSION-imap \
    php$PHP_VERSION-ldap \
    php$PHP_VERSION-pgsql \
    php$PHP_VERSION-pspell \
    php$PHP_VERSION-snmp \
    php$PHP_VERSION-tidy \
    php$PHP_VERSION-dev \
    php$PHP_VERSION-intl \
    php$PHP_VERSION-curl \
    php$PHP_VERSION-zip \
    php$PHP_VERSION-xml \
    php$PHP_VERSION-sqlite3 \
    php-imagick \
    php-memcached \
    php-redis && \
    git clone git://github.com/xdebug/xdebug.git && \
    cd xdebug && \
    phpize && \
    bash configure && \
    make && \
    make install && \
    cd .. && \
    rm -Rf xdebug && \
    set -ex; { \
        echo "; configuration for php xdebug module"; \
        echo "; priority=20"; \
        echo "zend_extension=xdebug.so"; \
    } > /etc/php/$PHP_VERSION/mods-available/xdebug.ini && \
    ln -s /etc/php/$PHP_VERSION/mods-available/xdebug.ini /etc/php/$PHP_VERSION/fpm/conf.d/20-xdebug.ini && \
    ln -s /etc/php/$PHP_VERSION/mods-available/xdebug.ini /etc/php/$PHP_VERSION/cli/conf.d/20-xdebug.ini && \
    ln -s /etc/php/$PHP_VERSION/mods-available/xdebug.ini /etc/php/$PHP_VERSION/phpdbg/conf.d/20-xdebug.ini && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '795f976fe0ebd8b75f26a6dd68f78fd3453ce79f32ecb33e7fd087d39bfeb978342fb73ac986cd4f54edd0dc902601dc') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Delete cache of apt and others.
RUN apt-get clean -y && \
    apt-get autoclean -y && \
    apt-get autoremove -y && \
    rm -rf /var/lib/{apt,dpkg,cache,log}/

# Copy NGiNX configuration file to Docker container.
COPY /config/nginx/nginx.conf /etc/nginx/nginx.conf
COPY /config/nginx/sites-available/ /etc/nginx/sites-available/

# Copy NGiNX SSL file to Docker container.
COPY /config/nginx/ssl/ /etc/nginx/ssl/

# Copy PHP configuration file to Docker container.
COPY /config/php/php.ini /etc/php/$PHP_VERSION/fpm/php.ini
COPY /config/php/www.conf /etc/php/$PHP_VERSION/fpm/pool.d/www.conf

# Copy docker-entrypoint.sh file to Docker container.
COPY docker-entrypoint.sh /docker-entrypoint.sh

EXPOSE 80 443

ENTRYPOINT [ "sh", "/docker-entrypoint.sh" ]
