
<div id="cartContainer" class="cart-container">
</div>

<input type="hidden" id="cartInput" name="cartInput">

<template id="tmpl-cart">
        <ul class="cart__list">
            <li class="cart__item cart__item--info">
                <img class="cart__img" width="100px">
                <div class="cart__product-info">
                    <h3 id="cartItemTitle_" class="cart__product-title">Title</h3>
                    <h3>Price: <span id="cartItemPrice_" class="cart__product-price"></span><span> руб</span></h3>
                </div>
            </li>

            <li class="cart__list__item">
                <div class="cart__quantity-change-block">
                    <button id="buttonAdd_" class="cart__button button-add" type="button">+</button>
                    <h3 id="cartItemQuantity_" class="cart__product-quantity">1</h3>
                    <button id="buttonReduce_" class="cart__button button-reduce" type="button">-</button> 
                </div>
            </li>
        </ul>
</template>

<?php

$script = <<< JS
    let cartContainer = document.getElementById('cartContainer');
    (function(){
        function getProducts() {
            let products = [];
            for(let i=0; i<localStorage.length; i++) {
                let key = localStorage.key(i);
                productId = key.split('_')[1];

                if(key.includes('productId_')) {
                    let product = {
                        productId: productId,
                        quantity: localStorage.getItem(key)
                    }
                    products.push(product);
                }
            }
            return products;
        }

        // function getCart() {
        //     let productsId = [];
        //     let products = getProducts();
        //     for(let product of products) {
        //         for(let i in product) {
        //             productsId.push(i);
        //         }
        //     }
        //     return productsId;
        // }

        function createCartList(products) {
            let cartContainer = document.getElementById('cartContainer');
            for(let i of products) {
                let cartList = document.getElementById('tmpl-cart');
                let cartItem = document.createElement('div'); 
                cartItem.id = 'cartItem_';
                cartItem.classList.add('cart__wrapper');
                cartItem.append(cartList.content.cloneNode(true));
                cartContainer.append(cartItem);
                let title = cartItem.querySelector('.cart__product-title');
                let price = cartItem.querySelector('.cart__product-price');
                let buttonAdd = cartItem.querySelector('.button-add');
                let buttonReduce = cartItem.querySelector('.button-reduce');
                let cartItemQuantity = cartItem.querySelector('.cart__product-quantity');
                let img = cartItem.querySelector('.cart__img');
                let elements = [
                    cartItem,
                    title, 
                    price,
                    buttonAdd,
                    buttonReduce,
                    cartItemQuantity
                ];
                for(let elem of elements) {
                    elem.id = elem.id + i.product_id;
                    elem.dataset.id = i.product_id;
                    if(elem.tagName === 'BUTTON'){
                        elem.dataset.price = i.price
                    } 
                }
                title.textContent = title.textContent + ': ' + i.title;
                price.textContent = i.price * i.quantity;
                cartItemQuantity.textContent = i.quantity;
                img.src = i.image_url;
            }
        }

        function putToCartInput() {
            let cartInput = document.getElementById('cartInput');
            cartInput.addEventListener("putToCartInput", function(event) {
                if(event.detail.name === 'ls') {
                    let products = getProducts();
                    cartInput.value = JSON.stringify(products);
                } 
            });
            cartInput.dispatchEvent(new CustomEvent('putToCartInput', {
                detail: { name: 'ls'}
            }));
        }

        function changeProductQuantity() {
            let cartContainer = document.getElementById('cartContainer');
            cartContainer.addEventListener('click', (evt)=> {
                evt.preventDefault();
                if(evt.target.classList.contains('button-add')) {
                    let quantityElem = document.getElementById('cartItemQuantity_' + evt.target.dataset.id);
                    let priceElem = document.getElementById('cartItemPrice_' + evt.target.dataset.id);
                    let price = evt.target.dataset.price;
                    let quantity = quantityElem.textContent*1 + 1;
                    quantityElem.textContent = quantity;
                    priceElem.textContent = price * quantityElem.textContent;
                    localStorage.setItem('productId_' + evt.target.dataset.id, quantity);

                    cartInput.dispatchEvent(new CustomEvent('putToCartInput', {
                        detail: { name: 'ls'}
                    }));

                } else if (evt.target.classList.contains('button-reduce')) {
                    let quantityElem = document.getElementById('cartItemQuantity_' + evt.target.dataset.id);
                    let priceElem = document.getElementById('cartItemPrice_' + evt.target.dataset.id);
                    let price = evt.target.dataset.price;
                    let quantity = quantityElem.textContent*1 - 1;
                   
                    if(quantity == 0) {
                        localStorage.removeItem('productId_' + evt.target.dataset.id);
                        document.getElementById('cartItem_' + evt.target.dataset.id).remove();
                        
                    } else {
                        quantityElem.textContent = quantity;
                        priceElem.textContent = price * quantityElem.textContent;
                        localStorage.setItem('productId_' + evt.target.dataset.id, quantity);   
                    }

                    cartInput.dispatchEvent(new CustomEvent('putToCartInput', {
                        detail: { name: 'ls'}
                    }));
                }  
            });
        }

        $.ajax({
            url: 'index.php?r=cart/request',
            dataType: 'json',
            data: { products : JSON.stringify(getProducts()) },
            type: 'POST',
            success: function(products) {
                if(products !== 'Error') {
                    createCartList(products);
                } else {
                    console.log(products);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
        putToCartInput();
        changeProductQuantity();
        
    })();
JS;

$this->registerJs($script);