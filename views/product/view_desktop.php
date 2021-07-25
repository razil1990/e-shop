<li>Процессор: <?=$product->currentProduct->processor ?></li>
<li>Частота: <?= $product->currentProduct->processor_frequency ?> Ггц</li>
<li>ОЗУ: <?= $product->currentProduct->ram_size?> Ггб</li>
<li>Видеокарта: <?=$product->currentProduct->v_card ?>"</li>
<li>Внутренняя память: <?= floatToInt($product->currentProduct->data_storage_size) ?> Ггб</li>
Корпус:
<ul> 
    <li>Длина: <?= $product->currentProduct->case_length ?> мм</li>
    <li>Ширина: <?= $product->currentProduct->case_width ?> мм</li>
    <li>Высота: <?= $product->currentProduct->case_height ?> мм</li>
</ul>
