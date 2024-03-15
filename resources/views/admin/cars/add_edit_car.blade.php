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
                    {{ $page == 'create' ? 'Add' : 'Edit' }} Car
                </div>
                <form method="POST" action="{{ route('create.car') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="form-group col-md-10 ">
                            <label for="brand">Car Name:</label>
                            <input type="text" name="car_name"
                                value="@if (!empty($carDetails)) {{ $carDetails->car_name ?? '' }} @endif"
                                class="form-control" id="usr">
                            @error('car_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10">
                            <label for="usr">Categories List:</label>
                            <div class="dropdown">
                                <select class="form-control category_list" name="category_id">
                                    <option value="">-- select --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (!empty($carDetails)) {{ $carDetails->category_id == $category->id ? 'selected' : '' }} @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="usr">Brand List:</label>
                            <div class="dropdown">
                                <select class="form-control" id='brand_select'  name="brand_id">
                                    <option class="brand_list" value="">-- select --</option>
                                    @if (!empty($carDetails->brand_id))
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            @if (!empty($carDetails)) {{ $carDetails->brand_id == $brand->id ? 'selected' : '' }} @endif>
                                            {{ $brand->brand_name }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @if (!empty($carDetails->car_image))  
                    
                    <div class="form-group col-md-8">
                        <img class="product-image" src="{{ asset('upimages/cars/'. $carDetails->car_image) }}" >
                    </div>
                     @endif
                        <div class="form-group col-md-10 ">
                            <label for="brand">Car Image:</label>
                            <input type="file" name="car_image"
                                value=""
                                class="form-control" id="usr">
                            @error('car_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="previous_car_image" value="@if (!empty($carDetails->car_image)){{ $carDetails->car_image ?? '' }}@endif">
                        <div class="form-group col-md-10 ">
                            <label for="brand">Fuel Type:</label>
                            <input type="text" name="fuel_type"
                                value="@if (!empty($carDetails)) {{ $carDetails->fuel_type ?? '' }} @endif"
                                class="form-control" id="usr">
                            @error('fuel_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10 ">
                            <label for="brand">Model & Year:</label>
                            <input type="text" name="model_year"
                                value="@if (!empty($carDetails)) {{ $carDetails->model_year ?? '' }} @endif"
                                class="form-control" id="usr">
                            @error('brand_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="id" value="{{ !empty($carDetails) ? $carDetails->id : '' }}">
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
    var url = '{{ route("get-brand-items", ":id") }}';
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
            $.each(response.result, function( index, value ){
                // $("#brand_select").("option:not(:first)").remove();
                $("#brand_select option:not(:first)").remove();
                $("#brand_select").append('<option value="' + value.id + '">' + value.brand_name  + '</option>');
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
