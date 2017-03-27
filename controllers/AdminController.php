<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Books;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class AdminController extends Controller
{
    public $layout = 'admin';
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model_books = new Books();
        $books = $model_books::find()->all();

        $model_cat = new Category();
        $categories = $model_cat::find()->all();

        return $this->render('index', [
            'books' => $books,
            'categories' => $categories
        ]);
    }

    public function actionCategories()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                return $this->refresh();
            }
        }

        $categories = $model::find()->all();

        return $this->render('categories', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionCategoryDelete()
    {
        $id = Yii::$app->request->get()['id'];

        if ($id) {
            $categories = new Category();
            $books = new Books();

            $categories::find()->where(['id' => $id])->one()->delete();
            $books::deleteAll(['category_id' => $id]);

            return $this->redirect('/admin/categories');
        }

        return false;
    }

    public function actionCategoryEdit()
    {
        $id = Yii::$app->request->get()['id'];

        if ($id) {
            $model= new Category();
            $category = $model::find()->where(['id' => $id])->one();

            if ($model->load(Yii::$app->request->post())) {
                $category->name = $model->name;
                $category->save();

                $this->redirect('/admin/categories');
            }

            return $this->render('categories_edit', [
                'category' => $category
            ]);

        }

        return false;
    }

    public function actionBooks()
    {
        $model = new Books();
        $getCategories = new Category();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload_image();

            $model->bookFile = UploadedFile::getInstance($model, 'bookFile');
            $model->upload_book();
            $model->url = $model->imageFile->name;

            $model->url_book = $model->bookFile->name;
            $model->save();

            return $this->refresh();
        }

        $books = $model::find()->all();
        $categories = ArrayHelper::map($getCategories::find()->all(), 'id', 'name');

        return $this->render('books', [
            'model' => $model,
            'books' => $books,
            'categories' => $categories
        ]);
    }

    public function actionBooksEdit()
    {
        $id = Yii::$app->request->get()['id'];

        if ($id) {
            $model= new Books();
            $getCategories = new Category();
            $book = $model::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->upload_image();
                $book->url = $model->imageFile->name;

                $model->bookFile = UploadedFile::getInstance($model, 'bookFile');
                $model->upload_book();
                $book->url_book = $model->bookFile->name;

                $book->name = $model->name;
                $book->category_id = $model->category_id;
                $book->description = $model->description;

                $book->save(false);

                $this->redirect('/admin/books');
            }

            $categories = ArrayHelper::map($getCategories::find()->all(), 'id', 'name');

            return $this->render('books_edit', [
                'model' => $model,
                'book'  => $book,
                'categories' => $categories
            ]);

        }

        return false;
    }

    public function actionBooksDelete()
    {
        $id = Yii::$app->request->get()['id'];

        if ($id) {
            $books = new Books();
            $books::find()->where(['id' => $id])->one()->delete();

            return $this->redirect('/admin/books');
        }

        return false;
    }

    public function actionChange() {
        $post = Yii::$app->request->post();
        $model = new Books();

        if ($post['ids'] && $post['category_id']) {
            foreach ($post['ids'] as $id) {
                var_dump($post['category_id']);
                $book = $model::find()->where(['id' => $id])->one();
                $book->category_id = $post['category_id'];
                $book->save(false);
            }

            return $this->redirect('/admin');
        }
    }
}
