<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:07
 */

namespace oboom\menu\widgets;
use oboom\menu\controllers\ItemsController;
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
    public $className;
    public $type="horizontal-menu";
    public $menuId;

    public function init(){
        parent::init();
        if ($this->data===null && $this->menuId!==null){
            $this->data =ItemsController::Menu($this->menuId);
        }
        else {
            throw new \ErrorException('menuId is required attribute');
        }
    }

    public function run(){
        if ($this->menuId!='' && $this->menuId!==null){
            return $this->render($this->template,
                    ['type'=>$this->type,
                     'className'=>$this->className?' '.$this->className:'',
                     'data'=>$this->data]);
        }

    }

}