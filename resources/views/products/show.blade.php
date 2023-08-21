<x-layout>
    <div class="bg-white border col-md-12 d-flex p-3  ">

        <div class="w-100">
            <!-- <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h4>Edit Product</h4>
                <button class="btn btn-primary btn-sm">Add Category Price</button>
            </div> -->
            <div class="card-body row">
                <div class="col-md-7">
                    <form method="POST" action="/products/update/{{$product->id}}" class="user">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <input class="form-control " type="text" name="name" id="name" placeholder="Product Name" value="{{$product->name}}" />
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <small>Edit Product Prices</small>
                        <hr>
                        @forelse ($categories as $category )
                        <div class="form-group">
                            <label>{{$category->name}}</label>
                            <input class="form-control" type="number" name="{{$category->slug}}" id="{{$category->slug}}" placeholder="Price" value="{{$category->price}}" />
                            @error('quantity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        @empty

                        @endforelse


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save Product" />
                        </div>
                    </form>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
</x-layout>