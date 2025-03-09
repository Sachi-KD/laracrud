FROM php:8.3-fpm
RUN apt update && apt install -y default-mysql-client \
    git \
    curl \
    libfreetype-dev \
	libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    vim \
    telnet \
    net-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www 
EXPOSE 9000
