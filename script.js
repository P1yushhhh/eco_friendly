const cart = [];

function addToCart(productId, productName, productPrice) {
    const existingProduct = cart.find(product => product.id === productId);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }
    updateCart();
}

function updateCart() {
    const cartContainer = document.getElementById("cart-items");
    const totalPrice = document.getElementById("total-price");
    let total = 0;

    cartContainer.innerHTML = "";
    cart.forEach(product => {
        const cartItem = document.createElement("div");
        cartItem.innerHTML = `${product.name} - $${product.price} x ${product.quantity}`;
        cartContainer.appendChild(cartItem);
        total += product.price * product.quantity;
    });
    totalPrice.textContent = `Total: $${total}`;
}
