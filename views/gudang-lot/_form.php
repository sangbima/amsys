<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use app\models\GudangBangunan;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\GudangLot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gudang-lot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $initValue = empty($model->gudang_bangunan_id) ? '' : GudangBangunan::findOne($model->gudang_bangunan_id)->nama;

    echo $form->field($model, 'gudang_bangunan_id')->widget(Select2::classname(), [
      'initValueText' => $initValue, // set the initial display text
      'options' => ['placeholder' => 'Cari Gudang Bangunan ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 3,
          'language' => [
              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
              'url' => \yii\helpers\Url::to(['/gudang-bangunan/bangunan-list']),
              'dataType' => 'json',
              'data' => new JsExpression('function(params) { return {q:params.term}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(gudangBangunan) { return gudangBangunan.text; }'),
          'templateSelection' => new JsExpression('function (gudangBangunan) { return gudangBangunan.text; }'),
      ],
    ]);
    ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kapasitas_m3')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
