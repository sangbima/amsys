<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\editable\Editable;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KomoditasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Varietas Bawang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('<i class="fa fa-plus"></i> Varietas', ['create'], ['class' => 'btn btn-success']) ?>
        <?php
        if((Mimin::checkRoute($this->context->id.'/create'))) { 
          echo Html::button('<i class="fa fa-plus"></i> Varietas', ['value' => Url::to(['komoditas/create'], true),'class' => 'btn btn-success', 'id' => 'modalButton']);
        }
        ?>
    </p>
    <?php
      Modal::begin([
        'header' => '<h4><i class="fa fa-plus"></i> Varietas</h4>',
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
            'id' => 'varietasGrid',
          ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
              'class' => 'kartik\grid\EditableColumn',
              'attribute' => 'nama',
              'editableOptions' => [
                'header'=>'Status',
                'formOptions' => ['action' => ['/komoditas/updateInline']],
              ],
            ],
            [
              'class' => 'kartik\grid\EditableColumn',
              'attribute' => 'keterangan',
              'editableOptions' => [
                'header'=>'Status',
                'inputType' => Editable::INPUT_TEXTAREA,
                'formOptions' => ['action' => ['/komoditas/updateInline']],
              ],
            ],

            [
              'class' => 'yii\grid\ActionColumn',
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
