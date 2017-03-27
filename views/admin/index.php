<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Админка';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <a href="#сhange" class="btn btn-primary" data-toggle="modal">Сменить категорию</a>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Название</th>
                    <th>Категория</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book) { ?>
                    <tr>
                        <td><input type="checkbox" name="ids" value="<?= $book->id ?>"></td>
                        <td><?= $book->name ?></td>
                        <td><?= $book->category->name ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="сhange" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Сменить категорию</h4>
            </div>
            <div class="modal-body">
                <select name="category_id">
                    <?php foreach ($categories as $category) :?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary change-category">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJS('
$(document).on("click", ".change-category", function () {
        var ids = [];
        $("input[name=ids]:checked").each(function() {
            ids.push($(this).val());
        });
        
        var category_id = $("select[name=\"category_id\"]").val()

       $.ajax({
            type: "POST",
            url: "/admin/change",
            dataType: "json",
            data : {
                "category_id" : category_id,
                "ids" : ids,
            },
            success: function(result) {

            }
        });
    });'
);?>

