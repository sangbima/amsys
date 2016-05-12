<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InfoHarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-harga-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'komoditas_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'harga_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
