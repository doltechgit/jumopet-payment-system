<x-layout>

    <div class="row mb-4">
        <div class=" col-lg-8 col-md-12 ">
            <!-- Content Row -->
            <div class="bg-white p-3">

                <div class="w-100">
                    <div class="card-header border-0">
                        <h4>New Transaction</h4>
                    </div>
                    <div class="card-body">
                        <form class="transaction_form" method="POST" action="transactions/store">
                            @csrf
                            <small id="error_ms"></small>

                            <input type="hidden" name="transaction_id" value="TXN_{{rand(0, 1000).time()}}">
                            <div class="col-md-12   p-0">
                                <div class="row">
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <input class="form-control name" type="text" name="name" id="name" placeholder="Customer's Name" value="{{old('name')}}" />
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <input class="form-control phone" type="text" name="phone" id="phone" placeholder="Customer's Phone" value="{{old('phone')}}" />
                                            @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                </div>

                                <div class="row">
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <select class="form-control product" name="product" value="{{old('product')}}">
                                                <option value="">Product</option>
                                                @foreach ($products as $product )
                                                <option value="{{$product->id}}">{{$product->name}} - {{$product->size}} CL</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>
                                    <span class="col-lg-6 d-flex justify-content-between px-0">
                                        <span class="col-lg-10 col-md-12">
                                            <div class="form-group">
                                                <!-- <label><small>Quantity</small></label> -->
                                                <input class="form-control buy_quantity" type="number" step="any" name="buy_quantity" id="buy_quantity" placeholder="0 crates" value="{{ old('buy_quantity') == null ? 1 : old('buy_quantity') }}" />
                                                @error('quantity')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </span>
                                        <span class=" ">
                                            <span class="btn btn-primary btn-sm add_cart"><i class="fa fa-shopping-cart"></i></span>
                                        </span>
                                    </span>


                                </div>
                                <div class="method_area">
                                    <div class="row">
                                        <span class="col-lg-6 col-md-12 px-2">
                                            <div class="form-group">
                                                <select class="form-control method" id="method" name="method[]" value="{{old('method')}}" required>
                                                    <option value="">Payment Method</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="POS">POS</option>
                                                    <option value="Transfer">Transfer</option>
                                                </select>
                                            </div>
                                        </span>
                                        <span class="col-lg-6 d-flex justify-content-between px-0">
                                            <span class="col-lg-10 col-md-12">
                                                <div class="form-group">

                                                    <input class="form-control method_amount" type="number" step="any" name="method_amount[]" id="" placeholder="" required />
                                                    @error('discount')
                                                    <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </span>
                                            <span class="">
                                                <span class="btn btn-primary btn-sm add_method"><i class="fa fa-plus"></i></span>
                                            </span>
                                        </span>
                                    </div>

                                </div>

                                <div class="">
                                    <span class="btn btn-sm text-primary apply_discount">Apply Discount</span>
                                </div>
                                <div class="row discount_area" style="display: none;">
                                    <span class="col-lg-12 col-md-12 px-2">
                                        <div class="form-group">
                                            <label><small>Discount:</small></label>
                                            <input class="form-control discount" type="number" step="any" name="discount" id="discount" placeholder="Discount" value="0" />
                                            @error('discount')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                </div>


                                <div class="row">
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <label><small>Paid:</small></label>
                                            <input class="form-control paid" type="number" step="any" name="paid" id="paid" placeholder="&#8358; 000.00" value="{{old('paid')}}" required />
                                            @error('paid')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <label><small>To Balance:</small></label>
                                            <input class="form-control balance" type="number" step="any" name="balance" id="balance" placeholder="&#8358; 000.00" value="{{old('balance')}}" />
                                            @error('balance')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                </div>

                            </div>
                            <div class="form-group">
                                <input class="form-control buy_price" type="hidden" name="buy_price" id="buy_price" placeholder="Total Price" value="{{old('price')}}" />
                                @error('price')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="display_price text-center ">
                                <small class="">Total Price:</small>
                                <h3 class="mx-4 font-weight-bold ">&#8358; <span class="price_display" id="price_display">000.00</span></h3>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit_transaction">Save Transaction</button>
                                <button type="reset" class="btn btn-secondary"><i class="fa fa-redo"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white col-lg-4 col-md-12  p-4">
            <div class="cart-area mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-bold"><i class="fa fa-shopping-cart"></i> Cart</h5>
                    <button class="btn btn-sm btn-danger clear_cart" style="display: none;"><i class="fa fa-trash"></i> Empty Cart</button>
                </div>

                <hr>
                <div class="cart">

                </div>
                <div class="cart_total " style="display: none;">
                    <h6>Total</h6> <span class="cart_amount">0</span>
                </div>

            </div>
            <div class="  my-4">
                <small>RGB Refill Details</small>
                <hr>
                <div class="d-flex justify-content-even">
                    <div class="col-lg-6 col-md-12">
                        <small>Empty Bottles</small>
                        <h4>{{$rgb->quantity}}</h4>
                    </div>
                </div>
            </div>
            <!-- <div class="  my-4">
                <small>Product Prices</small>
                <hr>
                <div class="">
                    @foreach ($categories as $category )
                    <div class="d-flex justify-content-between">
                        <span>{{$category->name}}</span>
                        <span>&#8358; {{$category->price}}</span>
                    </div>
                    @endforeach
                </div>
            </div> -->







        </div>
    </div>

    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">All Products</h6>
            @role('admin')
            <div>
                <a href="/products/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm disabled"><i class="fas fa-download fa-sm text-white-50"></i> Download Excel File</a> -->
            </div>
            @endrole
        </div>
        <div class="card-body">
            <div class="table-responsive" id="productTableWrap">
                <table class="table productTable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Current Quantity</th>
                            <th>Sold</th>
                            <th>Size</th>
                            <th>Category</th>
                            <th>Price per unit (&#8358;)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product )
                        <tr>
                            <td><a href="products/{{$product->id}}">{{$product->name}}</a></td>
                            <td>{{$product->quantity}} Crates</td>
                            @php $total_qty = 0

                            @endphp
                            <td> {{$product->orders->sum('quantity')}} Crates</td>
                            <td>{{$product->size}} CL</td>
                            <td>{{$product->category->name}}</td>
                            <td>&#8358; {{number_format($product->price)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Client Transaction Modal-->
    @include('partials._client-transaction')
    @include('partials._confirm-transaction')

    <script>
        $(document).ready(function() {

        })
        $(document).ready(function() {
            let sum = 0
            $(".add_method").on('click', function() {
                console.log('here')
                $(".method_area").append(
                    `
                    <div class="row added_method">
                        <span class="col-lg-6 col-md-12 px-2">
                            <div class="form-group">
                                <select class="form-control method" id="method" name="method[]" value="{{old('method')}}">
                                    <option value="">Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="POS">POS</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                        </span>
                        <span class="col-lg-6 d-flex justify-content-between px-0">
                            <span class="col-lg-10 col-md-12">
                                <div class="form-group">
                                    <input class="form-control method_amount" type="number" step="any" name="method_amount[]" id="" placeholder="" required />
                                    @error('discount')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </span>
                            <span class="">
                                <span class="btn  btn-sm remove_method"><i class="fa fa-times"></i></span>
                            </span>
                        </span>
                    </div>
                    `
                )
                // $('.method_amount').change(() => {

                //     console.log($('.method_amount').val())
                //     $('.method_amount').each(function() {
                //         sum += +$(this).val()
                //         $('.paid').val(sum)
                //     })

                // })

                $('.method_amount').on('input', function() {
                    let total = 0
                    $('.method_amount').each(function() {
                        total += parseFloat($(this).val())
                    })
                    $('.paid').val(parseFloat(total))
                    console.log(parseFloat(total))

                    $('.balance').val(parseFloat($('.buy_price').val()) - parseFloat(total));

                })
            })
            $(document).on('click', '.remove_method', function() {
                console.log('remove')
                $(this).closest('.added_method').remove()
            })
            $(document).on('click', '.apply_discount', () => {
                console.log('show')
                $('.discount_area').show()
            })

            $('.method_amount').on('input', function() {
                let total = 0
                $('.method_amount').each(function() {
                    total += parseFloat($(this).val())
                })
                $('.paid').val(parseFloat(total))
                console.log(parseFloat(total))

                $('.balance').val(parseFloat($('.buy_price').val()) - parseFloat(total));

            })

        })
    </script>
</x-layout>