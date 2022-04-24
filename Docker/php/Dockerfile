FROM php:7.2-apache

ENV DEBIAN_FRONTEND=noninteractive

EXPOSE 80

# debian packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    htop \
    wget \
    lynx \
    curl \
    tree \
    mc \
    vim \
    libmcrypt-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxml2-dev \
    default-mysql-client \
    unzip \
    git \
    locales \
    tzdata \
    graphicsmagick \
    imagemagick \
    libmagickwand-dev

# locales
RUN printf 'en_GB.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'en_US.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'pt_BR.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && locale-gen

ENV LANGUAGE=pt_BR.UTF-8
ENV LC_ALL=pt_BR.UTF-8
ENV LC_CTYPE=UTF-8
ENV LANG=pt_BR.UTF-8

# localtime
ENV TZ='America/Manaus'
RUN echo $TZ > /etc/timezone \
    && rm /etc/localtime \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

# php modules
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    iconv \
    intl \
    opcache \
    xml \
    soap \
    opcache \
    zip \
    exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# php pecl modules
RUN pecl install xdebug imagick mcrypt-1.0.1 \
    && docker-php-ext-enable xdebug imagick mcrypt

# php composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# apache modules
RUN a2enmod rewrite

# apache rights
RUN usermod -o -u 1000 www-data

# imagemagick
RUN ln -s /usr/lib/x86_64-linux-gnu/ImageMagick-6.8.9/bin-Q16/MagickWand-config /usr/bin/

# cleanup
RUN apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && rm -fr /tmp/* \
    && rm -fr /var/tmp/*
