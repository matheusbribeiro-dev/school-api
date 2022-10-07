FROM php:8.1.7-apache-bullseye
# Arguments defined in docker-compose.yml
ARG user
ARG uid

ENV ACCEPT_EULA=Y

RUN a2enmod ssl \
    && a2enmod rewrite
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    gnupg2 \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    bzr \
    cvs \
    subversion \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd && \
    pecl install xdebug && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/* 

# Retrieve the script used to install PHP extensions from the source container.
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Habilita no PHP.ini. PHP extensions and all their prerequisites available via apt.
RUN chmod uga+x /usr/bin/install-php-extensions \
    && sync \
    && install-php-extensions bcmath ds exif gd intl opcache pcntl pdo_sqlsrv redis sqlsrv zip xdebug \
    && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/html/school-app

USER $user

CMD ["apachectl", "-D", "FOREGROUND"]