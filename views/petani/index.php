<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetaniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petani';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><i class="fa fa-user"></i> <?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Petani', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_ktp',
            'nama',
            'alamat',
            [
              'attribute' => 'lokasi_kode',
              'label' => 'Lokasi',
              'value' => 'lokasiKode.nama'
            ],
            [
              'attribute' => 'status',
              'headerOptions' => ['width' => '80'],
              'label' => 'Status',
              'filter' => app\models\Petani::get_status(),
              'content' => function($data){
                return $data->status_style($data->status);
              }
            ],

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
