

let products = [
    {  
       price: 1000,
       title: 'One',
       quantity: 1
    },
    {
        price: 500,
       title: 'Two',
       quantity: 2
    }
];


function createCartList(arr) {
    let counter = 0;
    for(let i of arr) {
        counter++;
        let cartList = document.getElementById('tmpl-cart');
        let cartItem = document.createElement('div'); 
        cartItem.id = 'cartItem_';
        cartItem.append(cartList.content.cloneNode(true));
        document.body.append(cartItem);
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
            elem.id = elem.id + counter;
            elem.dataset.id = counter;
            console.log(elem.tagName);
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


function changeProductQuantity() {
    document.body.addEventListener('click', (evt)=> {
        evt.preventDefault();
        if(evt.target.classList.contains('button-add')) {
            let quantityElem = document.getElementById('cartItemQuantity_' + evt.target.dataset.id);
            let priceElem = document.getElementById('cartItemPrice_' + evt.target.dataset.id);
            let price = evt.target.dataset.price;
            let quantity = quantityElem.textContent*1;

            quantityElem.textContent = quantity + 1;
            priceElem.textContent = price * quantityElem.textContent;

        } else if (evt.target.classList.contains('button-reduce')) {
            let quantityElem = document.getElementById('cartItemQuantity_' + evt.target.dataset.id);
            let priceElem = document.getElementById('cartItemPrice_' + evt.target.dataset.id);
            let price = evt.target.dataset.price;
            let quantity = quantityElem.textContent*1;
            if(quantityElem.textContent*1 == 0) {
                 document.getElementById('cartItem_' + evt.target.dataset.id).remove();
            }
            quantityElem.textContent = quantity - 1;
            priceElem.textContent = price * quantityElem.textContent;
        }  
    });
}

createCartList(products);
changeProductQuantity();
