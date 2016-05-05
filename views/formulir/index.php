<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;


$this->title = 'Data Formulir Antar Hasil Panen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">
      <h3><i class="fa fa-file"></i> <?= Html::encode($this->title) ?></h3>

      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'pjax' => false,
          'pjaxSettings' => [
            'options' => [
              'id' => 'acuanHargaGrid',
            ]
          ],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              'no_proposal',
              [
                'attribute'=>'lahan_id',
                'label' => 'Pemilik Lahan',
                'value' => 'petani.nama'
              ],
              [
                'attribute' => 'komoditas_kode',
                'label' => 'Varietas',
                'value' => 'komoditasKode.nama'
              ],
              'tgl_panen',
              'est_bobot_panen',
              [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{print-pdf}',
                'buttons' => [
                  'print-pdf' => function($url, $model){
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', $url);
                  },
                ]
              ],
          ],
      ]); ?>
</div>
</div>
