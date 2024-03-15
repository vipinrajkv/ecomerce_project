@extends('admin.main_layout')
@section('content')
    <div class="col-md-10 content">
        <!-- <div class="panel panel-default"> -->
        <div class="panel-heading">
            {{-- Dashboard --}}
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    Customer order Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        {{-- <a href="{{route('add.subcategory')}}" class="btn btn-danger  btn-sm float-right" role="button">Add Orders</a> --}}
                        </div>
                        <table class="table table-striped custab">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Trucking Number</th>
                                    <th>Payment Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($ordersList as $orders)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$orders->name}}</td>
                                    <td>{{$orders->trucking_number}}</td>
                                    <td>{{$orders->payment_mode}}</td>
                                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('view.order', ['id' => $orders->id]) }}"><span
                                                class="glyphicon glyphicon-edit"></span> View</a> 
                                                {{-- <a href="{{ route('delete.subcategory', ['id' => $subCategory->id]) }}"
                                            class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>
                                            Del</a> --}}
                                        </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
@stop
