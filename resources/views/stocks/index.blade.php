<x-layout>
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">All Stocks</h6>
            <div>
                <a href="/stocks/create" class=" btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Restock</a>
                <div class="dropdown d-none d-sm-inline-block">
                    <button class=" btn btn-sm btn-success shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i> Download Stock Inventory
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="stocks_export">CSV</a>
                        <a class="dropdown-item" href="#">PDF</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="stockTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Previous Quantity</th>
                            <th>Added Quantity</th>
                            <th>New Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$stocks)
                        <tr>
                            <td>No Inventory Record yet.</td>
                        </tr>
                        @endif

                        @foreach ($stocks as $stock )
                        <tr>

                            <td>{{$stock->created_at}}</td>
                            <td><a href=""></a>{{$stock->name}}</td>
                            <td>{{$stock->prev_quantity}}</td>
                            <td>{{$stock->add_quantity}}</td>
                            <td>{{$stock->new_quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>