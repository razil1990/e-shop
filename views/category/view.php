<?php if($categories):?>
    <?php foreach($categories as $category):?>
        <ul>
            <li><img src="<?= $category->image_url?>" width="100px" height="100px"></li>
            <li>id: <?= $category->category_id?> | category: <?= $category->title?></li>
        </ul>
        <?php if($category->products): ?> 
            <?php foreach($category->products as $product):?>
                <h4>Товар:</h4>
                <ul>
                    <li><img src="<?= $product->image_url?>" width="100px" height="100px"></li>
                    <li><?=$product->title?></li>
                    <li><?=$product->price?></li>
                    <li><a href="index.php?r=product/view&id=<?=$product->product_id?>">Детали</a></li>
                </ul>
                <?php endforeach; ?>
        <?php else: ?>
        <a href="index.php?r=category/show&id=<?=$category->category_id?>" 
           data-id="<?=$category->category_id?>">Далее</a>
        <?php endif;?>
    <?php endforeach; ?>
<?php endif;?>







