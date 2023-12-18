<x-layout>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print_area,
            .print_area * {
                visibility: visible;
            }

        }
    </style>
    <div class="d-flex flex-wrap">
        <div class="card col-lg-6 col-md-12 mx-2 border-0 p-4">
            <div class="card-header border-0 d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="font-weight-bold">Transaction Details</h6>
                <div>
                    <!-- <a href="print_pdf/{{$transaction->id}}" class="btn btn-success  m-2"><i class="fa fa-print mx-2"></i>Print Invoice</a> -->
                    <button id="print_receipt" class="btn btn-success btn-sm  m-2"><i class="fa fa-print mx-2"></i>Print Invoice</button>
                    <a href="download_pdf/{{$transaction->id}}" class="btn btn-warning btn-sm m-2"><i class="fa fa-download mx-2"></i> Generate PDF</a>

                </div>
            </div>
            <h5>Order Summary</h5>
            <table class="table">
                <tr>
                    <th>Product</th>
                    <th>Price per unit</th>
                    <th>Quantity</th>
                </tr>

                @foreach ($orders as $order )
                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->unit_price}}</td>
                    <td>{{$order->quantity}}</td>
                </tr>
                @endforeach


            </table>
            <table class="table p-0 m-0">
                <tr class="col-md-6 p-0">
                    <td>ID: {{$transaction->trans_id}}</td>
                    <td>Date: {{$transaction->created_at}}</td>
                </tr>
                <tr class="c">
                    <td>Name: <a href="clients/{{$transaction->client->id}}">{{$transaction->client->name}}</a></td>
                    <td>Phone: {{$transaction->client->phone}} </td>
                </tr>
                <tr class="">
                    <td>Payment Method:
                        @if ($transaction->pay_method == 'Paid')
                        @foreach ($transaction->methods as $method)
                        {{$method->method}} - &#8358; {{$method->amount}}
                        @endforeach
                        @else
                        {{$transaction->pay_method}}
                        @endif
                    </td>
                    <td>Discount: &#8358; {{$transaction->discount}} </td>
                </tr>

                <tr>
                    <td>Paid: &#8358; {{number_format($transaction->paid)}}</td>
                    <td>
                        Balance: &#8358; {{number_format($transaction->balance)}}
                        <!-- <a href="#">Pay Balance</a> -->
                    </td>
                </tr>
                <tr>
                    <td>Transaction by:</td>
                    <td>Cashier</td>
                </tr>
            </table>
            @role('admin')
            @if($transaction->balance > 0)
            <div class="my-2">
                <p class="m-0 font-weight-bold">Pay Balance</p>
                <hr>
                <form method="POST" action="/transactions/update/{{$transaction->id}}">
                    @csrf
                    <div class="method_area">
                        <div class="row">
                            <span class="col-lg-6 col-md-12 px-2">
                                <div class="form-group">
                                    <select class="form-control method" id="method" name="method[]" value="{{old('method')}}" required>
                                        <option value="">Payment Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="POS">POS</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </span>
                            <span class="col-lg-6 d-flex justify-content-between px-0">
                                <span class="col-lg-10 col-md-12">
                                    <div class="form-group">

                                        <input class="form-control method_amount" type="number" step="any" name="method_amount[]" id="" placeholder="" required />
                                        @error('discount')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </span>
                                <span class="">
                                    <span class="btn btn-primary btn-sm add_method"><i class="fa fa-plus"></i></span>
                                </span>
                            </span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label><small>Balance: </small></label>
                        <input class="form-control" type="number" name='balance' placeholder="&#8358; 000.000" value="{{$transaction->balance}}" />
                    </div>
                    <div class="form-group">
                        <label><small>Pay: </small></label>
                        <input class="form-control" type="number" name='paid' placeholder="&#8358; 000.000" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Balance</button>
                </form>
            </div>
            @endif
            @endrole
        </div>
        <div class="card col-lg-5 col-md-12 mx-2 p-5 print_area border-0" id="print_area">
            <div class="card-header text-center border-0" style="text-align: center">
                <h2 class="text-uppercase h4 font-weight-bold my-0" style="line-height: 20px;">Jumopet Enterprises</h2>
                <small class="fs-3">{{auth()->user()->store->address}}</small><br>
                <small class="fs-3">{{auth()->user()->store->contact}}</small>
                <h5>Transaction Receipt</h5>
            </div>

            <table class="table">
                <tr>
                    <td><small>ID: </small></td>
                    <td><small>{{$transaction->transaction_id}}</small></td>
                </tr>
                <tr>
                    <td><small>Date: </small></td>
                    <td><small>{{$transaction->created_at}}</small></td>
                </tr>

                <tr>
                    <td><small>Name: </small></td>
                    @if($transaction->client !== null)
                    <td><small>{{$transaction->client->name}}</small></td>
                    @else
                    <td><small>{{$transaction->client_name}}</small></td>
                    @endif
                </tr>

                <tr>
                    <td><small>Payment Method: </small></td>
                    <td>
                        <small>
                            @if ($transaction->pay_method == 'Paid')
                            @foreach ($transaction->methods as $method)
                            {{$method->method}} - &#8358; {{$method->amount}}
                            @endforeach
                            @else
                            {{$transaction->pay_method}}
                            @endif
                        </small>
                    </td>
                </tr>
                <tr>
                    <td><small>Paid: </small></td>
                    <td><small>&#8358; {{$transaction->paid}}</small></td>
                </tr>
                <tr>
                    <td><small>To Bal: </small></td>
                    <td><small>&#8358; {{$transaction->balance}}</small></td>
                </tr>
                <tr>
                    <td><small>Discount: </small></td>
                    <td><small>&#8358; {{$transaction->discount}}</small></td>
                </tr>
                <tr>
                    <td><small>Transaction by: </small></td>
                    <td><small>{{$transaction->user->name}}</small></td>
                </tr>
            </table>
            <hr>
            <table class="table">
                <thead>
                    <th style="width: 50%; text-align:left;"><small>Item</small></th>
                    <th style="width: 50%; text-align:left;"><small>Size</small></th>
                    <th style="width: 50%; text-align:left;"><small>Qty</small></th>
                    <th style="width: 50%; text-align:left;"><small>Price</small></th>
                    <th style="width: 50%; text-align:left;"><small>Amount</small></th>
                </thead>

                @foreach ($orders as $order )
                <tr>
                    <td style="width: 30%; text-align:left;"><small>{{$order->name}}</small></td>
                    <td style="width: 20%; text-align:left;"><small>{{$order->size}} CL</small></td>
                    <td style="width: 20%; text-align:left;"><small>{{$order->quantity}}</small></td>
                    <td style="width: 10%; text-align:left;"><small>{{$order->unit_price}}</small></td>
                    <td style="width: 10%; text-align:left;"><small>{{$order->amount}}</small></td>
                </tr>
                @endforeach
            </table>
            <hr>
            <div class="text-center" style="text-align: center">
                <small>Total:</small>
                <h2 class="font-weight-bold" style="text-align: center; line-height: 10px;"> &#8358; {{number_format($transaction->price)}}</h2>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#print_receipt').on('click', function() {
                let content = $("#print_area")
                let win_print = window.open('', '', 'width=302', 'height=350')
                win_print.document.write(content.html())
                win_print.document.close()
                win_print.print()
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#open_client_transaction").on('click', function() {
                console.log('here')
                $("#client_transaction").show()
            })

            $("#close_transaction").on('click', function() {
                $("#client_transaction").hide()
            })
        })

        $(document).ready(function() {
            let sum = 0
            $(".add_method").on('click', function() {
                console.log('here')
                $(".method_area").append(
                    `
                    <div class="row added_method">
                        <span class="col-lg-6 col-md-12 px-2">
                            <div class="form-group">
                                <select class="form-control method" id="method" name="method[]" value="{{old('method')}}">
                                    <option value="">Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="POS">POS</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                        </span>
                        <span class="col-lg-6 d-flex justify-content-between px-0">
                            <span class="col-lg-10 col-md-12">
                                <div class="form-group">
                                    <input class="form-control method_amount" type="number" step="any" name="method_amount[]" id="" placeholder="" required />
                                    @error('discount')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </span>
                            <span class="">
                                <span class="btn  btn-sm remove_method"><i class="fa fa-times"></i></span>
                            </span>
                        </span>
                    </div>
                    `
                )
                // $('.method_amount').change(() => {

                //     console.log($('.method_amount').val())
                //     $('.method_amount').each(function() {
                //         sum += +$(this).val()
                //         $('.paid').val(sum)
                //     })

                // })

                $('.method_amount').on('input', function() {
                    let total = 0
                    $('.method_amount').each(function() {
                        total += parseFloat($(this).val())
                    })
                    $('.paid').val(parseFloat(total))
                    console.log(parseFloat(total))

                    $('.balance').val(parseFloat($('.buy_price').val()) - parseFloat(total));

                })
            })
            $(document).on('click', '.remove_method', function() {
                console.log('remove')
                $(this).closest('.added_method').remove()
            })
            $(document).on('click', '.apply_discount', () => {
                console.log('show')
                $('.discount_area').show()
            })

            $('.method_amount').on('input', function() {
                let total = 0
                $('.method_amount').each(function() {
                    total += parseFloat($(this).val())
                })
                $('.paid').val(parseFloat(total))
                console.log(parseFloat(total))

                $('.balance').val(parseFloat($('.buy_price').val()) - parseFloat(total));

            })

        })
    </script>


</x-layout>