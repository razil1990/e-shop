<?php if($categories):?>
    <?php foreach($categories as $category):?>
        <ul>
            <li><img src="<?= $category->image_url?>" width="100px" height="100px"></li>
            <li>id: <?= $category->category_id?> | category: <?= $category->title?></li>
            <?php if($category->products): ?> 
                <li> <a href="index.php?r=category/view&id=<?=$category->category_id?>" 
                    data-id="<?=$category->category_id?>">Товары</a></li>
            <?php else: ?>
                <li> <a href="index.php?r=category/show&id=<?=$category->category_id?>" 
                    data-id="<?=$category->category_id?>">Далее</a></li>
            <?php endif;?>
            
        </ul>
    <?php endforeach; ?>
<?php endif;?>