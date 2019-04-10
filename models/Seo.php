<?php

namespace oboom\menu\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $url
 *
 * @property CatalogCategory[] $catalogCategories
 * @property CatalogItems[] $catalogItems
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 90],
            [['description', 'keywords'], 'string', 'max' => 150],
            [['url'], 'string', 'max' => 200],
            ['url', 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'url' => 'Url',
        ];
    }


    public function beforeSave($insert){

        if (parent::beforeSave($insert)) {
            if(empty($this->url)){
                $this->url = Yii::$app->controller->module->id.Yii::$app->security->generateRandomString(4);
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasOne(MenuItems::className(), ['seo_id' => 'id']);
    }

}
