jQuery(document).ready(function ($) {
    var calculate = function () {
        var total = 0;
        var total2 = 0;
        var total6 = 0;

        // A text input field with numeric value
        var val4 = $('.quform-field-27_23').val();
        if (val4 && val4.length && $.isNumeric(val4)) {
            total += parseFloat(val4);
            total2 += parseFloat(val4);
            total6 += parseFloat(val4);
        }

        var val8 = $('.quform-field-27_121').val();
        if (val8 && val8.length && $.isNumeric(val8)) {
            total += parseFloat(val8);
            total2 += parseFloat(val8);
            total6 += parseFloat(val8);
        }

        var val12 = $('.quform-field-27_94').val();
        if (val12 && val12.length && $.isNumeric(val12)) {
            total += parseFloat(val12);
            total2 += parseFloat(val12);
            total6 += parseFloat(val12);
        }

        var val16 = $('.quform-field-27_67').val();
        if (val16 && val16.length && $.isNumeric(val16)) {
            total += parseFloat(val16);
            total2 += parseFloat(val16);
            total6 += parseFloat(val16);
        }

        // Display the result to the user
        $('#form-total').text('Total:' + total);
 
        // Set the value of the hidden field
        $('.quform-field-27_413').val(total);

        var total1 = 0;

       // A text input field with numeric value
       var val20 = $('.quform-field-27_427').val();
        if (val20 && val20.length && $.isNumeric(val20)) {
            total1 += parseFloat(val20);
            total2 += parseFloat(val20);
            total6 += parseFloat(val20);
        }

        var val21 = $('.quform-field-27_428').val();
        if (val21 && val21.length && $.isNumeric(val21)) {
            total1 += parseFloat(val21);
            total2 += parseFloat(val21);
            total6 += parseFloat(val21);
        }

        var val22 = $('.quform-field-27_429').val();
        if (val22 && val22.length && $.isNumeric(val22)) {
            total1 += parseFloat(val22);
            total2 += parseFloat(val22);
            total6 += parseFloat(val22);
        }

        var val23 = $('.quform-field-27_430').val();
        if (val23 && val23.length && $.isNumeric(val23)) {
            total1 += parseFloat(val23);
            total2 += parseFloat(val23);
            total6 += parseFloat(val23);
        }

        var val24 = $('.quform-field-27_431').val();
        if (val24 && val24.length && $.isNumeric(val24)) {
            total1 += parseFloat(val24);
            total2 += parseFloat(val24);
            total6 += parseFloat(val24);
        }

        // Display the result to the user
       $('#form-total1').text('Total:' + total1);

        // Set the value of the hidden field 
       $('.quform-field-27_419').val(total1);
        
        // Display the result to the user
       $('#form-total2').text('Total:' + total2);

        // Set the value of the hidden field 
       $('.quform-field-27_426').val(total2);

        var total3 = 0;
        var total5 = 0;

        // A text input field with numeric value
        var val25 = $('.quform-field-27_240').val();
        if (val25 && val25.length && $.isNumeric(val25)) {
            total3 += parseFloat(val25);
            total5 += parseFloat(val25);
            total6 += parseFloat(val25);
        }

        var val29 = $('.quform-field-27_267').val();
        if (val29 && val29.length && $.isNumeric(val29)) {
            total3 += parseFloat(val29);
            total5 += parseFloat(val29);
            total6 += parseFloat(val29);
        }

        var val33 = $('.quform-field-27_294').val();
        if (val33 && val33.length && $.isNumeric(val33)) {
            total3 += parseFloat(val33);
            total5 += parseFloat(val33);
            total6 += parseFloat(val33);
        }

        var val37 = $('.quform-field-27_321').val();
        if (val37 && val37.length && $.isNumeric(val37)) {
            total3 += parseFloat(val37);
            total5 += parseFloat(val37);
            total6 += parseFloat(val37);
        }

        // Display the result to the user
        $('#form-total3').text('Total:' + total3);
 
        // Set the value of the hidden field
        $('.quform-field-27_439').val(total3);

        var total4 = 0;

       // A text input field with numeric value
       var val41 = $('.quform-field-27_432').val();
        if (val41 && val41.length && $.isNumeric(val41)) {
            total4 += parseFloat(val41);
            total5 += parseFloat(val41);
            total6 += parseFloat(val41);
        }

        var val42 = $('.quform-field-27_433').val();
        if (val42 && val42.length && $.isNumeric(val42)) {
            total4 += parseFloat(val42);
            total5 += parseFloat(val42);
            total6 += parseFloat(val42);
        }

        var val43 = $('.quform-field-27_434').val();
        if (val43 && val43.length && $.isNumeric(val43)) {
            total4 += parseFloat(val43);
            total5 += parseFloat(val43);
            total6 += parseFloat(val43);
        }

        var val44 = $('.quform-field-27_435').val();
        if (val44 && val44.length && $.isNumeric(val44)) {
            total4 += parseFloat(val44);
            total5 += parseFloat(val44);
            total6 += parseFloat(val44);
        }

        var val45 = $('.quform-field-27_436').val();
        if (val45 && val45.length && $.isNumeric(val45)) {
            total4 += parseFloat(val45);
            total5 += parseFloat(val45);
            total6 += parseFloat(val45);
        }

        // Display the result to the user
       $('#form-total4').text('Total:' + total4);

        // Set the value of the hidden field 
       $('.quform-field-27_442').val(total4);
        
        // Display the result to the user
       $('#form-total5').text('Total:' + total5);

        // Set the value of the hidden field 
       $('.quform-field-27_445').val(total5);

       // Display the result to the user
       $('#form-total6').text('Total:' + total6);

        // Set the value of the hidden field 
       $('.quform-field-27_448').val(total6);
 };

    // Calculate on page load
    calculate();
 
    // Recalculate when these text input fields are changed
    $('.quform-field-27_121, .quform-field-27_23, .quform-field-27_94, .quform-field-27_67, .quform-field-27_427, .quform-field-27_428, .quform-field-27_429, .quform-field-27_430, .quform-field-27_431, .quform-field-27_240, .quform-field-27_267, .quform-field-27_294, .quform-field-27_321, .quform-field-27_432, .quform-field-27_433, .quform-field-27_434, .quform-field-27_435, .quform-field-27_436').on('keyup blur', calculate);
});