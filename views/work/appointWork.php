<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Application;
use kartik\select2\Select2;
use yii\helpers\Url;
//var_dump($model['role_methodist']);


?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Назначить эксперта на работу</h3>
        <div class="box-tools pull-right">
            <?= Html::a( 'К общему список',['work/come-back'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'user_groups'
    ]); ?>
    <div class="box-body">


        <p><label class="control-label">Работу выполнил: </label> <?=$user['second_name']?> <?=$user['first_name']?> <?=$user['third_name']?></p>
        <p><label class="control-label">Номинация: </label> <?=Application::$nominations[$model['nomination']];?></p>
        <br><br><br>


        <?php if($model['round'] == 1):?>
            <?php if($model['nomination'] == Application::TEACHER_MASTER):?>
                <label class="control-label">Видеоролик «Представление участника»</label>
                <p><?= $model['video_1'] ?></p>

                <label class="control-label">Авторское эссе</label>
                <p>
                    <?php if($model['essay'] != ''):?>
                        <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                    <?php endif;?>
                </p>
                <label class="control-label">Видеоролик «Просто о сложном»</label>
                <p><?= $model['video_2'] ?></p>
            <?php  elseif($model['nomination'] == Application::TEACHER_LEADER):?>
                <label class="control-label">Видеоролик «Представление участника»</label>
                <p><?= $model['video_1'] ?></p>

                <label class="control-label">Авторское эссе</label>
                <p>
                    <?php if($model['essay'] != ''):?>
                        <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                    <?php endif;?>
                </p>

                <!--                ссылка на тестирование-->
            <?php  elseif($model['nomination'] == Application::TRADE_UNION):?>
                <label class="control-label">Видеоролик «Представление Совета молодых педагогов образовательной организации»</label>
                <p><?= $model['video_1'] ?></p>

                <label class="control-label">Авторское эссе</label>
                <p>
                    <?php if($model['essay'] != ''):?>
                        <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                    <?php endif;?>
                </p>

                <label class="control-label">Авторское эссе</label>
                <p>
                    <?php if($model['project_map'] != ''):?>
                        <?= Html::a('Скачать карту проекта',Url::to($model['project_map'],true),['target'=>'_blank'])?>
                    <?php endif;?>
                </p>

            <?php endif;?>
        <?php else:?>

            <label class="control-label">Конкурсное испытание</label>
            <p>
                <?php if($model['competitive_test'] != ''):?>
                    <?= Html::a('Скачать конкурсное испытание',Url::to($model['competitive_test'],true),['target'=>'_blank'])?>
                <?php endif;?>
            </p>

            <br><br><br>
        <?php endif;?>


        <?= $form->field($model, 'appoint_expert_array')->widget(Select2::classname(), [
            'data' => $expert_array,
            'showToggleAll' => false,
            'options' => ['placeholder' => 'Выберите пользователя ...', 'multiple' => true],
            'pluginOptions' => [
//                'tags' => true, ,'maximumSelectionLength'=> 1
                'maximumSelectionLength' => 3
            ],
        ]);
        ?>

    </div>

    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>
