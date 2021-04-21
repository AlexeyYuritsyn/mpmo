<?php
use yii\bootstrap\Tabs;

?>

<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Профиль</h3>
    </div>
    <div class="box-body">
        <?php

        echo Tabs::widget([
            'options' =>[], //'class' => 'gkTabsNav','style'=>'width:80%;'
            'items' => [
                [
                    'label' => 'Основная информация',
                    'linkOptions' => ['class'=>'gkTabs-1'],
                    'content' => $this->render('_basic_information_user',['model'=>$model]),
                    'active' => !isset($no_validate)
                ],
                [
                    'label' => 'Входные данные',
                    'linkOptions' => ['class'=>'gkTabs-2'],
                    'content' => $this->render('_change_password_user',['model'=>$model]),
                    'active' => isset($no_validate)
                ],
            ],
        ]);
        ?>
    </div>
</div>