Dynamic menu
============
Dynamic menu

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist johnproza/yii2-menu "*"
```

or add

```
"johnproza/yii2-menu": "*"
```

to the require section of your `composer.json` file.


Config extantion
-----

Use it in your code by config file :

```php
'menu' => [
            'class' => 'oboom\menu\Module',
        ]
