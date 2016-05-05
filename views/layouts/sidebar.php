<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <form role="search">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Search">
    </div>
  </form>
  <?php
    echo \yii\widgets\Menu::widget([
      'items' => [
        [
          'label' => 'Dashboard',
          'url' => ['site/index'],
          'template' => '<a href="{url}"><i class="fa fa-dashboard" style="color:#30A5FF"></i> {label}</a>'
        ],
        [
          'label' => 'Lokasi',
          'url' => ['lokasi/index'],
          'template'=> '<a href="{url}"><i class="fa fa-flag" style="color:#FCB33D"></i> {label}</a>'
        ],
        [
          'label' => 'Petani',
          'url' => ['petani/index'],
          'template' => '<a href="{url}"><i class="fa fa-group" style="color:#90ED7D"></i> {label}</a>',
        ],
        [
          'label' => 'Lahan',
          'url' => ['lahan/index'],
          'template' => '<a href="{url}"><i class="fa fa-gears" style="color:#ed1201"></i> {label}</a>',
        ],
        [
          'label' => 'Varietas',
          'url' => ['komoditas/index'],
          'template' => '<a href="{url}"><i class="fa fa-line-chart" style="color:#fdf9b2"></i> {label}</a>',
        ],
        [
          'label' => 'Produksi',
          'url' => ['produksi/index'],
          'template' => '<a href="{url}"><i class="fa fa-archive" style="color:#FFF"></i> {label}</a>',
        ],
        [
          'label' => 'Users',
          'url' => ['user/index'],
          'template' => '<a href="{url}"><i class="fa fa-user" style="color:#30A5FF"></i> {label}</a>',
        ],
        [
          'label' => 'Acuan Harga',
          'url' => ['acuan-harga/index'],
          'template' => '<a href="{url}"><i class="fa fa-dollar" style="color:#0030F1"></i> {label}</a>',
        ],
        [
          'label' => 'Formulir',
          'url' => ['formulir/index'],
          'template' => '<a href="{url}"><i class="fa fa-print" style="color:#DD30F1"></i> {label}</a>',
        ],
      ],
      'options' => [
        'class' => 'nav menu'
      ],
      'activeCssClass'=>'active',
    ]);
  ?>

</div><!--/.sidebar-->
