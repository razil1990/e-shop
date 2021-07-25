<?php if($categories):?>
    <?php foreach($categories as $category):?>
        <ul>
            <?php if($category->products): ?> 
                <li>
                    <a href="index.php?r=category/view&id=<?=$category->category_id?>" 
                    data-id="<?=$category->category_id?>"><?= $category->title ?>
                    <img src="<?= $category->image_url?>" width="100px" height="100px"></a>
                </li>
            <?php else: ?>
                <li>
                    <a href="index.php?r=category/show&id=<?=$category->category_id?>" 
                    data-id="<?=$category->category_id?>"><?= $category->title ?>
                    <img src="<?= $category->image_url?>" width="100px" height="100px"></a>
                </li>
            <?php endif;?>
        </ul>
    <?php endforeach; ?>
<?php endif;?>