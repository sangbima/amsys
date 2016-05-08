<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use app\models\Lokasi;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Gudang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?php
    $proposalDesc = empty($model->lokasi_kode) ? '' : Lokasi::findOne($model->lokasi_kode)->nama;

    echo $form->field($model, 'lokasi_kode')->widget(Select2::classname(), [
      'initValueText' => $proposalDesc, // set the initial display text
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

    <?= $form->field($model, 'latitude')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <?= $form->field($model, 'longitude')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
