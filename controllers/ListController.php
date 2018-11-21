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
        $query = Menu::find()->asArray()->all();
        $provider = new ArrayDataProvider([

            'allModels'=>$query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => ['id'],
            ],
        ]);


        return $this->render('list',[
            'items'=>$provider->getModels(),
            'pages'=>$provider->pagination]);
    }

    public function actionList()
    {
        if(Yii::$app->request->isAjax) {
            $query = Menu::find()->all();
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

        $item = new Menu();

        if ($item->load(Yii::$app->request->post()) && $item->save()) {

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }

        else{
            return $this->render('create', ['item'=>$item]);
        }
    }

    public function actionUpdate($id=null)
    {

        $item = Menu::find()->where(['=','id',$id])->limit(1)->one();

        if ($item->load(Yii::$app->request->post()) && $item->save()) {

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }

        else{
            return $this->render('update', ['item'=>$item]);
        }

    }

    public function actionStatus($json=null)
    {


        if(Yii::$app->request->isPost){
            var_dump(Yii::$app->request->post());
            $cat = Menu::findOne();
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

