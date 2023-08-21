<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Transaction ID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Paid</th>
            <th>To Balance</th>
            <th>Payment Method</th>
            <th>Client Name</th>
            <th>Client Phone</th>
            <th>Client Category</th>
            <th>Transaction by</th>

        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        @php
        $date = explode(' ', $transaction->created_at);
        $created_at = $date[0];
        @endphp

        <tr>
            <td>{{ $created_at }}</td>
            <td>{{ $transaction->transaction_id }}</td>
            <td>{{ $transaction->quantity }}</td>
            <td>{{ $transaction->price }}</td>
            <td>{{ $transaction->discount }}</td>
            <td>{{ $transaction->paid }}</td>
            <td>{{ $transaction->balance }}</td>
            <td>{{ $transaction->pay_method }}</td>
            <td>{{ $transaction->client->name }}</td>
            <td>{{ $transaction->client->phone }}</td>
            <td>{{ $transaction->client->category->name }}</td>
            @if($transaction->user == null)
            <td>User does not exist</td>
            @else
            <td>{{ $transaction->user->name }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>