<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Админка';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <?php $form = ActiveForm::begin(); ?>
                <?php $param = ['options' =>[ $book->category_id => ['Selected' => true]]]; ?>
                <?= $form->field($model, 'category_id')->dropDownList($categories, $param); ?>
                <?= $form->field($book, 'name')?>
                <?php if ($book->url) : ?>
                    <?= Html::img(Yii::$app->homeUrl."uploads/{$book->url}") ?>
                <?php endif; ?>
                <?= $form->field($model, 'imageFile')->fileInput() ?>
                <?= $form->field($model, 'bookFile')->fileInput() ?>
                <?= $form->field($book, 'description')->textarea() ?>
                <div class="form-group">
                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
