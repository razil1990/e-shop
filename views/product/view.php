
<?php foreach($products as $product): ?> 
    <ul>
        <li><img src="<?= $product->image_url?>" width="100px" height="100px"></li>
        <li><?= $product->price?></li>
        <li><?=$product->title?></li>               
        <?php require_once('view_'.$product->category->title.'.php')?>
    </ul>
<?php endforeach ?>