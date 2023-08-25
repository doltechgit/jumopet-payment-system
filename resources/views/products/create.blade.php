<x-layout>
    <div class="bg-white border col-md-7 d-flex p-3 ">

        <div class="w-100">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h4>New Product</h4>
                <a href="/products">See all Products</a>
            </div>
            <div class="card-body">
                <form method="POST" action="/products/store">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <input class="form-control " type="text" name="name" id="name" placeholder="Product Name" value="{{old('name')}}" />
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control category" id="category" name="category" value="{{old('category')}}" required>
                            <option value="">Product Category</option>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}">{{$category->name}}</option>

                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="number" name="size" id="size" placeholder="Size (35CL)" value="{{old('size')}}" />
                        @error('size')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="number" name="price" id="price" placeholder="Price per Unit" value="{{old('price')}}" />
                        @error('price')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add Product" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>