@extends('admin.main_layout')
@section('content')
<div class="col-md-8 content">
    <!-- <div class="panel panel-default"> -->
    <div class="panel-heading">
        Dashboard
    </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                       {{$page == 'create' ? 'Add' : 'Edit'}} Roles
                    </div>
                    <form method="POST" action="{{route('create.update.roles')}}" >
                        @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10">
                            <label for="brand">Role Name:</label>
                            <input type="text" name="name"
                             value ="@if (!empty($roleDetails)) {{ $roleDetails->name ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <input type="hidden" name="id" value="{{!empty($userDetails) ? $userDetails->id : '' }}" >
                        <div class="form-group col-md-10 ">
                            {{-- <input value="submit" button class="btn btn-primary">  --}}
                            <button class="btn btn-success" type="input"> Cancel</button>
                            <button class="btn btn-primary" type="submit"> Submit</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
</div>
<!-- </div> -->
@stop