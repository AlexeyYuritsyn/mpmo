<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use phpnt\bootstrapSelect\BootstrapSelectAsset;
use dosamigos\tinymce\TinyMce;

//BootstrapSelectAsset::register($this);


//$this->title = $model->isNewRecord?'Создание музея':'Редактировать музей';

?>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$model->isNewRecord?'Добавить форму':'Редактировать форму'?></h3>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>
        <div class="box-body">
            <p>Пожалуйста, заполните следующие поля:</p>
            <span>
                <?= $form->field($model, 'name')->textInput(); ?>
            </span>
            <span>
                <?= $form->field($model, 'body_form')->hiddenInput(); ?>
                <div class="form-constructor"></div>
            </span>
            <span>
                <?= $form->field($model, 'email')->textInput(); ?>
            </span>
            <span>
                <?= $form->field($model, 'subject_email')->textInput(); ?>
            </span>
            <span>
                <?= $form->field($model, 'template_email')->widget(TinyMce::className(), [
                    'options' => ['rows' => 20],
                    'language' => 'ru',
                    'clientOptions' => [
                        'plugins' => [
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ]);?>
            </span>
            <span>
                <?= $form->field($model, 'in_archive')->checkbox(); ?>
            </span>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right save-form']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php

if($model->isNewRecord)
{
    $originalFormData = '[]';
}
else
{
    $originalFormData = $model['body_form'];
}
$script1 = <<< JS
  
  const originalFormData = $originalFormData;
  const formData = JSON.stringify(originalFormData);
  
  // const getUserDataBtn = document.getElementById("get-user-data");
  const fbRender = $('.form-constructor');// document.getElementById("fb-editor");
  
    var options = {
  i18n: {
    locale: 'ru-RU'
  },
      showActionButtons: false,
      dataType: 'json',
      formData:formData,
      disableFields: [
          'button',
          'file',
          'hidden'          
          ]
};

/*Сохранение данных конструктора формы*/
 var formBuilder = fbRender.formBuilder(options);
 
 $('.save-form').on('click',function() {
     var data = formBuilder.actions.getData('json', true);
     if(data != '[]' && data != '')
     {
        $('#forms-body_form').val(data); 
     }
     
   // console.log(formBuilder.actions.getData('json', true));
   // return false;
 });
 
 
//formBuilder.actions.getData('json', true)


  // getUserDataBtn.addEventListener(
  //   "click",
  //   () => {
  //       console.log(formBuilder.actions.getData('json', true));
  //     // window.alert(window.JSON.stringify($(fbRender).formRender("userData")));
  //   },
  //   false
  // );



/*Отображение формы и сохранение введенных данных пользователя*/
// const getUserDataBtn = document.getElementById("get-user-data");
// const fbRender = document.getElementById("fb-editor");
// const originalFormData = [{"type":"autocomplete","label":"Автозаполнение","className":"form-control","name":"autocomplete-1564750761792","values":[{"label":"Option 1","value":"option-1"},{"label":"Option 2","value":"option-2"},{"label":"Option 3","value":"option-3"}],"userData":["Option 2'"]},{"type":"text","required":true,"label":"Строка","className":"form-control","name":"text-1564750809066","subtype":"text","userData":["афвыафывафвыафы"]}];
// jQuery(function($) {
//   const formData = JSON.stringify(originalFormData);
//
//   $(fbRender).formRender({ formData });
//   getUserDataBtn.addEventListener(
//     "click",
//     () => {
//         console.log(window.JSON.stringify($(fbRender).formRender("userData")));
//       // window.alert(window.JSON.stringify($(fbRender).formRender("userData")));
//     },
//     false
//   );
// });
    
    // $(document).ready(function()
    // {
    //    
    // }); 

JS;

$this->registerJs($script1, yii\web\View::POS_END);

?>