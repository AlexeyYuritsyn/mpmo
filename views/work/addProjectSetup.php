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
            <h3 class="box-title">Настройки сайта</h3>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'project-setup',
        ]); ?>
        <div class="box-body">
            <?php if(Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>
                <?= $form->field($model, 'acceptance_works_for_first_stage')->checkbox() ?>
                <?= $form->field($model, 'registration')->checkbox() ?>
            <?php endif;?>
        </div>

    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
    </div>

        <?php ActiveForm::end(); ?>
    </div>
