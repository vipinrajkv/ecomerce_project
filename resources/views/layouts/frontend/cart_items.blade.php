<ul class="dropdown-menu" style="width: 225px;">
    @foreach ($cartItems as $items)
    <li>
       <span class="item">
         <span class="item-left">
             {{-- <img src="http://lorempixel.com/50/50/" alt="" /> --}}
             <span class="item-info">
                 <span>{{$items['item_name']}}</span>
                 <span>{{$items['item_price']}}</span>
             </span>
         </span>
         <span class="item-right">
             <button class="btn btn-xs btn-danger pull-right">x</button>
         </span>
     </span>
   </li>
   @endforeach



   <li class="divider"></li>
   <li><a class="text-center" href="">View Cart</a></li>
 </ul>