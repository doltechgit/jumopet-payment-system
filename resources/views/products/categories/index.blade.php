<x-layout>
    <div class="bg-white border  d-flex p-3 mx-auto mb-4">

        <div class="w-100">
            <div class="card-header border-0">
                <h4>New Category</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/categories/store">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <input class="form-control " type="text" name="name" id="name" placeholder="Category Name" value="{{old('name')}}" />
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="text" name="slug" id="slug" placeholder="Slug" value="{{old('slug')}}" />
                        @error('slug')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="number" step="any" name="price" id="price" placeholder="Price per Unit" value="{{old('price')}}" />
                        @error('price')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add Category" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">All Categories</h6>
            <!-- <div>
                    <a href="/products/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm disabled"><i class="fas fa-download fa-sm text-white-50"></i> Download Excel File</a>
                </div> -->
        </div>
        <div class="card-body">
            <div class="table-responsive" id="productTableWrap">
                <table class="table " id="productTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Price per unit (&#8358;)</th>
                            <th>Slug</th>
                            <th>Refill</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category )
                        <tr>

                            <td>{{$category->name}}</td>
                            <td>&#8358; {{number_format($category->price)}}</td>
                            <td>{{$category->slug}}</td>
                            <!-- <td>

                                <x-table-list-menu show="categories" delete="categories/delete" :id='$category->id' approve />
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>