<?php
use yii\bootstrap\Tabs;
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Анкета</h3>
    </div>
    <div class="box-body">
        <?php

        echo Tabs::widget([
            'options' =>[], //'class' => 'gkTabsNav','style'=>'width:80%;'
            'items' => [
                [
                    'label' => 'Анкета',
                    'linkOptions' => ['class'=>'gkTabs-1'],
                    'content' => $this->render('_basic_information_user',['model'=>$model,'ous_array'  => $ous_array, 'widget_logo_remove'  => $widget_logo_remove]),
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