<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LapakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lapak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="box-body">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if((Mimin::checkRoute($this->context->id.'/create'))) {
          echo Html::a('<i class="fa fa-plus"></i> Lapak', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode',
            'penanggung_jawab',
            'alamat',
            [
              'attribute' => 'lokasi_kode',
              'label' => 'Lokasi',
              'value' => 'lokasiKode.nama'
            ],

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => Mimin::filterActionColumn([
                'view', 'update', 'delete'
              ], $this->context->route)
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
