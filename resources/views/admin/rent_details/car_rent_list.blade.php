@extends('admin.main_layout')
@section('content')
    <div class="col-md-10 content">
        <!-- <div class="panel panel-default"> -->
        <div class="panel-heading">
            Dashboard
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    Car Rent Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        <a href="{{route('add.car.rent')}}" class="btn btn-info  btn-sm float-right" role="button">Add Rent</a>
                        </div>
                        <table class="table table-striped custab">
                            <thead>

                                <tr>
                                    <th>Sl No</th>
                                    <th>Car Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Rate/Hour</th>
                                    <th>Rate/Day</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($carRentList as $carRent)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$carRent->car->car_name}}</td>
                                    <td>{{$carRent->category->category_name}}</td>
                                    <td>{{$carRent->brand->brand_name}}</td>
                                    <td>{{$carRent->rate_per_hr}}</td>
                                    <td>{{$carRent->rate_per_day}}</td>
                                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('edit.car.rent', ['id' => $carRent->id]) }}"><span
                                                class="glyphicon glyphicon-edit"></span> Edit</a> <a href="{{ route('delete.car.rent', ['id' => $carRent->id]) }}"
                                            class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>
                                            Del</a></td>
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
