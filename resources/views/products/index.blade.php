<x-layout>
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">All Products</h6>
            <div>
                <a href="/products/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm disabled"><i class="fas fa-download fa-sm text-white-50"></i> Download Excel File</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="productTableWrap">
                <table class="table " id="productTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Current Quantity</th>
                            <th>Category</th>
                            <th>Price per unit (#)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>

                                <x-table-list-menu show="products" delete="products/delete" :id='$product->id' approve />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>