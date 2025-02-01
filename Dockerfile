# Используем официальный образ PHP 8.2
FROM php:8.2-cli

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    mariadb-client \
    cron && \
    docker-php-ext-install zip pdo_mysql sockets pcntl

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы приложения
COPY . .

# Устанавливаем зависимости Composer
RUN composer install --ignore-platform-reqs

# Копируем файл с cron задачами
COPY ./cronjobs /etc/cron.d/cronjobs

# Даем права на выполнение
RUN chmod 0644 /etc/cron.d/cronjobs

# Устанавливаем cron задачи
RUN crontab /etc/cron.d/cronjobs

# Запускаем cron и приложение
CMD service cron start && php artisan octane:start --host=0.0.0.0 --port=8000
