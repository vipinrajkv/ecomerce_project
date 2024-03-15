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
                    Users Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        <a href="{{route('add.role')}}" class="btn btn-info  btn-sm float-right" role="button">Add Role</a>
                        </div>
                        <table class="table table-striped custab">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Gaurd</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($rolesList as $roles)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$roles->name}}</td>
                                    <td>{{$roles->guard_name ?? ''}}
                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs' href="{{ route('view.role', ['id' => $roles->id]) }}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                        <a href="{{ route('delete.subcategory', ['id' => $roles->id]) }}"
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
