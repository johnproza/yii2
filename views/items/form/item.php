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
    <?php
        $arrayParent = [
            'Основная' => [
                '0' => 'Родительская категория',
                'Вложенная' =>ArrayHelper::map($parent,'id','label')
            ]

        ];
        $arrayMenu= [
            'Основная' => [
                '0' => 'Не в меню',
                'Вложенные меню' =>ArrayHelper::map($menu,'id','name')
            ]

        ];
    ?>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'label')->textInput(['autofocus' => true,'placeholder'=>'Название меню'])->label(false) ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'title')->textInput(['autofocus' => true,'placeholder'=>'Заголовок'])->label(false) ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'content')->textArea(['placeholder'=>'Описание'])->label(false) ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'redirect')->textInput(['placeholder'=>'Редирект url'])->label(false) ?>
    </div>
    <div class="col-lg-6 col-md-6">
        <?= $form->field($item, 'parent')->dropDownList($arrayParent,
            ['prompt' => ' -- Выберите родителя --'])->label(false) ?>
    </div>
    <div class="col-lg-6 col-md-6">
        <?= $form->field($item, 'menu_id')->dropDownList($arrayMenu,
            ['prompt' => ' -- Выберите меню --'])->label(false)?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($item, 'status')->radioList([1 => 'Опубликовано',
            0 => 'Не опубликовано'])
            ->label('Статус')?>
    </div>
</div>