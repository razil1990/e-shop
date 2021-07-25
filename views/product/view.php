<?php foreach($products as $product): ?> 
    <ul>
        <li><img src="<?= $product->image_url?>" width="100px" height="100px"></li>
        <br>
        <li>Модель: <?=$product->title?></li>               
        <?php require_once('view_'.$product->category->title.'.php')?>
        <li>Цена: <?= $product->price?> руб.</li>
    </ul>
<?php endforeach ?>
<button id="addToCart" type="button" data-id="<?= $product->product_id?>">Добавить в корзину</button>
<button id="removeFromCart" type="button" data-id="<?= $product->product_id?>">Удалить из корзины</button>
<?php $this->registerJsFile('./js/test.js');