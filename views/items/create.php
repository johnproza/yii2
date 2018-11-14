<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 10.11.2018
 * Time: 0:21
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Html;

$this->title = 'Login';
?>
<div class="mainSection category">
    <?php $form = ActiveForm::begin(['id' => 'create-category',
        'options' => ['class' => 'form']]); ?>


    <?php echo Tabs::widget([
        'items' => [
            [
                'label' => 'Описание',
                'content' =>  $this->render('form/item', ['item' => $item, 'form'=> $form, 'menu'=>$menu, 'parent'=>$parent]),
                'active' => true
            ],
            [
                'label' => 'SEO',
                'content' =>  $this->render('form/seo', ['seo' => $seo,  'form'=> $form]),

            ],
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Отмена', ['/menu/items/'], ['class'=>'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
