<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sopir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sopir-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_sim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

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
          $.pjax.reload({container:'#sopirGrid'});
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
