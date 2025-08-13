# Invibe task / Laravel Filament Admin Panel – Products & Categories
This is a test task for a backend web developer using Laravel and Filament. This project is a demo administration panel built with **Laravel** and **Filament**, providing CRUD management for products and categories.  
It includes **Spatie Laravel Media Library** integration for image uploads and several extra features to improve admin experience.

### Bonus Functionality
- Language translations to the Slovak language is done using the Laravel 

- Soft deleteing fucntion, is implemented according the Filament documentation: https://filamentphp.com/docs/2.x/admin/resources/deleting-records

- Slug generation based on the product name is implemented accroding to the Filament documentation: https://filamentphp.com/docs/3.x/forms/advanced#generating-a-slug-from-a-title

- Quick Active/Inactive toggle directly in tables

- Only active categories available when assigning to products

- Timestamps in Europe/Bratislava timezone

- Media handling via Spatie Media Library. More here https://spatie.be/docs/laravel-medialibrary/v11

### Requirements
- **Laravel 12.22.1**
- **PHP 8.4+**
- **Composer 2.8.10**
- **MySQL 8+**
- **WSL 2 (Ubuntu 22.04.5 LTS) or native Ubuntu 22.04.5 LTS** – tested under WSL2 Ubuntu environment
- **Git**
**Filament v3.3.35**

### Installation & Setup
#### 1. Clone the repository
```bash
git clone https://github.com/Ado148/Invibe-task.git
cd Invibe-task
```

#### 2. Install PHP dependencies
```bash 
composer install
```

#### 3. Install Spatie Media Library
```bash
composer require spatie/laravel-medialibrary
```

#### 4. Create .env file and Update database settings
```bash
cp .env.example .env
```
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filament_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then in the .env file set the **APP_LOCALE=sk** to use Slovak translations.

Then you need to clear the configuration caches:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

#### 5. Run migrations and seed the database
```bash
php artisan migrate --seed
```

#### 6. Create storage symlink
```bash
php artisan storage:link
```

#### 7. start the local development server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

#### 8. Access the admin panel
Open your web browser and navigate to `http://127.0.0.1:8000`. The default credentials are:
- **Email:** admin@gmail.com
- **Password:** admin 

It is located in the seeder AdminSeeder.php file in the `database/seeders` directory.


### Known issues
- The message "The xxxxx field is required." is still in English although the translation packages are installed.