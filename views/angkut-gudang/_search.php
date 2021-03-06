<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutGudangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="angkut-gudang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_surat') ?>

    <?= $form->field($model, 'no_proposal') ?>

    <?= $form->field($model, 'armada_id') ?>

    <?= $form->field($model, 'sopir_id') ?>

    <?php // echo $form->field($model, 'lapak_log_id') ?>

    <?php // echo $form->field($model, 'gudang_id') ?>

    <?php // echo $form->field($model, 'waktu_rencana') ?>

    <?php // echo $form->field($model, 'waktu_realisasi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'petugas_lapak') ?>

    <?php // echo $form->field($model, 'bobot_angkut_kg') ?>

    <?php // echo $form->field($model, 'jml_karung_angkut') ?>

    <?php // echo $form->field($model, 'petugas_gudang') ?>

    <?php // echo $form->field($model, 'bobot_serah_kg') ?>

    <?php // echo $form->field($model, 'jml_karung_serah') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
