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

class MenuList extends Widget
{
    /*
     *    show all category of menu / create list
     */
    public $template = "list";
    public $data;
    public $className;

    public function init(){
        parent::init();

        $this->data = \oboom\menu\models\Menu::find()->all();

    }

    public function run(){
        if(!is_null($this->data)){
            return $this->render($this->template,
                [
                    'className'=>$this->className?' '.$this->className:'',
                    'data'=>$this->data]);
        }


    }

}