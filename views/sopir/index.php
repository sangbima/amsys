<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SopirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sopir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('<i class="fa fa-plus"></i> Sopir', ['create'], ['class' => 'btn btn-success']) ?>
        <?=Html::button('<i class="fa fa-plus"></i> Sopir', ['value' => Url::to(['sopir/create'], true),'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <?php
      Modal::begin([
        'header' => '<h4><i class="fa fa-plus"></i> Sopir</h4>',
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
                'id' => 'sopirGrid',
              ]
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                  'class'=>'kartik\grid\EditableColumn',
                  'attribute' => 'nama',
                  'editableOptions' => [
                    'header'=>'Nama',
                    'formOptions' => ['action' => ['/sopir/updateInline']],
                  ],
                ],
                [
                  'class'=>'kartik\grid\EditableColumn',
                  'attribute' => 'no_sim',
                  'editableOptions' => [
                    'header'=>'SIM',
                    'formOptions' => ['action' => ['/sopir/updateInline']],
                  ],
                ],
                [
                  'class'=>'kartik\grid\EditableColumn',
                  'attribute' => 'alamat',
                  'editableOptions' => [
                    'header'=>'Alamat',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => ['/sopir/updateInline']],
                  ],
                ],

                [
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' => ['width' => '80'],
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
