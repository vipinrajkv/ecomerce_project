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
                    Cars Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        <a href="{{route('add.car')}}" class="btn btn-info  btn-sm float-right" role="button">Add Car</a>
                        </div>
                        <table class="table table-striped custab">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Car Name</th>
                                    <th>Brand Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($carsList as $cars)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$cars->car_name}}</td>
                                    <td>{{$cars->brand->brand_name}}</td>
                                    <td>{{$cars->category->category_name}}</td>
                                    <td>
                                        <img class="product-image" src="{{ asset('upimages/cars/'. $cars->car_image) }}" alt="">
                                    </td>
                                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('edit.car', ['id' => $cars->id]) }}"><span
                                                class="glyphicon glyphicon-edit"></span> Edit</a> <a href="{{ route('delete.car', ['id' => $cars->id]) }}"
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
