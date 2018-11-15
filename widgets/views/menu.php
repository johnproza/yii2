<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:21
 */

use yii\helpers\Url;
use oboom\menu\AssetsBundle;

AssetsBundle::register($this);
?>
<?if (!empty($data)):?>
<nav class="nav <?=$type;?><?=$className;?>">
    <ul>
    <?foreach ($data as $item):?>
       <li>
           <a href="<?=Url::toRoute([$item['seo']['url']]);?>"><?=$item['label'];?></a>
       </li>
    <?endforeach;?>
    </ul>
</nav>
<?endif;?>
