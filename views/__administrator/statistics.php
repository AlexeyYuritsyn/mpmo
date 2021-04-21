<?php
use yii\grid\GridView;
use yii\helpers\Html;

use yii\helpers\StringHelper;
//use app\models\MuseumSchedule;
//$this->title = 'Музеи'; addaddress

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title ">Статистика</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'format'    => 'html',
                ],
                [
                    'attribute' => 'email',
                    'format'    => 'html',
                ],
                [
                    'attribute' => 'subject_email',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return StringHelper::truncate($model->subject_email, 50);
                    }
                ],
                [
                    'attribute' => 'count_send_forms',
                    'format'    => 'html'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{viewform} {reportform}',
                    'visibleButtons' => [
                        'viewform' =>  true,
                        'reportform' =>  true,
                    ],
                    'buttons' => [
                        'viewform' => function ($url,$model,$key) {
                            return Html::a('Посмотреть', ['/administrator/show-statistics-form', 'id'=>$model['id']], ['class' => 'btn btn-primary btn-xs']);
                        },
                        'reportform' => function ($url,$model,$key) {
                            return Html::a('Отчет', ['/administrator/export-excel-file', 'id'=>$model['id']], ['class' => 'btn btn-success btn-xs']);
                        },
                    ],
                ],
            ],

        ]); ?>
    </div>
</div>






