<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AngkutLapak */

$this->title = 'Tambah Angkut Lapak';
$this->params['breadcrumbs'][] = ['label' => 'Angkut Lapak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="angkut-lapak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
