<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use app\models\Lokasi;

/* @var $this yii\web\View */
/* @var $model app\models\Lapak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lapak-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penanggung_jawab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'lokasi_kode')->textInput(['maxlength' => true]) ?>

    <?php
      $lokasiDesc = empty($model->lokasi_kode) ? '' : Lokasi::findOne($model->lokasi_kode)->nama;

      echo $form->field($model, 'lokasi_kode')->widget(Select2::classname(), [
        'initValueText' => $lokasiDesc, // set the initial display text
        'options' => ['placeholder' => 'Cari Lokasi ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => \yii\helpers\Url::to(['/lokasi/location-list']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(lokasi) { return lokasi.text; }'),
            'templateSelection' => new JsExpression('function (lokasi) { return lokasi.text; }'),
        ],
      ]);
    ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
