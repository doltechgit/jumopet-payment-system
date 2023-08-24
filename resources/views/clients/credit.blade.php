<x-layout>
    <div class="card border-0 mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Creditors</h6>
            <div>
                <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus fa-sm text-white-50"></i> Add New Client</a>
                <div class="dropdown d-none d-sm-inline-block">
                    <button class=" btn btn-sm btn-success shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-download fa-sm text-white-50"></i> Download Clients Record
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="clients_export">CSV Report</a>
                        <a class="dropdown-item" href="clients_upload">For Upload</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table clientTable" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Client</th>
                            <th>Outstanding</th>
                            <th>Transactions</th>
                            <th></th>
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

                            <td>
                                <a href="/clients/{{$client->id}}">
                                    <h6>{{$client->name}}</h6>
                                </a>
                            </td>
                            <td>&#8358; {{number_format($client->transactions->sum('balance'))}}</td>
                            <td>{{count($client->transactions)}}</td>
                            <td>
                                <x-table-list-menu show="clients" delete="clients/delete" :id='$client->id' />
                            </td>


                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>