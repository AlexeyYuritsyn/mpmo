<?php
use yii\grid\GridView;
use yii\helpers\Html;
use \yii\bootstrap\Modal;
use kartik\select2\Select2;
use app\models\Users;

use phpnt\bootstrapSelect\BootstrapSelectAsset;
BootstrapSelectAsset::register($this);

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Работы <?=Yii::$app->getRequest()->get('round')?> этапа</h3>
        <div class="box-tools pull-right">
            <?php if(Yii::$app->user->identity->role == \app\models\Users::ROLE_PARTICIPANT):?>
                <?= Html::Button( 'Добавить работу', ['class' => 'btn btn-primary add-work']) ?>
            <?php endif;?>
            <?php if(Yii::$app->user->identity->role == \app\models\Users::ROLE_ADMIN):?>
                <?= Html::Button( 'Групповое назначение', ['class' => 'btn btn-primary group-assignment']) ?>
                <?= Html::Button( 'Групповое снятие', ['class' => 'btn btn-primary group-withdrawal']) ?>
            <?php endif;?>
        </div>
    </div>
    <div class="box-body">
        <?php if(Yii::$app->user->identity->role != \app\models\Users::ROLE_PARTICIPANT):?>
            <?php echo Html::beginForm(['/work/all-work','round'=>Yii::$app->getRequest()->get('round')],'get');?>
            <div class="filter-wrapper">

                <div class="filter-block school-filter-block" style="width: 350px;">
                    <span class="filter-header-text">ФИО участника</span>
                    <?=Html::dropDownList('user_id', Yii::$app->getRequest()->get('user_id'), $users_array, [
                        'class'  => 'form-control selectpicker',
                        'data' => [
                            'live-search' => 'true',
                            'size' => 10,
                            'title' => 'Ничего не выбрано',
                        ]
                    ]);?>
                </div>


                <div class="filter-block school-filter-block" style="width: 300px;">
                    <span class="filter-header-text">Номинация</span>
                    <?=Html::dropDownList('nominations', Yii::$app->getRequest()->get('nominations'), \app\models\Application::$nominations, [
                        'class'  => 'form-control selectpicker',
                        'data' => [
                            'live-search' => 'true',
                            'size' => 10,
                            'title' => 'Ничего не выбрано',
                        ]
                    ]);?>
                </div>

                <div class="filter-block">
                    <?= Html::submitButton('Фильтр', ['class' => 'btn btn-primary button-filter']) ?>
                    <?= Html::a('Сброс', ['/work/all-work','round'=>Yii::$app->getRequest()->get('round')], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php echo Html::endForm();?>
        <?php endif;?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' =>  (Yii::$app->user->identity->role == Users::ROLE_ADMIN?'yii\grid\CheckboxColumn':'yii\grid\SerialColumn'),
                    'contentOptions' => ['aria-label' => '#']],
                [
                    'attribute' => 'update_date',
                    'format'    => 'html',
                    'value' => function ($data) {
                        return  date("d.m.Y H:i:s", strtotime($data['update_date']));
                    },
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('update_date')];
                    }
                ],
                [
                    'attribute' => 'fio',
                    'format'    => 'html',
//                    'value' => function ($model) {
//                        return  \app\models\Application::$nominations[$model['nomination']];
//                    },
                    'visible'   => (Yii::$app->user->identity->role == Users::ROLE_ADMIN || Yii::$app->user->identity->role == Users::ROLE_EXPERT)?true:false,
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('fio')];
                    }
                ],
                [
                    'attribute' => 'nomination',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return  \app\models\Application::$nominations[$model['nomination']];
                    },
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('nomination')];
                    }
                ],
                [
                    'attribute' => 'sum_appraisal',
                    'format'    => 'html',
                    'content' => function ($model) {
                        $result = null;

                        if((int)$model['sum_appraisal'] > 0)
                        {
                            $result = '<a href="/work/see-results?id='.$model['id'].'" target="_blank">'.$model['sum_appraisal'].'</a>';
                        }
                        else
                        {
                            $result = '<span class="not-set">(не задано)</span>';
                        }
                        return $result;
                    },
                    'visible'   => (Yii::$app->user->identity->role == Users::ROLE_ADMIN || Yii::$app->user->identity->role == Users::ROLE_EXPERT)?true:false,
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('sum_appraisal')];
                    }
                ],
                [
                    'attribute' => 'experts',
                    'header' => 'Эксперты',
                    'content' => function ($model) {
                        $result = null;

                        $appoint_expert = \app\models\AppointExpert::find()->where(['application_id'=>$model['id']])->all();
                        if(!empty($appoint_expert))
                        {
                            foreach ($appoint_expert as $appoint_expert_val)
                            {
                               $user = Users::find()->where(['id'=>$appoint_expert_val['expert_id']])->one();

                               if(!is_null($user))
                               {
                                   $result .= $user['second_name'].' '.$user['first_name'].' '.$user['third_name'].'<br/>';
                               }

                            }
                        }

                        return $result;
                    },
                    'visible'   => (Yii::$app->user->identity->role == Users::ROLE_ADMIN || Yii::$app->user->identity->role == Users::ROLE_EXPERT)?true:false,
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('experts')];
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update-work} {appoint-work} {evaluate-work}',
                    'visibleButtons' => [
                        'update-work' =>  (Yii::$app->user->identity->role == Users::ROLE_ADMIN || Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)?true:false,
                        'appoint-work' =>  Yii::$app->user->identity->role == Users::ROLE_ADMIN?true:false,
                        'evaluate-work' =>  (Yii::$app->user->identity->role == Users::ROLE_ADMIN || Yii::$app->user->identity->role == Users::ROLE_EXPERT)?true:false,
                    ],
                    'buttons' => [
                        'update-work' => function ($url,$model,$key) {

//                            $result = null;
                            if(Yii::$app->user->identity->role == Users::ROLE_PARTICIPANT)
                            {
                                $appoint_expert = \app\models\AppointExpert::find()->where(['application_id'=>$model['id']])->count();
                                if($appoint_expert > 0)
                                {
                                    return Html::a('Посмотреть', ['/work/update-work', 'nomination'=>$model['nomination'], 'id'=>$model['id']], ['class' => 'btn btn-info btn-xs']);
                                }
                            }
                            return Html::a('Редактировать', ['/work/update-work', 'nomination'=>$model['nomination'], 'id'=>$model['id']], ['class' => 'btn btn-success btn-xs']);
                        },
                        'appoint-work' => function ($url,$model,$key) {
                            return Html::a('Назначить', ['/work/appoint-work', 'id'=>$model['id']], ['class' => 'btn btn-warning btn-xs']);
                        },
                        'evaluate-work' => function ($url,$model,$key) {
                            return Html::a('Оценить', ['/work/evaluate-work', 'id'=>$model['id']], ['class' => 'btn btn-info btn-xs']);
                        },
                    ],
                ],
            ],
            'options' => [
                'style'=>'margin-top: 20px;'
            ],
            'pager' => [
                'firstPageLabel' => '««',
                'lastPageLabel'  => '»»'
            ],

        ]); ?>


    </div>
</div>


<?php echo Html::beginForm(['/work/add-work'],'get',['id'=>'form-add-work']);?>
    <?php
    Modal::begin([
        'header' => '<h2>Добавить работу на номинацию</h2>',
        'id'=> 'nomination-form',
//        'clientOptions' => ['show' => true],
    ]);
    ?>

    <label class="control-label">Выберите номинацию:</label>
    <?= Select2::widget([
        'name' => 'nomination',
        'id' => 'nomination-work',
        'data' => \app\models\Application::$nominations,
    ]);

    ?>

    <?= Html::hiddenInput('round',Yii::$app->getRequest()->get('round')); ?>

    <div class="box-footer text-right">
        <?= Html::Button( 'Добавить работу', ['class' => 'btn btn-primary button-add-work']) ?>
    </div>
<?php Modal::end(); ?>


<?php echo Html::endForm();?>

<?php if(Yii::$app->user->identity->role == Users::ROLE_ADMIN):?>
    <?php
    Modal::begin([
        'header' => '<h5>Группове назначение</h5>',
        'id'=> 'modal-form-group-assignment',
//        'clientOptions' => ['show' => true],
    ]);
    ?>

    <span class="filter-header-text">ФИО эксперта</span>
    <?=Html::dropDownList('expert_id', null, $expert_array, [
        'class'  => 'form-control selectpicker group-assignment-expert-id',
        'data' => [
            'live-search' => 'true',
            'size' => 10,
            'title' => 'Ничего не выбрано',
        ]
    ]);?>

    <div class="box-footer">
        <?= Html::Button('Назначить эксперта', ['class' => 'btn btn-primary modal-button-group-assignment']) ?>
    </div>
    <?php Modal::end(); ?>


    <?php
    Modal::begin([
        'header' => '<h5>Группове снятие эксперта</h5>',
        'id'=> 'modal-form-group-withdrawal',
//        'clientOptions' => ['show' => true],
    ]);
    ?>

    <span class="filter-header-text">ФИО эксперта</span>
    <?=Html::dropDownList('expert_id', null, $expert_array, [
        'class'  => 'form-control selectpicker group-withdrawal-expert-id',
        'data' => [
            'live-search' => 'true',
            'size' => 10,
            'title' => 'Ничего не выбрано',
        ]
    ]);?>

    <div class="box-footer">
        <?= Html::Button('Снять эксперта', ['class' => 'btn btn-primary modal-button-group-withdrawal']) ?>
    </div>
    <?php Modal::end(); ?>


    <?php
    Modal::begin([
        'header' => '<h5>Обработка работ</h5>',
        'id'=> 'modal-form-loading',
//        'clientOptions' => ['show' => true],
    ]);
    ?>
    <table>
        <tr>
            <td>
                <?= Html::img('/images/mosmetod/preloader.gif') ?>
            </td>
            <td>
                Подождите, пока работы обрабатываются.
            </td>
        </tr>
    </table>


    <?php Modal::end(); ?>
<?php endif;?>


<?php

$checking_questionnaire = \yii\helpers\Url::to(['/work/checking-questionnaire']);
$checking_nomination_work = \yii\helpers\Url::to(['/work/checking-nomination-work']);
$group_assignment_work = \yii\helpers\Url::to(['/work/group-assignment-work']);
$group_withdrawal_work = \yii\helpers\Url::to(['/work/group-withdrawal-work']);
$round = Yii::$app->getRequest()->get('round');

$script = <<< JS

    $(document).ready(function() {
        
        $('.modal-button-group-assignment').on('click',function() {
            
            
            let work_checked = $('input[name="selection[]"]:checked');
            
            if(work_checked.length > 0 && $('.group-assignment-expert-id  option:selected').val() != '')
            {
                $('#modal-form-group-assignment').modal('hide');
                $('#modal-form-loading').modal('show');
                
                
                
                var processSchema = function() {
                        let promises = [];
                        var def = new $.Deferred();
                        let i = 1;
                        for (let work_checked_item of work_checked) {
                            
                            $.ajax({
                                type: "GET",
                                url: "$group_assignment_work",
                                data: {
                                    work_id: $(work_checked_item).val(),
                                    expert_id: $('.group-assignment-expert-id  option:selected').val(),
                                },
                              success: function(data){
                                i += 1;
                                if(i > work_checked.length)
                                {
                                    def.resolve(1);
                                }
                                
                              },
                              error:function(msg) {
                                    i += 1;
                                alert(msg.responseText);
                                
                                if(i > work_checked.length)
                                {
                                    def.resolve(1);
                                }
                              }  
                            });
                            
                            promises.push(def);  
                            
                          }
                          
                          return $.when.apply(undefined, promises).promise();
                    };
                
                    let move_work_group_assignment =  processSchema();
                    
                    move_work_group_assignment.done(function() {
                        location.reload();
                    });
            }
            else 
            {
                if ($('.group-assignment-expert-id  option:selected').val() != '') 
                {
                    alert('Выберите эксперта');
                }
                else 
                {
                   alert('Вы должны выбрать хотя бы одину работу'); 
                }
            }
        });
        
        $('.modal-button-group-withdrawal').on('click',function() {
            
            let work_checked = $('input[name="selection[]"]:checked');
            
            if(work_checked.length > 0 && $('.group-withdrawal-expert-id  option:selected').val() != '')
            {
                $('#modal-form-group-withdrawal').modal('hide');
                $('#modal-form-loading').modal('show');
                
                
                var processSchema = function() {
                        let promises = [];
                        var def = new $.Deferred();
                        let i = 1;
                        for (let work_checked_item of work_checked) {
                            
                            $.ajax({
                                type: "GET",
                                url: "$group_withdrawal_work",
                                data: {
                                    work_id: $(work_checked_item).val(),
                                    expert_id: $('.group-withdrawal-expert-id  option:selected').val(),
                                },
                              success: function(data){
                                i += 1;
                                if(i > work_checked.length)
                                {
                                    def.resolve(1);
                                }
                                
                              },
                              error:function(msg) {
                                    i += 1;
                                alert(msg.responseText);
                                
                                if(i > work_checked.length)
                                {
                                    def.resolve(1);
                                }
                              }  
                            });
                            
                            promises.push(def);  
                            
                          }
                          
                          return $.when.apply(undefined, promises).promise();
                    };
                
                    let move_work_group_withdrawal =  processSchema();
                    
                    move_work_group_withdrawal.done(function() {
                        location.reload();
                    });
            }
            else 
            {
                if ($('.group-withdrawal-expert-id  option:selected').val() != '') 
                {
                    alert('Выберите эксперта');
                }
                else 
                {
                   alert('Вы должны выбрать хотя бы одину работу');  
                }
            }
            
        });
        
        $('.group-assignment').on('click',function() 
        {
            if($('input[name="selection[]"]:checked').length > 0)
            {
                $('#modal-form-group-assignment').modal('show');
            }
            else
            {
                alert('Отметьте хотя бы одину работу');
            }
        });
        
        $('.group-withdrawal').on('click',function() 
        {
            if($('input[name="selection[]"]:checked').length > 0)
            {
                $('#modal-form-group-withdrawal').modal('show');
            }
            else
            {
                alert('Отметьте хотя бы одину работу');
            }
        });
        
        $('.add-work').on('click',function() {
            $.ajax({
            type: "GET",
            url: "$checking_questionnaire",
            success: function(data){
                if(data == '1')
                {
                    $('#nomination-form').modal('show');
                }
                else
                {
                  alert('Чтобы добавить работу, нужно заполнить свою анкету');
                }
                
              },
            error:function(msg) {
              alert(msg.responseText);
              }
        });  
        });
        
        $('.button-add-work').on('click',function() {
            $.ajax({
            type: "GET",
            url: "$checking_nomination_work",
            data:{
                nomination:$('#nomination-work').val(),
                round:'$round',
            },
            success: function(data){
                if(data == '1')
                {
                    $('#form-add-work').submit();
                }
                else
                {
                  alert(data);
                }
              },
            error:function(msg) {
              alert(msg.responseText);
              }
        });  
        });
   }); 

JS;

$this->registerJs($script, yii\web\View::POS_END);
?>






