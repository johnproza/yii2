<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:07
 */

namespace oboom\menu\widgets;
use oboom\menu\controllers\ItemsController;
use oboom\menu\models\MenuAssign;
use oboom\menu\models\MenuItems;
use yii\base\Widget;
use yii\helpers\Html;

class Menu extends Widget
{
    /*
     *      $template -> path to your template | default 'menu' | yii2-menu/widgets/views/menu.php
     *      $data -> values from DataBase
     *      $type -> base css style type of menu (horizontal-menu | vertical-menu)
     *      $menuId -> id value menu table from DataBase (table 'menu')
     *      $className -> personal user css styles for customize menu
     */
    public $template = "menu";
    public $data;
    public $level=1;
    public $className;
    public $type="horizontal-menu";
    public $menuId;
    public $itemId;

    public function init(){
        parent::init();

        if(!is_null($this->menuId)){
            $item = \oboom\menu\models\Menu::findOne($this->menuId);

            if($item->static==1){
                $this->data =ItemsController::Menu($this->menuId,$this->level);
            }

            else {
                $assign = MenuAssign::find()->where(["menu_id"=>$this->menuId,"menu_item_id"=>$this->itemId])->limit(1)->one();
                if(!is_null($assign)){
                    $this->data =ItemsController::Menu($this->menuId,$this->level);
                }
            }
        }
        else {
            throw new \ErrorException('menuId is required attribute');
        }

    }

    public function run(){
        if(!is_null($this->data)){
            return $this->render($this->template,
                ['type'=>$this->type,
                    'level'=>$this->level,
                    'className'=>$this->className?' '.$this->className:'',
                    'data'=>$this->data]);
        }


    }

}