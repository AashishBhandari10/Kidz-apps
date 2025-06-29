// Smooth scrolling for anchor links
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});

// Add to cart functionality
$('.add-to-cart').on('click', function(e) {
    e.preventDefault();
    var productId = $(this).data('product-id');
    // Add product to cart using AJAX
    $.post('add_to_cart.php', {product_id: productId}, function(response) {
        if (response.success) {
            alert('Product added to cart!');
        } else {
            alert('Error adding product to cart.');
        }
    }, 'json');
});

// Newsletter subscription
$('#newsletter-form').on('submit', function(e) {
    e.preventDefault();
    var email = $('#newsletter-email').val();
    $.post('subscribe.php', {email: email}, function(response) {
        if (response.success) {
            alert('Thank you for subscribing to our newsletter!');
        } else {
            alert('Error subscribing to newsletter. Please try again.');
        }
    }, 'json');
});