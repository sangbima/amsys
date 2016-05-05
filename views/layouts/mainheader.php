<?php
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use yii\helpers\Url;
?>
<?php

NavBar::begin([
    'brandLabel' => '<span>AM</span>SYS',
    'brandUrl' => Yii::$app->homeUrl,
    'innerContainerOptions' => ['class'=>'container-fluid'],
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top',
    ],
]);

    if(!Yii::$app->user->isGuest) {
      echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'encodeLabels' => false,
        'items' => [
          [
            'label' => '<i class="fa fa-home" style="color:#30A5FF"></i> Dashboard', 'url' => ['site/index'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            
          ],
          [
            'label' => '<i class="fa fa-scissors" style="color:#FFB53E"></i> Tebasan', 'url' => ['#'],
            'template' => '<a href="{url}" class="href_class">{label}</a>',
            'items' => [
              ['label' => '<i class="fa fa-cubes" style="color:#fdf9b2"></i> Produksi', 'url' => ['produksi/index']],
              ['label' => '<i class="fa fa-file-o" style="color:#fdf9b2"></i> Formulir Antar', 'url' => ['formulir/index']],
            ]
          ],
          ['label' => '<i class="fa fa-bar-chart" style="color:#ef2222"></i> Transaksi', 'url' => ['#']],
          [
            'label' => '<i class="fa fa-file" style="color:#2ded14"></i> Laporan', 'url' => ['#'],
            'items' => [
              ['label' => '<i class="fa fa-map-marker" style="color:#ef2222"></i> Peta Luas Lahan', 'url' => ['map/lokasi']],
              ['label' => '<i class="fa fa-map-marker" style="color:#ef2222"></i> Peta Harga Pasar', 'url' => ['map/info-harga']]
            ]
          ],
          [
            'label' => '<i class="fa fa-database" style="color:#fff"></i> Master Data', 'url' => ['#'],
            'items' => [
              ['label' => '<i class="fa fa-map-pin" style="color:#FFB53E"></i> Lokasi', 'url' => ['lokasi/index']],
              ['label' => '<i class="fa fa-user" style="color:#FFB53E"></i> Petani', 'url' => ['petani/index']],
              ['label' => '<i class="fa fa-map" style="color:#FFB53E"></i> Lahan', 'url' => ['lahan/index']],
              ['label' => '<i class="fa fa-tree" style="color:#FFB53E"></i> Varietas', 'url' => ['komoditas/index']],
              // '<li role="separator" class="divider"></li>',
              ['label' => '<i class="fa fa-map-o" style="color:#FFB53E"></i> Lapak', 'url' => ['lapak/index']],
              // '<li role="separator" class="divider"></li>',
              ['label' => '<i class="fa fa-truck" style="color:#FFB53E"></i> Armada', 'url' => ['armada/index']],
              ['label' => '<i class="fa fa-user" style="color:#FFB53E"></i> Sopir', 'url' => ['sopir/index']],
            ]
          ],
          [
            'label' => '<i class="fa fa-gear" style="color:#fdf9b2"></i> Konfigurasi', 'url' => ['#'],
            'items' => [
              ['label' => '<i class="fa fa-user" style="color:#ef2222"></i> Users', 'url' => ['user/index']],
            ]
          ],
        ],
        'activateParents'=>true,
      ]);

      // echo '<form class="navbar-form navbar-left" role="search">
      //   <div class="form-group">
      //     <input type="text" class="form-control" placeholder="Search">
      //   </div>
      // </form>';

      echo Nav::widget([
          'options' => ['class' => 'user-menu navbar-nav navbar-right'],
          'encodeLabels' => false,
          'items' => [
              [
                // 'label' => '<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.Yii::$app->user->identity->username.'', 'url' => ['#'],
              'label' => '<i class="fa fa-user"></i> '.Yii::$app->user->identity->username.'', 'url' => ['#'],
                'items' => [
                  ['label' => '<i class="fa fa-user"></i> Profile', 'url' => ['#']],
                  ['label' => '<i class="fa fa-gear"></i>  Settings', 'url' => ['#']],
                 
                  '<li>'
                      . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                      . Html::submitButton('<i class="fa fa-power-off"></i> Logout', ['class' => 'btn btn-danger'])
                      . Html::endform() .
                  '</li>',
                ],
              ],
          ],
      ]);

    }
Navbar::end();
?>
