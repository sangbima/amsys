<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProduksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produksi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><i class="fa fa-cubes"></i> <?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('<i class="fa fa-plus"></i> Produksi', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
        if ((Mimin::checkRoute($this->context->id.'/create'))){
          echo Html::button('<i class="fa fa-plus"></i> Produksi', ['value' => Url::to(['produksi/create'], true),'class' => 'btn btn-success', 'id' => 'modalButton']);
        }
        ?>
    </p>
    <?php
      Modal::begin([
        'header' => '<h4><i class="fa fa-plus"></i> Produksi</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-lg'
      ]);

      echo '<div id="modalContent"></div>';
      Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings' => [
          'options' => [
            'id' => 'produksiGrid',
          ]
        ],
        'columns' => [
            'no_proposal',
            [
              'attribute'=>'lahan_id',
              'label' => 'Pemilik Lahan',
              'value' => 'lahan.petani.nama'
            ],
            [
              'attribute' => 'komoditas_kode',
              'label' => 'Varietas',
              'value' => 'komoditasKode.nama'
            ],
            [
              'attribute'=>'tgl_tanam',
              'value' => 'tgl_tanam',
              'format' => 'raw',
              'filter' => DatePicker::widget([
                  'name' => 'ProduksiSearch[tgl_tanam]',
                  'type' => DatePicker::TYPE_INPUT,
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd'
                  ]
              ])
            ],
            [
              'attribute'=>'tgl_panen',
              'value' => 'tgl_panen',
              'format' => 'raw',
              'filter' => DatePicker::widget([
                  'name' => 'ProduksiSearch[tgl_panen]',
                  'type' => DatePicker::TYPE_INPUT,
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd'
                  ]
              ])
            ],
            'est_bobot_panen',
            // 'bobot_panen_kotor',
            'harga_panen',
            [
              'class'=>'kartik\grid\EditableColumn',
              'attribute' => 'status',
              'headerOptions' => ['width' => '80'],
              'label' => 'Status',
              'filter' => app\models\Produksi::get_status(),
              'content' => function($data){
                return $data->status_style($data->status);
              },
              'editableOptions' => [
                'header'=>'Status',
                'inputType'=>Editable::INPUT_SELECT2,
                'formOptions' => ['action' => ['/produksi/updateInline']],
                'options' => [
                  'data'=>app\models\Produksi::get_status(),
                ]
              ],
            ],
            // 'user_id',
            // 'created',
            // 'updated',

            // [
            //   'class' => 'yii\grid\ActionColumn',
            //   'headerOptions' => ['width' => '80'],
            // ],
            [
              'class' => 'yii\grid\ActionColumn',
              'headerOptions' => ['width' => '80'],
              'contentOptions' => ['style' => 'width: 10%'],
              'template' => Mimin::filterActionColumn([
                'view', 'update', 'delete'
              ], $this->context->route),
              'buttons' => [
                'view'=>function ($url, $model) {
                  return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value'=>$url, 'class' => 'btn btn-default btn-xs btnViewModal']);
                },
                'update'=>function ($url, $model) {
                  return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value'=>$url, 'class' => 'btn btn-info btn-xs btnUpdateModal']);
                },
                'delete' => function($url, $model){
                  return Html::a(
                    '<span class="glyphicon glyphicon-trash"></span>', $url, [
                      'class' => 'btn btn-danger btn-xs',
                      'data-method' => 'post',
                      'data-confirm' => 'Are you sure you want to delete this item?',
                    ]
                  );
                }
              ]
            ],
        ],
    ]); ?>
</div>
</div>
<?php
  Modal::begin([
    'header' => '<h4><i class="fa fa-bars"></i> Detail</h4>',
    'id' => 'modalView',
    'size' => 'modal-md'
  ]);

  echo '<div id="modalDetail"></div>';
  Modal::end();

  Modal::begin([
    'header' => '<h4><i class="fa fa-edit"></i> Ubah</h4>',
    'id' => 'modalUpdate',
    'size' => 'modal-lg'
  ]);

  echo '<div id="modalEdit"></div>';
  Modal::end();
?>
<?php
$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip();

  $('#modalButton').click(function(){
    $('#modalCreate').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  });

  $('.btnViewModal').click(function(){
    $('#modalView').modal('show').find('#modalDetail').load($(this).attr('value'));
  });

  $('.btnUpdateModal').click(function(){
    $('#modalUpdate').modal('show').find('#modalEdit').load($(this).attr('value'));
  });
});
JS;
$this->registerJs($js);
?>
