<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Komoditas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="komoditas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php /*echo $form->field($model, 'kode')->textInput(['maxlength' => true]) */ ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php /*echo $form->field($model, 'level')->dropDownList([ 'Komoditas' => 'Komoditas', 'Variatas' => 'Variatas', ], ['prompt' => '--']) */?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?php /* echo $form->field($model, 'parent')->textInput(['maxlength' => true]) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
