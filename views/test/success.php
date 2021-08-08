<h3>
hello from test/success
</h3>

<?php
use yii\helpers\Html;
?>

<ul>
    <li>Имя: <?= Html::encode($model->name) ?></li>
    <li>Возраст: <?=Html::encode($model->age) ?></li>
</ul>