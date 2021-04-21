<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php

$script1 = <<< JS
JS;
$this->registerJs($script1, yii\web\View::POS_END);
?>
