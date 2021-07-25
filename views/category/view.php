<?php if($categories):?>
    <?php foreach($categories as $category):?>
        <?php if($category->products): ?> 
            <?php foreach($category->products as $product):?>
                <ul>
                    <li><a href="index.php?r=product/view&id=<?=$product->product_id?>">
                        <img src="<?= $product->image_url?>" width="100px" height="100px"></a>
                    </li>
                    <li><?=$product->title?></li>
                    <li><?=$product->price?> руб.</li>
                </ul>
                <hr>
                <?php endforeach; ?>
        <?php else: ?>
        <a href="index.php?r=category/show&id=<?=$category->category_id?>" 
           data-id="<?=$category->category_id?>"><?= $category->title ?>
           <img src="<?= $category->image_url?>" width="100px" height="100px">
           </a>
        <?php endif;?>
    <?php endforeach; ?>
<?php endif;?>







