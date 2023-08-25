<x-layout>
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
</x-layout>