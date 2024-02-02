
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.classList.remove('active');
        });

        this.classList.add('active');

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        const id = entry.target.getAttribute('id');
        const link = document.querySelector(`a[href="#${id}"]`);

        if (entry.isIntersecting) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}, { threshold: 0.8});

document.querySelectorAll('section[id]').forEach(section => {
    observer.observe(section);
});




document.getElementById('searchforms').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        this.submit(); 
    }
});

//increase quantity button
function increaseQuantity() {
    var quantityInputs = document.getElementsByClassName('quantityInput');
    for (var i = 0; i < quantityInputs.length; i++) {
        var currentQuantity = parseInt(quantityInputs[i].value, 10);
        quantityInputs[i].value = currentQuantity + 1;
    }
}
//decrease quantity button
function decreaseQuantity() {
    var quantityInputs = document.getElementsByClassName('quantityInput');
    for (var i = 0; i < quantityInputs.length; i++) {
        var currentQuantity = parseInt(quantityInputs[i].value, 10);
        if (currentQuantity > 1) {
            quantityInputs[i].value = currentQuantity - 1;
        }
    }
}


$(document).ready(function() {
    function handleMenuChanges() {
        if ($('.modal.show').length > 0 &&
            $('input[name="menuvariation"]:checked').length > 0 &&
            $('input[name="menusize"]:checked').length > 0) {
            
            var selectedVariety = $('input[name="menuvariation"]:checked').val();
            var selectedSize = $('input[name="menusize"]:checked').val();
            var menuid = $('.modal.show').data('currentmenuid');

            $.ajax({
                url: '../database/fetchmenudetails.php',
                method: 'POST',
                data: {
                    variety: selectedVariety,
                    size: selectedSize,
                    menuid: menuid
                },
                success: function(response) {
                    $('.menuprice').text("₱" + response);
                }
            });
        }
    }
    $('input[name="menuvariation"], input[name="menusize"]').change(handleMenuChanges);

    $('.modal').on('hidden.bs.modal', function () {
        $('input[name="menuvariation"], input[name="menusize"]').prop('checked', false);
        //$('.menuprice').val("₱"+$lowestprice); // Set initial price display

    });
});




const cartCountElement = document.querySelector('.cart-count-number');

cartCountElement.classList.add('show-animation');

setTimeout(() => {
    cartCountElement.classList.remove('show-animation');
}, 1000);




function closeModals() {
    $('.modal').modal('hide');
}

function updateCartCount() {
    $.ajax({
        url: '../database/countcart.php',
        method: 'GET',
        dataType: 'json', 
        success: function (data) {
            if (data.error) {
                console.error('Error fetching cart count:', data.error);
            } else {
                var $cartCount = $('#cartCount');
                var currentCount = parseInt($cartCount.text(), 10);
                var newCount = data.totalcartcount;

                if (currentCount !== newCount) {
                    $cartCount
                        .prop('counter', currentCount)
                        .animate({
                            counter: newCount
                        }, {
                            duration: 0,
                            easing: 'swing',
                            step: function (now) {
                                $cartCount.text(Math.ceil(now));
                            },
                            complete: function () {
                                $cartCount.addClass('show-animation');
                                setTimeout(function () {
                                    $cartCount.removeClass('show-animation');
                                }, 700);
                            }
                        });
                }
            }
        },
        error: function (error) {
            console.error('Error fetching cart count:', error);
        }
    });
}
updateCartCount();
setInterval(updateCartCount, 1000);



function submitForm(event, form) {
    event.preventDefault();

    var formData = new FormData(form);
    
    $.ajax({
        type: 'POST',
        url: '../database/addtocart.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.error(error);
        }
    });
    closeModals();
}




$(document).ready(function() {
    function checkSelection() {
        var varietyRadio = $('.modal.show input[name="menuvariation"]:checked').length > 0;
        var sizeRadio = $('.modal.show input[name="menusize"]:checked').length > 0;
        var addToCartBtn = $('.modal.show #addtocartbutton');
        var menuModalBody = $('.modal.show .menumodalbody');

        if (varietyRadio && sizeRadio) {
            addToCartBtn.removeAttr('disabled');
            console.log('Button enabled');
        } else {
            addToCartBtn.attr('disabled', 'disabled');
            console.log('Button disabled');
            if (varietyRadio || sizeRadio) {
                menuModalBody.animate({
                    scrollTop: menuModalBody[0].scrollHeight
                }, 500);
            }
        }
    }
    $(document).on('change', '.modal.show input[name="menuvariation"], .modal.show input[name="menusize"]', function() {
        checkSelection();
    });
    checkSelection();
});