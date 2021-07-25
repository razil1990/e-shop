<li>Размер экрана: <?=floatToInt($product->currentProduct->display_size) ?>"</li>
<li>Процессор: <?=$product->currentProduct->processor ?></li>
<li>Частота: <?= $product->currentProduct->processor_frequency ?> Ггц</li>
<li>ОЗУ: <?= $product->currentProduct->ram_size?> Ггб</li>
<li>Видеокарта: <?=$product->currentProduct->v_card ?></li>
<li>Внутренняя память: <?= floatToInt($product->currentProduct->data_storage_size) ?> Ггб</li>
<li>Вес: <?=floatToInt($product->currentProduct->weight) ?> кг</li>