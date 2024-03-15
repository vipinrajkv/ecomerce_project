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
                    Product Details
                </div>
                <div class="container">
                    <div class="row col-md-8 custyle">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="text-right" style="margin-top: 18px;">
                        <a href="{{route('add.product')}}" class="btn btn-info  btn-sm float-right" role="button">Add Product</a>
                        </div>
                        <table class="table table-striped custab">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($productList as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->category_name ?? ''}}</td>
                                    <td>{{$product->subCategory->sub_category_name ?? ''}}</td>
                                    <td>
                                        <img class="product-image" src="{{ asset('upimages/product/'. $product->image) }}" alt="">
                                    </td>
                                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{ route('edit.product', ['id' => $product->id]) }}"><span
                                                class="glyphicon glyphicon-edit"></span> Edit</a> <a href="{{ route('delete.product', ['id' => $product->id]) }}"
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
