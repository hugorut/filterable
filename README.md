#Fiterable
__A package which provides a fluent interface to apply constraints to an Eloquent query__

For example:
```php
#Set the package to run all constraints against an Article model
$filter = Filter::setType('articles');

#filter those articles by the Page and Author model so that only
#articles that appear with these contraints are returned
$filter->by([
    'pages' => [1, 2], 
    'authors' => [4, 7, 9]
])->get();
```
## Installation

First, pull in the package through Composer.

```js
"require": {
    "hugorut/filter": "1.0"
}
```

Include the service provider within `config/app.php`.

```php
'providers' => [
    Hugorut\Filter\Laravel\FilterServiceProvider::class,
];
```

Add the facade alias to this same file at the bottom:

```php
'aliases' => [
    'Filter'    => Hugorut\Filter\Laravel\Filter::class,
];
```

Then publish the package assets by running in your project root

```shell
php artisan vendor:publish
```

You should see a terminal output similar to:

```shell
Copied File [/vendor/Filter/src/Hugorut/Filter/config.php] To [/config/filter.php]
Publishing complete for tag []!
```

## Usage

__Config__

First you need to provide the package with knowledge of what models are filterable and which can have filters applied to them. Add your settings to the package configuration file which located at `app\config\filter.php` after you have published the package assets.

Add models you wish to apply filters to in the *Builders* array

```php
'Builders' => [
    'articles' => 'App\Article'
],
```

Add models you wish to filter by in the *Filters* array

```php
'Filters' => [
    'pages' => 'App\Page',
    'authors' => 'App\Author'
],
```

__Api__

It is highly recommended that you use the Filter facade or dependency injection to access the package functionality as this the class has a number of depencies which the laravel IOC container can rectify. 

Using the Filter class is simple, first set a model you wish to appy filters against (and which has been aliased in the filter config file).

```php
$filter = Filter::setType('articles');
```

Then call the `by` method on the filter instance passing in an associative array of filters you would like to apply. This array needs to have keys as the class aliases as defined in the filter config file and values as an array model ids.

```php
$filter = filter->by(['pages' => [1, 2] ]);
```

Call the `get` method on the filter to then query the database and return the filtered results.

```php
$filter->get();
```