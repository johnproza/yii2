<?php

namespace oboom\menu;

use Yii;
use yii\helpers\Inflector;


class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'default';
    public $controllerNamespace = 'oboom\menu\controllers';

    public $mainLayout = '@oboom/menu/views/layouts/main.php';

}
