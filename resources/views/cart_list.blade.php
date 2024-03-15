
@extends('layouts.frontend.main')
@section('content')
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Cart</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      <div class="card">
         <div class="row">
             <div class="col-md-8 cart">
                 <div class="title">
                     <div class="row">
                         <div class="col"><h4><b>Shopping Cart</b></h4></div>
                         <div class="col align-self-center text-right text-muted">3 items</div>
                     </div>
                 </div>
                 @if(Session::get('Cart'))  
                 <div class="row border-top border-bottom">
                     <div class="row main align-items-center">
                         <div class="col-2">Image</div>
                         <div class="col">
                             <div class="row text-muted">Item</div>
                         </div>
                         <div class="col">
                            <div class="row text-muted">Qty</div>
                         </div>
                         <div class="col">
                         <div class="row text-muted">Amount</div>
                             <!-- <span class="close">&#10005;</span> -->
                            </div>
                        <div class="col">
                            <div class="row text-muted">Remove</div>
                        </div>
                     </div>
                 </div> 
                 @php $total=0 @endphp
                       @foreach($productItems as $productItem)
                 <div class="row border-top border-bottom">
                     <div class="row main align-items-center">
                         <div class="col-2"><img class="img-fluid f-pro-img" src="{{asset('images/'.$productItem['item_image'])}}"></div>
                         <div class="col">
                             <div class="row text-muted">{{$productItem['item_name']}}</div>
                         </div>
                         <div class="col">
                             <a href="#">-</a><a href="#" class="border">{{$productItem['item_qty']}}</a><a href="#">+</a>
                         </div>
                         <div class="col">₹ {{$productItem['item_qty'] * $productItem['item_price']}}</div>
                         <div class="col">
                            <span value="{{$productItem['item_id']}}" data-value="{{$productItem['item_id']}}" class="close remove_cart_item">&#10005;</span>
                        </div>
                    </div>
                 </div>
                 @php $total = $total + ($productItem['item_qty'] * $productItem['item_price']) @endphp
                 @endforeach
                 @endif
                 
                 <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
             </div>
             <div class="col-md-4 summary">
                 <div class="f-h5"><h5><b>Summary</b></h5></div>
                 <hr>
                 <div class="row">
                     <div class="col" style="">TOTAL AMOUNT </div>
                     <div class="col text-right">₹  @php if (!empty($total)){ echo "$total"; } @endphp</div>
                 </div>
                 <form class="f-form">
                     {{-- <p>SHIPPING</p> --}}
                     <select><option class="text-muted">Standard-Delivery- 5.00</option></select>
                     <p>GIVE CODE</p>
                     <input id="code" placeholder="Enter your code">
                 </form>
                 <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                     <div class="col">GRAND TOTAL</div>
                     <div class="col text-right">₹ @php if (!empty($total)){ echo "$total"; } @endphp</div>
                 </div>
                 <button class="btn-chkout">CHECKOUT</button>
             </div>
         </div>
         
     </div>
      <!-- end why section -->
      @endsection
