//Script do produtos
function filterByCategory(category) {
    const cards = document.querySelectorAll('.drink-card');
    cards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        if (category === 'all' || cardCategory === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function clearFilters() {
    const cards = document.querySelectorAll('.drink-card');
    cards.forEach(card => {
        card.style.display = 'block';
    });
}

function addToCart(productName, price, message, image) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push({ name: productName, price: price, image: image, quantity: 1 });
    localStorage.setItem('cart', JSON.stringify(cart));
    // Exiba a mensagem de confirmação
    alert(message);
    updateCartCount();
}

document.addEventListener('DOMContentLoaded', function () {
    updateCartCount();
});

function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    //cartCountElement.innerText = cart.length;
}

//Script do carrinho

document.addEventListener('DOMContentLoaded', function () {
    updateCartItems();
    updateTotalPrice();
});

function updateCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Limpa o conteúdo atual do carrinho
    if (cartItemsContainer != null) {
        cartItemsContainer.innerHTML = '';
    }

    // Adiciona os itens do carrinho à página
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <h2>${item.name}</h2>
            <p>Preço: R$ ${item.price.toFixed(2)}</p>
            <button onclick="decreaseQuantity('${item.name}')">-</button>
            <span>${item.quantity}</span>
            <button onclick="increaseQuantity('${item.name}')">+</button>
            <button onclick="removeOneFromCart('${item.name}')">Remover</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    // Atualiza o contador do carrinho
    updateCartCount();
}


function removeOneFromCart(productName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Encontra o item no carrinho
    const cartItem = cart.find(item => item.name === productName);

    // Garante que a quantidade não seja menor que 1
    if (cartItem.quantity > 1) {
        // Diminui a quantidade
        cartItem.quantity--;
    } else {
        // Remove o item do carrinho se a quantidade for 1
        cart = cart.filter(item => item.name !== productName);
    }

    // Atualiza o carrinho no armazenamento local
    localStorage.setItem('cart', JSON.stringify(cart));

    // Atualiza a exibição dos itens do carrinho na página
    updateCartItems();
    updateTotalPrice();
}

function increaseQuantity(productName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Encontra o item no carrinho
    const cartItem = cart.find(item => item.name === productName);

    // Aumenta a quantidade
    cartItem.quantity++;

    // Atualiza o carrinho no armazenamento local
    localStorage.setItem('cart', JSON.stringify(cart));

    // Atualiza a exibição dos itens do carrinho na página
    updateCartItems();
    updateTotalPrice();
}

function decreaseQuantity(productName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Encontra o item no carrinho
    const cartItem = cart.find(item => item.name === productName);

    // Garante que a quantidade não seja menor que 1
    if (cartItem.quantity > 1) {
        // Diminui a quantidade
        cartItem.quantity--;
    } else {
        // Remove o item do carrinho se a quantidade for 1
        cart = cart.filter(item => item.name !== productName);
    }

    // Atualiza o carrinho no armazenamento local
    localStorage.setItem('cart', JSON.stringify(cart));

    // Atualiza a exibição dos itens do carrinho na página
    updateCartItems();
    updateTotalPrice();
}

function updateTotalPrice() {
    const totalPriceElement = document.getElementById('total-price');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    totalPriceElement.innerHTML = total.toFixed(2);
}

function checkout() {
    // Implemente a lógica de checkout aqui, usando os dados do formulário
    // Você pode limpar o carrinho e redirecionar o usuário para uma página de confirmação
    // ou realizar uma chamada a um servidor para processar o pedido.
    alert('Compra finalizada!');
    localStorage.removeItem('cart');
    updateCartItems();
    updateTotalPrice();
}

document.addEventListener('DOMContentLoaded', function () {
    updateCartCount();
});

function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartCountElement.innerText = cart.length;
}

//Script do admin-login

function authenticateAdmin() {
    const username = document.getElementById('admin-username').value;
    const password = document.getElementById('admin-password').value;

    // Verifica se o nome de usuário e senha correspondem aos administradores
    if (username === 'admin' && password === 'admin') {
        // Autenticação bem-sucedida, redireciona para a página de administração real
        window.location.href = '/admin';
    } else {
        alert('Login de admin inválido');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateCartCount();
});

function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cartCountElement)
    cartCountElement.innerText = cart.length;
}

//Script do admin

document.addEventListener('DOMContentLoaded', function () {
    displayAdminProductList();
});

function displayAdminProductList() {
    const adminProductList = document.getElementById('admin-product-list');
    const products = getAdminProducts();

    // Limpa o conteúdo atual da lista de produtos
    if(adminProductList)
    adminProductList.innerHTML = '';

    // Adiciona os produtos à página
    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'drink-card';
        productCard.setAttribute('data-category', product.category);

        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h2>${product.name}</h2>
            <p>Preço: R$ ${product.price.toFixed(2)}</p>
            <button onclick="editProduct('${product.name}')">Editar</button>
            <button onclick="confirmDeleteProduct('${product.name}')">Deletar</button>
        `;

        adminProductList.appendChild(productCard);
    });
}

function getAdminProducts() {
    // Simule a obtenção de produtos do armazenamento local ou de um servidor
    return JSON.parse(localStorage.getItem('adminProducts')) || [];
}

function saveProduct() {
    const productName = document.getElementById('product-name').value;
    const productPrice = parseFloat(document.getElementById('product-price').value);
    const productCategory = document.getElementById('product-category').value;

    if (productName && !isNaN(productPrice) && productCategory) {
        const product = {
            name: productName,
            price: productPrice,
            category: productCategory,
            image: 'default_image.jpg' // Adicione uma imagem padrão ou permita o upload de imagens
        };

        const products = getAdminProducts();

        // Verifica se é uma edição ou adição
        const existingProductIndex = products.findIndex(p => p.name === productName);
        if (existingProductIndex !== -1) {
            // Edição
            products[existingProductIndex] = product;
        } else {
            // Adição
            products.push(product);
        }

        // Atualize os produtos na armazenamento local
        localStorage.setItem('adminProducts', JSON.stringify(products));

        // Limpe o formulário
        clearForm();

        // Atualize a exibição da lista de produtos
        displayAdminProductList();
    } else {
        alert('Preencha todos os campos corretamente.');
    }
}

function editProduct(productName) {
    const products = getAdminProducts();
    const productToEdit = products.find(p => p.name === productName);

    // Preenche o formulário com os detalhes do produto
    document.getElementById('product-name').value = productToEdit.name;
    document.getElementById('product-price').value = productToEdit.price.toFixed(2);
    document.getElementById('product-category').value = productToEdit.category;
}

function confirmDeleteProduct(productName) {
    const confirmation = confirm(`Tem certeza que deseja deletar o produto "${productName}"?`);

    if (confirmation) {
        deleteProduct(productName);
    }
}

function deleteProduct(productName) {
    const products = getAdminProducts();
    const updatedProducts = products.filter(p => p.name !== productName);

    // Atualize os produtos na armazenamento local
    localStorage.setItem('adminProducts', JSON.stringify(updatedProducts));

    // Atualize a exibição da lista de produtos
    displayAdminProductList();
}

function clearForm() {
    document.getElementById('product-name').value = '';
    document.getElementById('product-price').value = '';
    document.getElementById('product-category').value = 'cervejas';
}
