<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class Books extends ActiveRecord
{
    public $imageFile;
    public $bookFile;

    private  $dir = "uploads/";

    public function rules()
    {
        return [
            [['name', 'category_id', 'description'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['bookFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Книга',
            'category_id' => 'Категория',
            'imageFile' => 'Фотография',
            'bookFile' => 'Книга'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function upload_image()
    {
        $name = time()."_image";

        $this->imageFile->saveAs($this->dir . $name . '.' . $this->imageFile->extension, false);
        $this->imageFile->name = $name . '.' . $this->imageFile->extension;
    }

    public function upload_book()
    {
        $name = time()."_book";

        $this->bookFile->saveAs($this->dir . $name . '.' . $this->bookFile->extension, false);
        $this->bookFile->name = $name . '.' . $this->bookFile->extension;
    }

    public function sendEmail($email, $name)
    {
        $from = [
            'mailer@test.ru' => 'Отправитель'
        ];

        $subject = "Скачали книгу {$name}";
        $body = "Скачали книгу {$name}";

        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom($from)
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }

}
