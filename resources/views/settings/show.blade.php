<x-layout>
   
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>User Settings</h4>
                <a href="/users/delete/{{$user->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete User</a>
            </div>
            <div class="card-body">
                <form method="POST" action="users/update/{{$user->id}}">
                    @csrf
                    <table class="table table-borderless p-0 m-0">

                        <div class="form-group">
                            <tr>
                                <td>
                                    <label for="name">Name:</label>
                                </td>
                                <td style="width: 75%">
                                    <input class="form-control" name="name" placeholder="Enter Name..." value="{{$user->name}}" />
                                </td>
                            </tr>
                        </div>

                        <div class="form-group">
                            <tr>
                                <td>
                                    <label for="name">Username:</label>
                                </td>
                                <td class="">
                                    <input class="form-control" name="username" placeholder="Username" value="{{$user->username}}" />
                                </td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td><label for="store">Store:</label></td>
                                <td>
                                    <select class="form-control " id="store" name="store_id" placeholder="Store" required>
                                        <option value="{{$user->store->id}}">{{$user->store->name}}</option>
                                        @foreach ($stores as $store )
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td>
                                    <label for="name">Change Passsword:</label>
                                </td>
                                <td>
                                    <input class="form-control" name="password" placeholder="New Password" />
                                </td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td>
                                    <label for="name">User Role:</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="{{$user->roles->pluck('name')[0]}}">{{$user->roles->pluck('name')[0]}}</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="cashier">Cashier</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </table>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save Settings" />
                    </div>
                </form>
            </div>
        </div>
   
</x-layout>