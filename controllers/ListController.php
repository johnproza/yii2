<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 12:59
 */

namespace oboom\menu\controllers;
use Yii;
use yii\web\Controller;
use common\models\Seo;
use oboom\menu\models\Menu;
use oboom\menu\models\MenuItems;
use yii\data\ArrayDataProvider;

class ListController extends Controller
{
    public function actionIndex()
    {
        $query = Menu::find()->all();
        $provider = new ArrayDataProvider([

            'allModels'=>$query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => ['id'],
            ],
        ]);

        $items = $provider->getModels();

        return $this->render('list',['items'=>$items]);
    }
}

