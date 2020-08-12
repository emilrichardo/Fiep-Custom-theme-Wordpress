jQuery(function($) {
    //Nombre
    $('body').on('blur change', '#billing_first_name', function() {
        var wrapper = $(this).closest('.form-row');
        // you do not have to removeClass() because Woo do it in checkout.js
        if (/\d/.test($(this).val())) { // check if contains numbers
            wrapper.addClass('woocommerce-invalid'); // error
            wrapper.removeClass('woocommerce-validated'); // error
        } else {
            wrapper.addClass('woocommerce-validated'); // success
        }
    });

    //Apellido
    $('body').on('blur change', '#billing_last_name', function() {
        var wrapper = $(this).closest('.form-row');
        // you do not have to removeClass() because Woo do it in checkout.js
        if (/\d/.test($(this).val())) { // check if contains numbers
            wrapper.addClass('woocommerce-invalid'); // error
            wrapper.removeClass('woocommerce-validated'); // error
        } else {
            wrapper.addClass('woocommerce-validated'); // success
        }
    });


    //Documento
    $('body').on('blur change', '#billing_document', function() {
        var wrapper = $(this).closest('.form-row');
        // you do not have to removeClass() because Woo do it in checkout.js
        if (/^([0-9])*$/.test($(this).val())) { // check if contains numbers
            wrapper.addClass('woocommerce-validated'); // success
        } else {
            wrapper.addClass('woocommerce-invalid'); // error
            wrapper.removeClass('woocommerce-validated'); // error
        }
    });

    //Telefono
    $('body').on('blur change', '#billing_phone', function() {
        var wrapper = $(this).closest('.form-row');
        // you do not have to removeClass() because Woo do it in checkout.js
        if (/^([0-9])*$/.test($(this).val())) { // check if contains numbers
            wrapper.addClass('woocommerce-validated'); // success
        } else {
            wrapper.addClass('woocommerce-invalid'); // error
            wrapper.removeClass('woocommerce-validated'); // error
        }
    });

});