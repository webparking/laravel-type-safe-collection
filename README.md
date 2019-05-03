<h1 align="center">
  Laravel Type-Safe Collection
</h1>

<p align="center">
    <a href="https://travis-ci.org/webparking/laravel-type-safe-collection">
        <img src="https://travis-ci.org/webparking/laravel-type-safe-collection.svg?branch=master" alt="Build Status">
    </a> 
    <a href="https://scrutinizer-ci.com/g/webparking/laravel-type-safe-collection/?branch=master">
        <img src="https://scrutinizer-ci.com/g/webparking/laravel-type-safe-collection/badges/quality-score.png?b=master" alt="Quality score">
    </a> 
    <a href="https://scrutinizer-ci.com/g/webparking/laravel-type-safe-collection/?branch=master">
        <img src="https://scrutinizer-ci.com/g/webparking/laravel-type-safe-collection/badges/coverage.png?b=master" alt="Code coverage">
    </a> 
</p>

PHP is getting more mature and allows us to program strong typed in new ways with each new version, however we still lack the option to have generic lists/arrays. This package aims to provide such a thing in the meantime.

The `TypeSafeCollection` provided by this package will make sure that any object within it is the object you expect.

## Installation
Add this package to composer.

```
coming soon
```

## Usage

```php
/**
 * @method \ArrayIterator|User[] getIterator()
 * @method User|null             first()
 */
class User extends TypeSafeCollection
{
    protected $type = User::class;
}
```

```php
class User extends Model
{
    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }
}
```

All queries on User that would result in a Collection will now result in a UserCollection.

```php
get_class(User::all()) // UserCollection
get_class(User::where('type', '=', 'admin')->get()) // UserCollection
get_class(User::where('id', '=', 1)->first()) // User
```

## Licence and Postcardware

This software is open source and licensed under the [MIT license](LICENSE.md).

If you use this software in your daily development we would appreciate to receive a postcard of your hometown. 

Please send it to: Webparking BV, Cypresbaan 31a, 2908 LT Capelle aan den IJssel, The Netherlands
