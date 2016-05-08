<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArmadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Armadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('<i class="fa fa-plus"></i> Armada', ['create'], ['class' => 'btn btn-success']) ?>
        <?php //Html::button('<i class="fa fa-plus"></i> Acuan Harga', ['value' => Url::to(['armada/create'], true),'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <?php
      Modal::begin([
        'header' => '<h4><i class="fa fa-plus"></i> Armada</h4>',
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
            'id' => 'armadaGrid',
          ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_polisi',
            'kode',
            'kapasitas_mesin',
            'kapasitas_angkut',
            // 'created',
            // 'updated',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
