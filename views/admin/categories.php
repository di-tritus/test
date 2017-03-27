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
                    <?= $form->field($model, 'name')?>
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
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->name ?></td>
                        <td>
                            <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['admin/category-edit', 'id'=>$category->id]) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-remove text-danger"></span>', ['admin/category-delete', 'id'=>$category->id]) ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
