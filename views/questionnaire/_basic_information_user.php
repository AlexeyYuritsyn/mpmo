<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\file\FileInput;

use app\models\Users;


?>
<div class="site-login" style="margin-top: 20px; ">

    <?php $form = ActiveForm::begin([
        'id' => 'basic_information_user'
    ]); ?>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'second_name')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'first_name') ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'third_name') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'phone') ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-xs-4">
            <?php if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT || $model['role'] == Users::ROLE_PARTICIPANT) :?>
                <?= $form->field($model, 'age') ?>
            <?php endif;?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'school')->widget(Select2::classname(), [
                'data' => $ous_array,
                'options' => ['placeholder' => 'Выберите школу ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($model, 'position') ?>
        </div>
    </div>

    <?php if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT || $model['role'] == Users::ROLE_PARTICIPANT) :?>

        <?=$form->field($model, "path_image")->widget(FileInput::classname(), [
            'options'=>[
                'multiple'=>false,
                'accept' => 'image/png,image/jpg,image/jpeg'
            ],
            'pluginOptions'=>[
                'previewFileType' => 'image',
                'allowedFileExtensions' => ['png','jfif','pjpeg','jpeg','pjp','jpg'],
                'showUpload' => false,
                'showPreview' => true,
                'initialPreview'=> $model['image'] != ''? Url::to($model['image'],true):[],
    //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                'initialPreviewConfig' => $widget_logo_remove,
                'initialPreviewAsData'=>true,
                'overwriteInitial'=>false,
            'maxFileCount' => 1
    //            'maxFileSize'=>100
            ],
        ]);?>
        <p>
            <?php if($model['image'] != ''):?>
                <?= Html::a('Скачать фотографию',Url::to($model['image'],true),['target'=>'_blank'])?>
            <?php endif;?>
        </p>

        <p style="margin-top: 50px;"></p>



        <div class="row">
            <div class="col-xs-4">
                <?= $form->field($model, 'subject_taught')->widget(Select2::classname(), [
                    'data' => Users::$subject,
                    'options' => ['placeholder' => 'Выберите предмет ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
                ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'hours_in_week') ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'additional_load') ?>
            </div>
        </div>
        <p style="margin-top: 50px;"></p>
        <div class="row">
            <div class="col-xs-4">
                <?= $form->field($model, 'total_work_experience') ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'teaching_experience') ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'have_mentor')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ])
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-5">
                <?= $form->field($model, 'relatives_in_education')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ]);
                ?>
            </div>
            <div class="col-xs-7">
                <?= $form->field($model, 'which_of_relatives') ?>
            </div>
        </div>
        <p style="margin-top: 50px;"></p>
        <div class="row">
            <div class="col-xs-3">
                <?= $form->field($model, 'union_member')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ])
                ?>
            </div>
            <div class="col-xs-3">
                <?= $form->field($model, 'union_card_number') ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'council_young_teachers')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ])
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'your_district_young_educators_council')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ])
                ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'metropolitan_association_young_teachers')->widget(Select2::classname(), [
                    'data' => Users::$yes_or_no
                ])
                ?>
            </div>
        </div>

        <p style="margin-top: 50px;">Какое учебное заведение Вы закончили?</p>
        <div class="row">
            <div class="col-xs-7">
                <?= $form->field($model, 'full_name_university') ?>
            </div>
            <div class="col-xs-5">
                <?= $form->field($model, 'abbreviated_name_university') ?>
            </div>
        </div>
        <?= $form->field($model, 'specialty') ?>

        <p style="margin-top: 50px;"></p>

        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'hobby')->textarea(['rows'=>7]) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'credo')->textarea(['rows'=>7]) ?>
            </div>
        </div>
        <?= $form->field($model, 'purpose_participation')->textarea(['rows'=>7]) ?>
        <?= $form->field($model, 'nomination')->widget(Select2::classname(), [
            'data' => app\models\Application::$nominations,
            'options' => ['placeholder' => 'Выберите номинацию ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        <div style="border:thick double #32a1ce; margin-top: 50px;">
            <p style="">Вопросы для участников номинации «Профессиональный союз»</p>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model, 'team_name') ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'fio_captain') ?>
                </div>
            </div>
            <?= $form->field($model, 'composition_team')->textarea(['rows'=>7]) ?>
        </div>

        <?= $form->field($model, 'i_agree_data_processing')->checkbox()->label('Я принимаю <a href="/files/Agreement.pdf" target="_blank">соглашение</a> на обработку персональных данных') ?>
    <?php endif;?>

    <?php if(Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>
        <?= $form->field($model, 'in_archive')->checkbox() ?>
        <?php if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT || $model['role'] == Users::ROLE_PARTICIPANT) :?>
            <?= $form->field($model, 'second_round')->checkbox() ?>
        <?php endif;?>

        <?= $form->field($model, 'role')->widget(Select2::classname(), [
            'data' => app\models\Users::$roles,
        ]);
        ?>
    <?php endif;?>


    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
    </div>



    <?php ActiveForm::end(); ?>

    <?php

    $script = <<< JS

    $(document).ready(function() {

    $("#users-email").inputmask("email");
    $("#users-phone").mask("+7(999) 999-99-99");
    $("#users-age").mask("99");
    // $("#users-total_work_experience").mask("99");
    // $("#users-teaching_experience").mask("99");
    
    
   }); 

JS;

            $this->registerJs($script, yii\web\View::POS_END);
    ?>
</div>
