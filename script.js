
const swiper = new Swiper('.slider-container', {
    loop: true, // Enable looping
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    slidesPerView: 1, // Adjust slides per view
    spaceBetween: 30, // Add space between slides
         });

        
         const cart = [];
         const cartContainer = document.querySelector('.cart-items');
         const cartTotal = document.getElementById('cart-total');
 
         function updateCart() {
             cartContainer.innerHTML = '';
             let total = 0;
             cart.forEach((item, index) => {
                 const cartItem = document.createElement('div');
                 cartItem.className = 'cart-item';
                 cartItem.innerHTML = `
                     <h4>${item.name} (${item.size})</h4>
                     <span>$${(item.price * item.quantity).toFixed(2)} (${item.quantity})</span>
                     <button onclick="removeFromCart(${index})">Remove</button>
                 `;
                 cartContainer.appendChild(cartItem);
                 total += item.price * item.quantity;
             });
 
             cartTotal.textContent = total.toFixed(2);
         }
 
         function addToCart(name, price, size) {
             const existingItem = cart.find(item => item.name === name && item.size === size);
 
             if (existingItem) {
                 existingItem.quantity += 1;
             } else {
                 cart.push({ name, price: parseFloat(price), quantity: 1, size });
             }
 
             updateCart();
         }
 
         function removeFromCart(index) {
             cart.splice(index, 1);
             updateCart();
         }
 
         document.querySelectorAll('.add-to-cart').forEach(button => {
             button.addEventListener('click', () => {
                 const name = button.dataset.name;
                 const price = button.dataset.price;
                 const size = button.previousElementSibling.value; // Get selected size from the dropdown
                 addToCart(name, price, size);
             });
         });
 
         document.getElementById('proceed-to-pay').addEventListener('click', () => {
             if (cart.length === 0) {
                 alert('Your cart is empty!');
             } else {
                 const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2);
                 alert(`Thank you for your purchase! Your total is $${total}.`);
                 cart.length = 0; // Clear cart
                 updateCart();
             }
         });
 
         // Category filtering
         document.querySelectorAll('.category-button').forEach(button => {
             button.addEventListener('click', () => {
                 const category = button.getAttribute('data-category');
                 document.querySelectorAll('.menu-section').forEach(section => {
                     if (category === 'all' || section.id === category) {
                         section.classList.add('active');
                     } else {
                         section.classList.remove('active');
                     }
                 });
             });
         });
 
         // Initialize cart
         updateCart();
     
    
              const buttons = document.querySelectorAll('.category-button');
              const sections = document.querySelectorAll('.menu-section');
    
              buttons.forEach(button => {
                  button.addEventListener('click', () => {
                      sections.forEach(section => section.classList.remove('active'));
                      document.getElementById(button.dataset.category).classList.add('active');
                  });
              });
          



