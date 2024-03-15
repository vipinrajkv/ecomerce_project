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
                       {{$page == 'create' ? 'Add' : 'Edit'}} Category
                    </div>
                    <form method="POST" action="{{route('create.category')}}" >
                        @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10">
                            <label for="brand">Category Name:</label>
                            <input type="text" name="category_name"
                             value ="@if (!empty($category)) {{ $category->category_name ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      
                        <div class="form-group col-md-10">
                            <label class=" checkbox-inline">
                            <input id="status" type="checkbox" value="{{ $category->status ?? 1 }}">Activate</label>
                        </div>
                
                        <input type="hidden" name="id" value="{{!empty($category) ? $category->id : '' }}" >
                        <div class="form-group col-md-10 ">
                            <button class="btn btn-primary" type="submit"> Submit</button>
                            {{-- <input value="submit" button class="btn btn-primary">  --}}
                            <button class="btn btn-success" type="input"> Cancel</button>
                        </div>
                    </div>
                    
                </form>
                </div>
            </div>
</div>



<!-- </div> -->
@stop