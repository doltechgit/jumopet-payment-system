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
                                            <select class="form-control product"  name="product" value="{{old('product')}}" required>
                                                <option value="">Product</option>
                                                @foreach ($products as $product )
                                                <option value="{{$product->id}}">{{$product->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </span>
                                    <div class="col-lg-6 row">
                                        <span class="col-lg-10 col-md-12 ">
                                            <div class="form-group">
                                                <!-- <label><small>Quantity</small></label> -->
                                                <input class="form-control buy_quantity" type="number" step="any" name="buy_quantity" id="buy_quantity" placeholder="0 crates" value="{{ old('buy_quantity') == null ? 1 : old('buy_quantity') }}" />
                                                @error('quantity')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </span>
                                        <span class=" ">
                                            <span class="btn btn-primary btn-sm add_cart"><i class="fa fa-plus"></i></span>
                                        </span>
                                    </div>


                                </div>

                                <div class="row">
                                    <span class="col-lg-6 col-md-12 px-2">
                                        <div class="form-group">
                                            <label><small>Payment Method:</small></label>
                                            <select class="form-control method" id="method" name="method" value="{{old('method')}}" required>
                                                <option value="">Payment Method</option>
                                                <option value="Cash">Cash</option>
                                                <option value="POS">POS</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                        </div>
                                    </span>
                                    <span class="col-lg-6 col-md-12 px-2">
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
                    <p class="empty_cart">Cart is Empty</p>
                </div>
                <div class="cart_total " style="display: none;">
                    <h6>Total</h6> <span class="cart_amount">0</span>
                </div>

            </div>
            <div class="  my-4">
                <small>RGB Refill Details</small>
                <hr>
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="col-lg-6 col-md-12">
                        <small>Filled</small>
                        <h5>0</h5>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <small>Empty</small>
                        <h5>{{$rgb->quantity}}</h5>
                    </div>
                </div>
            </div>
            <div class="  my-4">
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
            </div>







        </div>
    </div>
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Clients</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="homeTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Client Category</th>
                            <th>Transaction Count</th>
                            <th>Coupon</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$clients)
                        <tr>
                            <td>No Client yet..</td>
                        </tr>
                        @endif
                        @foreach ($clients->keyBy('created_at') as $client)


                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->phone}}</td>
                            <td>{{count($client->transactions)}}</td>
                            <td>Nil</td>
                            <!-- <td>
                                <x-table-list-menu show="transactions" delete="transactions/delete" :id='$client->id' />
                            </td> -->
                            <td>
                                <a href="/clients/{{$client->id}}">
                                    <button type="button" class="btn btn-light">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </td>
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

</x-layout>