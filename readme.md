## Requirements
- [Composer](https://getcomposer.org/download/) - Package manager for PHP
- [NPM](https://npmjs.org/) - Node package manager

If you use Vagrant and [Homestead](https://laravel.com/docs/5.4/homestead) box, all software dependencies are already met.

## Installation

- clone repository and cd into it
- run installer script via `./install` or `bash install`
- set proper WS credentials\keys in `.env` file (lines 7-13) in order to make SOAP requests work properly
- add valid cert and key files according to `.env` file
- run `php artisan serve` and proceed to a browser to see the app

