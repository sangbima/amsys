<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcuanHargaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acuan Harga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acuan-harga-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('<i class="fa fa-plus"></i> Acuan Harga', ['create'], ['class' => 'btn btn-success']) ?>
        <?=Html::button('<i class="fa fa-plus"></i> Acuan Harga', ['value' => Url::to(['acuan-harga/create'], true),'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <?php
      Modal::begin([
        'header' => '<h4><i class="fa fa-plus"></i> Acuan Harga</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-md'
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
            'id' => 'acuanHargaGrid',
          ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute' => 'komoditas_kode',
              'label' => 'Nama Komoditas',
              'value' => 'komoditasKode.nama'
            ],
            [
              'class' => 'kartik\grid\EditableColumn',
              'attribute'=>'harga',
              'value'=>'harga'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'contentOptions' => ['style' => 'width: 10%'],
              'template' => '{view} {update} {delete}',
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
    'size' => 'modal-md'
  ]);

  echo '<div id="modalEdit"></div>';
  Modal::end();
?>


<?php
$scCreate = <<< JS
$(function(){
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
$this->registerJs($scCreate);
?>
