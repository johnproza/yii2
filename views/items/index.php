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
<div id="app" class="mainSection list">
    <div class="col-md-12">
        <div class="row systemBar">
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
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success hide" role="alert" id="message"></div>
            <table class="table">
                <thead>
                <tr>
                    <th class="w-f50"></th>
                    <th class="w-f50">#</th>
                    <th>Название</th>
                    <th class="w-f150">Категория</th>
                    <th class="center w-f50">Статус</th>
                    <th class="w-f150"></th>
                </tr>
                </thead>
                <tbody class="drag">
                <?foreach ($items as $item) :?>
                    <tr data-id="<?=$item['id'];?>">
                        <td>
                            <span>&#9769;</span>
                        </td>
                        <td>
                            <?=$item['id'];?>
                        </td>
                        <td>
                            <?= Html::a($item['label'], '/menu/items/update/'.$item['id']) ?>
<!--                            --><?//if(count($item['child'])):?>
<!--                                <table class="table table-bordered table-striped">-->
<!--                                    --><?//foreach ($item['child'] as $child) :?>
<!--                                        <tr>-->
<!--                                            <td>--><?//=$child->id;?><!--</td>-->
<!--                                            <td class="col-lg-8">--><?//= Html::a($child->name, [Url::to().'/update/'.$child->id]) ?><!--</td>-->
<!--                                            <td class="center">-->
<!--                                                --><?//if($child->status==1):?>
<!--                                                    <span class="badge badge-success">Активный</span>-->
<!--                                                --><?//else:?>
<!--                                                    <span class="badge badge-danger">Неактивный</span>-->
<!--                                                --><?//endif;?>
<!---->
<!--                                            </td>-->
<!--                                            <td class="center">-->
<!--                                                --><?//= Html::a("<i>Обновить</i>", '/menu/items/update/'.$child->id) ?>
<!--                                                --><?//= Html::a("<i>Удалить</i>", '/menu/items/remove/'.$child->id,
//                                                    ['data-confirm' => 'Хотите удалить запись?',
//                                                        'data-method' => 'post',
//                                                        'data-pjax' => '0',]
//                                                ) ?>
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                    --><?//endforeach;?>
<!--                                </table>-->
<!--                            --><?//endif;?>
                        </td>
                        <td>
                            <?=$item['menu']['name'];?>
                        </td>
                        <td class="centerItems">
                            <?if($item['status']==1):?>
                                <span class="badge badge-success">Активный</span>
                            <?else:?>
                                <span class="badge badge-danger">Неактивный</span>
                            <?endif;?>
                        </td>
                        <td class="center">
                            <?= Html::a('<i class="icon ion-md-create iconBase"></i>', '/menu/items/update/'.$item['id']) ?>
                            <?= Html::a('<i class="icon ion-md-close-circle-outline iconBase"></i>', '/menu/items/remove/'.$item['id'],
                                ['data-confirm' => 'Хотите удалить запись?',
                                    'data-method' => 'post',
                                    'data-pjax' => '0',]
                            ) ?>
                        </td>
                    </tr>

                <?endforeach;?>

                </tbody>
            </table>
        </div>
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</div>