<?php

namespace app\controllers;
use app\models\Application;
use app\models\AppointExpert;
use app\models\AuthorEssay;
use app\models\EvaluateWork;
use app\models\JustAboutComplicated;
use app\models\ParticipantIntroduction;
use app\models\ProjectMap;
use app\models\ProjectSetup;
use app\models\TeacherLeaderSecondStage;
use app\models\TeacherMasterSecondStage;
use app\models\TradeUnionSecondStage;
use app\models\Users;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class WorkController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            throw new HttpException(500 ,'Сессия закончилась. Выполните повторно вход.');
        }

        return true;
    }

    public function actionAllWork($round,$user_id=0,$nominations=0)
    {
        if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT && Yii::$app->user->identity->second_round == false && $round == 2)
        {
            throw new HttpException(500 ,'Вы не прошли во второй этап');
        }

        $query = Application::find()->where(['application.in_archive'=>false,'application.round'=>$round]);
        $query->select([
            'application.*',
            'CONCAT(uc.second_name,\' \',uc.first_name,\' \',uc.third_name) AS fio',
            '(SELECT  SUM( coalesce(author_essay.relevance_topic, 0) + coalesce(author_essay.breadth_mind, 0) + coalesce(author_essay.logic_presentation, 0) +
                coalesce(author_essay.originality_text, 0) + coalesce(author_essay.observance_language, 0) + coalesce(just_about_complicated.availability_presentation, 0) +
                coalesce(just_about_complicated.scientific_validity, 0) + coalesce(just_about_complicated.culture_speech, 0) +
                coalesce(just_about_complicated.individuality, 0) + coalesce(just_about_complicated.logic_and_argumentation, 0) + coalesce(participant_introduction.no_plagiarism, 0) +
                coalesce(participant_introduction.clarity_idea, 0) + coalesce(participant_introduction.originality, 0) + coalesce(participant_introduction.completeness_and_correctness, 0) +
                coalesce(participant_introduction.relevance, 0) + coalesce(participant_introduction.aesthetic_design, 0) +
                coalesce(participant_introduction.ability_present_yourself, 0) + coalesce(project_map.relevance_project, 0) + coalesce(project_map.social_significance, 0) +
                coalesce(project_map.originality_idea, 0) + coalesce(project_map.matching_tasks, 0) + coalesce(project_map.project_viability, 0) +
                coalesce(project_map.financial_efficiency, 0) + coalesce(project_map.availability_quality, 0) + coalesce(teacher_master_second_stage.content_compliance, 0) +
                coalesce(teacher_master_second_stage.content_depth, 0) + coalesce(teacher_master_second_stage.clear_structure, 0) +
                coalesce(teacher_master_second_stage.possession_subject, 0) + coalesce(teacher_master_second_stage.competent_use, 0) +
                coalesce(teacher_master_second_stage.depth_topic_disclosure, 0) + coalesce(teacher_master_second_stage.pedagogical_culture, 0) +
                coalesce(teacher_master_second_stage.communication_efficiency, 0) + coalesce(teacher_master_second_stage.methodological_value, 0) +
                coalesce(teacher_leader_second_stage.consistency_results, 0) + coalesce(teacher_leader_second_stage.rating_awareness, 0) +
                coalesce(teacher_leader_second_stage.clear_structure, 0) + coalesce(teacher_leader_second_stage.management_ownership, 0) +
                coalesce(teacher_leader_second_stage.possession_city_information, 0) + coalesce(teacher_leader_second_stage.topic_depth, 0) +
                coalesce(teacher_leader_second_stage.communication_efficiency, 0) + coalesce(trade_union_second_stage.selection_project, 0) +
                coalesce(trade_union_second_stage.project_proposal, 0) + coalesce(trade_union_second_stage.having_idea, 0) +
                coalesce(trade_union_second_stage.project_budget, 0) + coalesce(trade_union_second_stage.use_technology, 0) +
                coalesce(trade_union_second_stage.formulated_proposals, 0) + coalesce(trade_union_second_stage.compliance_regulations, 0))
       FROM appoint_expert
       LEFT JOIN participant_introduction ON appoint_expert.expert_id = participant_introduction.expert_id AND appoint_expert.application_id = participant_introduction.application_id
       LEFT JOIN author_essay ON appoint_expert.expert_id = author_essay.expert_id AND appoint_expert.application_id = author_essay.application_id
       LEFT JOIN just_about_complicated ON appoint_expert.expert_id = just_about_complicated.expert_id AND appoint_expert.application_id = just_about_complicated.application_id
       LEFT JOIN project_map ON appoint_expert.expert_id = project_map.expert_id AND appoint_expert.application_id = project_map.application_id
       LEFT JOIN teacher_master_second_stage ON appoint_expert.expert_id = teacher_master_second_stage.expert_id AND appoint_expert.application_id = teacher_master_second_stage.application_id
       LEFT JOIN teacher_leader_second_stage ON appoint_expert.expert_id = teacher_leader_second_stage.expert_id AND appoint_expert.application_id = teacher_leader_second_stage.application_id
       LEFT JOIN trade_union_second_stage ON appoint_expert.expert_id = trade_union_second_stage.expert_id AND appoint_expert.application_id = trade_union_second_stage.application_id
       WHERE (appoint_expert.application_id = application.id)) AS sum_appraisal'
            ]);
        $query->innerJoin(Users::tableName().' uc', 'application.participant_id = uc.id');

        if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
        {
//            $query->select('*');
            $query->andWhere(['participant_id' => Yii::$app->user->identity->id]);
        }
        else if(Yii::$app->user->identity->role == Users::ROLE_ADMIN)
        {

        }
        else if(Yii::$app->user->identity->role == Users::ROLE_EXPERT)
        {
            $query->innerJoin(AppointExpert::tableName().' ae', 'application.id = ae.application_id');

            $query->andWhere(['expert_id'=>Yii::$app->user->identity->id]);
        }

        if((int)$user_id > 0)
        {
            $query->andWhere(['application.participant_id'=>$user_id]);
        }

        if((int)$nominations > 0)
        {
            $query->andWhere(['application.nomination'=>$nominations]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort(['attributes' =>
            [
                'update_date',
                'fio',
                'nomination',
                'sum_appraisal',
            ],
            'defaultOrder' => [ 'update_date' => SORT_DESC],
        ]);

        $users_array = [];

        $users = Users::find()->where(['role'=>Users::ROLE_PARTICIPANT,'in_archive'=>false])->all();

        if(!empty($users))
        {
            foreach ($users as $users_val)
            {
                $users_array[$users_val['id']] = $users_val['second_name'].' '.$users_val['first_name'].' '.$users_val['third_name'].' ['.$users_val['email'].']';
            }
        }

        $expert_array = [];

        $expert = Users::find()->where(['role'=>[Users::ROLE_EXPERT,Users::ROLE_ADMIN],'in_archive'=>false])->all();

        if(!empty($expert))
        {
            foreach ($expert as $users_val)
            {
                $expert_array[$users_val['id']] = $users_val['second_name'].' '.$users_val['first_name'].' '.$users_val['third_name'].' ['.$users_val['email'].']';
            }
        }

        Url::remember();
        return $this->render('allWork', [
            'dataProvider' => $dataProvider,
            'users_array' => $users_array,
            'expert_array' => $expert_array,
        ]);

    }

    public function actionComeBack()
    {
        return $this->redirect([Url::previous()]);
    }

    public function actionGroupAssignmentWork($work_id,$expert_id)
    {
        $appoint_expert_application_count = AppointExpert::find()->where(['application_id'=>$work_id])->count();

        if($appoint_expert_application_count < 3)
        {
            $appoint_expert = AppointExpert::find()->where(['application_id'=>$work_id,'expert_id'=>$expert_id])->one();

            if(is_null($appoint_expert))
            {
                $new_appoint_expert = new AppointExpert();
                $new_appoint_expert['expert_id'] = $expert_id;
                $new_appoint_expert['application_id'] = $work_id;

                $new_appoint_expert->save();
            }
        }
    }

    public function actionGroupWithdrawalWork($work_id,$expert_id)
    {
        AppointExpert::deleteAll(['application_id'=>$work_id,'expert_id'=>$expert_id]);
    }

    public function actionAddWork($nomination,$round)
    {

        if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT && Yii::$app->user->identity->second_round == false && $round == 2)
        {
            throw new HttpException(500 ,'Вы не прошли во второй раунд');
        }

        $model = new Application();

        if($round == 1)
        {
            if($nomination == Application::TEACHER_MASTER)
            {
                $model->setScenario('add_work_teacher_master');
            }
            else if($nomination == Application::TEACHER_LEADER)
            {
                $model->setScenario('add_work_teacher_leader');
            }
            else if($nomination == Application::TRADE_UNION)
            {
                $model->setScenario('add_work_trade_union');
            }
        }
        else
        {
            $model->setScenario('add_work_round_second');
        }



        $model['nomination'] = $nomination;
        $model['round'] = $round;
        $post = Yii::$app->getRequest()->post('Application');

        if($post)
        {
            $model->setAttributes($post);

            if($round == 1)
            {
                $model->path_essay = UploadedFile::getInstance($model, 'path_essay');

                if(!is_null($model->path_essay))
                {
                    $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_essay->extension;
                    if($model->path_essay->saveAs($file_path))
                    {
                        $model['essay'] = $file_path;
                    }
                    else
                    {
                        throw new HttpException(517 ,var_export($model->path_essay->getErrors(),true) );
                    }
                }

                if($nomination == Application::TRADE_UNION)
                {
                    $model->path_project_map = UploadedFile::getInstance($model, 'path_project_map');

                    if(!is_null($model->path_project_map))
                    {
                        $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_project_map->extension;

                        if($model->path_project_map->saveAs($file_path))
                        {
                            $model['project_map'] = $file_path;
                        }
                        else
                        {
                            throw new HttpException(517 ,var_export($model->path_project_map->getErrors(),true) );
                        }
                    }
                }
            }
            else
            {
                $model->path_competitive_test = UploadedFile::getInstance($model, 'path_competitive_test');

                if(!is_null($model->path_competitive_test))
                {
                    $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_competitive_test->extension;
                    if($model->path_competitive_test->saveAs($file_path))
                    {
                        $model['competitive_test'] = $file_path;
                    }
                    else
                    {
                        throw new HttpException(517 ,var_export($model->path_competitive_test->getErrors(),true) );
                    }
                }
            }


            $model['participant_id'] = Yii::$app->user->identity->id;
            $model['update_date'] = new Expression('NOW()');


            if($model->save())
            {
                return $this->redirect(['work/all-work','round'=>$round]);
            }
//            else
//            {
//                var_dump($model->getErrors());
//                die;
//            }
        }

        return $this->render('addWork', [
            'model' => $model,
            'can_saved' => true,
        ]);

    }

    public function actionUpdateWork($nomination,$id)
    {
        $model = Application::find()->where(['id'=>$id,'nomination'=>$nomination]);

        if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
        {
            $model->andWhere(['participant_id'=>Yii::$app->user->identity->id]);
        }

        $model = $model->one();

        if(is_null($model))
        {
            throw new HttpException(517 ,'Работа не найдена');
        }

        $can_saved = true;

        if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
        {
            $appoint_expert = \app\models\AppointExpert::find()->where(['application_id'=>$model['id']])->count();
            if($appoint_expert > 0)
            {
                $can_saved = false;
            }
        }

        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            if($model['round'] == 1)
            {
                if($nomination == Application::TEACHER_MASTER)
                {
                    $model->setScenario('add_work_teacher_master');
                }
                else if($nomination == Application::TEACHER_LEADER)
                {
                    $model->setScenario('add_work_teacher_leader');
                }
                else if($nomination == Application::TRADE_UNION)
                {
                    $model->setScenario('add_work_trade_union');
                }
            }
            else
            {
                $model->setScenario('add_work_round_second');
            }
        }

        $model['nomination'] = $nomination;
        $post = Yii::$app->getRequest()->post('Application');

        if($post)
        {
            $model->setAttributes($post);

            if($model['round'] == 1)
            {
                $model->path_essay = UploadedFile::getInstance($model, 'path_essay');

                if(!is_null($model->path_essay))
                {
                    $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_essay->extension;
                    if($model->path_essay->saveAs($file_path))
                    {
                        $model['essay'] = $file_path;
                    }
                    else
                    {
                        throw new HttpException(517 ,var_export($model->path_essay->getErrors(),true) );
                    }
                }

                if($nomination == Application::TRADE_UNION)
                {
                    $model->path_project_map = UploadedFile::getInstance($model, 'path_project_map');

                    if(!is_null($model->path_project_map))
                    {
                        $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_project_map->extension;

                        if($model->path_project_map->saveAs($file_path))
                        {
                            $model['project_map'] = $file_path;
                        }
                        else
                        {
                            throw new HttpException(517 ,var_export($model->path_project_map->getErrors(),true) );
                        }
                    }
                }
            }
            else
            {
                $model->path_competitive_test = UploadedFile::getInstance($model, 'path_competitive_test');

                if(!is_null($model->path_competitive_test))
                {
                    $file_path = 'uploads/files_for_work/'.md5(rand(1,2147483647)).'.'.$model->path_competitive_test->extension;
                    if($model->path_competitive_test->saveAs($file_path))
                    {
                        $model['competitive_test'] = $file_path;
                    }
                    else
                    {
                        throw new HttpException(517 ,var_export($model->path_competitive_test->getErrors(),true) );
                    }
                }
            }


            if(isset($post['delete-work']))
            {
                $model['in_archive'] = true;
            }

            $model['update_date'] = new Expression('NOW()');

            if($model->save())
            {
                return $this->redirect(['work/all-work','round'=>$model['round']]);
            }
        }

        return $this->render('addWork', [
            'model' => $model,
            'can_saved' => $can_saved,
        ]);

    }

    public function actionCheckingQuestionnaire()
    {
        $model = Users::find()->where(['id'=>Yii::$app->user->identity->id])->one();

        if($model['i_agree_data_processing'] == true)
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function actionProjectSetup()
    {
        $model = ProjectSetup::find()->where(['id'=>1])->one();

        $post = Yii::$app->getRequest()->post('ProjectSetup');

        if($post)
        {
            $model->setAttributes($post);

            $model->save();
        }

        return $this->render('addProjectSetup', [
            'model' => $model
        ]);
    }

    public function actionAppointWork($id)
    {
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN)
        {
            $this->redirect(['/site/index']);
        }
        $model = Application::find()->where(['id'=>$id])->one();

        if(is_null($model))
        {
            throw new HttpException(517 ,'Работа не найдена');
        }

        $expert_array = [];
        $expert = Users::find()->where(['in_archive'=>false,'role'=>[Users::ROLE_EXPERT,Users::ROLE_ADMIN]])->all();

        if(!empty($expert))
        {
            foreach($expert as $expert_val)
            {
                $expert_array[$expert_val['id']] = $expert_val['second_name'].' '.$expert_val['first_name'].' '.$expert_val['third_name'];
            }
        }

        $appoint_expert_array = [];
        $appoint_expert = AppointExpert::find()->where(['application_id'=>$model['id']])->all();

        if(!empty($appoint_expert))
        {
            foreach($appoint_expert as $appoint_expert_val)
            {
                $appoint_expert_array[] = $appoint_expert_val['expert_id'];
            }
        }

        $model['appoint_expert_array'] = $appoint_expert_array;

        $user = Users::find()->where(['id'=>$model['participant_id']])->one();

        $post = Yii::$app->getRequest()->post('Application');

        if($post)
        {
            AppointExpert::deleteAll(['application_id'=>$model['id']]);

            if(!empty($post['appoint_expert_array']))
            {
                foreach($post['appoint_expert_array'] as $appoint_expert_array_val)
                {
                    $new_appoint_expert = new AppointExpert();
                    $new_appoint_expert['expert_id'] = $appoint_expert_array_val;
                    $new_appoint_expert['application_id'] = $model['id'];

                    $new_appoint_expert->save();
                }
            }

            return $this->redirect(['work/appoint-work','id'=>$id]);
        }

        return $this->render('appointWork', [
            'expert_array' => $expert_array,
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionSeeResults($id)
    {
        $model = Application::find()->where(['id'=>$id])->one();

        if(is_null($model))
        {
            throw new HttpException(517 ,'Работа не найдена');
        }

        $user = Users::find()->where(['id'=>$model['participant_id']])->one();

        $query = AppointExpert::find()
            ->select(['(coalesce(author_essay.relevance_topic, 0) + coalesce(author_essay.breadth_mind, 0) + coalesce(author_essay.logic_presentation, 0) +
                coalesce(author_essay.originality_text, 0) + coalesce(author_essay.observance_language, 0) + coalesce(just_about_complicated.availability_presentation, 0) +
                coalesce(just_about_complicated.scientific_validity, 0) + coalesce(just_about_complicated.culture_speech, 0) +
                coalesce(just_about_complicated.individuality, 0) + coalesce(just_about_complicated.logic_and_argumentation, 0) + coalesce(participant_introduction.no_plagiarism, 0) +
                coalesce(participant_introduction.clarity_idea, 0) + coalesce(participant_introduction.originality, 0) + coalesce(participant_introduction.completeness_and_correctness, 0) +
                coalesce(participant_introduction.relevance, 0) + coalesce(participant_introduction.aesthetic_design, 0) +
                coalesce(participant_introduction.ability_present_yourself, 0) + coalesce(project_map.relevance_project, 0) + coalesce(project_map.social_significance, 0) +
                coalesce(project_map.originality_idea, 0) + coalesce(project_map.matching_tasks, 0) + coalesce(project_map.project_viability, 0) +
                coalesce(project_map.financial_efficiency, 0) + coalesce(project_map.availability_quality, 0) + coalesce(teacher_master_second_stage.content_compliance, 0) +
                coalesce(teacher_master_second_stage.content_depth, 0) + coalesce(teacher_master_second_stage.clear_structure, 0) +
                coalesce(teacher_master_second_stage.possession_subject, 0) + coalesce(teacher_master_second_stage.competent_use, 0) +
                coalesce(teacher_master_second_stage.depth_topic_disclosure, 0) + coalesce(teacher_master_second_stage.pedagogical_culture, 0) +
                coalesce(teacher_master_second_stage.communication_efficiency, 0) + coalesce(teacher_master_second_stage.methodological_value, 0) +
                coalesce(teacher_leader_second_stage.consistency_results, 0) + coalesce(teacher_leader_second_stage.rating_awareness, 0) +
                coalesce(teacher_leader_second_stage.clear_structure, 0) + coalesce(teacher_leader_second_stage.management_ownership, 0) +
                coalesce(teacher_leader_second_stage.possession_city_information, 0) + coalesce(teacher_leader_second_stage.topic_depth, 0) +
                coalesce(teacher_leader_second_stage.communication_efficiency, 0) + coalesce(trade_union_second_stage.selection_project, 0) +
                coalesce(trade_union_second_stage.project_proposal, 0) + coalesce(trade_union_second_stage.having_idea, 0) +
                coalesce(trade_union_second_stage.project_budget, 0) + coalesce(trade_union_second_stage.use_technology, 0) +
                coalesce(trade_union_second_stage.formulated_proposals, 0) + coalesce(trade_union_second_stage.compliance_regulations, 0)) AS sum_ratings','evaluate_work.comment AS evaluate_work_comment','CONCAT(users.second_name,\' \',users.first_name,\' \',users.third_name) AS fio'])
            ->where(['appoint_expert.application_id' => $id])
            ->leftJoin(ParticipantIntroduction::tableName(),'appoint_expert.expert_id = participant_introduction.expert_id AND appoint_expert.application_id = participant_introduction.application_id')
            ->leftJoin(AuthorEssay::tableName(),'appoint_expert.expert_id = author_essay.expert_id AND appoint_expert.application_id = author_essay.application_id')
            ->leftJoin(JustAboutComplicated::tableName(),'appoint_expert.expert_id = just_about_complicated.expert_id AND appoint_expert.application_id = just_about_complicated.application_id')
            ->leftJoin(ProjectMap::tableName(),'appoint_expert.expert_id = project_map.expert_id AND appoint_expert.application_id = project_map.application_id')
            ->leftJoin(TeacherMasterSecondStage::tableName(),'appoint_expert.expert_id = teacher_master_second_stage.expert_id AND appoint_expert.application_id = teacher_master_second_stage.application_id')
            ->leftJoin(TeacherLeaderSecondStage::tableName(),'appoint_expert.expert_id = teacher_leader_second_stage.expert_id AND appoint_expert.application_id = teacher_leader_second_stage.application_id')
            ->leftJoin(TradeUnionSecondStage::tableName(),'appoint_expert.expert_id = trade_union_second_stage.expert_id AND appoint_expert.application_id = trade_union_second_stage.application_id')
            ->innerJoin(EvaluateWork::tableName(),'appoint_expert.expert_id = evaluate_work.expert_id AND appoint_expert.application_id = evaluate_work.application_id')
            ->innerJoin(Users::tableName(),'appoint_expert.expert_id = users.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('seeResults', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'user' => $user
        ]);

    }

    public function actionEvaluateWork($id)
    {
        if(Yii::$app->user->identity->role != Users::ROLE_ADMIN && Yii::$app->user->identity->role != Users::ROLE_EXPERT)
        {
            $this->redirect(['/site/index']);
        }

        $model = Application::find()->where(['id'=>$id])->one();

        if(is_null($model))
        {
            throw new HttpException(517 ,'Работа не найдена');
        }

        $participant_introduction = null;
        $author_essay = null;
        $just_about_complicated = null;
        $project_map = null;
        $evaluate_work = null;
        $teacher_leader_second_stage = null;
        $teacher_master_second_stage = null;
        $trade_union_second_stage = null;

        if(trim($model['video_1']) != '')
        {
            $participant_introduction = ParticipantIntroduction::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();

            if(is_null($participant_introduction))
            {
                $participant_introduction = new ParticipantIntroduction();
            }
        }

        if(trim($model['essay']) != '')
        {
            $author_essay = AuthorEssay::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();

            if(is_null($author_essay))
            {
                $author_essay = new AuthorEssay();
            }
        }

        if(trim($model['video_2']) != '')
        {
            $just_about_complicated = JustAboutComplicated::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();

            if(is_null($just_about_complicated))
            {
                $just_about_complicated = new JustAboutComplicated();
            }
        }

        if(trim($model['project_map']) != '')
        {
            $project_map = ProjectMap::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();

            if(is_null($project_map))
            {
                $project_map = new ProjectMap();
            }
        }

        if(trim($model['competitive_test']) != '')
        {
            if($model['nomination'] == Application::TEACHER_LEADER)
            {
                $teacher_leader_second_stage = TeacherLeaderSecondStage::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();
                if(is_null($teacher_leader_second_stage))
                {
                    $teacher_leader_second_stage = new TeacherLeaderSecondStage();
                }
            }
            else if($model['nomination'] == Application::TEACHER_MASTER)
            {
                $teacher_master_second_stage = TeacherMasterSecondStage::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();
                if(is_null($teacher_master_second_stage))
                {
                    $teacher_master_second_stage = new TeacherMasterSecondStage();
                }
            }
            else if($model['nomination'] == Application::TRADE_UNION)
            {
                $trade_union_second_stage = TradeUnionSecondStage::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();
                if(is_null($trade_union_second_stage))
                {
                    $trade_union_second_stage = new TradeUnionSecondStage();
                }
            }
        }

        $evaluate_work = EvaluateWork::find()->where(['application_id'=>$model['id'],'expert_id'=>Yii::$app->user->identity->id])->one();

        if(is_null($evaluate_work))
        {
            $evaluate_work = new EvaluateWork();
        }

        $user = Users::find()->where(['id'=>$model['participant_id']])->one();

        $post = Yii::$app->getRequest()->post();

        if($post)
        {
            $redirect = true;
            if(isset($post['ParticipantIntroduction']))
            {
                $participant_introduction->setAttributes($post['ParticipantIntroduction']);
                $participant_introduction['expert_id'] = Yii::$app->user->identity->id;
                $participant_introduction['application_id'] = $model['id'];

                if(!$participant_introduction->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['AuthorEssay']))
            {
                $author_essay->setAttributes($post['AuthorEssay']);
                $author_essay['expert_id'] = Yii::$app->user->identity->id;
                $author_essay['application_id'] = $model['id'];

                if(!$author_essay->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['JustAboutComplicated']))
            {
                $just_about_complicated->setAttributes($post['JustAboutComplicated']);
                $just_about_complicated['expert_id'] = Yii::$app->user->identity->id;
                $just_about_complicated['application_id'] = $model['id'];

                if(!$just_about_complicated->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['ProjectMap']))
            {
                $project_map->setAttributes($post['ProjectMap']);
                $project_map['expert_id'] = Yii::$app->user->identity->id;
                $project_map['application_id'] = $model['id'];

                if(!$project_map->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['TeacherLeaderSecondStage']))
            {
                $teacher_leader_second_stage->setAttributes($post['TeacherLeaderSecondStage']);
                $teacher_leader_second_stage['expert_id'] = Yii::$app->user->identity->id;
                $teacher_leader_second_stage['application_id'] = $model['id'];

                if(!$teacher_leader_second_stage->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['TeacherMasterSecondStage']))
            {
                $teacher_master_second_stage->setAttributes($post['TeacherMasterSecondStage']);
                $teacher_master_second_stage['expert_id'] = Yii::$app->user->identity->id;
                $teacher_master_second_stage['application_id'] = $model['id'];

                if(!$teacher_master_second_stage->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['TradeUnionSecondStage']))
            {
                $trade_union_second_stage->setAttributes($post['TradeUnionSecondStage']);
                $trade_union_second_stage['expert_id'] = Yii::$app->user->identity->id;
                $trade_union_second_stage['application_id'] = $model['id'];

                if(!$trade_union_second_stage->save())
                {
                    $redirect = false;
                }
            }

            if(isset($post['EvaluateWork']))
            {
                $evaluate_work->setAttributes($post['EvaluateWork']);
                $evaluate_work['expert_id'] = Yii::$app->user->identity->id;
                $evaluate_work['application_id'] = $model['id'];

                if(!$evaluate_work->save())
                {
                    $redirect = false;
                }
            }


            if($redirect == true)
            {
                return $this->redirect(['work/all-work','round'=>1]);
            }
//            $evaluate_work->setAttributes($post);
//            $evaluate_work['expert_id'] = Yii::$app->user->identity->id;
//            $evaluate_work['application_id'] = $model['id'];
//
//            if($evaluate_work->save())
//            {
//                return $this->redirect(['work/all-work','round'=>1]);
//            }
//            else
//            {
//                throw new HttpException(517 ,var_export($model->getErrors(),true) );
//            }
        }

        return $this->render('evaluateWork', [
            'teacher_leader_second_stage' => $teacher_leader_second_stage,
            'teacher_master_second_stage' => $teacher_master_second_stage,
            'trade_union_second_stage' => $trade_union_second_stage,
            'participant_introduction' => $participant_introduction,
            'author_essay' => $author_essay,
            'just_about_complicated' => $just_about_complicated,
            'model' => $model,
            'user' => $user,
            'project_map' => $project_map,
            'evaluate_work' => $evaluate_work,
        ]);
    }

    public function actionCheckingNominationWork($nomination,$round)
    {
        $model = Application::find()->where(['participant_id'=>Yii::$app->user->identity->id,'nomination'=>$nomination,'round'=>$round,'in_archive'=>false])->one();

        if(is_null($model))
        {
            $project_setup =  ProjectSetup::find()->where(['id'=>1])->one();

            if($project_setup['acceptance_works_for_first_stage'] == false)
            {
                return 'Прием работ завершен';
            }
            else
            {
                return '1';
            }
        }
        else
        {
            return 'На данную номинацию вы уже подавали работу';
        }
    }

}
