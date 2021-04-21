<?php
use scotthuangzl\googlechart\GoogleChart;
use yii\helpers\Html;

?>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$form['name']?></h3>
            <div class="box-tools pull-right">
                <?php echo Html::beginForm(['/administrator/export-excel-file','id'=>Yii::$app->getRequest()->get('id')],'get');?>
                    <?= Html::submitButton( 'Выгрузить отчет', ['class' => 'btn btn-primary']) ?>
                <?php echo Html::endForm();?>
            </div>
        </div>
        <div class="box-body">

            <?php if(isset($result_count)):?>
                <?php foreach($result_count as $key_rc=>$val_rc):?>

                    <span>
                        <?php
                        $ChartArray = array(
                            array('Task', 'Hours per Day')
                        );

                        foreach($val_rc as $rc_key=>$rc_value)
                        {
                            $ChartArray[] = [(string)$rc_key,$rc_value];
                        }

                        echo GoogleChart::widget(array('visualization' => 'PieChart',
                            'data' => $ChartArray,
                            'options' => array(
                                'title' => $questions_form_lable[$key_rc],
                                'height' => 450,
                            )));
                        ?>
                    </span>

                <?php endforeach;?>
            <?php endif;?>

        </div>
    </div>
