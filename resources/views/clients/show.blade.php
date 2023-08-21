<x-layout>
    <div class="m-2">
        <div class="row p-0 my-4">
            <div class="col-lg-6 col-md-12 mx-2 ">
                <div class="bg-white card border-0 p-4">
                    <div class="row">
                        <span class=" col-md-4"><small>Name: </small>
                            <h5 class="font-weight-bold">{{$client->name}}</h5>
                        </span>

                        <span class=" col-md-4"><small>Phone: </small>
                            <h5 class="font-weight-bold">{{$client->phone}}</h5>
                        </span>

                    </div>
                    <div class="my-2 row">
                        <span class=" col-md-4">
                            <small> Outstanding Payment:</small>
                            <h6>&#8358; {{number_format($balance)}}</h6>
                        </span>
                        <span class=" col-md-4">
                            <small> Transaction Count:</small>
                            <h6>{{count($client->transactions)}}</h6>
                        </span>
                        @if($client->coupon)
                        <span class=" col-md-4">
                            <small> Coupon Code:</small>
                            <h6>{{$client->coupon->code}}</h6>
                        </span>
                        @endif
                    </div>

                </div>
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Client Details</h5>
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
            <div class="col-lg-5 col-md-12 card">
                <div class="card-header">
                    <h5 class="font-weight-bold">New Transaction</h5>
                </div>
                <div class="m-2">
                    <form method="POST" action="/transactions/client/{{$client->id}}">
                        @csrf
                        <input type="hidden" name="transaction_id" value="TXN_{{rand(0, 1000).time()}}">
                        <input type="hidden" class="client_id" name="client_id" id="client_id">
                        <input type="hidden" class="unit_price" name="unit_price" id="unit_price">
                        <input type="hidden" class="disc_est" name="disc_est" id="disc_est">

                        <table class="table table-borderless  p-0 m-0">
                            <div class="form-group">
                                <tr>
                                    <td><label>Category:</label></td>
                                    <td class="">
                                        <select class="form-control category" id="category" name="category" value="{{old('method')}}" required>
                                            <option value="category">Product Category</option>
                                            @foreach ($categories as $category )
                                            <option value="{{$category->slug}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label>Category:</label></td>
                                    <td class="">
                                        <select class="form-control product" id="product" name="product" value="{{old('product')}}" required>
                                            <option value="products">Product</option>

                                        </select>
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label>Payment Method:</label></td>
                                    <td class="">

                                        <select class="form-control" id="method" name="method" value="{{old('method')}}" placeholder="Quantity">
                                            <option value="Select KG">--Payment Method--</option>
                                            <option value="Cash">Cash</option>
                                            <option value="POS">POS</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>

                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td>
                                        <label class="mr-2" for="discount">Quantity: </label>
                                    </td>
                                    <td class="">


                                        <input class="form-control buy_quantity" type="number" step="any" name="buy_quantity" id="cl_quantity" placeholder="0 kg" value="{{old('buy_quantity')}}" />
                                        @error('quantity')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror

                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td>
                                        <label class="mr-2" for="amount">Amount: </label>
                                    </td>
                                    <td class="">
                                        <input class="form-control amount" type="number" step="any" name="amount" id="amount" placeholder="#000.00" value="{{old('amount')}}" />
                                        @error('amount')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror

                                    </td>
                                </tr>
                            </div>
                            <div class="form-group ">
                                <tr>
                                    <td>
                                        <label class="" for="discount">Discount: </label>
                                    </td>
                                    <td class="">

                                        <input class="form-control discount " type="number" step="any" name="discount" id="cl_discount" placeholder="Discount" value="0" />
                                        @error('discount')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group ">
                                <tr>
                                    <td>
                                        <label class="" for="paid">Paid: </label>
                                    </td>
                                    <td class="">

                                        <input class="form-control paid " type="number" step="any" name="paid" id="paid" placeholder="&#8358; 000.00" value="{{old('paid')}}" />
                                        @error('paid')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group ">
                                <tr>
                                    <td>
                                        <label class="" for="balance">To Balance: </label>
                                    </td>
                                    <td class="">

                                        <input class="form-control balance " type="number" step="any" name="balance" id="balance" placeholder="&#8358; 000.00" value="{{old('balance')}}" />
                                        @error('balance')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <tr>
                                <td class="">
                                    <div class="form-group">
                                        <input class="form-control buy_price" type="hidden" name="buy_price" id="cl_price" placeholder="Total Price" value="{{old('price')}}" />
                                        @error('buy_price')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="display_price  text-center">
                            <small>Total Price:</small>
                            <h3 class="mx-4 font-weight-bold">&#8358; <span class="price_display" id="cl_price_display">000.00</span></h3>
                        </div>
                        <div class="form-group m-3">
                            <input type="submit" class="btn btn-primary" value="Save Transaction" />
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-redo"></i></button>
                        </div>

                    </form>
                </div>

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
                                        <h6>{{$transaction->transaction_id}}</h6>
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
    </div>


</x-layout>