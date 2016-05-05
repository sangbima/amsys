<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutGudang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="angkut-gudang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_proposal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'armada_id')->textInput() ?>

    <?= $form->field($model, 'sopir_id')->textInput() ?>

    <?= $form->field($model, 'lapak_log_id')->textInput() ?>

    <?= $form->field($model, 'gudang_id')->textInput() ?>

    <?= $form->field($model, 'waktu_rencana')->textInput() ?>

    <?= $form->field($model, 'waktu_realisasi')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'petugas_lapak')->textInput() ?>

    <?= $form->field($model, 'bobot_angkut_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_karung_angkut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'petugas_gudang')->textInput() ?>

    <?= $form->field($model, 'bobot_serah_kg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_karung_serah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
