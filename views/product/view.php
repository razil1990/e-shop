<?php foreach($products as $product): ?> 
    <ul>
        <li><img src="<?= $product->image_url?>" width="100px" height="100px"></li>
        <br>
        <li>Модель: <?=$product->title?></li>               
        <?php require_once('view_'.$product->category->title.'.php')?>
        <li>Цена: <?= $product->price?> руб.</li>
    </ul>
<?php endforeach ?>
<?php $this->registerJsFile('./js/test.js');