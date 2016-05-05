<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Lahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
              'attribute' => 'petani_id',
              'label' => 'Pemilik Lahan',
              'value' => 'petani.nama'
            ],
            [
              'attribute' => 'lokasi_kode',
              'label' => 'Lokasi',
              'value' => 'lokasiKode.nama'
            ],
            'luas_m2',
            [
              'attribute' => 'status',
              'headerOptions' => ['width' => '80'],
              'label' => 'Status',
              'filter' => app\models\Lahan::get_status(),
              'content' => function($data){
                return $data->status_style($data->status);
              }
            ],
            // 'keterangan',
            // 'user_id',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
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
