@extends('layouts.frontend.main')
@section('content')
<!-- inner page section -->
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h3>Checkout</h3>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- end inner page section -->




<section class="bg-light py-5">
<div class="container">
  <div class="row">
    <div class="col-xl-8 col-lg-8 mb-4">
      <div class="card mb-4 border shadow-0">
        <div class="p-4 d-flex justify-content-between">
          <div class="">
            <h5>Have an account?</h5>
            <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
          </div>
          <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
            <a href="#" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
            <a href="#" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
          </div>
        </div>
      </div>

      <!-- Checkout -->
      <div class="card shadow-0 border">
        <div class="p-4">
        <form name="proceedCheckOut" method="POST" action="{{route('save.order')}}" id="proceedCheckOut">
         @csrf
          @if(!empty($userDetails)) 
        @foreach ($userDetails as $userDetail)
          <div class="row">
            <div class="col-6 mb-3">
              <p class="mb-0">First name</p>
              <div class="form-outline">
                <input type="text" id="typeText" name="first_name" value="{{ $userDetail->name ? $userDetail->name : '' }}" placeholder="First Name" class="form-control" />
                @error('first_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-6">
              <p class="mb-0">Last name</p>
              <div class="form-outline">
                <input type="text" id="typeText"  name="last_name" value="{{ $userDetail->last_name ? $userDetail->last_name : '' }}" placeholder="Last Name" class="form-control" />
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
              
            </div>

            <div class="col-6 mb-3">
              <p class="mb-0">Phone</p>
              <div class="form-outline">
                <input type="tel" id="typePhone"  name="phone" value="{{ $userDetail->phone ? $userDetail->phone : '' }}" class="form-control" />
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>

            <div class="col-6 mb-3">
              <p class="mb-0">Email</p>
              <div class="form-outline">
                <input type="email" id="typeEmail"   name="email" value="{{ $userDetail->email ? $userDetail->email : '' }}" placeholder="example@gmail.com" class="form-control" />
              @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>
          </div>

          <hr class="my-4" />

          <div class="row">
            <div class="col-sm-8 mb-3">
              <p class="mb-0">Address</p>
              <div class="form-outline">
                <input type="text" name="address" value="{{ $userDetail->address ? $userDetail->email : '' }}" id="typeText" placeholder="Type here" class="form-control" />
              @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>

            {{-- <div class="col-sm-4 mb-3">
              <p class="mb-0">City</p>
              <select class="form-select">
                <option value="1">New York</option>
                <option value="2">Moscow</option>
                <option value="3">Samarqand</option>
              </select>
            </div> --}}

            {{-- <div class="col-sm-4 mb-3">
              <p class="mb-0">House</p>
              <div class="form-outline">
                <input type="text" id="typeText" placeholder="Type here" class="form-control" />
              </div>
            </div> --}}

            <div class="col-sm-4 col-6 mb-3">
              <p class="mb-0">Postal code</p>
              <div class="form-outline">
                <input type="text"  name="pin_number" value="{{ $userDetail->pin_number ? $userDetail->pin_number : '' }}" id="typeText" class="form-control" />
              @error('pin_number')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>

          </div>

          <h5 class="card-title mb-3">Shipping info</h5>

          <div class="row mb-3">
            <div class="col-lg-4 mb-3">
              <!-- Default checked radio -->
              <div class="form-check h-100 border rounded-3">
                <div class="p-3">
                  <input class="form-check-input" style="margin: 4px 0 0 36px;" type="radio" value="express_delivery" name="payment_mode" id="express_delivery" checked />
                  <label class="form-check-label" for="flexRadioDefault1">
                    Express delivery <br />
                    <small class="text-muted">3-4 days via Fedex </small>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-3">
              <!-- Default radio -->
              <div class="form-check h-100 border rounded-3">
                <div class="p-3">
                  <input class="form-check-input" style="margin: 4px 0 0 36px;" type="radio" value="post_office" name="payment_mode" id="post_office" />
                  <label class="form-check-label" for="flexRadioDefault2">
                    Post office <br />
                    <small class="text-muted">20-30 days via post </small>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-3">
              <!-- Default radio -->
              <div class="form-check h-100 border rounded-3">
                <div class="p-3">
                  <input class="form-check-input" style="margin: 4px 0 0 36px;" type="radio" value="self_pickup" name="payment_mode" id="self_pickup" />
                  <label class="form-check-label" for="flexRadioDefault3">
                    Self pick-up <br />
                    <small class="text-muted">Come to our shop </small>
                  </label>
                </div>
              </div>
            </div>
          </div>

          @endforeach
          @endif
          <div class="float-end">
            <button class="btn btn-light border">Cancel</button>
            <button type="submit" class="btn btn-success shadow-0 border save_order">Continue</button>
          </div>
        </form>
        </div>
      </div>
      <!-- Checkout -->
    </div>
    <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
      <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">


        

        {{-- <div class="input-group mt-3 mb-4">
          <input type="text" class="form-control border" name="" placeholder="Promo code" />
          <button class="btn btn-light text-primary border">Apply</button>
        </div> --}}

        <hr />
        <h6 class="text-dark my-4">Items in cart</h6>
        @php $total=0 @endphp
        @if(!empty($productItems)) 
        @foreach ($productItems as $productItem)
        

        <div class="d-flex align-items-center mb-4">
          <div class="me-3 position-relative">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
              {{$productItem['item_qty']}}
            </span>
            <img src="{{asset('images/'.$productItem['item_image'])}}" style="height: 66px; width: 46x;" class="img-sm rounded border" />
          </div>
          <div class="">
            <a href="#" class="nav-link">
              {{$productItem['item_name']}}
            </a>
            <div class="price text-muted">Total: ₹ {{$productItem['item_qty'] * $productItem['item_price']}}</div>
          </div>
        </div>
        @php $total = $total + ($productItem['item_qty'] * $productItem['item_price']) @endphp
        @endforeach
        @endif

        <h6 class="mb-3">Summary</h6>
        <div class="d-flex justify-content-between">
          <p class="mb-2">Total price:</p>
          <p class="mb-2">$195.90</p>
        </div>
        <div class="d-flex justify-content-between">
          <p class="mb-2">Discount:</p>
          <p class="mb-2 text-danger">- $60.00</p>
        </div>
        <div class="d-flex justify-content-between">
          <p class="mb-2">Shipping cost:</p>
          <p class="mb-2">+ $14.00</p>
        </div>
        <hr />
        <div class="d-flex justify-content-between">
          <p class="mb-2">Total price:</p>
          <p class="mb-2 fw-bold">₹  @php if (!empty($total)){ echo $total; } @endphp</p>
        </div>
        
      </div>
    </div>
  </div>
</div>
</section>


@endsection