<li>Размер экрана: <?=$product->currentProduct->screen_size ?>"</li>
<li>Процессор: <?= floatToInt($product->currentProduct->proc_frequency) ?> Ггц</li>
<li>ОЗУ: <?= $product->currentProduct->ram_size?> Ггб</li>
<li>Внутренняя память: <?= floatToInt($product->currentProduct->data_storage_size) ?>Ггб</li>
<li>Объем аккумулятора: <?= $product->currentProduct->battery_capacity ?> мА*ч</li>