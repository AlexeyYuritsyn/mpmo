<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\Users;
use app\models\Notifications;
use Yii;
use app\models\Ous;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class QuestionnaireController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            throw new HttpException(500 ,'Сессия закончилась. Выполните повторно вход.');
        }

        return true;
    }

    public function actionFileDeleteImage($id)
    {
        $model = Users::find()->where(['id'=>$id])->one();
        unlink($model['image']);
        $model['image'] = null;

        $model->save(false);
        return true;
    }

    public function actionMyProfile()
    {
        $model = Users::find()->where(['id'=>Yii::$app->user->identity->id])->one();


        $ous = Ous::find()->select('id,short_name')->where('arhiv = :arhiv AND type_id != :type_id_one AND type_id != :type_id_two'.Ous::SQL_QUERY,[':arhiv'=>0,':type_id_one'=>2,':type_id_two'=>6])->all();
        $ous_array = [];

        foreach ($ous as $valOus)
        {
            $ous_array[$valOus['id']]=$valOus['short_name'];
        }

        $widget_logo_remove[]['url'] = Url::to(['/questionnaire/file-delete-image','id'=>Yii::$app->user->identity->id]);

        $post_user = Yii::$app->getRequest()->post('Users');

        if($post_user)
        {

            if(isset($post_user['scenario']) && $post_user['scenario'] == 'change_password_user')
            {
                $model->setScenario('change_password_user');

                $model['repeat_password'] = $post_user['repeat_password'];
                $model['new_password'] = $post_user['new_password'];

                if(!$model->validate())
                {
                    return $this->render('updateUser',[
                        'model'  => $model,
                        'no_validate' => true
                    ]);
                }
                else
                {
                    $model->setScenario('default');
                    $model['password'] = password_hash($post_user['new_password'],PASSWORD_DEFAULT);
                }
            }
            else
            {
                if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
                {
                    $model->setScenario('change_profile');
                }
                else
                {
                    $model->setScenario('default');
                }


                $model->setAttributes($post_user);

                if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
                {
                    $model->path_image = UploadedFile::getInstance($model, 'path_image');

                    if(!is_null($model->path_image))
                    {
                        $file_path = 'uploads/photo_users/'.md5(rand(1,2147483647)).'.'.$model->path_image->extension;
                        if($model->path_image->saveAs($file_path))
                        {
                            $model['image'] = $file_path;
                        }
                        else
                        {
                            throw new HttpException(517 ,var_export($model->path_image->getErrors(),true) );
                        }
                    }
                    else if($model['image'] == '' && $model->path_image == '')
                    {
                        $model['image'] = '/';
                    }
                }
            }

            if($model->save())
            {
                return $this->redirect(['questionnaire/my-profile']);
            }
        }

        return $this->render('updateUser',[
            'model'  => $model,
            'ous_array'  => $ous_array,
            'widget_logo_remove'  => $widget_logo_remove,
        ]);
    }

    public function actionAllUsers($user_id=0,$role=0)
    {
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            return $this->redirect(['/site/index']);
        }

        $query = Users::find()->select(['id','CONCAT(second_name,\' \',first_name,\' \',third_name) AS fio','email','role'])->where(['in_archive'=>false]);

        if((int)$user_id > 0)
        {
            $query->andWhere(['id'=>$user_id]);
        }

        if((int)$role > 0)
        {
            $query->andWhere(['role'=>$role]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort(['attributes' =>
            [
                'fio',
                'email',
                'role',
            ]
        ]);

        $users_array = [];
        $users = Users::find()->all();

        if(!empty($users))
        {
            foreach ($users as $users_val)
            {
                $users_array[$users_val['id']] = $users_val['second_name'].' '.$users_val['first_name'].' '.$users_val['third_name'].' ['.$users_val['email'].']';
            }
        }

        return $this->render('allUsers', [
            'dataProvider' => $dataProvider,
            'users_array' => $users_array,
        ]);
    }

    public function actionUpdateUser($id)
    {
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            return $this->redirect(['/site/index']);
        }

        $model = Users::find()->where(['id'=>$id])->one();


        $ous = Ous::find()->select('id,short_name')->where('arhiv = :arhiv AND type_id != :type_id_one AND type_id != :type_id_two'.Ous::SQL_QUERY,[':arhiv'=>0,':type_id_one'=>2,':type_id_two'=>6])->all();
        $ous_array = [];

        foreach ($ous as $valOus)
        {
            $ous_array[$valOus['id']]=$valOus['short_name'];
        }

        $widget_logo_remove[]['url'] = Url::to(['/questionnaire/file-delete-image','id'=>$model['id']]);

        $post_user = Yii::$app->getRequest()->post('Users');

        if($post_user)
        {
            if (isset($post_user['scenario']) && $post_user['scenario'] == 'change_password_user') {
                $model->setScenario('change_password_user');

                $model['repeat_password'] = $post_user['repeat_password'];
                $model['new_password'] = $post_user['new_password'];

                if (!$model->validate()) {
                    return $this->render('updateUser', [
                        'model' => $model,
                        'no_validate' => true
                    ]);
                } else {
                    $model->setScenario('default');
                    $model['password'] = password_hash($post_user['new_password'], PASSWORD_DEFAULT);
                }
            }
            else
            {
                if ($model['role'] == Users::ROLE_PARTICIPANT) {
                    $model->setScenario('change_profile');
                } else {
                    $model->setScenario('default');
                }


                $model->setAttributes($post_user);

                if ($model['role'] == Users::ROLE_PARTICIPANT)
                {
                    $model->path_image = UploadedFile::getInstance($model, 'path_image');

                    if (!is_null($model->path_image))
                    {
                        $file_path = 'uploads/photo_users/' . $model['id'] . '_' . md5(rand(1, 2147483647)) . '.' . $model->path_image->extension;
                        if ($model->path_image->saveAs($file_path)) {
                            $model['image'] = $file_path;
                        } else {
                            throw new HttpException(517, var_export($model->path_image->getErrors(), true));
                        }
                    }
                    else if ($model['image'] == '' && $model->path_image == '')
                    {
                        $model['image'] = '/';
                    }
                }
                else
                {
                    $model->setScenario('default');
                }



            }

            $model_old = $model->getOldAttributes();
            $model_new = $model->getAttributes();


            if ($model->save()) {

                if($model_old['second_round'] == false && $model_new['second_round'] == true)
                {
                    $ContactForm =  new ContactForm();
                    $param['<%io%>'] = $model['first_name'].' '.$model['third_name'];

                    $ContactForm->SendMail($model['email'],Notifications::PASSED_TO_SECOND_STAGE,$param);
                }


                return $this->redirect(['questionnaire/all-users']);
            }

        }
        return $this->render('updateUser', [
            'model' => $model,
            'ous_array'  => $ous_array,
            'widget_logo_remove'  => $widget_logo_remove,
        ]);
    }

    public function actionAddUser()
    {
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            return $this->redirect(['/site/index']);
        }
        $model = new Users();

        if(Yii::$app->getRequest()->post())
        {
            $post_user = Yii::$app->getRequest()->post('Users');
            $model->setAttributes($post_user);
            $model['password'] = password_hash($post_user['password'],PASSWORD_DEFAULT);

            if($model->save())
            {
                return $this->redirect(['/questionnaire/all-users']);
            }
        }

        return $this->render('addUser',[
            'model'  => $model
        ]);
    }
}
