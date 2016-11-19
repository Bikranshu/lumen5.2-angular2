Lumen 5.2 Framework + Angular2 project.

## Versions
- Laravel 5.2.0
- Angular 2.0.0


## Requirements

- PHP >= 5.6.4
- NodeJs
- [Composer](https://getcomposer.org/download/) - Package manager for PHP
- [NPM](https://npmjs.org/) - Node package manager
- [Gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md#getting-started)
    run command on terminal 'npm install --global gulp-cli'


## Installation

- clone repository
- run command on terminal `composer install`
- go to project folder and run `php -S localhost:8000 -t public/`
- run command on terminal `gulp`


## Database

Set proper credentials in `.env` file in order to use database.

Run migrations via `php artisan migrate`.
