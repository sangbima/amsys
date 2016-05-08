<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Produksi */

$this->title = 'Form Tambah Produksi';
$this->params['breadcrumbs'][] = ['label' => 'Produksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produksi-create">

			    <h4><strong><?= Html::encode($this->title) ?></strong></h4>

			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
		
</div>
