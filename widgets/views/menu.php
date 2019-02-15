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
<?if (!empty($data) && $level==1):?>
    <nav class="nav <?=$type;?><?=$className;?>">
        <ul>
        <?foreach ($data as $item):?>
           <li>
               <a href="<?
                        if(!empty($item['redirect']) && !is_null($item['redirect'])) {
                            echo Url::toRoute($item['redirect']);
                        }
                        else {
                            echo Url::toRoute('/'.$item['seo']['url']);
                        }
                          ;?>"><?=$item['label'];?></a>
           </li>
        <?endforeach;?>
        </ul>
    </nav>

<?else : ?>
    <nav class="nav <?=$type;?><?=$className;?>">
        <ul>
            <?foreach ($data as $item):?>
                <li>
                    <a href="<?
                    if(!empty($item['parent']['redirect']) && !is_null($item['parent']['redirect'])) {
                        echo Url::toRoute($item['parent']['redirect']);
                    }
                    else {
                        echo Url::toRoute('/'.$item['parent']['seo']['url']);
                    }
                    ;?>"><?=$item['parent']['label'];?></a>

                    <?if (isset($item['child'])):?>
                        <ul>
                            <?foreach ($item['child'] as $child):?>
                                <li>
                                    <a href="<?
                                    if(!empty($child['redirect']) && !is_null($child['redirect'])) {
                                        echo Url::toRoute($item['parent']['redirect']);
                                    }
                                    else {
                                        echo Url::toRoute('/'.$child['seo']['url']);
                                    }
                                    ;?>"><?=$child['label'];?></a>
                                </li>
                            <?endforeach;?>
                        </ul>
                    <?endif;?>
                </li>
            <?endforeach;?>
        </ul>
    </nav>
<?endif;?>
