@extends('admin.main_layout')
@section('content')
    <div class="col-md-8 content">
        <!-- <div class="panel panel-default"> -->
        {{-- <div class="panel-heading">
            Car
        </div> --}}
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    {{ $page == 'create' ? 'Add' : 'Edit' }} Product
                </div>
                <form method="POST" action="{{ route('create.product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10 ">
                            <label for="brand">Product Name:</label>
                            <input type="text" name="name"
                                value="@if (!empty($productDetails)) {{ $productDetails->name ?? '' }} @endif"
                                class="form-control" id="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10 ">
                            <label for="brand">Price:</label>
                            <input type="text" name="price"
                                value="@if (!empty($productDetails)) {{ $productDetails->price ?? '' }} @endif"
                                class="form-control" id="price">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10">
                            <label for="usr">Categories:</label>
                            <div class="dropdown">
                                <select class="form-control category_list" name="category_id">
                                    <option value="">-- select --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (!empty($productDetails)) {{ $productDetails->category_id == $category->id ? 'selected' : '' }} @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="usr">Sub Categories:</label>
                            <div class="dropdown">
                                <select class="form-control" id='sub_category_select'  name="sub_category_id">
                                    <option class="brand_list" value="">-- select --</option>
                                    @if (!empty($productDetails->sub_category_id))
                                        @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            @if (!empty($productDetails)) {{ $productDetails->sub_category_id == $subCategory->id ? 'selected' : '' }} @endif>
                                            {{ $subCategory->sub_category_name }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    @if (!empty($productDetails->image))  
                    
                    <div class="form-group col-md-8">
                        <img class="product-image" src="{{ asset('upimages/product/'. $productDetails->image) }}" >
                    </div>
                     @endif
                        <div class="form-group col-md-10 ">
                            <label for="brand">Product Image:</label>
                            <input type="file" name="image"
                                value=""
                                class="form-control" id="usr">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="previous_product_image" value="@if (!empty($productDetails->image)){{ $productDetails->image ?? '' }}@endif">

                        <input type="hidden" name="id" value="{{ !empty($productDetails) ? $productDetails->id : '' }}">
                        <div class="form-group col-md-10 ">
                            <button class="btn btn-success" type="input"> Cancel</button>
                            <button class="btn btn-primary" type="submit"> Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<script>

$(".category_list").change(function() {
    var categoryId = $(this).val();
    var url = '{{ route("get-subcategory-items", ":id") }}';
    url = url.replace(':id', categoryId);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $.ajax({
        method: 'GET',
        url : url,
        success: function(response) {     
            console.log(response);    
            $.each(response.result, function( index, value ){
                // $("#brand_select").("option:not(:first)").remove();
                $("#sub_category_select option:not(:first)").remove();
                $("#sub_category_select").append('<option value="' + value.id + '">' + value.sub_category_name  + '</option>');
            });
        },
        error: function(data) {
            // console.log(data);
        }
    });
});
</script>


    <!-- </div> -->
@stop
