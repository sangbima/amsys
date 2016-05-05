<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Komoditas;

/* @var $this yii\web\View */
/* @var $model app\models\AcuanHarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acuan-harga-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'komoditas_kode')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Komoditas::find()->where(['level' => 'variatas'])->all(), 'kode', 'nama'),
        'language' => 'en',
        'options' => [
          'placeholder' => 'Pilih Varietas ...',
          'id' => 'varietaskode'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'harga')->widget(\yii\widgets\MaskedInput::className(),[
      'clientOptions' => [
        'alias' => 'decimal',
      ]
      ]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> Tambah' : '<i class="fa fa-edit"></i> Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('form#{$model->formName()}').on('beforeSubmit', function(e){
  var \$form = $(this);
    $.post(
      \$form.attr("action"),  // serialize Yii2 form
      \$form.serialize()
    )
      .done(function(result){
        console.log(result);
        if(result == 1){
          $(\$form).trigger("reset");
          $.pjax.reload({container:'#acuanHargaGrid'});
        } else {
          $(\$form).trigger("reset");
          $("#message").html(result.message);
        }
      }).fail(function(){
        console.log("server error");
      });
    return false;
});
JS;
$this->registerJs($script);
?>
