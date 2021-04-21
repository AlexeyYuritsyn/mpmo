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
        <p class="login-box-msg">Введите данные для регистрации</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'email')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
        <?= $form
            ->field($model, 'password')
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('Пароль')]) ?>
        <?= $form
            ->field($model, 'repeat_password')
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('Повторите пароль')]) ?>
        <?= $form
            ->field($model, 'second_name')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('Фамилия')]) ?>
        <?= $form
            ->field($model, 'first_name')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('Имя')]) ?>
        <?= $form
            ->field($model, 'third_name')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('Отчество')]) ?>
        <?= $form->field($model, 'role')->widget(Select2::classname(), [
            'data' => app\models\Users::$roles_register,
//            'language' => 'de',
            'options' => ['placeholder' => 'Выберите роль ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ->label(false);
        ?>
        <?= $form->field($model, 'nomination')->widget(Select2::classname(), [
            'data' => app\models\Application::$nominations,
            'options' => ['placeholder' => 'Выберите номинацию ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ->label(false);
        ?>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary pull-right']) ?>
            </div>
            <!-- /.col -->
        </div>
        <a href="<?=Url::to(['/site/login'])?>" class="text-center">Вход</a>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<?php
$role_participant = app\models\Users::ROLE_PARTICIPANT;
$script = <<< JS

    $(document).ready(function() {
        
        $('body').on('change','#users-role',function() {
            
            if($(this).val() == '$role_participant')
            {
               $('.field-users-nomination').css("display", "");
            }
            else
            {
                $('.field-users-nomination').css("display", "none");
            }
          // console.log($("#users-role option:selected").val());
          // console.log();
        });
        
        if($("#users-role option:selected").val() == '$role_participant')
            {
               $('.field-users-nomination').css("display", "");
            }
            else
            {
                $('.field-users-nomination').css("display", "none");
            }
    
   }); 
JS;

$this->registerJs($script, yii\web\View::POS_END);
?>