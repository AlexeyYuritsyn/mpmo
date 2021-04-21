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

$label = '';
if($model['nomination'] == Application::TEACHER_MASTER)
{
    $label = 'Конкурсное испытание «Мастер-класс» (.zip)';
}
else if($model['nomination'] == Application::TEACHER_LEADER)
{
    $label = 'Конкурсное испытание «Представление управленческого проекта» (.zip)';
}
else if($model['nomination'] == Application::TRADE_UNION)
{
    $label = 'Конкурсное испытание «Защита проекта» (.zip)';
}
?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?=Application::$nominations[$model['nomination']]?></h3>
            <div class="box-tools pull-right">
                <?= Html::a( 'К общему список',['work/come-back'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'work-form',
        ]); ?>
        <div class="box-body">

            <?php if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT || Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>
                <?php if($model['round'] == 1):?>
                    <?php if($model['nomination'] == Application::TEACHER_MASTER):?>

                        <?= $form->field($model, 'video_1')->label('Видеоролик «Представление участника»') ?>
                        <?= $form->field($model, 'path_essay')->widget(FileInput::classname(), [
                            'options'=>[
                                'multiple'=>false,
                                'accept' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                            ],
                            'pluginOptions'=>[
                                'previewFileType' => 'any',
                                'allowedFileExtensions' => ['pdf','doc','docx'],
                                'showUpload' => false,
                                'showPreview' => false,
//                                'initialPreview'=> $model['essay'] != ''? Url::to($model['essay'],true):[],
                                //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                                //            'initialPreviewConfig' => $widget_logo_remove,
//                                'initialPreviewAsData'=>true,
                                'overwriteInitial'=>false,
                                'maxFileCount' => 1,
                                'maxFileSize'=>20000
                            ],
                        ])->label('Авторское эссе (.doc, .docx, .pdf)');?>
                        <?php if($model['essay'] != ''):?>
                            <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                        <?= $form->field($model, 'video_2')->label('Видеоролик «Просто о сложном»')?>
                    <?php  elseif($model['nomination'] == Application::TEACHER_LEADER):?>
                        <?= $form->field($model, 'video_1')->label('Видеоролик «Представление участника»') ?>
                        <?= $form->field($model, 'path_essay')->widget(FileInput::classname(), [
                            'options'=>[
                                'multiple'=>false,
                                'accept' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                            ],
                            'pluginOptions'=>[
                                'previewFileType' => 'any',
                                'allowedFileExtensions' => ['pdf','doc','docx'],
                                'showUpload' => false,
                                'showPreview' => false,
//                                'initialPreview'=> $model['essay'] != ''? Url::to($model['essay'],true):[],
                                //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                                //            'initialPreviewConfig' => $widget_logo_remove,
//                                'initialPreviewAsData'=>true,
                                'overwriteInitial'=>false,
                                'maxFileCount' => 1,
                                'maxFileSize'=>20000
                            ],
                        ])->label('Авторское эссе (.doc, .docx, .pdf)');?>
                        <?php if($model['essay'] != ''):?>
                            <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                        <!--                ссылка на тестирование-->
                    <?php  elseif($model['nomination'] == Application::TRADE_UNION):?>
                        <?= $form->field($model, 'video_1')->label('Видеоролик «Представление Совета молодых педагогов образовательной организации»') ?>
                        <?= $form->field($model, 'path_essay')->widget(FileInput::classname(), [
                            'options'=>[
                                'multiple'=>false,
                                'accept' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                            ],
                            'pluginOptions'=>[
                                'previewFileType' => 'any',
                                'allowedFileExtensions' => ['pdf','doc','docx'],
                                'showUpload' => false,
                                'showPreview' => false,
//                                'initialPreview'=> $model['essay'] != ''? Url::to($model['essay'],true):[],
                                //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                                //            'initialPreviewConfig' => $widget_logo_remove,
//                                'initialPreviewAsData'=>true,
                                'overwriteInitial'=>false,
                                'maxFileCount' => 1,
                                'maxFileSize'=>20000
                            ],
                        ])->label('Авторское эссе (.doc, .docx, .pdf)');?>
                        <?php if($model['essay'] != ''):?>
                            <?= Html::a('Скачать эссе',Url::to($model['essay'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                        <?= $form->field($model, 'path_project_map')->widget(FileInput::classname(), [
                            'options'=>[
                                'multiple'=>false,
                                'accept' => 'application/zip'
                            ],
                            'pluginOptions'=>[
                                'previewFileType' => 'any',
                                'allowedFileExtensions' => ['zip'],
                                'showUpload' => false,
                                'showPreview' => false,
//                                'initialPreview'=> $model['project_map'] != ''? Url::to($model['project_map'],true):[],
                                //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                                //            'initialPreviewConfig' => $widget_logo_remove,
//                                'initialPreviewAsData'=>true,
                                'overwriteInitial'=>false,
                                'maxFileCount' => 1,
                                'maxFileSize'=>20000
                            ],
                        ])->label('Карта проекта (.zip)')?>
                        <?php if($model['project_map'] != ''):?>
                            <?= Html::a('Скачать карту проекта',Url::to($model['project_map'],true),['target'=>'_blank'])?>
                        <?php endif;?>
                    <?php endif;?>
                <?php else:?>
                    <?= $form->field($model, 'path_competitive_test')->widget(FileInput::classname(), [
                        'options'=>[
                            'multiple'=>false,
                            'accept' => 'application/zip'
                        ],
                        'pluginOptions'=>[
                            'previewFileType' => 'any',
                            'allowedFileExtensions' => ['zip'],
                            'showUpload' => false,
                            'showPreview' => false,
//                                'initialPreview'=> $model['project_map'] != ''? Url::to($model['project_map'],true):[],
                            //        'uploadUrl' => Url::to(['/methodist/file-delete-material','id'=>Yii::$app->getRequest()->get('id')]),
                            //            'initialPreviewConfig' => $widget_logo_remove,
//                                'initialPreviewAsData'=>true,
                            'overwriteInitial'=>false,
                            'maxFileCount' => 1,
                            'maxFileSize'=>20000
                        ],
                    ])->label($label)?>
                    <?php if($model['competitive_test'] != ''):?>
                        <?= Html::a('Скачать конкурсное испытание',Url::to($model['competitive_test'],true),['target'=>'_blank'])?>
                    <?php endif;?>
                <?php endif;?>
                    <?= $form->field($model, 'nomination')->hiddenInput(['value'=>$model['nomination']])->label(false) ?>
                    <?= $form->field($model, 'round')->hiddenInput()->label(false) ?>
            <?php endif;?>





        </div>



    <div class="box-footer pull-right">
        <?php if(Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>
            <?= Html::submitButton('Удалить', ['class' => 'btn btn-primary', 'name'=>'Application[delete-work]']) ?>
        <?php endif;?>
        <?php if($can_saved == true):?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
    </div>

        <?php ActiveForm::end(); ?>
    </div>

<?php

$script = <<< JS

    $(document).ready(function() {

    // $("#users-email").inputmask("email");
    
   }); 
JS;

$this->registerJs($script, yii\web\View::POS_END);
?>