FROM php:8.2-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales ghostscript imagemagick libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev supervisor cron
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  locale-gen en_US.UTF-8 && \
  localedef -f UTF-8 -i en_US en_US.UTF-8 && \
  mkdir /var/run/php-fpm && \
  docker-php-ext-install intl pdo_mysql zip bcmath gd && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org

# Create a Supervisor configuration directory
RUN mkdir -p /etc/supervisor/conf.d

# Copy Supervisor configuration file into the container directory
COPY ./docker/php/supervisor/laravel-worker.conf /etc/supervisor/conf.d/docker-worker.conf

# Add crontab file
COPY ./docker/php/schedule/crontab /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Apply cron job
RUN crontab /etc/cron.d/crontab

# Start the cron service

COPY ./docker/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/policy.xml /etc/ImageMagick-6/policy.xml
WORKDIR /var/www/app

CMD bash -c "cron && /usr/bin/supervisord -c /etc/supervisor/supervisord.conf && php-fpm"
