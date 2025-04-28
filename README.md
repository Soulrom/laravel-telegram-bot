<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Telegram Bot

This project is an example of a bot built on Laravel that processes messages via Telegram Webhook. It uses Docker to run the environment and supports asynchronous task processing through Laravel Queue.

## Installation

1. **Clone the repository:**

    Clone the repository to your local machine:

    ```bash
    git clone https://github.com/yourusername/laravel-bot-telegram.git
    cd laravel-bot-telegram
    ```

2. **Set up Docker:**

    If you are using Docker, start the container:

    ```bash
    ./vendor/bin/sail up -d
    ```

3. **Set up the environment:**

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

4. **Configure .env:**

    Edit the `.env` file and provide the following settings:

    - `TELEGRAM_BOT_TOKEN`: your Telegram bot token.
    - `TELEGRAM_WEBHOOK_URL`: the URL of your webhook (usually in the format `https://yourdomain.com/bot/webhook`).

    Example:

    ```env
    TELEGRAM_BOT_TOKEN=your-telegram-bot-token
    TELEGRAM_WEBHOOK_URL=https://yourdomain.com/bot/webhook
    ```

5. **Install dependencies:**

    Use Composer to install the required packages:

    ```bash
    ./vendor/bin/sail composer install
    ```

6. **Run migrations and seeders:**

    Run the database migrations:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

    If needed, run the seeders:

    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

## Running the Queue

To start the queue for processing tasks asynchronously, use the following command:

```bash
./vendor/bin/sail artisan queue:work
```
