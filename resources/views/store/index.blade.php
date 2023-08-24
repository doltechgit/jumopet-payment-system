<x-layout>
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
                        <th>Store</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact</th>
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
</x-layout>