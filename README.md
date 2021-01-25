# .ENV Manipulator - Laravel 5

> This is a mirror of `absolutehh/dotenv-manipulator` that was deleted. All the credits to the authors mentioned in composer.json.

This package can manipulate the `.env` file on runtime.

[![GitHub release](https://img.shields.io/github/release/absolutehh/dotenv-manipulator.svg?style=flat-square)](https://github.com/absolutehh/dotenv-manipulator/releases)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/absolutehh/dotenv-manipulator/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/absolutehh/dotenv-manipulator.svg?style=flat-square)](https://github.com/absolutehh/dotenv-manipulator/issues)

[![StyleCI](https://styleci.io/repos/85225035/shield)](https://styleci.io/repos/85225035)
[![Code Climate](https://img.shields.io/codeclimate/github/absolutehh/dotenv-manipulator.svg?style=flat-square)](https://codeclimate.com/github/absolutehh/dotenv-manipulator)


## Installation

Add it as dependency to composer `composer require absolutehh/dotenv-manipulator` and add the `\Absolute\DotEnvManipulator\ManipulatorServiceProvider` to your `config/app.php`

## Usage

### Code

```php
use Absolute\DotEnvManipulator\Libs\DotEnv;

$dotenv = new DotEnv('/ma/app/base/path', '.env');
// get current value
$value = $dotenv->get('YOUR_ENV_VAR');
// set and write value
$dotenv->set('YOUR_ENV_VAR', 'new_value')->write();
// sort variables in .env file
$dotenv->sort()->write();
```

### Command-Line

```bash
php artisan dotenv:get YOUR_ENV_VAR
php artisan dotenv:set YOUR_ENV_VAR --value=new_value
```
