Dynamic menu + content 
============
Dynamic menu and html content with TinyMCE editor

You also can assign menu to item (dynamic and static menu) 

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

Usage
-----

Before using you must prepare database
```php
php yii migrate --migrationPath=@vendor/johnproza/yii2-menu/migrations 
```

Config extension
-----

Use it in your code:

```php
'menu' => [
    'class' => 'oboom\menu\Module',
]
```

Widget usage
------------

Insert into your view file to show menu in frontend
```php
use oboom\menu\widgets\Menu;
.....
.....
<?=Menu::widget([
    'menuId'=>1, // menu id
    'itemId'=>$item->id, // id of item. This is check, how to assign menu into item 
    'level'=>1, //menu level
    'className'=>'header' // css class name
]) ?>
```

Insert into your view file to show categories in backend
```php
use oboom\menu\widgets\MenuList;
.....
.....
<?=MenuList::widget()?>
```