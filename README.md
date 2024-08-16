# Quick Start - Project With Laravel 10.x , php8.1,Jquery, Node - v14.21.1

### Step by step
Clone this Repository
```sh
git clone https://github.com/sahasujoy/laravel-10-structure
```

Create the .env file
```sh
Go project folder
cp .env.example .env
```


Update environment variables in .env
```dosini
APP_NAME="Name Your Project"
APP_URL=http://localhost:8080
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=name_you_want_db
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Install project dependencies
```sh
composer install
```

Install node package dependencies
```sh
npm  install
npm run dev
```


Generate the Laravel project key
```sh
php artisan key:generate
```

Run database migration
```sh
php artisan migrate
```

Run seeder
```sh
php artisan db:seed
```

Start the local development server
```sh
php artisan serve
```

Admin credential
```sh
Url : http://127.0.0.1:8000/admin
User : admin@mail.com
Password : 123456
```

User credential
```sh
Url : http://127.0.0.1:8000
User : user@mail.com
Password : 123456
```

On development run
```sh
npm run dev 
or
npm run watch
```

Access admin panel
[ http://127.0.0.1:8000/admin ]

Access user panel
[ http://127.0.0.1:8000 ]
