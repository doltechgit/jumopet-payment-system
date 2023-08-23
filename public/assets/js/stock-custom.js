const stk_product = $("#product");
const stk_quantity = $("#stk_quantity");
const add_quantity = $("#add_quantity");
const new_quantity = $("#new_quantity");

stk_product.change(function (e) {
e.preventDefault()
    add_quantity.val('')
    new_quantity.val('')
    $.ajax({
        type: "GET",
        url: "/get_product/" + stk_product.val(),
        success: function (response) {
            const product = response.product;
            console.log(product);
            stk_quantity.val(product.quantity);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
    
    console.log(stk_quantity.val());
});
add_quantity.change (function () {
    new_quantity.val(
        parseFloat(stk_quantity.val()) + parseFloat(add_quantity.val()));
    round(new_quantity.val());
});


