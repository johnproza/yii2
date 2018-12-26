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
use yii\helpers\Url;

$this->title = 'Обновление группы меню';
?>
<div class="mainSection category">
    <?php $form = ActiveForm::begin(['id' => 'create-category',
        'options' => ['class' => 'form']]); ?>
    <?php echo Tabs::widget([
        'items' => [
            [
                'label' => 'Описание',
                'content' =>  $this->render('form/item', ['item' => $item, 'form'=> $form]),
                'active' => true
            ],
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class'=>'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
