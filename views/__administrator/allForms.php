<?php
use yii\grid\GridView;
use yii\helpers\Html;

use yii\helpers\StringHelper;
//use app\models\MuseumSchedule;
//$this->title = 'Музеи'; addaddress

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title ">Формы</h3>
        <div class="box-tools pull-right">
            <?php echo Html::beginForm(['/administrator/addform'],'get');?>
            <?php if(Yii::$app->user->identity->role == \app\models\Users::ROLE_ADMIN):?>
                <?= Html::submitButton( 'Добавить форму', ['class' => 'btn btn-primary']) ?>
             <?php endif;?>
            <?php echo Html::endForm();?>
        </div>
    </div>
    <div class="box-body">

    </div>
</div>






