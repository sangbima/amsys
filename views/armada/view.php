<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Armada */

$this->title = $model->no_polisi;
$this->params['breadcrumbs'][] = ['label' => 'Armada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_polisi',
            'kode',
            'kapasitas_mesin',
            'kapasitas_angkut',
        ],
    ]) ?>

</div>
