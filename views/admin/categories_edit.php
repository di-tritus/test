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
                    <?= $form->field($category, 'name')?>
                    <div class="form-group">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
