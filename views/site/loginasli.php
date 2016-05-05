<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Selamat Datang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-panel panel panel-default">
  <div class="panel-heading"><span></span><b>Admin</b> AMSYS</div>
  <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      <fieldset>
        <?= $form->field($model, 'username', ['options' => [
            'tag' => 'div',
            'class' => 'form-group field-loginform-username has-feedback required'
          ],
          'template' => '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>{error}{hint}'
        ])->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>

        <?= $form->field($model, 'password', ['options' => [
            'tag' => 'div',
            'class' => 'form-group field-loginform-password has-feedback required'
          ],
          'template' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}{hint}'
        ])->passwordInput(['placeholder' => 'Password']) ?>

        <?= $form->field($model, 'rememberMe', ['options' => [
            'tag' => 'div',
            'class' => 'checkbox'
          ],
          'template' => '<label>{input} {label} {error}</label>'
        ])->checkbox() ?>
      </fieldset>
      <div class="form-group">
          <div class="col-lg-11">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
          </div>
      </div>
    <?php ActiveForm::end(); ?>

  </div>
</div>
<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4"><p style="font-size: 10px; color:#fff">&copy; bawangmerahteam 2016</p></div>
<!--<div class="panel-heading">Log in</div>
<div class="panel-body">
  <form role="form">
    <fieldset>
      <div class="form-group">
        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Password" name="password" type="password" value="">
      </div>
      <div class="checkbox">
        <label>
          <input name="remember" type="checkbox" value="Remember Me">Remember Me
        </label>
      </div>
      <a href="index.html" class="btn btn-primary">Login</a>
    </fieldset>
  </form>
</div>
</div>-->
