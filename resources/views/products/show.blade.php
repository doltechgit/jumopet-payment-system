<x-layout>
    <div class="d-flex justify-content-center align-items-center flex-wrap">
        <div class="card col-md-3 border-left-primary p-2">
            <small>Today</small>
            <h4>{{$today_qty}} Crates</h4>
            <small>Total Amount: &#8358; {{number_format($today_amt)}}</small>
        </div>
        <div class="card col-md-3 border-left-danger p-2">
            <small>This Week</small>
            <h4>{{$this_week_qty}} Crates</h4>
            <small>Total Amount: &#8358; {{number_format($this_week_amt)}}</small>
        </div>
        <div class="card col-md-3 border-left-warning p-2">
            <small>Last Week</small>
            <h4>{{$last_week_qty}} Crates</h4>
            <small>Total Amount: &#8358; {{number_format($last_week_amt)}}</small>
        </div>
        <div class="card col-md-3 border-left-primary p-2">
            <small>Last Month</small>
            <h4>{{$last_month_qty}} Crates</h4>
            <small>Total Amount: &#8358; {{number_format($last_month_amt)}}</small>
        </div>
    </div>
    <div class="card  my-3">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Order History for {{$product->name}}</h6>
            <div>
                <div class="dropdown  d-sm-inline-block">
                    <button class=" btn btn-sm btn-success shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i> Download Records
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="export">CSV</a>
                        <a class="dropdown-item" href="#">PDF</a>

                    </div>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table transTable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Quantity Ordered</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$product->orders)
                        <tr>
                            <td>No Transactions yet. You can make one <a href="/">here</a></td>
                        </tr>
                        @endif
                        @foreach ($product->orders->keyBy('created_at') as $order)

                        @php
                        $date = date('d-m-Y', $order->created_at->timestamp);
                        @endphp
                        <tr>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->transaction->trans_id}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->amount}}</td>
                            <!-- <td>
                                <x-table-list-menu show="orders" delete="orders/delete" :id='$order->id' />
                            </td> -->
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @role('admin')
    <div class="card my-5">
        <div class="card-header">
            <h6>Edit Product</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="products/update/{{$product->id}}">
                @csrf
                <table class="table table-borderless p-0 m-0">

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Product Name:</label>
                            </td>
                            <td style="width: 75%">
                                <input class="form-control" name="name" placeholder="Enter Store Name..." value="{{$product->name}}" />
                            </td>
                        </tr>
                    </div>

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Price:</label>
                            </td>
                            <td class="">
                                <input class="form-control" name="price" placeholder="0.00" value="{{$product->price}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Size:</label>
                            </td>
                            <td class="">
                                <input class="form-control" name="size" placeholder="0CL" value="{{$product->size}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Product Category:</label>
                            </td>
                            <td>
                                <select class="form-control category" id="category" name="category_id" value="{{old('category')}}" required>
                                    <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                                    @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>

                                    @endforeach

                                </select>
                            </td>
                        </tr>
                    </div>
                </table>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save Product" />
                </div>
            </form>
        </div>
    </div>
    @endrole
</x-layout>