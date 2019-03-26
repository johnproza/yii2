<?php

namespace oboom\menu\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $position
 *
 * @property MenuItems[] $menuItems
 */
class Menu extends ActiveRecord
{

    public $assign=null;

    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status','static'], 'integer'],
            [['assign'], 'safe'],
            [['name', 'position'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Статус',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::className(), ['menu_id' => 'id']);
    }

    public function getMenuAssign()
    {
        return $this->hasMany(MenuAssign::className(), ['menu_id' => 'id']);
    }
}
