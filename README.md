# Laravel Wishlist

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lamalama/laravel-wishlist.svg?style=flat-square)](https://packagist.org/packages/lamalama/laravel-wishlist)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://github.styleci.io/repos/268217938/shield?branch=master)](https://github.styleci.io/repos/268217938)
[![Total Downloads](https://img.shields.io/packagist/dt/lamalama/laravel-wishlist.svg?style=flat-square)](https://packagist.org/packages/lamalama/laravel-wishlist)

Make your Eloquent models wishlistable.

## Install

Via Composer

``` bash
$ composer require lamalama/laravel-wishlist
```

You can publish the migration with:
```bash
php artisan vendor:publish --provider="LamaLama\Wishlist\WishlistServiceProvider" --tag="migrations"
```

After publishing the migration you can create the `wishlist` table by running the migrations:

```bash
php artisan migrate
```

You can optionally publish the config file with:
```bash
php artisan vendor:publish --provider="LamaLama\Wishlist\WishlistServiceProvider" --tag="config"
```

## Prepare user model

Import the ```HasWishlists``` trait to your User model file.
```php
use LamaLama\Wishlist\HasWishlists;
```

Add the ```HasWishlists``` trait to your User model.
```php
use HasWishlists;
```

## Prepare wishlistable model(s)

Optionally you can add the ```Wishlistable``` trait to Eloquent models that you want to give additional methods.
Import the ```Wishlistable``` trait to your wishlistable model file.
```php
use LamaLama\Wishlist\Wishlistable;
```

Add the ```Wishlistable``` trait to your wishlistable model.
```php
use Wishlistable;
```

## Use

You can add any Eloquent model as 'wish' to the User model:

```php
$user = User::find(1);
$product = Product::find(1);
$user->wish($product);
```

Optionally you can set the name of the wishlist to which you want to add the wish. When no list is specified the wish will be stored on the 'default' list. The name of the default list can be adjusted in the config file.
```php
$user->wish($product, 'Christmas presents');
```

You can remove any Eloquent model as 'wish' from the User model:

```php
$user->unwish($product);
$user->unwish($product, 'Christmas presents');
```

Get all wishlists
```php
$user->wishlists();
```

Get a specific wishlist
```php
$user->wishlist('Christmas presents');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Lama Lama](https://github.com/lamalamaNL)
- [Mark de Vries](https://github.com/lamalamaMark)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
