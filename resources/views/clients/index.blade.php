<x-layout>
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Clients</h6>
            <div>
                <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Client</a>
                <div class="dropdown d-none d-sm-inline-block">
                    <button class=" btn btn-sm btn-success shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i> Download Clients Record
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="clients_export">CSV</a>
                        <a class="dropdown-item" href="#">PDF</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table clientTable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Phone</th>
                            <th>Transactions</th>
                            @role('admin')
                            <th></th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$clients)
                        <tr>
                            <td>No Transactions yet. You can make one <a href="/">here</a></td>
                        </tr>
                        @endif
                        @foreach ($clients->keyBy('created_at') as $client)


                        <tr>

                            <td><a href="/clients/{{$client->id}}">{{$client->name}}</a></td>
                            <td>{{$client->phone}}</td>
                            <td>{{count($client->transactions)}}</td>
                            @role('admin')
                            <td>
                                <x-table-list-menu show="clients" delete="clients/delete" :id='$client->id' />
                            </td>
                            @endrole


                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>