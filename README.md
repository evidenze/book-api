## Book API
Built with Laravel 9

Prerequisites
-------------

- [Mysql](https://www.mysql.com/) or [Postgresql](http://www.postgresql.org/)
- [PHP 8.1.0](http://php.net/)
- Command Line Tools

## Build Setup

```bash
# Get the project
git clone https://github.com/evidenze/book-api.git book-api

# Change directory
cd book-api

# Copy .env.example to .env
cp .env.example .env

# Create a database (with mysql)
# And update .env file with database credentials
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=bookapi
# DB_USERNAME=root
# DB_PASSWORD=root

# Install Composer dependencies
composer install 

# Generate application secure key (in .env file)
php artisan key:generate

# Start the app
php artisan serve

# Run tests
php artisan test
```

API Endpoints
-----------------

| Endpoint                                 | Description                    |
| ----------------------------------       | ------------------------------ |
| **api/v1**/books (POST)                  | Create a new book              |
| **api/v1**/books  (GET)                  | Return all books               |
| **api/v1**/books/{id} (PATCH)            | Update the specified book      |
| **api/v1**/books/{id}  (GET)             | Return the specified book      |
| **api/v1**/books/{id}  (DELETE)          | Delete the specified book      |
| **api/external-books**/                  | Return external books          |
