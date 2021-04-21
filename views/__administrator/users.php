<?php
use yii\grid\GridView;
use yii\helpers\Html;

use yii\helpers\StringHelper;
//use app\models\MuseumSchedule;
//$this->title = 'Музеи'; addaddress

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title ">Пользователи</h3>
        <div class="box-tools pull-right">
            <?php echo Html::beginForm(['/administrator/add-user'],'get');?>
            <?php if(Yii::$app->user->identity->role == \app\models\Users::ROLE_ADMIN):?>
                <?= Html::submitButton( 'Добавить пользователя', ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
            <?php echo Html::endForm();?>
        </div>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'fio',
                    'format'    => 'html',
                ],
                [
                    'attribute' => 'email',
                    'format'    => 'html',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{updateform}',
                    'visibleButtons' => [
                        'updateform' =>  true,
                    ],
                    'buttons' => [
                        'updateform' => function ($url,$model,$key) {
                            return Html::a('Редактировать', ['/administrator/update-user', 'id'=>$model['id']], ['class' => 'btn btn-success btn-xs']);
                        }
                    ],
                ],
            ],

        ]); ?>
    </div>
</div>






