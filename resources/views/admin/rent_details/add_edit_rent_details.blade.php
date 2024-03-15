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
                       {{$page == 'create' ? 'Add' : 'Edit'}} Car Rent 
                    </div>
                    <form method="POST" action="{{route('create.car.rent')}}" >
                        @csrf
                    <div class="panel-body">                       
                        <div class="form-group col-md-10">
                            <label for="usr">Cars List:</label>
                            <div class="dropdown">
                                <select class="form-control" name="car">
                                    <option value="">-- select --</option>
                                    @foreach ($carDetails as $car)
                                    <option  value="{{$car->id}}"   @if(!empty($carRentDetails)) {{ $carRentDetails->category_id == $car->id ? 'selected' : ''; }} @endif  >{{$car->car_name}}</option>
                                    @endforeach 
                                </select>
                              </div>
                        </div>
                        <div class="form-group col-md-10 ">
                            <label for="brand">Hour Charge:</label>
                            <input type="text" name="hour_charge"
                             value ="@if (!empty($carRentDetails)) {{ $carRentDetails->rate_per_hr ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('hour_charge')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-10 ">
                            <label for="brand">Day Charge:</label>
                            <input type="text" name="day_charge"
                             value ="@if (!empty($carRentDetails)) {{ $carRentDetails->rate_per_day ?? '' }} @endif"  
                             class="form-control" id="usr">
                            @error('day_charge')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="id" value="{{!empty($carRentDetails) ? $carRentDetails->id : '' }}" >
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