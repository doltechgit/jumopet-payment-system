<x-layout>
    <div class="card my-5">
        <div class="card-header">
            <h6>Store Settings</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="stores/update/{{$store->id}}">
                @csrf
                <table class="table table-borderless p-0 m-0">

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Store Name:</label>
                            </td>
                            <td style="width: 75%">
                                <input class="form-control" name="name" placeholder="Enter Store Name..." value="{{$store->name}}" />
                            </td>
                        </tr>
                    </div>

                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Contact:</label>
                            </td>
                            <td class="">
                                <input class="form-control" name="contact" placeholder="+23412345678" value="{{$store->contact}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Email Address:</label>
                            </td>
                            <td>
                                <input class="form-control" name="email" placeholder="Enter Email Address..." value="{{$store->email}}" />
                            </td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>
                                <label for="name">Store Address:</label>
                            </td>
                            <td>
                                <input class="form-control" name="address" placeholder="Nigeria" value="{{$store->address}}" />
                            </td>
                        </tr>
                    </div>
                </table>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save Store Details" />
                </div>
            </form>
        </div>
    </div>
</x-layout>