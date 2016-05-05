<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use kartik\editable\Editable;

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
        <?= Html::a('<i class="fa fa-plus"></i> Produksi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'formOptions' => ['action' => ['/produksi/update']],
                'options' => [
                  'data'=>app\models\Produksi::get_status(),
                ]
              ],
            ],
            // 'user_id',
            // 'created',
            // 'updated',

            [
              'class' => 'yii\grid\ActionColumn',
              'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
</div>
<?php
$js = <<< JS
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
JS;
$this->registerJs($js);
?>
