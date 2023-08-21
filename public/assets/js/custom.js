$(document).ready(function () {
    // Transcation
    const prdouct_id = document.getElementById("product_id");
    const buy_product = document.getElementById("buy_product");
    const unit_price = $(".unit_price");
    const disc_est = $(".disc_est");
    const discount = $(".discount");
    const buy_quantity = $(".buy_quantity");
    const price = $(".buy_price");
    const price_display = $(".price_display");
    const category = $(".product");
    const paid = $(".paid");
    const balance = $(".balance");
    const amount = $(".amount");

    category.change(function () {
        $.ajax({
            type: "GET",
            url: "/get_product/" + category.val(),
            success: function (response) {
                const product = response.product;
                console.log(product);
                unit_price.val(product.price);
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
console.log(unit_price.val())
        if (buy_quantity.val() > 0 || disc_est.val() > 0) {
            
            const total_price =
                parseFloat(buy_quantity.val()) * parseFloat(unit_price.val());

            const discount_price =
                parseFloat(buy_quantity.val()) *
                parseFloat(unit_price.val()) *
                disc_est.val();

            price.val(total_price - discount_price);
            price_display.text(new Intl.NumberFormat().format(price.val()));
        } else if (buy_quantity.val() > 0) {
           
            price.val(
                parseFloat(buy_quantity.val()) * parseFloat(unit_price.val())
            );
            price_display.text(new Intl.NumberFormat().format(price.val()));
        }
    });
    discount.change(function () {
        disc_est.val(parseFloat(discount.val()) / 100);
        const total_price =
            parseFloat(buy_quantity.val()) * parseFloat(unit_price.val());

        const discount_price =
            parseFloat(buy_quantity.val()) *
            parseFloat(unit_price.val()) *
            disc_est.val();

        price.val(total_price - discount_price);
        price_display.text(new Intl.NumberFormat().format(price.val()));
    });
    const quantityChange = function () {
       
        if (disc_est.val() > 0) {
            const total_price =
                parseFloat(buy_quantity.val()) * parseFloat(unit_price.val());

            const discount_price =
                parseFloat(buy_quantity.val()) *
                parseFloat(unit_price.val()) *
                disc_est.val();
            price.val(total_price - discount_price);
            price_display.text(price.val());
        } else if (parseFloat(category.val()) > 0) {
            price.val(
                parseFloat(buy_quantity.val()) * parseFloat(unit_price.val())
            );
            price_display.text(new Intl.NumberFormat().format(price.val()));
        } else {
            price.val(
                parseFloat(buy_quantity.val()) * parseFloat(unit_price.val())
            );
            price_display.text(new Intl.NumberFormat().format(price.val()));
        }
    };
    buy_quantity.change(quantityChange);
    paid.change(function () {
        balance.val(parseFloat(price.val()) - parseFloat(paid.val()));
    });

    amount.change(function () {
        buy_quantity.val(parseFloat(amount.val()) / parseFloat(unit_price.val()));
        price.val(parseFloat(buy_quantity.val()) * parseFloat(unit_price.val()));
        price_display.text(new Intl.NumberFormat().format(price.val()));
    });
});

$(document).ready(function () {
    // Search Functionality
    $(".navbar-search").on("submit", function (e) {
        // alert('heere')
        e.preventDefault();
        let query = $(".search_query").val();
        if (!query) {
            $("#s_result").html(
                "<td class='text-danger'>Search Query is Empty</td>"
            );
        }
        $.ajax({
            type: "GET",
            url: "/search_client/" + query,
            success: function (response) {
                const client = response.client;
                console.log(client);
                $.each(client, function (i, item) {
                    $("#s_result").html(
                        "<td>" +
                            item.name +
                            "</td>" +
                            "<td>" +
                            item.phone +
                            "</td>" +
                            '<td><a href="/clients/' +
                            item.id +
                            '"><button type="button" class="btn btn-light"><i class="fa fa-edit"></i></button></a></td>'
                    );
                });
            },
            error: function (xhr, status, error) {
                console.log(error);
                $("#s_result").html(
                    "<td class='text-danger'>" + error + "</td>"
                );
            },
        });
        $(".search-result").removeClass("d-none");
    });
    $("#close_search").on("click", function () {
        $(".search-result").addClass("d-none");
    });
});

// $(document).ready(function () {
//     $(".transaction_form").on("submit", function (e) {
//         e.preventDefault();

//         $(":input").each(function () {
//             if ($(this).val() === "") {
//                 $("#error_ms").text("Empty Fields");
//             }
//         });
//         confirm(
//             "Please Check Details again and be sure before confirming transaction."
//         );
//         $.ajax({
//             type: "POST",
//             url: "/transactions/store",
//             data: new FormData(this),
//             dataType: "JSON",
//             contentType: false,
//             cache: false,
//             processData: false,
//             beforeSend: function () {
//                 $(".submit_transaction").text("Loading...");
//             },
//             success: function (response) {
//                 $(".transaction_form").trigger("reset");
//                 window.location.replace(
//                     "https://mattel.com.ng/" + response.redirect
//                 );
//                 console.log(response);
//             },
//             complete: function () {
//                 $(".submit_transaction").text("Done");
//             },
//         });
//     });
// });

$(document).ready(function () {
    $(".category").change(function () {
        $('.product').empty()
        const ctg = $(".category").val();
        $.ajax({
            type: "GET",
            url: "/get_category/" + ctg,
            success: function (response) {
                const products = response.products;
                console.log(products);
                $(".product").append(
                    "<option value='Select Product'>Select Product</option>"
                );
                $.each(products, function (i, item) {
                    $(".product").append(
                        "<option value=" +
                            item.id +
                        ">" + item.name + "</option>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.log(error);
                $(".product").html(
                    "<option value=" +
                        error +
                        ">" +
                        error +
                        "</option>"
                );
            },
        });
    });
});

$(document).ready(function () {
    // $('.custom-alert').delay(4000).slideUp(500, function () {
    //     $(".custom-alert").fadeTo(2000, 0)
    // })
    $(".custom-alert").delay(4000).fadeTo(4000, 0);
});

// $(document).ready(function () {
//     Client Transaction Pop Up Functionality
//     $(".new_transaction").on("click", function () {
//         $("#transactionModal").modal("show");
//         let trans_id = $(this).val();
//         $.ajax({
//             type: "GET",
//             url: "/get_client/" + trans_id,
//             success: function (response) {
//                 let client = response.client;
//                 let cl_category = response.category;
//                 console.log(cl_category);
//                 $(".client_id").val(client.id);
//                 $(".name").text(client.name);
//                 $(".phone").text(client.phone);
//                 $(".address").text(client.address);
//                 $(".cl_category").val(cl_category);
//                 $(".cl_unit_price").val(cl_category);
//             },
//         });
//     });
// });
