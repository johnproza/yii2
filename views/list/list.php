<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Группы меню";
?>
<div id="app" class="mainSection list">
    <?php Pjax::begin(['id' => 'ajax','timeout'=> 10000] ); ?>



    <div class="col-md-12">
        <div class="systemBar">
            <?= Html::a("Создать запись", [Url::to().'/create/'], ['class' => 'btn btn-success']); ?>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table ">
            <thead>
            <tr>
                <th class="w-f50">#</th>
                <th>Название</th>
                <th class="center w-f50">Статус</th>
                <th class="w-f150"></th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($items as $item) :?>
                <tr>
                    <td>
                        <?=$item['id'];?>
                    </td>
                    <td>
                        <?= Html::a($item['name'], [Url::to().'/update/'.$item['id']]) ?>
                    </td>

                    <td class="centerItems">
                        <?if($item['status']==1):?>
                            <span class="badge badge-success">Активный
<!--                                --><?//= Html::a("Активный", [Url::to().'/status/'],
//                                    [   'data-confirm' => 'Хотите изменить статус запись?',
//                                        'data-method'=>"post",
//                                        'data-pjax'=>1,
//                                        'data-id'=>$item['id']
//                                    ]) ?>
                            </span>
                        <?else:?>
                            <span class="badge badge-danger">Неактивный</span>
                        <?endif;?>
                    </td>
                    <!--                    <td class="center">-->
                    <!--                        --><?//=\Yii::$app->formatter->asDate($item->created_at, 'dd.MM.yyyy')?><!--<br/>-->
                    <!--                        --><?//=\Yii::$app->formatter->asDate($item->created_at, 'hh:mm:ss')?>
                    <!--                    </td>-->
                    <td class="center">
                        <?= Html::a('<i class="icon ion-md-create iconBase"></i>', [Url::to().'/update/'.$item['id']]) ?>
                        <?= Html::a('<i class="icon ion-md-close-circle-outline iconBase"></i>', [Url::to().'/remove/'.$item['id']],
                            ['data-confirm' => 'Хотите удалить запись?',
                                'data-method' => 'post',
                                'data-status' => '0',]
                        ) ?>
                    </td>
                </tr>

            <?endforeach;?>

            </tbody>
        </table>

        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>

</div>
<?php Pjax::end(); ?>
</div>