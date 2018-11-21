<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 13:20
 */

namespace oboom\menu;
use yii\web\AssetBundle;

class BackAssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/johnproza/yii2-menu/assets';
    public $css = [
        'css/style.css',
        'css/skins/lightgray/skin.min.css',
        'css/skins/lightgray/content.min.css',
    ];
    public $js = [
        'js/tinymce.min.js',
        'js/themes/modern/theme.min.js',
        'js/script.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}