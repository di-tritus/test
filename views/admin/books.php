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
                    <?= $form->field($model, 'category_id')->dropDownList($categories); ?>
                    <?= $form->field($model, 'name')?>
                    <?= $form->field($model, 'imageFile')->fileInput() ?>
                    <?= $form->field($model, 'bookFile')->fileInput() ?>
                    <?= $form->field($model, 'description')->textarea() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Категория</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr>
                        <td><?= $book->id ?></td>
                        <td><?= $book->category->name ?></td>
                        <td><?= $book->name ?></td>
                        <td>
                            <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['admin/books-edit', 'id'=>$book->id]) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-remove text-danger"></span>', ['admin/books-delete', 'id'=>$book->id]) ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
