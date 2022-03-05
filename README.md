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

- Run fresh database migration and seeders
```shell
php artisan migrate:fresh --seed
```

- Serve the application depending on your setup


### Queues

- This application makes use of queues, and database driver has been employed for demo purposes
Be sure to add `QUEUE_CONNECTION=database` to use the database drivers or `QUEUE_CONNECTION=sync`
to test without queuing jobs.
  
- Run the queue command to start the queue worker if a queue driver was used
```shell
php artisan queue:work --queue=high,default
```

### Task Scheduling

- This application makes use of laravel task scheduler to schedule the command responsible for updating posts from feed server

- First ensure the `FEED_SERVER` env variable is set to the new posts endpoint
`FEED_SERVER=https://sq1-api-test.herokuapp.com/posts`
  
- The task scheduler can be started locally by running the command
```shell
php artisan schedule:work
```

- Alternatively, the scheduled command can be run from the command line by running the custom artisan command
```shell
php artisan posts:update
```

## Testing

- To test the application, run
```shell
php artisan test
```

## Packages

The project makes use of a few packages. The packages of note are listed below.

### Authentication

This application uses _laravel/breeze_ as a session based authentication for the project.
For more information, visit **[Laravel Breeze Documentation](https://laravel.com/docs/9.x/starter-kits#laravel-breeze)**

### Debugging

This application uses _barryvdh/laravel-debugbar_ for debugging throughout the development process.
For more information, visit **[Laravel Debugbar Documentation](https://github.com/barryvdh/laravel-debugbar#installation)**
