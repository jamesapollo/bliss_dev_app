# BLISS DEV APP

This is a PHP application that manages patients records.

## Installation & Configuration

Create a database for use with this application.

Go to the root folder of this project and open the config.php file.

Set the database configuration here (for example):
```bash
'db_host' => 'localhost',

'db_name' => 'bliss_dev_app',

'db_username' => 'root',

'db_password' => '',
```

Bliss Dev App does not contain any third party PHP packages. This means there will be requirement to use 'composer install'.

In order to run it, place this project in the root folder or "xampp" if your are using windows or "/var/www/" if using linux. Navigate to the root folder of the files and run the following command to migrate the database

```bash
php bliss-migrate
```

This will cater for all the table creation and table seeding that is necessary.

Next one is required to start the PHP server from the command line by running the following command:


```bash
php -S localhost:8000
```

## Routes

```bash
http:localhost:8000
```
