FROM php:8.4-fpm-bookworm

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    ca-certificates \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Install Node dependencies
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs && \
    npm ci && \
    npm run build && \
    npm prune --omit=dev

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache && \
    chmod -R a+rw storage

# Cache Laravel config
RUN php artisan config:cache && \
    php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Install Caddy
RUN curl -1sLf 'https://dl.caddy.community/linux/caddy_linux_amd64.tar.gz' | tar -xz -C /usr/local/bin/

# Create Caddyfile
RUN echo ':80 { \
    root * /app/public \
    encode gzip \
    try_files {path} {path}/ /index.php?{query} \
    php_fastcgi localhost:9000 \
    file_server \
}' > /etc/Caddyfile

# Expose port
EXPOSE 80

# Start PHP-FPM and Caddy
CMD ["sh", "-c", "php-fpm -D && caddy run --config /etc/Caddyfile"]

