<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:21
 */

use yii\helpers\Url;
use oboom\menu\FrontAssetsBundle;

FrontAssetsBundle::register($this);

?>
<?if (!empty($data)):?>


        <?foreach ($data as $item):?>
           <li>
               <a href="<?='/'.Yii::$app->getModule('menu')->id.'/items/'.$item->id;?>"><?=$item->name;?></a>
           </li>
        <?endforeach;?>
<!--    <ul class="--><?//=$className;?><!--"></ul>-->


<?endif;?>
