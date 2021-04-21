<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use kartik\select2\Select2;
use app\models\Application;
use kartik\file\FileInput;
use yii\helpers\Url;
use app\models\Users;
?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Оценочный табель</h3>
            <div class="box-tools pull-right">
                <?= Html::a( 'К общему список',['work/come-back'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'work-form',
        ]); ?>
        <div class="box-body">



            <?php if(Yii::$app->user->identity->role == Users::ROLE_EXPERT || Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>

                <p><label class="control-label">Работу выполнил: </label> <?=$user['second_name']?> <?=$user['first_name']?> <?=$user['third_name']?></p>
                <p><label class="control-label">Номинация: </label> <?=Application::$nominations[$model['nomination']];?></p>
                <hr>
            <br><br>
                <?php if($model['round'] == 1):?>
                    <?php  if($model['nomination'] == Application::TRADE_UNION):?>
                        <label class="control-label">Видеоролик «Представление Совета молодых педагогов образовательной организации»</label>
                    <?php  else:?>
                        <label class="control-label">Видеоролик «Представление участника»</label>
                    <?php endif;?>
                    <p><?= $model['video_1'] ?></p>
                    <br>
                    <p style="color: #c80000">Регламент – до 3 минут</p>

                    <table class="criteria-table">
                        <tr>
                            <th colspan="2">Критерии оценивания:</th>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                        </tr>
                        <tr>
                            <td>Отсутствие плагиата, наличие авторского прочтения</td>
                            <td><?= $form->field($participant_introduction, 'no_plagiarism')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Ясность идеи видеоролика</td>
                            <td><?= $form->field($participant_introduction, 'clarity_idea')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Оригинальность</td>
                            <td><?= $form->field($participant_introduction, 'originality')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Полнота и корректность подачи информации</td>
                            <td><?= $form->field($participant_introduction, 'completeness_and_correctness')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Уместность, сбалансированность информации</td>
                            <td><?= $form->field($participant_introduction, 'relevance')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Эстетичность дизайна видеоролика</td>
                            <td><?= $form->field($participant_introduction, 'aesthetic_design')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Умение представить себя/команду</td>
                            <td><?= $form->field($participant_introduction, 'ability_present_yourself')->label(false)?></td>
                        </tr>
                    </table>
                    <hr>
                    <br><br>

                    <label class="control-label">Авторское эссе</label>
                    <p>
                        <?php if($model['essay'] != ''):?>
                            <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                    </p>
                    <br>

                    <table class="criteria-table">
                        <tr>
                            <th colspan="2">Критерии оценивания:</th>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                        </tr>
                        <tr>
                            <td>Соответствие теме и глубина раскрытия темы</td>
                            <td><?= $form->field($author_essay, 'relevance_topic')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Широта кругозора</td>
                            <td><?= $form->field($author_essay, 'breadth_mind')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Логика изложения</td>
                            <td><?= $form->field($author_essay, 'logic_presentation')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Оригинальность текста (отсутствие плагиата и заимствований)</td>
                            <td><?= $form->field($author_essay, 'originality_text')->label(false)?></td>
                        </tr>
                        <tr>
                            <td>Соблюдение языковых норм русского языка</td>
                            <td><?= $form->field($author_essay, 'observance_language')->label(false)?></td>
                        </tr>
                    </table>
                    <hr>
                    <br><br>

                    <?php if($model['nomination'] == Application::TEACHER_MASTER):?>

                        <label class="control-label">Видеоролик «Просто о сложном»</label>
                        <p><?= $model['video_2'] ?></p>
                        <br>
                        <table class="criteria-table">
                            <tr>
                                <th colspan="2">Критерии оценивания:</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                            </tr>
                            <tr>
                                <td>Доступность изложения</td>
                                <td><?= $form->field($just_about_complicated, 'availability_presentation')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Научная обоснованность</td>
                                <td><?= $form->field($just_about_complicated, 'scientific_validity')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Культура речи</td>
                                <td><?= $form->field($just_about_complicated, 'culture_speech')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Индивидуальность и оригинальность</td>
                                <td><?= $form->field($just_about_complicated, 'individuality')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Логика и аргументированность</td>
                                <td><?= $form->field($just_about_complicated, 'logic_and_argumentation')->label(false)?></td>
                            </tr>
                        </table>
                        <hr>
                        <br><br>

                    <?php  elseif($model['nomination'] == Application::TEACHER_LEADER):?>

                        <!--                ссылка на тестирование-->
                    <?php  elseif($model['nomination'] == Application::TRADE_UNION):?>

                        <label class="control-label">Карта проекта</label>
                        <p>
                            <?php if($model['project_map'] != ''):?>
                                <?= Html::a('Скачать карту проекта',Url::to($model['project_map'],true),['target'=>'_blank'])?>
                            <?php endif;?>
                        </p>
                        <br>
                        <table class="criteria-table">
                            <tr>
                                <th colspan="2">Критерии оценивания:</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                            </tr>
                            <tr>
                                <td>Актуальность проекта для молодых педагогов образовательной организации</td>
                                <td><?= $form->field($project_map, 'relevance_project')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Социальная значимость для системы образования города Москвы</td>
                                <td><?= $form->field($project_map, 'social_significance')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Оригинальность предлагаемой идеи</td>
                                <td><?= $form->field($project_map, 'originality_idea')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Соответствие задач проекта приоритетным направлениям САМП</td>
                                <td><?= $form->field($project_map, 'matching_tasks')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Жизнеспособность проекта</td>
                                <td><?= $form->field($project_map, 'project_viability')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Финансовая эффективность проекта</td>
                                <td><?= $form->field($project_map, 'financial_efficiency')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Наличие системы контроля качества и результативности реализации проекта</td>
                                <td><?= $form->field($project_map, 'availability_quality')->label(false)?></td>
                            </tr>
                        </table>
                        <hr>
                    <?php endif;?>

                <?php else:?>
                    <label class="control-label">Конкурсное испытание</label>
                    <p>
                        <?php if($model['competitive_test'] != ''):?>
                            <?= Html::a('Скачать конкурсное испытание',Url::to($model['competitive_test'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                    </p>
                    <br>

                    <?php if($model['nomination'] == Application::TEACHER_MASTER):?>
                        <p style="color: #c80000">Регламент – до 15 минут</p>
                        <table class="criteria-table">
                            <tr>
                                <th colspan="2">Критерии оценивания:</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                            </tr>
                            <tr>
                                <td>Соответствие содержания мастер-класса заявленной теме, поставленным целям и задачам</td>
                                <td><?= $form->field($teacher_master_second_stage, 'content_compliance')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Глубина и оригинальность содержания</td>
                                <td><?= $form->field($teacher_master_second_stage, 'content_depth')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Наличие четкой структуры (логичность, целостность, завершенность)</td>
                                <td><?= $form->field($teacher_master_second_stage, 'clear_structure')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Владение предметом на современном уровне</td>
                                <td><?= $form->field($teacher_master_second_stage, 'possession_subject')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Грамотное использование научного языка</td>
                                <td><?= $form->field($teacher_master_second_stage, 'competent_use')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Глубина раскрытия темы</td>
                                <td><?= $form->field($teacher_master_second_stage, 'depth_topic_disclosure')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Педагогическая культура мастера</td>
                                <td><?= $form->field($teacher_master_second_stage, 'pedagogical_culture')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Эффективность психолого-педагогического общения с участниками мастер-класса</td>
                                <td><?= $form->field($teacher_master_second_stage, 'communication_efficiency')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Методическая ценность</td>
                                <td><?= $form->field($teacher_master_second_stage, 'methodological_value')->label(false)?></td>
                            </tr>
                        </table>
                        <hr>

                    <?php  elseif($model['nomination'] == Application::TEACHER_LEADER):?>
                        <table class="criteria-table">
                            <tr>
                                <th colspan="2">Критерии оценивания:</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                            </tr>
                            <tr>
                                <td>Соответствие ожидаемых результатов заявленным целям и задачам</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'consistency_results')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Информированность о критериях рейтинга вклада образовательных организаций в качественное образование московских школьников</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'rating_awareness')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Наличие четкой структуры (логичность, целостность, завершенность)</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'clear_structure')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Владение терминологией менеджмента</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'management_ownership')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Владение информацией о ресурсах города, системы образования</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'possession_city_information')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Глубина раскрытия темы</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'topic_depth')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Эффективность коммуникации при подготовке проекта (при наличии сопровождения)</td>
                                <td><?= $form->field($teacher_leader_second_stage, 'communication_efficiency')->label(false)?></td>
                            </tr>
                        </table>
                        <hr>
                    <?php  elseif($model['nomination'] == Application::TRADE_UNION):?>
                        <table class="criteria-table">
                            <tr>
                                <th colspan="2">Критерии оценивания:</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-weight:bold;">0 - не соответствует критерию<br>1 - частично соответствует критерию<br>2 - соответствует критерию<br></td>
                            </tr>
                            <tr>
                                <td>Выбор и обоснование проекта с учетом наличия в команде проектировщиков, которые смогут действительно хорошо выполнить работу</td>
                                <td><?= $form->field($trade_union_second_stage, 'selection_project')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Предложение реализации проекта на обширном, быстро развивающемся образовательном пространстве с описанием  стратегии развития организации</td>
                                <td><?= $form->field($trade_union_second_stage, 'project_proposal')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Наличие уникальной  идеи</td>
                                <td><?= $form->field($trade_union_second_stage, 'having_idea')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Реалистичный (обоснованный, с указанием источников) бюджет проекта</td>
                                <td><?= $form->field($trade_union_second_stage, 'project_budget')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Использование в проекте высоких технологий</td>
                                <td><?= $form->field($trade_union_second_stage, 'use_technology')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Сформулированные предложения по инвестированию в проект</td>
                                <td><?= $form->field($trade_union_second_stage, 'formulated_proposals')->label(false)?></td>
                            </tr>
                            <tr>
                                <td>Соответствие регламенту оформления проекта</td>
                                <td><?= $form->field($trade_union_second_stage, 'compliance_regulations')->label(false)?></td>
                            </tr>
                        </table>
                        <hr>
                    <?php endif;?>
                <?php endif;?>
                <br><br><br>

<!--                <?//= $form->field($evaluate_work, 'appraisal')?>-->
                <?= $form->field($evaluate_work, 'comment')->textarea(['rows'=>7])?>
            <?php endif;?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php

$script = <<< JS

    $(document).ready(function() {

    $("#participantintroduction-no_plagiarism,#participantintroduction-clarity_idea,#participantintroduction-originality," +
     "#participantintroduction-completeness_and_correctness,#participantintroduction-relevance,#participantintroduction-aesthetic_design," +
      "#participantintroduction-ability_present_yourself,#authoressay-relevance_topic,#authoressay-breadth_mind,#authoressay-logic_presentation," +
       "#authoressay-originality_text,#authoressay-observance_language,#projectmap-relevance_project,#projectmap-social_significance," +
        "#projectmap-originality_idea,#projectmap-matching_tasks,#projectmap-project_viability,#projectmap-financial_efficiency," +
         "#projectmap-availability_quality,#teacherleadersecondstage-consistency_results,#teacherleadersecondstage-rating_awareness," +
          "#teacherleadersecondstage-clear_structure,#teacherleadersecondstage-management_ownership,#teacherleadersecondstage-possession_city_information," +
     "#teacherleadersecondstage-topic_depth,#teacherleadersecondstage-communication_efficiency,#teachermastersecondstage-content_compliance," +
      "#teachermastersecondstage-content_depth,#teachermastersecondstage-clear_structure,#teachermastersecondstage-possession_subject," +
       "#teachermastersecondstage-competent_use,#teachermastersecondstage-depth_topic_disclosure,#teachermastersecondstage-pedagogical_culture," +
        "#teachermastersecondstage-communication_efficiency,#teachermastersecondstage-methodological_value,#tradeunionsecondstage-selection_project," +
         "#tradeunionsecondstage-project_proposal,#tradeunionsecondstage-having_idea,#tradeunionsecondstage-project_budget," +
          "#tradeunionsecondstage-use_technology,#tradeunionsecondstage-formulated_proposals,#tradeunionsecondstage-compliance_regulations").mask("9");
    
   }); 
JS;

$this->registerJs($script, yii\web\View::POS_END);
?>