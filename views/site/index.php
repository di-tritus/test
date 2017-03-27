<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Библиотека';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <?php $form = ActiveForm::begin(); ?>
                            <?= Html::textInput('book_name', '', ['placeholder' => 'Введите название книги']) ?>
                            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col-lg-3">
                            <?php $form = ActiveForm::begin(); ?>
                            <?= Html::hiddenInput('all', 1) ?>
                            <?= Html::submitButton('Показать все', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col-lg-6">
                            <?php foreach ($abc as $value) :?>
                            <?= Html::a($value, ['/', 'abc' => $value]) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($list && !$search_book) {?>
                    <p><label>Список книг</label></p>
                    <ul class="nav nav-list">
                        <?php foreach ($list as $category): ?>
                            <li class="nav-header"><?= $category->name ?></li>
                            <?php foreach ($category->books as $book): ?>
                                <li><?= Html::a($book->name, ['/site/book', 'id' => $book->id]) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php } elseif ($list && $search_book) { ?>
                    <ul class="nav nav-list">
                        <?php foreach ($list as $book): ?>
                            <li><?php Html::a($book->name, ['/site/book', 'id' => $book->id]) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php } else { ?>
                    <p><label>По Вашему запросу ничего не найдено</label></p>
                <?php }; ?>
            </div>
        </div>
    </div>
</div>
