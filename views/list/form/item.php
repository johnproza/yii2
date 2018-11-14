<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 10.11.2018
 * Time: 1:08
 */
use yii\helpers\ArrayHelper;

?>
<div class="tabContent">
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'name')->textInput(['autofocus' => true,'placeholder'=>'Название'])->label(false) ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'status')->radioList([1 => 'Опубликовано',
            0 => 'Не опубликовано'])
            ->label('Статус')?>
    </div>
</div>