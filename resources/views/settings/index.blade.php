<x-layout>
    <div class="  col-md-12 col-sm-12">
        <div class="card bg-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Settings</h3>
                <div>
                    <!-- <a href="trash_records"><i class="fa fa-trash"></i> Transaction Trash</a> -->
                </div>

            </div>
            <div class="card-body">
                <div class="users-section my-4">
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <h6>Users Settings</h6>
                        <div>
                            <a href="/register" class="btn btn-primary btn-sm">Register New User</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Store</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td><a href="users/{{$user->id}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->store->name}}</td>
                                <td>{{$user->roles->pluck('name')[0]}}</td>
                            </tr>
                            @endforeach
                            <tr>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="card bg-white my-4">

            <div class="card-header d-flex justify-content-between align-items-center my-2">
                <h6>Store Settings</h6>
                <div>
                    <a href="/store/create" class="btn btn-primary btn-sm">Add New Store</a>
                </div>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$stores)
                        <tr>
                            Store is empty
                        </tr>
                        @else
                        @foreach ($stores as $store )
                        <tr>
                            <td><a href="stores/{{$store->id}}">{{$store->name}}</a></td>
                            <td>{{$store->address}}</td>
                            <td>{{$store->email}}</td>
                            <td>{{$store->contact}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>