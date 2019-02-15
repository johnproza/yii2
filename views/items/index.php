<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use oboom\menu\BackAssetsBundle;
BackAssetsBundle::register($this);
$this->title = "Список материалов";
?>
<div id="app" class="mainSection row">
    <div class="col-md-12">
        <div class="systemBar">
            <div class="row">
                <div class="col-md-7 buttons">
                    <?= Html::a("Создать запись", '/menu/items/create', ['class' => 'btn btn-success']) ?>
                </div>
                <div class="col-md-5">
                    <?= Html::dropDownList('cats',$catId, ArrayHelper::map($cats,'id','name'),[
                        'prompt' => ' -- Выберите категорию --',
                        'class'=>'form-control',
                        'id'=>'menuFilter']
                    );?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="alert alert-success hide" role="alert" id="message"></div>
        <?if ($items): ?>
            <ul  class="drag">
                <?foreach ($items as $item) :?>
                    <li data-id="<?=$item['parent']['id'];?>">
                        <?=$this->render('item',['item'=>$item['parent']]);?>

                        <ol>
                            <?if(count($item['child'])>0):?>
                                <?foreach ($item['child'] as $child) :?>
                                    <li data-id="<?=$child->id;?>">
                                        <?=$this->render('item',['item'=>$child]);?>
                                    </li>
                                <?endforeach;?>
                            <?endif;?>
                        </ol>


                    </li>
                <?endforeach;?>
            </ul>
        <?endif;?>
    </div>


</div>