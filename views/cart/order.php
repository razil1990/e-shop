<?php if(!$products): ?>
    <h2>Заказов нет</h2>
<?php endif;?>
<div id="orderContainer">
<?php foreach($products as $product): ?>
<ul class="confirm-order">
    <li><?= $product['title'] ?> | <?= $product['quantity'] ?>шт. | <?= $product['quantity'] * $product['price']?> руб.</li>
</ul>
<?php endforeach;?>

<button type="button" data-order_id="<?=$orders?>" id="confirm-order">Подтвердить заказ</button>
</div>


<?php 
    $script = <<< JS

    (function(){
        function clearLocalStorage() {
            let arr = [];
            for(let i=0; i<localStorage.length; i++) {
                if(localStorage.key(i).includes('productId_')) {
                    arr.push(localStorage.key(i));
                }
            }
            console.log(arr);
            for(let i of arr) {
                localStorage.removeItem(i);
            }
        }

        let confirmOrder = document.getElementById('confirm-order');
        confirmOrder.addEventListener('click', (evt)=>{
            evt.preventDefault();
            let order = { order: JSON.stringify([{confirm: 1, orders: confirmOrder.dataset.order_id}]) };
            $.ajax({
                url: 'index.php?r=cart/confirm',
                dataType: 'json',
                data: order,
                type: 'POST',
                success: function(data) {
                    if(data === 1) {
                        console.log('Заказ выполнен');
                        clearLocalStorage();
                        let orderContainer = document.getElementById('orderContainer');
                        orderContainer.innerHTML = '';
                        orderContainer.insertAdjacentHTML('afterbegin', '<h3>Ваш заказ принят в обработку</h3><div><a href="index.php?r=site">На главную</a></div>');
                    } else if(data === 'error') {
                        console.log('error');
                    } 
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    })();
JS;

$this->registerJs($script);?>
