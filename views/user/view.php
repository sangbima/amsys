<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'nama',
            'email:email',
            [
              'attribute' => 'status',
              'format' => 'raw',
              'value' => $model->getStatusLabel($model->status)
            ],
        ],
    ]) ?>
    <?php $form = ActiveForm::begin([]);?>
    <?php
      echo $form->field($authAssignment, 'item_name')->widget(Select2::classname(), [
        'data' => $authItems,
        'options' => [
          'placeholder' => 'Pilih Group ...',
        ],
        'pluginOptions' => [
          'allowClear' => true,
          'multiple' => true,
        ],
      ])->label('Group'); ?>

    <div class="from-group">
      <?= Html::submitButton('<i class="fa fa-edit"></i> Update', ['class' => $authAssignment->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
          //'data-confirm' => "Apakah anda yakin akan menyimpan data ini?",
      ]) ?>
    </div>
    <?php ActiveForm::end();?>
</div>
