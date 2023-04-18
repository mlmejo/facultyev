# Install application dependencies

```
composer install
```

```
npm install
```

# Copy and configure .env file

```
copy .env.example .env
```

# Migrate and seed database

```
php artisan migrate --seed
```

# Create application secret key

```
php artisan key:generate
```

# Start up backend server

```
php artisan serve
```
