![Symfony Concepts](./assets/images/banner.png)

### Topics Explored

* Symfony Fundamentals(Services, Configs & Environments)
* Doctrine Basics

### How to Set up and run the Application
```bash
# Copy Config
# Feel free to update values in .env.local file as needed
cp ./.env ./.env.local

# Install php dependencies
composer update

# Configure MySQL database in .env.local file
DATABASE_URL="mysql://root:root@127.0.0.1:3306/symfony_concepts?serverVersion=5.7"

# Create Database
php bin/console make:database

# Migrate data to database
php bin/console doctrine:migrations:migrate

# Update Database with Dummy Data
php bin/console doctrine:fixtures:load

# Serve Application
symfony server:start
```

### Resources

[API Platform Website](https://api-platform.com/)

To access API from API Platform

```bash
# For Swagger UI 2.0
http://symfony-concepts.local/api

# For Swagger UI 3.0
http://symfony-concepts.local/api?spec_version=3
```

Generated Swagger Config file from API Platform

```bash
# Version 2
http://local.url/api/docs.json

# Version 3
http://local.url/api/docs.json?spec_version=3
```
