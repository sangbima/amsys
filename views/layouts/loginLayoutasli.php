<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
// use app\assets\AppAsset;
use app\assets\LoginAsset;

// AppAsset::register($this);
LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body id="loginpage">
<?php $this->beginBody() ?>
<nav class="navbar navbar-static-top">
  <div class="container-fluid hidden-xs hidden-sm">
    <ul id="sosmed" class="nav navbar-nav navbar-right">
      <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
      <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
      <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
      <li><a href="#"><i class="fa fa-youtube-square"></i></a></li>
    </ul>
    </div>
</nav>

<div class="row">
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">


      <?= $content ?>


  </div><!-- /.col-->
</div><!-- /.row -->
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
