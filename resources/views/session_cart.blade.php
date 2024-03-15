<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></scri
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>



<link rel="stylesheet" type="text/css" href="css/style.css" />
<!------ Include the above in your HEAD tag ---------->


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <div class="container">
    <div>
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Sample Cart
        </h3>

        <div class="row ">
        @foreach($productlist as $productdata) 
            <div class="col-md-4 product_data"> 
                <div class="card mb-4">
                    <img class="card-img-top" src="{{$productdata->image}}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{$productdata->name}}</h5>
                    <p class="card-text">{{$productdata->name}}</p>
                    <input type="text" class="product-quantity" name="productQuantity" class="form-control" value="1" />
                    <input type="hidden" class="product-id" name="productId" value="{{$productdata->id}}" />  
                    <button type="button" style="" class="add-to-carts btn btn-outline-dark btn-sm">Add to Cart</button>
                    </div>
                </div> 
            </div>
        @endforeach 
        </div>
        <div style="clear:both"></div>  
                <br />  
                @if(Session::get('Cart')) 
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>
                         
                       @php $total=0 @endphp
                       @foreach($productItems as $productItem)
                          <tr> 
                               <td> {{$productItem['item_name']}} </td>  
                               <td> {{($productItem['item_qty'])}} </td>  
                               <td> {{$productItem['item_price']}} </td>  
                               
                               <td>{{$productItem['item_qty'] * $productItem['item_price'] }}</td>  
                               <td><a href=""><span class="text-danger">Remove</span></a></td> 
                               
                               
                          </tr>  
                          @php $total = $total + ($productItem['item_qty'] * $productItem['item_price']) @endphp
                        @endforeach 
                     </table>  
                     {{$total}}
                </div>  
                @endif
           </div>  
    </div>
    </div>

    
    
    </div>

    <script>
 $(document).ready(function() {
    $('.add-to-carts').on('click',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var productQuantity = $(this).closest("div.product_data").find('.product-quantity').val();
        var productId = $(this).closest("div.product_data").find('.product-id').val();
        alert(productQuantity);
        alert(productId);
            
        $.ajax({
            method : 'POST',
            url  : '{{route("session.cart")}}',
            data: {
                'productQty': productQuantity,
                'productId': productId,
            },
            success: function(response) {
                // alertify.set('notifier','position','top-right');
                // alertify.success(response.status);
            },
        });
            return false;
    });
});
  
</script>