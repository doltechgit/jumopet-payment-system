<x-layout>
    <div class=" my-4 row ">
        <div class="card mx-2">
            <div class="card-header">
                <h6 class="font-weight-bold">Transaction Summary</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning p-2 my-2">Total</div>
                <div class="row">
                    <div class="mx-3">
                        <small>Discounts</small>
                        <h5>&#8358;{{number_format($discount)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Paid</small>
                        <h5>&#8358;{{number_format($paid)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Outstanding</small>
                        <h5>&#8358;{{number_format($balance)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Amount</small>
                        <h5>&#8358;{{number_format($total)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Expected</small>
                        <h5>&#8358;{{number_format($total + $discount)}}</h5>
                    </div>
                </div>
                <div class="alert alert-success p-2 my-2">Total Paid (Payment Method) </div>
                <div class="row">
                    <div class="mx-3">
                        <small>Cash</small>
                        <h5>&#8358;{{number_format($cash)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>POS</small>
                        <h5>&#8358;{{number_format($pos)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Transfer</small>
                        <h5>&#8358;{{number_format($transfer)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Amount</small>
                        <h5>&#8358;{{number_format($cash + $pos + $transfer)}}</h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mx-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold">Transaction Summary</h6>
                <div class="dropdown  d-sm-inline-block">
                    <select class=" btn btn-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i> Today
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <option class="dropdown-item">Today</option>
                            <option class="dropdown-item">This Week</option>
                            <option class="dropdown-item">This Month</option>
                        </div>
                    </select>

                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-danger p-2 my-2">Today </div>
                <div class="row">
                    <div class="mx-3">
                        <small>Discounts</small>
                        <h5>&#8358;{{number_format($discount_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Paid</small>
                        <h5>&#8358;{{number_format($paid_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Outstanding</small>
                        <h5>&#8358;{{number_format($balance_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Amount</small>
                        <h5>&#8358;{{number_format($paid_today + $balance_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Expected</small>
                        <h5>&#8358;{{number_format($paid_today + $balance_today + $discount_today)}}</h5>
                    </div>
                </div>

                <div class="alert alert-danger p-2 my-2">Today: Amount Paid (Payment Method) </div>
                <div class="row">
                    <div class="mx-3">
                        <small>Cash Transactions</small>
                        <h5>&#8358;{{number_format($cash_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>POS Transactions</small>
                        <h5>&#8358;{{number_format($pos_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Transfer</small>
                        <h5>&#8358;{{number_format($transfer_today)}}</h5>
                    </div>
                    <div class="mx-3">
                        <small>Total Amount</small>
                        <h5>&#8358;{{number_format($cash_today + $pos_today + $transfer_today)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @role('admin')
    <div class="d-flex justify-content-between align-items-stretch flex-wrap">
        <div class="card w-100 mx-2">
            <div class="card-header">
                <h6 class="font-weight-bold">Filter by Payment Method</h6>
            </div>
            <form method="POST" action="transactions/generate_method" class="card-body">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="method">
                        <option value="cash">Cash</option>
                        <option value="pos">POS</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label><small>From:</small></label> -->
                    <input type="date" name="from" class="form-control" />
                </div>
                <div class="form-group">
                    <!-- <label><small>To:</small></label> -->
                    <input type="date" name="to" class="form-control" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Generate Report</button>
                </div>
            </form>
        </div>
        <div class="card w-100  mx-2">
            <div class="card-header">
                <h6 class="font-weight-bold">Filter Transaction Records</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="transactions/generate">
                    @csrf
                    <div class="form-group">
                        <label><small>From:</small></label>
                        <input type="date" name="from" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label><small>To:</small></label>
                        <input type="date" name="to" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Generate Report</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    @endrole
    <div class="card  my-3">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Transactions</h6>
            <div>
                <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Transaction</a>
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
                            <th>Transaction ID</th>
                            <th>Details</th>
                            <th>Client</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$transactions)
                        <tr>
                            <td>No Transactions yet. You can make one <a href="/">here</a></td>
                        </tr>
                        @endif
                        @foreach ($transactions->keyBy('created_at') as $transaction)

                        @php
                        $date = date('d-m-Y', $transaction->created_at->timestamp);
                        @endphp
                        <tr>
                            <td>
                                <a href="transactions/{{$transaction->id}}">
                                    <small>{{$transaction->created_at}}</small>
                                    <h6>{{$transaction->trans_id}}</h6>
                                </a>
                            </td>

                            <td>
                                <h5>&#8358; {{number_format($transaction->price)}}</h5>
                                <small>Discount: &#8358; {{$transaction->discount}}</small>
                                <small>Payment Method:
                                    @if ($transaction->pay_method == 'Paid')
                                    @foreach ($transaction->methods as $method)
                                    {{$method->method}} - &#8358; {{$method->amount}}
                                    @endforeach
                                    @else
                                    {{$transaction->pay_method}}
                                    @endif
                                </small>
                            </td>
                            @if($transaction->client !== null)
                            <td>
                                <a href="clients/{{$transaction->client->id}}">
                                    <h6>{{$transaction->client->name}}</h6>
                                </a>
                                <small>Contact: {{$transaction->client->phone}}</small>
                            </td>
                            @else
                            <td>
                                <h6>{{$transaction->client_name}}</h6>
                                <small>Client Record not available</small>
                            </td>
                            @endif
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

</x-layout>