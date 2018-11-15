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
use oboom\menu\models\Seo;
use oboom\menu\models\Menu;
use oboom\menu\models\MenuItems;
use yii\data\ArrayDataProvider;

class ItemsController extends Controller
{
    public function actionIndex()
    {
        $query = MenuItems::find()->all();
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

        return $this->render('index',['items'=>$items]);
    }

    public static function Menu($id){
        return MenuItems::find()->joinWith('seo')->joinWith('menu')->where(['menu_items.status'=>1,'menu.id'=>$id , 'menu.status'=>1])->asArray()->all();
    }

    public function actionList()
    {
        if(Yii::$app->request->isAjax) {
            $query = MenuItems::find()->joinWith('menu')->asArray()->all();
            $provider = new ArrayDataProvider([

                'allModels' => $query,
                'pagination' => [
                    'pageSize' => 20,
                ],
                'sort' => [
                    'attributes' => ['id'],
                ],
            ]);

            $items = $provider->getModels();

            return $this->asJson([
                'items'=>$items,
                'total' =>$provider->pagination->pageCount,
                'status' => true,
            ]);

        }
        else {
            return $this->asJson(['status'=>'Access denied']);
        }
    }

    public function actionCreate()
    {

        $item = new MenuItems();
        $seo = new Seo();
        $menu = Menu::find()->all();
        $parent = MenuItems::find()->where(['=','parent',0])->all();

        if ($item->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())) {
            if($seo->save()){
                $item->seo_id = $seo->id;
                $item->save();
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            }
        }

        else{
            return $this->render('create', ['item'=>$item,'seo'=>$seo, 'menu'=>$menu, 'parent'=>$parent]);
        }
    }

    public function actionUpdate($id=null)
    {

        $item = MenuItems::find()->where(['=','menu_items.id',$id])->joinWith('seo')->limit(1)->one();
        $menu = Menu::find()->all();
        $parent = MenuItems::find()->where(['=','parent',0])->all();

        if ($item->load(Yii::$app->request->post()) &&
            $item['seo']->load(Yii::$app->request->post())) {

            if ($item->save() && $item['seo']->save()){
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            }
        }

        else{
            return $this->render('update', ['item'=>$item, 'menu'=>$menu, 'parent'=>$parent]);
        }

    }

    public function actionStatus($json=null)
    {


        if(Yii::$app->request->isAjax){
            $cat = Menu::findOne(Yii::$app->request->post(id));
            if ($cat->status == 0) {
                $cat->status =1;
            }
            else {
                $cat->status =0;
            }
            if ($cat->save()) {
                return $this->asJson([
                    'status' => true,
                ]);
            }
            else {
                return $this->asJson([
                    'status' => false,
                ]);
            }




        }
        else {
            return $this->asJson(['status'=>'Access denied']);
        }
    }

    public function actionRemove($json=null)
    {


        if(Yii::$app->request->isAjax){
            $cat = Menu::findOne(Yii::$app->request->post(id));
            if ($cat->delete()) { //
                return $this->asJson([
                    'status' => true,
                ]);
            }
            else {
                return $this->asJson([
                    'status' => false,
                ]);
            }




        }
        else {
            return $this->asJson(['status'=>'Access denied']);
        }
    }
}

