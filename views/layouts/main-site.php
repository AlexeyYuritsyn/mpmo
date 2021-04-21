<?php

use app\assets\AppAssetSite;

AppAssetSite::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="образование, городской методический центр, методический центр, москва, методцентр, мосметод, гмц">
    <meta name="description" content="Портал методической помощи">
    <meta property="og:image" content="https://mpmo.mosmetod.ru/images/logo/young_pedagog_logo.png" />
    <meta property="og:image:secure_url" content="https://mpmo.mosmetod.ru/images/logo/young_pedagog_logo.png" />
    <meta property="og:image:type" content="image/png" />
    <?php $this->registerCsrfMetaTags() ?>
    <title>Молодые педагоги — московскому образованию</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div id="root"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
