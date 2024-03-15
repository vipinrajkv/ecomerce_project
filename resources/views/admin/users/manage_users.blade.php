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
                       {{$page == 'create' ? 'Add' : 'Edit'}} Users
                    </div>
                    <form method="POST" action="{{route('create.update.user')}}" >
                        @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10">
                            <label for="brand">User Name:</label>
                            <input type="text" name="user_name"
                             value ="@if (!empty($userDetails)) {{ $userDetails->name ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('user_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-10">
                            <label for="usr">Role:</label>
                            <div class="dropdown">
                                <select class="form-control category_list" name="role">
                                    <option value="">-- select --</option>
                                    @foreach ($roles as  $role)
                                        <option value="{{ $role['id'] }}"
                                            @if (!empty($userDetails)) {{ $userDetails->role == $role['name'] ? 'selected' : '' }} @endif>
                                            {{ $role['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                 <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
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