<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GudangMasuk */

$this->title = 'Create Gudang Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Gudang Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-masuk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
