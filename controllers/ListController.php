<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 12:59
 */

namespace oboom\menu\controllers;
use oboom\menu\models\MenuAssign;
use Yii;
use yii\web\Controller;
use common\models\Seo;
use oboom\menu\models\Menu;
use oboom\menu\models\MenuItems;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class ListController extends Controller
{
    public function actionIndex()
    {
        \yii\helpers\Url::remember();
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
        $allList = MenuItems::find()->select(['id','label'])->all();

//        var_dump(Yii::$app->request->post('Menu')['assign']);
//        return false;

        if ($item->load(Yii::$app->request->post()) && $item->save()) {
            $this->updateCheckbox(Yii::$app->request->post('assign'),$item->id);
            return $this->goBack();
        }
        else{
            return $this->render('create', ['item'=>$item,'list'=>$allList]);
        }
    }

    public function actionUpdate($id=null)
    {

        $allList = MenuItems::find()->select(['id','label'])->all();
        $item = Menu::find()->where(['=','id',$id])->limit(1)->one();

        $assing = array_filter($item->menuAssign);

        if ($item->load(Yii::$app->request->post())) {
            if(!is_null(Yii::$app->request->post('assign'))){
                $delCat = array_diff(ArrayHelper::map($assing, 'id', 'menu_item_id'), array_filter(Yii::$app->request->post('assign')));
            }

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if($flag = $item->save()){
                    if (!empty($delCat)) {
                        MenuAssign::deleteAll(['menu_id' => $item->id,'menu_item_id'=>$delCat]);
                    }

                    if (!$this->updateCheckbox(Yii::$app->request->post('assign'),$item->id)){
                        $transaction->rollBack();
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', Yii::$app->params['message']['update']);
                    return $this->goBack();
                }

            }catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        else{
            return $this->render('update', ['item'=>$item,'list'=>$allList]);
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

    public function actionRemove($id=null)
    {


        $item = Menu::findOne($id);
        MenuAssign::deleteAll(['menu_id' => $id]);
        if ($item->delete()) {
            Yii::$app->session->setFlash('success', Yii::$app->params['message']['remove']);
            return $this->redirect(Yii::$app->request->referrer);
        }
        else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    private function updateCheckbox($data=null,$menuID=null){

        if(!is_null($data)){
            foreach ($data as $value){

                if($item = MenuAssign::findOne(['menu_id'=>$menuID, 'menu_item_id'=>$value])){
                    $item->save(false);
                }

                else {
                    $assign = new MenuAssign();
                    $assign->menu_item_id = $value;
                    $assign->menu_id = $menuID;
                    $assign->save(false);
                }
            }
        }

        return true;

    }
}

