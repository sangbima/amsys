<?php

/* @var $this yii\web\View */

$this->title = 'AMSYS::Dashboard';
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
?>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header" style="margin:15px 10px 10px 0px">Dashboard</h3>
  </div>
</div><!--/.row-->

<div class="row">
  <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-blue panel-widget ">
      <div class="row no-padding">
        <div class="col-sm-3 col-lg-5 widget-left">
          <?=Html::img('@web/images/petani72.png',  $options = ['style'=>'margin-top:-10px;'])?>
        </div>
        <div class="col-sm-9 col-lg-7 widget-right">
          <div class="large"><?= $modelPetani." <span style='font-size:16px'>Orang</span>"; ?></div>
          <div class="text-muted">Petani </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-orange panel-widget">
      <div class="row no-padding">
        <div class="col-sm-3 col-lg-5 widget-left">
          <?=Html::img('@web/images/area92.png',  $options = ['style'=>'margin-top:-22px;'])?>
          <?php
            $luasLahan = 0;
            foreach ($modelLahan as $modelLahan) {
              $luasLahan += $modelLahan->luas_m2;
            }

            $luasLahan = $luasLahan/1000;
            $luasLahan = number_format($luasLahan,2,",",".");
          ?>
        </div>
        <div class="col-sm-9 col-lg-7 widget-right">
          <div class="large"><?= $luasLahan." <span style='font-size:16px'>H.</span>" ?></div>
          <div class="text-muted">Lahan</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-grey panel-widget">
      <div class="row no-padding">
        <div class="col-sm-3 col-lg-5 widget-left">
          <?=Html::img('@web/images/redon96.png',  $options = ['style'=>'margin-top:-20px;'])?>
          <?php $jumlahEstimasi = 0;
            foreach ($modelEstimasi as $modelEstimasi) {
              $jumlahEstimasi += $modelEstimasi->est_bobot_panen;
            }
            $jumlahEstimasi = $jumlahEstimasi/1000;
            $jumlahEstimasi = number_format($jumlahEstimasi,2,",",".");
          ?>
        </div>
        <div class="col-sm-9 col-lg-7 widget-right">
          <div class="large"><?= $jumlahEstimasi."<span style='font-size:16px'> T.</span>"; ?></div>
          <div class="text-muted">Estimasi Panen</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-white panel-widget">
      <div class="row no-padding">
        <div class="col-sm-3 col-lg-5 widget-left">
          <?=Html::img('@web/images/redon96.png',  $options = ['style'=>'margin-top:-20px;'])?>
          <?php $jumlahProduksi = 0;
            foreach ($modelProduksi as $modelProduksi) {
              $jumlahProduksi += $modelProduksi->bobot_panen_kotor;
            }
          ?>
        </div>
        <div class="col-sm-9 col-lg-7 widget-right">
          <div class="large"><?= $jumlahProduksi. "<span style='font-size:16px'> T.</span>"; ?></div>
          <div class="text-muted">Total Produksi</div>
        </div>
      </div>
    </div>
  </div>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Pantauan Harga Bawang</div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'line'
                  ],
                  'credits'=>[
                  'enabled'=>false
                  ],
                  'title' => ['text' => 'Harga Bawang di 5 Pasar Tradisional Dalam 1 Bulan'],
                  'xAxis' => [
                     'categories' => $dataX
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Harga Dalam Rupiah']
                  ],
                  
                   'series' => $modelNama
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'column'
                  ],
                  'credits' =>[
                    'enabled' =>false
                    ],
                  'title' => ['text' => 'Grafik Jumlah Petani Bawang Pada Setiap Kecamatan'],
                  'xAxis' => [
                     'categories' => ['']
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Jumlah Petani']
                  ],
                   'series' => $graphOk
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div><!--/.row-->


<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <div class="canvas-wrapper">
          <?php
              echo Highcharts::widget([
               'options' => [
                   'chart'=> [
                      'type'=> 'column'
                  ],
                  'credits' =>[
                    'enabled' =>false
                    ],
                  'title' => ['text' => 'Grafik Jumlah Luas Lahan Bawang Pada Setiap Kecamatan'],
                  'xAxis' => [
                     'categories' => ['']
                  ],
                  'yAxis' => [
                     'title' => ['text' => 'Luas Lahan Dalam Hekar']
                  ],
                   'series' => $graphLahanOk
               ]
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div><!--/.row-->


<?php
$script = <<< JS
/*// $('#calendar').datepicker({
// });
*/
!function ($) {
    $(document).on("click","ul.nav li.parent > a > span.icon", function(){
        $(this).find('em:first').toggleClass("glyphicon-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})
JS;
$this->registerJs($script);
?>
