<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{

    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Категория',
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['category_id' => 'id']);
    }
}
