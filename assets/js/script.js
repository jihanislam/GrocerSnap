document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('fa-search');
    const searchForm = document.querySelector('.search-form');
    
    if (menuBtn && searchForm) {
        menuBtn.addEventListener('click', function () {
            console.log("There is clicked");
            searchForm.classList.toggle('active');
        });
    
        // Optional: Hide the form when clicking outside
        document.addEventListener('click', function (event) {
            if (!menuBtn.contains(event.target) && !searchForm.contains(event.target)) {
                searchForm.classList.remove('active');
            }
        });
    } else {
        console.error("menu-btn or search-form not found in the DOM");
    }
});

// Function to load the cart from localStorage
function loadCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// Function to save the cart to localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to add an item to the cart
function addToCart(product) {
    let cart = loadCart();

    // Check if the product already exists in the cart
    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        // Increase quantity if product already exists
        existingProduct.quantity += 1;
    } else {
        // Add new product to the cart
        product.quantity = 1;
        cart.push(product);
    }

    // Save the updated cart back to localStorage
    saveCart(cart);
    Swal.fire({
        icon: 'success',
        title: product.name +'Added to Card',
        type: 'success',
        showConfirmButton: '!1',
        position: 'top-end',
        timer: '1000'
    });
    // alert(`Added "${product.name}" to the cart!`);
}

// Event listener for Add to Cart buttons
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const product = {
            id: this.dataset.id,
            name: this.dataset.name,
            price: parseFloat(this.dataset.price),
        };

        addToCart(product);
    });
});












// Function to load the cart from localStorage
function loadCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : [];
}

// Function to render the cart items
function renderCart() {
    const cart = loadCart();
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    let total = 0;

    // Clear existing cart items
    cartItemsContainer.innerHTML = '';

    // Populate the cart with items
    cart.forEach(item => {
        const subtotal = item.price * item.quantity;
        total += subtotal;

        const row = `
            <tr>
                <td>
                    <div class="product-info">
                        <input type="hidden" name="id[]" value="${item.id}">
                        <p>${item.name}</p>
                        <small><span>Price: Tk</span> ${item.price}</small>
                        <br>
                        <a class="remove-button" href="#" data-id="${item.id}">Remove</a>
                    </div>
                </td>
                <td>
                    <input type="number" name="quentity[]" value="${item.quantity}" min="1" class="quantity-input" data-id="${item.id}">
                </td>
                <td>
                    <span>Tk</span>
                    <span class="product-subtotal">${subtotal}</span>
                </td>
            </tr>
        `;
        cartItemsContainer.insertAdjacentHTML('beforeend', row);
    });

    // Update the total price
    cartTotalElement.textContent = `Tk ${total}`;

    // Add event listeners for quantity change and remove buttons
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            updateQuantity(this.dataset.id, parseInt(this.value));
        });
    });

    document.querySelectorAll('.remove-button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            removeItemFromCart(this.dataset.id);
        });
    });
}

// Function to update the quantity of an item
function updateQuantity(id, newQuantity) {
    const cart = loadCart();
    const product = cart.find(item => item.id === id);

    if (product && newQuantity > 0) {
        product.quantity = newQuantity;
        saveCart(cart);
        renderCart(); // Re-render the cart
    }
}

// Function to remove an item from the cart
function removeItemFromCart(id) {
    let cart = loadCart();
    cart = cart.filter(item => item.id !== id);
    saveCart(cart);
    renderCart(); // Re-render the cart
}

// Function to save the cart to localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Render the cart on page load
document.addEventListener('DOMContentLoaded', renderCart);


