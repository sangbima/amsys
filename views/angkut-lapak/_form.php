<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Armada;
use app\models\Sopir;
use app\models\Produksi;

/* @var $this yii\web\View */
/* @var $model app\models\AngkutLapak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="angkut-lapak-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $proposalDesc = empty($model->id) ? '' : Produksi::findOne($model->id)->no_proposal;

    echo $form->field($model, 'no_proposal')->widget(Select2::classname(), [
      'initValueText' => $proposalDesc, // set the initial display text
      'options' => ['placeholder' => 'Cari Proposal ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 3,
          'language' => [
              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
              'url' => \yii\helpers\Url::to(['/produksi/produksi-list']),
              'dataType' => 'json',
              'data' => new JsExpression('function(params) { return {q:params.term}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(produksi) { return produksi.text; }'),
          'templateSelection' => new JsExpression('function (produksi) { return produksi.text; }'),
      ],
    ]);
    ?>

    <?php
    $armadaDesc = empty($model->armada_id) ? '' : Armada::findOne($model->armada_id)->no_polisi;

    echo $form->field($model, 'armada_id')->widget(Select2::classname(), [
      'initValueText' => $armadaDesc, // set the initial display text
      'options' => ['placeholder' => 'Cari Armada ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 3,
          'language' => [
              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
              'url' => \yii\helpers\Url::to(['/armada/armada-list']),
              'dataType' => 'json',
              'data' => new JsExpression('function(params) { return {q:params.term}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(armada) { return armada.text; }'),
          'templateSelection' => new JsExpression('function (armada) { return armada.text; }'),
      ],
    ]);
    ?>

    <?php
    $armadaDesc = empty($model->sopir_id) ? '' : Sopir::findOne($model->sopir_id)->nama;

    echo $form->field($model, 'sopir_id')->widget(Select2::classname(), [
      'initValueText' => $armadaDesc, // set the initial display text
      'options' => ['placeholder' => 'Cari Sopir ...'],
      'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 3,
          'language' => [
              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
              'url' => \yii\helpers\Url::to(['/sopir/sopir-list']),
              'dataType' => 'json',
              'data' => new JsExpression('function(params) { return {q:params.term}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(sopir) { return sopir.text; }'),
          'templateSelection' => new JsExpression('function (sopir) { return sopir.text; }'),
      ],
    ]);
    ?>

    <?= $form->field($model, 'produksi_id')->textInput() ?>

    <?= $form->field($model, 'lapak_id')->textInput() ?>

    <?= $form->field($model, 'waktu_rencana')->widget(DatePicker::classname(),[
      'options' => ['placeholder' => 'Pilih tanggal rencana...'],
      'type' => DatePicker::TYPE_COMPONENT_APPEND,
      'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy'
      ]
    ]); ?>

    <?= $form->field($model, 'waktu_realisasi')->widget(DatePicker::classname(),[
      'options' => ['placeholder' => 'Pilih tanggal realisasi...'],
      'type' => DatePicker::TYPE_COMPONENT_APPEND,
      'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy'
      ]
    ]); ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => [ 'pending' => 'Pending', 'proses' => 'Proses', 'selesai' => 'Selesai', ],
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Status ...',
          'id' => 'statusId'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'diterima_oleh')->textInput() ?>

    <?= $form->field($model, 'diterima_pada')->widget(DatePicker::classname(),[
      'options' => ['placeholder' => 'Pilih tanggal terima...'],
      'type' => DatePicker::TYPE_COMPONENT_APPEND,
      'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy'
      ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus></i> Tambah' : '<i class="fa fa-plus></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
