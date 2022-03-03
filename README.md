# Web Blogging Platform

## Technical Assignment

## Introduction

This repository holds a web blogging platform, developed as a technical assignment. 
To set up the project, follow the instructions

## Installation

- Clone the repository
```shell
git clone https://github.com/ElmageAce/dev-assignment.git
```

- Set up the _.env_ file using the _.env.example_ file

- Install project dependencies
```shell
composer install
```

- Generate laravel _APP_KEY_
```shell
php artisan key:generate
```

- MySQL database is used in this project. 
Set up your MySQL database and update the _.env_ file with your database information

- Run fresh database migration and seeders if available
```shell
php artisan migrate:fresh --seed
```

- Serve the application depending on your setup

## Packages

The project makes use of a few packages. The packages of note are listed below.

### Authentication

This application uses _laravel/breeze_ as a session based authentication for the project.
For more information, visit **[Laravel Breeze Documentation](https://laravel.com/docs/9.x/starter-kits#laravel-breeze)**

### Debugging

This application uses _barryvdh/laravel-debugbar_ for debugging throughout the development process.
For more information, visit **[Laravel Debugbar Documentation](https://github.com/barryvdh/laravel-debugbar#installation)**
