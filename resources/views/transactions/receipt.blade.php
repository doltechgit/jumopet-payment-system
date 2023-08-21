<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Doltech Gas Invoice System</title>
</head>
<style>
    tr {
        border-bottom: 1px solid black;
    }

    td {
        padding: 5px 0;

    }

    .text-center {
        text-align: center;
    }
</style>

<body>

    <div class="text-center">
        <h2 style=" font-size:30px; margin:0">Mattel Gas</h2>
        <small>Bigboy Junction University Road Tanke Ilorin, Kwara State</small>
        <h3 style="margin:10px 0;">Transaction Receipt</h3>
    </div>
    <table>
        <tr>
            <td>Date: </td>
            <td>{{$transaction->created_at}}</td>
        </tr>
        <tr>
            <td>ID:</td>
            <td>{{$transaction->transaction_id}}</td>
        </tr>
        <tr>
            <td>Name: </td>
            <td>{{$transaction->client->name}}</td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td>{{$transaction->client->phone}} </td>
        </tr>
        <tr>
            <td>Quantity: </td>
            <td>{{$transaction->quantity}} KG</td>
        </tr>
        <tr>
            <td>Payment Method: </td>
            <td>{{$transaction->pay_method}}</td>
        </tr>
        <tr>
            <td>Discount: </td>
            <td>{{$transaction->discount}} %</td>
        </tr>
        <tr>
            <td>Paid: </td>
            <td># {{$transaction->paid}}</td>
        </tr>
        <tr>
            <td>Balance: </td>
            <td># {{$transaction->balance}}</td>
        </tr>
        <tr>
            <td>Transaction by: </td>
            <td>{{$transaction->user->name}}</td>
        </tr>
    </table>

    <div class="text-center">
        <h2> # {{number_format($transaction->price)}}</h2>
    </div>
</body>

</html>