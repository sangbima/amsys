<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lokasi */

$this->title = 'Ubah Lokasi: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Lokasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="row">
    <div class="box-body">
		<div class="row">
			<div class="col-md-6">

		    <h3><i class="fa fa-pencil-square-o"></i> <?= Html::encode($this->title) ?></h3>

		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

			</div>
		</div>
	</div>
</div>
