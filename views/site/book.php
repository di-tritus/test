<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Библиотека';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="thumbnail">
                    <img src=" <?= Yii::$app->homeUrl."uploads/{$book->url}" ?>" >
                </div>
            </div>
            <div class="col-lg-6">
                <p><label>Книга: </label><?= $book->name ?></p>
                <p><label>Описание: </label><?= $book->description ?></p>
                <p><?= Html::a('Скачать', ['/site/download', 'id' => $book->id]) ?></p>
            </div>
        </div>
    </div>
</div>
