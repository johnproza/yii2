<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 13:20
 */

namespace oboom\menu;
use yii\web\AssetBundle;

class AssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/oboom/yii2-menu/assets';
    public $css = [
        'css/style.css'
    ];
}