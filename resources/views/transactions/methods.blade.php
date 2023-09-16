<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Transaction ID</th>
            <th>Method</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Price</th>
            <th>Payment Methods</th>
            <th>To Balance</th>
            <th>Order</th>
            <th>Client Name</th>
            <th>Client Phone</th>
            <th>Transaction by</th>
        </tr>
    </thead>
    <tbody>
        @foreach($methods as $method)
        @php
        $date = explode(' ', $method->created_at);
        $created_at = $date[0];
        @endphp

        <tr>
            <td>{{ $created_at }}</td>
            <td>{{ $method->transaction->trans_id }}</td>
            <td>{{ $method->method }}</td>
            <td>{{ $method->amount }}</td>
            <td>{{ $method->transaction->paid }}</td>
            <td>{{ $method->transaction->price }}</td>
            <td>
                @foreach ($method->transaction->methods as $method )
                <span style="display: flex;">
                    {{$method->method}} -
                    {{$method->amount}}
                </span><br>
                @endforeach
            </td>
            <td>{{ $method->transaction->balance }}</td>

            <td>
                @foreach ($method->transaction->orders as $order )
                <span style="display: flex;">
                    {{$order->name}} |
                    {{$order->unit_price}} |
                    {{$order->quantity}} |
                    {{$order->amount}} |
                </span><br>
                @endforeach
            </td>
            @if($method->transaction->client == null)
            <td>$method->transaction->client_name</td>
            <td>Client does not exist</td>
            @else
            <td>{{ $method->transaction->client->name }}</td>
            <td>{{ $method->transaction->client->phone }}</td>
            @endif
            @if($method->transaction->user == null)
            <td>User does not exist</td>
            @else
            <td>{{ $method->transaction->user->name }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>