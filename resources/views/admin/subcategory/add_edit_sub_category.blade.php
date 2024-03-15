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
                       {{$page == 'create' ? 'Add' : 'Edit'}} Sub Category
                    </div>
                    <form method="POST" action="{{route('create.edit.subcategory')}}" >
                        @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10">
                            <label for="brand">Sub Category Name:</label>
                            <input type="text" name="sub_category_name"
                             value ="@if (!empty($subCategory)) {{ $subCategory->sub_category_name ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('sub_category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10">
                            <label for="usr">Categories:</label>
                            <div class="dropdown">
                                <select class="form-control category_list" name="category">
                                    <option value="">-- select --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (!empty($subCategory)) {{ $subCategory->category_id == $category->id ? 'selected' : '' }} @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                 <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{!empty($subCategory) ? $subCategory->id : '' }}" >
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