<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Пункты меню";
?>
<div id="app" class="mainSection list">
    <?php Pjax::begin(['id' => 'ajax','timeout'=> 5000] ); ?>



    <div class="col-md-12">
        <div class="systemBar">
            <?= Html::a("Создать запись", [Url::to().'/create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table ">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th class="center">Статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($items as $item) :?>
                <tr>
                    <td>
                        <?=$item['id'];?>
                    </td>
                    <td>
                        <?= Html::a($item['label'], [Url::to().'/update/'.$item['id']]) ?>
                        <?if(count($item['child'])):?>
                            <table class="table table-bordered table-striped">
                                <?foreach ($item['child'] as $child) :?>
                                    <tr>
                                        <td><?=$child->id;?></td>
                                        <td class="col-lg-8"><?= Html::a($child->name, [Url::to().'/update/'.$child->id]) ?></td>
                                        <td class="center">
                                            <?if($child->status==1):?>
                                                <span class="badge badge-success">Активный</span>
                                            <?else:?>
                                                <span class="badge badge-danger">Неактивный</span>
                                            <?endif;?>

                                        </td>
                                        <td class="center">
                                            <?= Html::a("<i>Обновить</i>", [Url::to().'/update/'.$child->id]) ?>
                                            <?= Html::a("<i>Удалить</i>", [Url::to().'/remove/'.$child->id],
                                                ['data-confirm' => 'Хотите удалить запись?',
                                                    'data-method' => 'post',
                                                    'data-pjax' => '0',]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?endforeach;?>
                            </table>
                        <?endif;?>
                    </td>

                    <td class="centerItems">
                        <?if($item['status']==1):?>
                            <span class="badge badge-success">Активный</span>
                        <?else:?>
                            <span class="badge badge-danger">Неактивный</span>
                        <?endif;?>
                    </td>
                    <td class="center">
                        <?= Html::a("<i>Обновить</i>", [Url::to().'/update/'.$item['id']]) ?>
                        <?= Html::a("<i>Удалить</i>", [Url::to().'/remove/'.$item['id']],
                            ['data-confirm' => 'Хотите удалить запись?',
                                'data-method' => 'post',
                                'data-pjax' => '0',]
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