@extends('admin.main_layout')
@section('content')
<div class="col-md-10">
    <div class="card-body order-main p-0">
        <hr class="my-5">
        <div class="row pb-5 p-5">
            <div class="col-md-6">
                <p class="font-weight-bold  text-uppercase mb-4 details-block">User Information</p>
                
                @foreach ($orderUser as $user)
                <p class="mb-1"><span class="text-muted">Name: </span>{{$user->name . $user->last_name}}</p>
                <p class="mb-1"><span class="text-muted">Email: </span>{{$user->email}}</p>    
                <p class="mb-1"><span class="text-muted">Phone: </span>{{$user->phone}}</p> 
                <p class="mb-1"><span class="text-muted">Address: </span>{{$user->address}}</p> 
                <p class="mb-1"><span class="text-muted">Pin number: </span>{{$user->pin_number}}</p> 
                @endforeach
            </div>

            <div class="col-md-6 text-right">
                <p class="font-weight-bold details-block text-uppercase mb-4">Payment Details</p>
                <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
            </div>
        </div>

        <div class="row p-5">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Order Id</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Image</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                            <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($orderList as $order)
                        <tr>
                            <td>1</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>
                                {{-- <img class="{{asset()}}" > --}}
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{$grandTotal += $order->price * $order->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="col-md-10">
            <ul id="progressbar" class="text-center">
                <li class="active" id="step1">
                    <div class="d-none d-md-block">STEP 1</div>
                </li>
                <li class="active" id="step2">
                    <div class="d-none d-md-block">STEP 2</div>
                </li>
                <li class="" id="step3">
                    <div class="d-none d-md-block">STEP 3</div>
                </li>
                <li class="" id="step4">
                    <div class="d-none d-md-block">STEP 4</div>
                </li>
                <li class="" id="step5">
                    <div class="d-none d-md-block">STEP 5</div>
                </li>
                <li class="" id="step6">
                    <div class="d-none d-md-block">STEP 5</div>
                </li>
            </ul>
        </div> --}}
        <div style="float: right;">
            <div class="">Grand Total</div>
            <div class="h2 font-weight-light">{{$grandTotal }}</div>
        </div>
    </div>
    </div>
<!-- </div> -->
@stop