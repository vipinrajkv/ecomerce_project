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
                    Category Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        <a href="{{route('add.category')}}" class="btn btn-info  btn-sm float-right" role="button">Add Category</a>
                        </div>
                        <table class="table table-striped custab">
                            <thead>

                                <tr>
                                    <th>Sl No</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_name ? 'active' : ''}}
                                        {{-- @php 
                                    if($category->status == 1)
                                    { echo('Active');} 
                                    // else
                                    // {'Deactive'}
                                    @endphp</td> --}}
                                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('edit.category', ['id' => $category->id]) }}"><span
                                                class="glyphicon glyphicon-edit"></span> Edit</a> <a href="{{ route('delete.category', ['id' => $category->id]) }}"
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
