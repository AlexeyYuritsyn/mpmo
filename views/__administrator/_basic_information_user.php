<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Users;


?>
<div class="site-login" style="margin-top: 20px; ">

    <?php $form = ActiveForm::begin([
        'id' => 'basic_information_user'
    ]); ?>
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'second_name')->textInput() ?>
        <?= $form->field($model, 'first_name')->textInput() ?>
        <?= $form->field($model, 'third_name')->textInput() ?>

        <?= $form->field($model, 'role')->hiddenInput(['value' => Users::ROLE_ADMIN])->label('') ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right']) ?>


    <?php ActiveForm::end(); ?>

    <?php

    $script = <<< JS

    $(document).ready(function() {

    // $("#users-email").inputmask("email");
   
    
   }); 
JS;

            $this->registerJs($script, yii\web\View::POS_END);
    ?>
</div>
