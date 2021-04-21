<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Регистрация';

?>

<div class="login-box">
    <div class="login-logo">
        <a href="/"><img src="/images/logo/login_logo.png" alt="Alt text" /></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=$text?></p>


        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::a('Вход',[Url::to(['/site/login'])], ['class' => 'btn btn-primary pull-right']) ?>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
