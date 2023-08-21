<x-layout>
    <div class="container card">
        <div class="card-header">
            <h4>Notification Center</h4>
        </div>
        <div class="p-2">
            @forelse (auth()->user()->unreadNotifications->take(5) as $notification)
            <div class="d-flex align-items-center  col-md-12 my-2" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="small text-gray-500">{{$notification->created_at}}</div>
                    <span class="font-weight-bold">{{$notification->data['transaction_id']}}</span>
                </div>
                <div class="col-md-2">
                    <i class="fas fa-check-circle text-primary"></i>
                </div>
            </div>
            <hr>
            @empty
            <small>No New Notification</small>
            @endforelse
        </div>
    </div>

</x-layout>