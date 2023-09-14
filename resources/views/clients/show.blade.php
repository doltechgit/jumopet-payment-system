<x-layout>

    <div class="row mb-4" id="client_transaction" style="display: none;">
        <div class=" col-lg-8 col-md-12 ">
            <!-- Content Row -->
            <div class="bg-white p-3">
                <div class="w-100">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <h4>{{$client->name}}</h4>
                        <button class="btn btn-sm " id="close_transaction"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="card-body">
                        <form class="transaction_form" method="POST" action="transactions/store">
                            @csrf
                            <small id="error_ms"></small>
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <input type="hidden" name="transaction_id" value="TXN_{{rand(0, 1000).time()}}">
                            <div class="col-md-12   p-0">
                                <div class="row">
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <input class="form-control name" type="hidden" name="name" id="name" placeholder="Customer's Name" value="{{$client->name}}" />
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </span>
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <input class="form-control phone" type="hidden" name="phone" id="phone" placeholder="Customer's Phone" value="{{$client->phone}}" />
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
                                    <div class="col-lg-6 d-flex justify-content-between px-0">
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
                                    </div>


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
                    <h5 class="font-weight-bold">Cart</h5>
                    <button class="btn btn-sm btn-danger clear_cart" style="display: none;">Empty Cart</button>
                </div>

                <hr>
                <div class="cart">

                </div>
                <div class="cart_total " style="display: none;">
                    <h6>Total</h6> <span class="cart_amount">0</span>
                </div>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-start flex-wrap p-0 my-4">
        <div class="bg-white col-lg-5 card border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold">Client Details</h5>
                <button class="btn btn-sm btn-primary" id="open_client_transaction"><i class="fa fa-book"></i></button>
            </div>
            <div class="card-body">
                <div class="row">
                    <span class=" col-lg-6"><small>Name: </small>
                        <h5 class="font-weight-bold">{{$client->name}}</h5>
                    </span>

                    <span class=" col-lg-6"><small>Phone: </small>
                        <h5 class="font-weight-bold">{{$client->phone}}</h5>
                    </span>

                </div>
                <div class="my-2 row">
                    <span class=" col-lg-6">
                        <small> Outstanding Payment:</small>
                        <h4 class="font-weight-bold">&#8358; {{number_format($balance)}}</h4>
                    </span>
                    <span class=" col-lg-6">
                        <small> Transaction Count:</small>
                        <h4 class="font-weight-bold">{{count($client->transactions)}}</h4>
                    </span>
                    @if($client->coupon)
                    <span class=" col-md-4">
                        <small> Coupon Code:</small>
                        <h6>{{$client->coupon->code}}</h6>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card border-0 col-lg-6">
            <div class="card-header">
                <h5 class="font-weight-bold">Edit Client Details</h5>
            </div>
            <form method="POST" action="clients/update/{{$client->id}}" class="p-2">
                @csrf
                <table class="table table-borderless p-0 m-0">

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Client's Name:</label>
                            </td>
                            <td style="width: 75%">
                                <input class="form-control" name="name" placeholder="Client Name" value="{{$client->name}}" />
                            </td>
                        </tr>
                    </div>

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Phone:</label>
                            </td>
                            <td class="">
                                <input class="form-control" name="phone" placeholder="+23412345678" value="{{$client->phone}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Email Address:</label>
                            </td>
                            <td>
                                <input class="form-control" name="email" placeholder="Enter Email Address..." value="{{$client->email}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Address:</label>
                            </td>
                            <td>
                                <input class="form-control" name="address" placeholder="Nigeria" value="{{$client->address}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Date of Birth:</label>
                            </td>
                            <td>
                                <input class="form-control" type="date" name="dob" value="{{$client->dob}}" />
                            </td>
                        </tr>
                    </div>

                </table>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary form-control my-3" value="Save Client Details" />
                </div>
            </form>
        </div>
    </div>
    <div class="card col-md-12 mx-2">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Transactions History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="homeTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Details</th>
                            <th>Payment/Balance</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$client->transactions)
                        <tr>
                            <td>No Transactions yet. You can make one <a href="/">here</a></td>
                        </tr>
                        @endif
                        @foreach ($client->transactions->keyBy('created_at') as $transaction)
                        <tr>
                            <td>
                                <a href="/transactions/{{$transaction->id}}">
                                    <small>{{$transaction->created_at}}</small>
                                    <h6>{{$transaction->trans_id}}</h6>
                                </a>
                            </td>
                            <td>
                                <h6 class="p-0 m-0">&#8358; {{number_format($transaction->price)}}</h6>
                                <small>Quantity: {{$transaction->quantity}} Crates</small>
                                <small>Discount: {{$transaction->discount}} %</small>
                            </td>
                            <td>
                                <h6>&#8358; {{number_format($transaction->paid)}}</h6>
                                To Bal: &#8358; {{number_format($transaction->balance)}}

                            </td>
                            <td>
                                <x-table-list-menu show="transactions" delete="transactions/delete" :id='$transaction->id' />
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#open_client_transaction").on('click', function() {
                console.log('here')
                $("#client_transaction").show()
            })

            $("#close_transaction").on('click', function() {
                $("#client_transaction").hide()
            })
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
            })
            $(document).on('click', '.remove_method', function() {
                console.log('remove')
                $(this).closest('.added_method').remove()
            })
            $(document).on('click', '.apply_discount', () => {
                console.log('show')
                $('.discount_area').show()
            })

        })
    </script>


</x-layout>