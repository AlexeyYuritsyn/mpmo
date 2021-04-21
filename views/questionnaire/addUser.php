<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

?>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Создать пользователя</h3>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'basic_information_user',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>
        <div class="box-body">

            <?= $form->field($model, 'email')->textInput(['autofocus' => true,'autocomplete'=>'off']) ?>
            <?= $form->field($model, 'password')->passwordInput(['autocomplete'=>'off']) ?>
            <?= $form->field($model, 'second_name')->textInput(['autocomplete'=>'off']) ?>
            <?= $form->field($model, 'first_name')->textInput(['autocomplete'=>'off']) ?>
            <?= $form->field($model, 'third_name')->textInput(['autocomplete'=>'off']) ?>

            <?= $form->field($model, 'role')->widget(Select2::classname(), [
                'data' => app\models\Users::$roles,
            ]);
            ?>

        </div>

        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>
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