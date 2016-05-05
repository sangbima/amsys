<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GudangLot */

$this->title = 'Create Gudang Lot';
$this->params['breadcrumbs'][] = ['label' => 'Gudang Lots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-lot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
