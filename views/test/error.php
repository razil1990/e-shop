<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'age') ?>

    <div class="form-group">
        <?= Html::submitButton('Send', ['class'=>'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>