<?php
use yii\helpers\Html;

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?=Html::img('@web/images/bgr32.png',  $options = ['style'=>'margin-top:-5px; float:left; margin-right:5px'])?><span>AM</span>SYS</a>
      <ul class="user-menu">
        <li class="dropdown pull-right">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?= Yii::$app->user->identity->username; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><?=Html::a('<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile', ['site/index'], ['data-method'=>'post']) ?></li>
            <li><?=Html::a('<svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings', ['site/index'], ['data-method'=>'post']) ?></li>
            <li><?=Html::a('<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout', ['site/logout'], ['data-method'=>'post']) ?></li>
          </ul>
        </li>
      </ul>
    </div>

  </div><!-- /.container-fluid -->
</nav>
