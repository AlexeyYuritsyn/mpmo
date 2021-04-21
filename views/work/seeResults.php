<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Application;
use kartik\select2\Select2;
use yii\helpers\Url;
//var_dump($model['role_methodist']);
//var_dump($users_array);
//die;

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Оценочный табель</h3>
        <div class="box-tools pull-right">
            <?= Html::a( 'К общему список',['work/come-back'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="box-body">

        <p><label class="control-label">Работу выполнил: </label> <?=$user['second_name']?> <?=$user['first_name']?> <?=$user['third_name']?></p>
        <p><label class="control-label">Номинация: </label> <?=Application::$nominations[$model['nomination']];?></p>
        <br><br><br>


        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "<div>{items}</div><div class='not-css-in-pager'>{pager}</div>",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item_see_results',['model' => $model]);
            },
//            'pager' => [
//                'prevPageLabel' => '<<',
//                'nextPageLabel' => '>>',
//                'maxButtonCount' => 5,
//
////                    // Customzing options for pager container tag
//                'options' => [
//                    'tag' => 'lu',
//                    'class' => 'pagination',
//                ],
//            ],
        ]);
        ?>

    </div>

</div>
