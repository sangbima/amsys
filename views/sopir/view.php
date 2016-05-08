<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sopir */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Sopir', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sopir-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('<i class="fa fa-edit"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //Html::a('<i class="fa fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'no_sim',
            'alamat',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
