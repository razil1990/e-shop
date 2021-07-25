let addToCart = document.getElementById('addToCart');
let removeFromCart = document.getElementById('removeFromCart');

function addOrRemovefromCart(add = true) {
    let productId = addToCart.dataset.id; 
    let productKey = 'productId_' + productId;
    if(localStorage.getItem(productKey) >= 0 && localStorage.getItem(productKey) < 10 && add) {
        localStorage.setItem(productKey, localStorage.getItem(productKey)*1 + 1);
    } else if (localStorage.getItem(productKey) > 0 && !add ) {
        localStorage.setItem(productKey, localStorage.getItem(productKey)*1 - 1);
    } else if (!localStorage.getItem(productKey) <= 0  && add) {
        localStorage.setItem(productKey, 1);
    } 
}

addToCart.addEventListener('click', (evt) => {
    evt.preventDefault();
    addOrRemovefromCart();
});

removeFromCart.addEventListener('click', (evt) => {
    evt.preventDefault();
    addOrRemovefromCart(false);
});


