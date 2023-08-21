<x-layout>
    <div class="card my-5">
        <div class="card-header">
            <h6>Edit Product Category</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="categories/update/{{$category->id}}">
                @csrf
                <table class="table table-borderless p-0 m-0">

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Category Name:</label>
                            </td>
                            <td style="width: 75%">
                                <input class="form-control" name="name" placeholder="Enter Store Name..." value="{{$category->name}}" />
                            </td>
                        </tr>
                    </div>

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Price:</label>
                            </td>
                            <td class="">
                                <input class="form-control" name="contact" placeholder="+23412345678" value="{{$category->slug}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Current Quantity:</label>
                            </td>
                            <td>
                                <input class="form-control" name="email" placeholder="00" value="{{$category->price}}" />
                            </td>
                        </tr>
                    </div>
                    
                </table>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save Product Category Details" />
                </div>
            </form>
        </div>
    </div>
</x-layout>