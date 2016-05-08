<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Produksi */

$this->title = 'Ubah Produksi: ' . $model->petani->nama . ' - ' . $model->lahan->luas_m2 . ' m2';
$this->params['breadcrumbs'][] = ['label' => 'Produksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->petani->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="produksi-update">

			    <h4><?= Html::encode($this->title) ?></h4>

			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

</div>
