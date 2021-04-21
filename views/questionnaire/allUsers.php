<?php
use yii\grid\GridView;
use yii\helpers\Html;

use phpnt\bootstrapSelect\BootstrapSelectAsset;
BootstrapSelectAsset::register($this);


?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title ">Пользователи</h3>
        <div class="box-tools pull-right">
            <?php echo Html::beginForm(['/questionnaire/add-user'],'get');?>
            <?php if(Yii::$app->user->identity->role == \app\models\Users::ROLE_ADMIN):?>
                <?= Html::submitButton( 'Добавить пользователя', ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
            <?php echo Html::endForm();?>
        </div>
    </div>
    <div class="box-body">
        <?php echo Html::beginForm(['/questionnaire/all-users'],'get');?>
        <div class="filter-wrapper">

            <div class="filter-block school-filter-block">
                <span class="filter-header-text">ФИО пользователя или Email</span>
                <?=Html::dropDownList('user_id', Yii::$app->getRequest()->get('user_id'), $users_array, [
                    'class'  => 'form-control selectpicker',
                    'data' => [
                        'live-search' => 'true',
                        'size' => 10,
                        'title' => 'Ничего не выбрано',
                    ]
                ]);?>
            </div>


            <div class="filter-block school-filter-block">
                <span class="filter-header-text">Основная роль</span>
                <?=Html::dropDownList('role', Yii::$app->getRequest()->get('role'), \app\models\Users::$roles, [
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
                <?= Html::a('Сброс', ['/questionnaire/all-users'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php echo Html::endForm();?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'fio',
                    'format'    => 'html',
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('fio')];
                    }
                ],
                [
                    'attribute' => 'email',
                    'format'    => 'html',
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('email')];
                    }
                ],
                [
                    'attribute' => 'role',
                    'value'     => function($model){
                        return \app\models\Users::$roles[$model['role']];
                    },
                    'contentOptions' => function ($model) {
                        return ['aria-label' => $model->getAttributeLabel('role')];
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{updateform}',
                    'visibleButtons' => [
                        'updateform' =>  true,
                    ],
                    'buttons' => [
                        'updateform' => function ($url,$model,$key) {
                            return Html::a('Редактировать', ['/questionnaire/update-user', 'id'=>$model['id']], ['class' => 'btn btn-success btn-xs']);
                        }
                    ],
                ],
            ],

        ]); ?>
    </div>
</div>






