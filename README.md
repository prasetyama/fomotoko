## Run

TECH STACK : LARAVEL
Database : MYSQL

Git Clone

type this command to run:

```Shell
git clone https://github.com/prasetyama/fomotoko.git
```

```Shell
composer install
```

Create file .env and change with your database config

```Shell
cp .env.example .env
```

Created Database

Migrate Database

```Shell
php artisan migrate
```

Add Product Seeder
```Shell
php artisan db:seed --class=CreateProductSeeder
```

Genereta JWT Secret
```Shell
php artisan jwt:secret
```

## Run this Project
```Shell
php artisan serve
```

## API Documentation POSTMAN
There is postman file in folder postman

You can create orders for comman using laravel prompt implement bulk orders, you can change how many repeat order in file app/console/commands/MakeOrder.php
Run this command
```Shell
php artisan app:make-order
```
