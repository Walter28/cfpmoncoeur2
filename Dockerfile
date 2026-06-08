FROM dunglas/frankenphp:php8.4.22-bookworm

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    ca-certificates \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

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

# Start command
CMD ["/start-container.sh"]

