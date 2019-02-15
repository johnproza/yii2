<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.02.2019
 * Time: 12:02
 */
use yii\helpers\Html;
?>

<div class="item">
    <div class="title">
        <span>&#9769;</span> <?= Html::a($item['label'], '/menu/items/update/'.$item['id']) ?>
    </div>
    <div class="menu-cat"></div>
    <div class="status-item">
        <?if($item['status']==1):?>
            <span class="badge badge-success">Активный</span>
        <?else:?>
            <span class="badge badge-danger">Неактивный</span>
        <?endif;?>
    </div>
    <div class="action-item">
        <?= Html::a('<i class="icon ion-md-create iconBase"></i>', '/menu/items/update/'.$item['id']) ?>
        <?= Html::a('<i class="icon ion-md-close-circle-outline iconBase"></i>', '/menu/items/remove/'.$item['id'],
            ['data-confirm' => 'Хотите удалить запись?',
                'data-method' => 'post',
                'data-pjax' => '0',]
        ) ?>
    </div>
</div>
