<?php

namespace oboom\menu\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "menu_items".
 *
 * @property int $id
 * @property string $label
 * @property int $status
 * @property int $parent
 * @property int $seo_id
 * @property int $menu_id
 *
 * @property Menu $menu
 * @property Seo $seo
 */
class MenuItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'status','title'], 'required'],
            [['status', 'parent', 'seo_id', 'menu_id'], 'integer'],
            [['label'], 'string', 'max' => 45],
            [['redirect'], 'string', 'max' => 90],
            [['content'],'string'],
            [['title'], 'string', 'max' => 45],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Название',
            'title' => 'Заголовок',
            'content' => 'Описание',
            'redirect' => 'Редирект',
            'status' => 'Статус',
            'parent' => 'Родитель',
            'seo_id' => 'Seo ID',
            'menu_id' => 'Menu ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);
    }
}
