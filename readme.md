[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

# Laravel LogNotify

Laravel package to automatically show notifications in real-time whenever there is new log entry made anywhere in application.

## Screenshot

![Main Window](https://github.com/sarfraznawaz2005/lognotify/blob/master/screen.jpg?raw=true)

## Requirements

 - PHP >= 5.6
 - Laravel 5

## Installation

Via Composer

``` bash
$ composer require sarfraznawaz2005/lognotify
```

For Laravel < 5.5:

Add Service Provider to `config/app.php` in `providers` section
```php
Sarfraznawaz2005\LogNotify\LogNotifyServiceProvider::class,
```

---

Publish package's config file by running below command:

```bash
$ php artisan vendor:publish --provider="Sarfraznawaz2005\LogNotify\LogNotifyServiceProvider"
```
It should publish `config/lognotify.php` config file.

## Usage

Start socket server by issuing following command:

```bash
$ php artisan socket_serve
```

Now whenever new entry is made in laravel log file, you will see popup notification at bottom right of your application.

## Customizing Notifications

You can customize notifications ui by modifying published file at `resources/views/vendor/logNotify/view.blade.php`

## Credits

- [Sarfraz Ahmed][link-author]
- [All Contributors][link-contributors]

## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sarfraznawaz2005/lognotify.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sarfraznawaz2005/lognotify.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sarfraznawaz2005/lognotify
[link-downloads]: https://packagist.org/packages/sarfraznawaz2005/lognotify
[link-author]: https://github.com/sarfraznawaz2005
[link-contributors]: https://github.com/sarfraznawaz2005/lognotify/graphs/contributors