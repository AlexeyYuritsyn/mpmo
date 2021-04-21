<?php

namespace app\controllers;

use app\models\Notifications;
use app\models\ProjectSetup;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
//use app\models\Forms;
use yii\web\HttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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

    public function beforeAction($action)
    {
        if($this->action->id == 'index')
        {
            $this->layout = 'main-site';
        }
        else
        {
            $this->layout = 'main';
        }


//        if (!Yii::$app->user->isGuest)
//        {
//            $this->layout = 'main';
//            $role = Yii::$app->user->identity->role;
//            if ($role == Users::ROLE_ADMIN) {
//                $this->redirect(['/administrator/all-forms']);
//            }
//        }
//        else if($this->action->id != 'login' && $this->action->id != 'createuser')
//        {
//            $this->layout = 'main-login';
//            $this->redirect(['/site/login']);
//        }
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCreateuser()
    {
        echo 'pass = '.password_hash('yUEesA',PASSWORD_DEFAULT);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {

//            Users::updateAll(['last_visit_date'=>date('Y-m-d H:i:s',time())],['id'=>Yii::$app->user->identity->id]);
//
            $role = Yii::$app->user->identity->role;
            if ($role == Users::ROLE_ADMIN)
            {
                return  $this->redirect(['/work/all-work','round'=>1]);
            }
            else if($role == Users::ROLE_EXPERT)
            {
                return $this->redirect(['/work/all-work','round'=>1]);
            }
            else if($role == Users::ROLE_PARTICIPANT)
            {
                return $this->redirect(['/work/all-work','round'=>1]);
            }

//            return $this->goHome();
        }

//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $role = Yii::$app->user->identity->role;
            if ($role == Users::ROLE_ADMIN)
            {
                return  $this->redirect(['/work/all-work','round'=>1]);
            }
            else if($role == Users::ROLE_EXPERT)
            {
                return $this->redirect(['/work/all-work','round'=>1]);
            }
            else if($role == Users::ROLE_PARTICIPANT)
            {
                return $this->redirect(['/work/all-work','round'=>1]);
            }
//            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionRegistration()
    {
        $model = new Users();//'registration_user'
        $model->setScenario('registration_user');

        $post = Yii::$app->request->post('Users');

        if($post)
        {
            $model->setAttributes($post);

            $project_setup =  ProjectSetup::find()->where(['id'=>1])->one();

            if($model['role'] == Users::ROLE_PARTICIPANT && $project_setup['registration'] == false)
            {
                throw new HttpException(517 ,'Регистрация участников заблокирована');
            }

            if($model['role'] != Users::ROLE_PARTICIPANT)
            {
                $model['nomination'] = null;
            }


            if($model->validate())
            {
                $model['password'] = password_hash($post['password'],PASSWORD_DEFAULT);

                if($model->save(false))
                {
                    $ContactForm =  new ContactForm();
                    $param['<%io%>'] = $model['first_name'].' '.$model['third_name'];
                    $param['<%role%>'] = Users::$roles[$model['role']];
                    $param['<%login%>'] = $model['email'];
                    $param['<%password%>'] = $post['password'];

                    $ContactForm->SendMail($model['email'],Notifications::REGISTRATION_ON_SITE,$param);

                    return $this->redirect(['/site/success']);
                }
            }
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }


    public function actionSuccess()
    {
        return $this->render('success', [
            'text' => 'Вы успешно зарегистрировались. Пройдите на страницу входа',
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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
}
