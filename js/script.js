
// Add Item to Cart Function
function addToCart(id) {
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'add', itemId: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateCart(data.cart);
        } else {
            alert('Failed to add item to cart.');
        }
    })
    .catch(error => console.error('Error:', error));
}



// Clear cart function
function clearCart() {
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'clear' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            var userResponse = confirm("Are you sure you want to clear the cart?");
            if (userResponse) {
                updateCart([]);
            } else {
                console.log("User cancelled the action.");
            }
        }
        
    })
    .catch(error => console.error('Error:', error));
}


//Remove item from cart
function removeFromCart(index) {
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'remove', index: index })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateCart(data.cart);
        } else {
            alert('Failed to remove item from cart.');
        }
    })
    .catch(error => console.error('Error:', error));
}


// Update and refresh the cart based on adding and removing food items and quantities
function updateCart(cart) {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    let total = 0;
    let count = 0;
    for (let i = 0; i < cart.length; i++) {
        const item = cart[i];
        const li = document.createElement('li');
        li.innerHTML = `${item.name} - ${item.quantity} x GH₵${item.price} <button class="update-cart" onclick="removeFromCart(${i})">X</button>`;
        cartItems.appendChild(li);
        total += item.price * item.quantity;
        count += item.quantity;
    }
    const totalPrice = document.createElement('p');
    totalPrice.textContent = 'Total: GH₵' + total.toFixed(2);
    const itemCount = document.createElement('p');
    itemCount.textContent = 'Items: ' + count;
    cartItems.appendChild(totalPrice);
    cartItems.appendChild(itemCount);
}



//Place and order function
function placeOrder() {
    var userId = sessionStorage.getItem('customer_id'); 

    if (!userId) {
        alert("You need to be logged in to place an order.");
        window.location.href = "login.php"; // Redirect to login page
        return; // Exit the function if not logged in
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "place_order.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response === "Order placed successfully.") {
                alert(response);
                document.getElementById('cart-items').innerHTML = '<p>Cart is empty.</p>';
            } else {
                alert(response); 
            }
        }
    };

    xhr.send();
}
