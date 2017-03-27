<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use app\models\Books;

class SiteController extends Controller
{
    public $search_book = false;
    public $dir = "uploads/";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $getCategories = new Category();
        $getBooks = new Books();

        $book_name = Yii::$app->request->post('book_name');
        $abc = Yii::$app->request->get();

        if (Yii::$app->request->post('all')) {
            $this->search_book = false;
            $this->redirect('/');
        }

        if ($book_name) {
            $list = $getBooks::find()->where(['like', 'name', $book_name])->all();
            $this->search_book = true;
        } elseif ($abc) {
            $list = $getBooks::find()->where(['like', 'name', "{$abc['abc']}%", false])->all();
            $this->search_book = true;
        } else {
            $list = $getCategories::find()->all();
        }

        return $this->render('index',
            [
                'list' => $list,
                'search_book' => $this->search_book,
                'abc' => $this->getAbc()
            ]
        );
    }

    private function getAbc()
    {
        $abc = [];
        foreach (range(chr(0xC0),chr(0xDF)) as $i)
            $abc[] = iconv('CP1251','UTF-8',$i);
        return $abc;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionBook() {
        $id = Yii::$app->request->get()['id'];

        if ($id) {
            $model= new Books();
            $book = $model::find()->where(['id' => $id])->one();


        }
        return $this->render('book', [
            'book' => $book
        ]);
    }

    public function actionDownload()
    {
        $id = Yii::$app->request->get()['id'];

        $model = new Books();
        $book = $model::find()->where(['id' => $id])->one();

        $file = $this->dir . $book->url_book;

        if (file_exists($file)) {
            $model->sendEmail(Yii::$app->params['adminEmail'], $book->name);
            Yii::$app->response->sendFile($file);
        }
    }
}
