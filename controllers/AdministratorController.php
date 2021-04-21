<?php

namespace app\controllers;
use app\models\Application;
use app\models\Ous;
use Yii;
use app\models\Users;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdministratorController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            throw new HttpException(500 ,'Сессия закончилась. Выполните повторно вход.');
        }
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            $this->redirect(['/site/index']);
        }

        return true;
    }


    public function actionStatistics()
    {
//        ini_set('max_execution_time', 0);
//        $params = Yii::$app->getRequest()->post();
//
//        if($params['report'] == '1')
//        {
//            $status = [Applicant::REFUSED_FROM_MUSEUM, Applicant::CONFIRMED_FROM_MUSEUM];
//        }
//        else if($params['report'] == '2')
//        {
//            $status = [Applicant::CONFIRMED_FROM_GMC,Applicant::REFUSED_FROM_MUSEUM, Applicant::CONFIRMED_FROM_MUSEUM];
//        }
//        else
//        {
//            $status = null;
//        }

        $spreadsheet = new Spreadsheet();

//        $startTime = strtotime($params['fromdate']);
//        $endTime = strtotime($params['todate']);

        $model = Users::find()->where(['in_archive'=>false,'role'=>Users::ROLE_PARTICIPANT])->all();


        /*
                     'email' => 'E-mail',
            'password' => 'Пароль',
            'role' => 'Роль',
            'in_archive' => 'Удалить пользователя',
            'fio' => 'ФИО',
            'second_name' => 'Фамилия',
            'first_name' => 'Имя',
            'third_name' => 'Отчество',
            'new_password' => 'Новый пароль',
            'repeat_password' => 'Повторите пароль',
            'phone' => 'Телефон',
            'age' => 'Возраст',
            'school' => 'Школа',
            'position' => 'Должность',
            'subject_taught' => 'Преподаваемый предмет',
            'hours_in_week' => 'Количество часов в неделю',
            'additional_load' => 'Дополнительная нагрузка',
            'total_work_experience' => 'Общий стаж работы',
            'teaching_experience' => 'Педагогический стаж работы',
            'have_mentor' => 'Есть ли у Вас наставник?',
            'relatives_in_education' => 'Работают (работали) Ваши родственники в системе образования?',
            'which_of_relatives' => 'Кто из родственников?',
            'union_member' => 'Являетесь ли членом Профсоюза?',
            'union_card_number' => 'Номер профсоюзного билета',
            'council_young_teachers' => 'Есть ли в Вашей организации Совет молодых педагогов?',
            'your_district_young_educators_council' => 'Принимаете ли Вы участие в мероприятиях проводимых Советом молодых педагогов вашего округа?',
            'metropolitan_association_young_teachers' => 'Принимаете ли Вы участие в мероприятиях проводимых Столичной ассоциацией молодых педагогов?',
            'full_name_university' => 'Полное название учебного заведения',
            'abbreviated_name_university' => 'Сокращенное название учебного заведения',
            'specialty' => 'Специальность по диплому',
            'hobby' => 'Ваше хобби',
            'credo' => 'Педагогическое кредо',
            'purpose_participation' => 'Цель участия в конкурсе',
            'team_name' => 'Название команды',
            'fio_captain' => 'ФИО капитана команды',
            'composition_team' => 'Состав команды',
            'i_agree_data_processing' => 'Согласен на обработку персональных данных',
            'path_image' => 'Фотография',
            'second_round' => 'Прошел во второй этап',
            'nomination' => 'Номинация при регистрации',
         * */

        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            1,
            1,
            'П/П');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            2,
            1,
            'E-mail');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            3,
            1,
            'ФИО');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            4,
            1,
            'Телефон');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            5,
            1,
            'Возраст');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            6,
            1,
            'Школа');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            7,
            1,
            'Должность');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            8,
            1,
            'Преподаваемый предмет');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            9,
            1,
            'Количество часов в неделю');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            10,
            1,
            'Дополнительная нагрузка');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            11,
            1,
            'Общий стаж работы');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            12,
            1,
            'Педагогический стаж работы');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            13,
            1,
            'Есть ли у Вас наставник?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            14,
            1,
            'Работают (работали) Ваши родственники в системе образования?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            15,
            1,
            'Кто из родственников?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            16,
            1,
            'Являетесь ли членом Профсоюза?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            17,
            1,
            'Номер профсоюзного билета');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            18,
            1,
            'Есть ли в Вашей организации Совет молодых педагогов?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            19,
            1,
            'Принимаете ли Вы участие в мероприятиях проводимых Советом молодых педагогов вашего округа?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            20,
            1,
            'Принимаете ли Вы участие в мероприятиях проводимых Столичной ассоциацией молодых педагогов?');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            21,
            1,
            'Полное название учебного заведения');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            22,
            1,
            'Сокращенное название учебного заведения');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            23,
            1,
            'Специальность по диплому');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            24,
            1,
            'Ваше хобби');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            25,
            1,
            'Педагогическое кредо');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            26,
            1,
            'Цель участия в конкурсе');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            27,
            1,
            'Название команды');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            28,
            1,
            'ФИО капитана команды');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            29,
            1,
            'Состав команды');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            30,
            1,
            'Согласен на обработку персональных данных');
        $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
            31,
            1,
            'Номинация при регистрации');


        $i = 2;
        $j = 1;

        foreach ($model as  $value)
        {
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                1,
                $i,
                $j++);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                2,
                $i,
                $value['email']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                3,
                $i,
                $value['second_name'].' '.$value['first_name'].' '.$value['third_name']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                4,
                $i,
                $value['phone']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                5,
                $i,
                $value['age']);

            $ous = Ous::find()->where(['id'=>$value['school']])->one();

            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                6,
                $i,
                is_null($ous)?'':$ous['short_name']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                7,
                $i,
                $value['position']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                8,
                $i,
                $value['subject_taught'] != '' ? Users::$subject[$value['subject_taught']]:'');
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                9,
                $i,
                $value['hours_in_week']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                10,
                $i,
                $value['additional_load']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                11,
                $i,
                $value['total_work_experience']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                12,
                $i,
                $value['teaching_experience']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                13,
                $i,
                Users::$yes_or_no[$value['have_mentor']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                14,
                $i,
                Users::$yes_or_no[$value['relatives_in_education']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                15,
                $i,
                $value['which_of_relatives']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                16,
                $i,
                Users::$yes_or_no[$value['union_member']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                17,
                $i,
                $value['union_card_number']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                18,
                $i,
                Users::$yes_or_no[$value['council_young_teachers']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                19,
                $i,
                Users::$yes_or_no[$value['your_district_young_educators_council']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                20,
                $i,
                Users::$yes_or_no[$value['metropolitan_association_young_teachers']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                21,
                $i,
                $value['full_name_university']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                22,
                $i,
                $value['abbreviated_name_university']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                23,
                $i,
                $value['specialty']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                24,
                $i,
                $value['hobby']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                25,
                $i,
                $value['credo']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                26,
                $i,
                $value['purpose_participation']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                27,
                $i,
                $value['team_name']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                28,
                $i,
                $value['fio_captain']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                29,
                $i,
                $value['composition_team']);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                30,
                $i,
                Users::$yes_or_no[$value['i_agree_data_processing']]);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(
                31,
                $i,
                $value['nomination'] != '' ? Application::$nominations[$value['nomination']]:'');

            $i++;
        }


        $spreadsheet->getActiveSheet()->setTitle('Статистика');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="ОТЧЕТ.xls"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        die;
    }

//    public function actionAllForms()
//    {
////        $query = Forms::find()->where(['in_archive'=>false]);
////
////        $dataProvider = new ActiveDataProvider([
////            'query' => $query,
////        ]);
//
//        return $this->render('allForms', [
////            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    public function actionAllUsers()
//    {
//        $query = Users::find()->select(['id','CONCAT(second_name,\' \',first_name,\' \',third_name) AS fio','email'])->where(['in_archive'=>false]);
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $dataProvider->setSort(['attributes' =>
//            [
//                'fio',
//                'email'
//            ]
//        ]);
//
//        return $this->render('users', [
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    public function actionUpdateUser($id)
//    {
//        $model = Users::find()->where(['id'=>$id])->one();
//
//        $post_user = Yii::$app->getRequest()->post('Users');
//
//        if($post_user)
//        {
//
//            if(isset($post_user['scenario']) && $post_user['scenario'] == 'change_password_user')
//            {
//                $model->setScenario('change_password_user');
//
//                $model['repeat_password'] = $post_user['repeat_password'];
//                $model['new_password'] = $post_user['new_password'];
//
//                if(!$model->validate())
//                {
//                    return $this->render('updateUser',[
//                        'model'  => $model,
//                        'no_validate' => true
//                    ]);
//                }
//                else
//                {
//                    $model->setScenario('default');
//                    $model['password'] = password_hash($post_user['new_password'],PASSWORD_DEFAULT);
//                }
//            }
//            else
//            {
//                $model->setScenario('default');
//                $model->setAttributes($post_user);
//            }
//
//            if($model->save())
//            {
//                return $this->redirect(['/administrator/all-users']);
//            }
//        }
//
//        return $this->render('updateUser',[
//            'model'  => $model
//        ]);
//    }
//
//    public function actionAddUser()
//    {
//        $model = new Users();
//
//        if(Yii::$app->getRequest()->post())
//        {
//            $post_user = Yii::$app->getRequest()->post('Users');
//            $model->setAttributes($post_user);
//            $model['password'] = password_hash($post_user['password'],PASSWORD_DEFAULT);
//
//            if($model->save())
//            {
//                return $this->redirect(['/administrator/all-users']);
//            }
//        }
//
//        return $this->render('addUser',[
//            'model'  => $model
//        ]);
//    }
}
