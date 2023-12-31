$(document).ready(function () {
    const discount = $(".discount");
    const buy_quantity = $(".buy_quantity");
    const price = $(".buy_price");
    const price_display = $(".price_display");
    const category = $(".product");
    const paid = $(".paid");
    const balance = $(".balance");

    const getCart = function (carts, cart_sum) {
        if (cart_sum > 0) {
            $(".cart").empty();
            $(".empty_cart").empty();

            $.each(carts, function (i, item) {
                $(".cart").append(
                    "<div class='cart_item d-flex align-items-center my-2'><input type='hidden' class='cart_id' value=" +
                        item.id +
                        "><p class='col-md-8 px-0'>" +
                        item.name +
                        "</p><input type='number' class='w-25 form-control text-center item_quantity' value=" +
                        item.quantity +
                        "><button class='clear_item btn btn-sm'><i class='fa fa-trash'></i></span></button></div>"
                );
            });
            $(".clear_item").on("click", function (e) {
                e.preventDefault();

                let cart_id = $(this).closest(".cart_item").find(".cart_id");
                console.log(cart_id.val());
                $.ajax({
                    type: "GET",
                    url: "/carts/delete/" + cart_id.val(),
                    success: function (response) {
                        let carts = response.carts;
                        let cart_sum = response.cart_sum;

                        getCart(carts, cart_sum);
                        $(".cart_amount").text(cart_sum);
                        price.val(cart_sum);
                        price_display.text(
                            new Intl.NumberFormat().format(price.val())
                        );
                    },
                });
                $(this).closest(".cart_item").remove();
            });

            // $(".minus_quantity").on("click", function () {
            //     let item_quantity = $(this)
            //         .closest(".cart_item")
            //         .find(".item_quantity");
            //     console.log(item_quantity.val());

            //     if (item_quantity.val() <= 0) {
            //         item_quantity.val();
            //     } else {
            //         item_quantity.val(item_quantity.val() - 1);
            //     }
            // });
            // $(".plus_quantity").on("click", function () {
            //     let item_quantity = $(this)
            //         .closest(".cart_item")
            //         .find(".item_quantity");
            //     console.log(item_quantity.val());
            //     item_quantity.val(item_quantity.val()+ 1 );
            // });

            $(".item_quantity").change(function () {
                let cart_id = $(this).closest(".cart_item").find(".cart_id");
                console.log(cart_id.val());
                let cart_item = {
                    _token: $("#csrf_token")[0].content,
                    quantity: $(this).val(),
                };
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    method: "POST",
                    url: "/carts/update/" + cart_id.val(),
                    data: cart_item,
                    success: function (response) {
                        let carts = response.carts;
                        let cart_sum = response.cart_sum;
                        getCart(carts, cart_sum);
                        $(".cart_amount").text(cart_sum);
                        price.val(cart_sum);
                        price_display.text(
                            new Intl.NumberFormat().format(price.val())
                        );
                        if (response.message) {
                            alert(response.message);
                        }
                        if (cart_sum > 0) {
                            $(".cart_total").show();
                            $(".clear_cart").show();
                        }
                    },
                });
            });
        } else if (cart_sum <= 0) {
            $(".cart_total").hide();
            $(".clear_cart").hide();
            $(".cart").append("<p class='empty_cart'>Cart is Empty</p>");
        }
    };

    $.ajax({
        type: "GET",
        url: "/carts/",
        success: function (response) {
            let carts = response.carts;
            let cart_sum = response.cart_sum;
            getCart(carts, cart_sum);
            $(".cart_amount").text(cart_sum);
            price.val(cart_sum);
            price_display.text(new Intl.NumberFormat().format(price.val()));

            if (cart_sum > 0) {
                $(".cart_total").show();
                $(".clear_cart").show();
            }
        },
    });

    $(".add_cart").on("click", function (e) {
        e.preventDefault();
        let cart_item = {
            _token: $("#csrf_token")[0].content,
            product_id: $(".product").val(),
            quantity: $(".buy_quantity").val(),
        };
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "POST",
            url: "/carts/store",
            data: cart_item,
            success: function (response) {
                let carts = response.carts;
                let cart_sum = response.cart_sum;
                getCart(carts, cart_sum);
                $(".cart_amount").text(cart_sum);
                price.val(cart_sum);
                price_display.text(new Intl.NumberFormat().format(price.val()));
                if (response.message) {
                    alert(response.message);
                }
                if (cart_sum > 0) {
                    $(".cart_total").show();
                    $(".clear_cart").show();
                }
            },
        });
    });

    $(".clear_cart").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/clear_cart",
            success: function (response) {
                let carts = response.carts;
                let cart_sum = response.cart_sum;
                getCart(carts);
                $(".cart_amount").text(cart_sum);
                price.val(cart_sum);
                price_display.text(new Intl.NumberFormat().format(price.val()));
                console.log(response);
                $(".clear_cart").hide();
                $(".cart_total").hide();
                $(".cart").empty();
                $(".cart").append("<p class='empty_cart'>Cart is Empty</p>");
            },
        });
    });

    discount.change(function () {
        price.val(parseFloat(price.val()) - parseFloat(discount.val()));
        console.log(price.val());
        price_display.text(new Intl.NumberFormat().format(price.val()));
    });
    paid.change(function () {
        balance.val(parseFloat(price.val()) - parseFloat(paid.val()));
    });
});

// Search Functionality
$(document).ready(function () {
    $(".navbar-search").on("submit", function (e) {
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

// Transaction Confirmation
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

// $(document).ready(function () {
//     $(".category").change(function () {
//         $('.product').empty()
//         const ctg = $(".category").val();
//         $.ajax({
//             type: "GET",
//             url: "/get_category/" + ctg,
//             success: function (response) {
//                 const products = response.products;
//                 console.log(products);
//                 $(".product").append(
//                     "<option value=''>Select Product</option>"
//                 );
//                 $.each(products, function (i, item) {
//                     $(".product").append(
//                         "<option value=" +
//                             item.id +
//                         ">" + item.name + "</option>"
//                     );
//                 });
//             },
//             error: function (xhr, status, error) {
//                 console.log(error);
//                 $(".product").html(
//                     "<option value=" +
//                         error +
//                         ">" +
//                         error +
//                         "</option>"
//                 );
//             },
//         });
//     });
// });

// Alert Pop-up
$(document).ready(function () {
    $(".custom-alert").delay(4000).fadeTo(4000, 0);
});

//  Client Transaction Pop Up Functionality
// $(document).ready(function () {
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
