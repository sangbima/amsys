<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LapakLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lapak-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_proposal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_antar_lapak')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_antar_gudang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'proses' => 'Proses', 'siap_angkut' => 'Siap angkut', 'terangkut' => 'Terangkut', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'timbang_kotor_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timbang_bersih_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu_masuk')->textInput() ?>

    <?= $form->field($model, 'waktu_keluar')->textInput() ?>

    <?= $form->field($model, 'jml_karung_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_karung_keluar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
