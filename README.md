# choresApp
Laravel WebApp for lazy people. To help people do their chores.

## Dev Env Information

### 1. Create your dev db:

``` 
Mysql -u root -p 
Enter password: your_password 
create database your_dbname; 
use your_dbname; 
show tables; 
exit
```

### 2. Clone the repo in the server \www folder and cd in your project directory

### 3. Install the dependencies with composer:

```
composer install
composer dumpautoload -o
```

### 4. Copy the environment template

```
cp .env.example .env
```

### 5. Generate the key for your env file

```
php artisan key:generate
```

### 6. Edit the .env file with your db information (name/pass)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_dbname
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 7. Migrate DB tables
```
php artisan migrate
```

### 8. Clear the config and generate the cache

```
php artisan config:clear
php artisan config:cache
```

### 9. Use Artisan to run the server

```
php artisan serve
```