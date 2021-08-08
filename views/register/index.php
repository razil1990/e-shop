<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="register">
    <h1>Регистрация</h1>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => 'index.php?r=register'
        
    ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true])->label('Логин') ?>

        <?= $form->field($model, 'password')->textInput()->label('Пароль') ?>

        <?= $form->field($model, 'password_repeat')->passwordInput()->label('Подтверждение пароля') ?>

        <?= $form->field($model, 'rememberMe')->checkbox([], false)->label('Запомнить меня')?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>


