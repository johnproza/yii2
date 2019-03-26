<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 10.11.2018
 * Time: 1:08
 */
use yii\helpers\ArrayHelper;
use \yii\helpers\Html;
$activeCheckbox = ArrayHelper::map($item['menuAssign'],'menu_item_id','menu_item_id');
?>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($item, 'name')->textInput(['autofocus' => true,'placeholder'=>'Название'])->label(false) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($item, 'status')->radioList([1 => 'Опубликовано',
            0 => 'Не опубликовано'])
            ->label('Статус')?>
    </div>
    <div class="col-md-6">
        <?= $form->field($item, 'static')->radioList([1 => 'Статика',
            0 => 'Динамика'])
            ->label('Тип отображения')?>
    </div>
    <div class="col-md-12 assign">
        <h3>Привязка к пунктам меню</h3>
        <?= Html::checkboxList('assign',$activeCheckbox, ArrayHelper::map($list,'id','label'));?>
    </div>
</div>