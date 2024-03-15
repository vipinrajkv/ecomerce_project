<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Auth;
/** Models */
use App\Models\User;
use App\Models\Order;
use App\Models\OrderList;

class SessionCartController extends Controller
{
    private $user;
    private $order;
    private $orderList;

    /**
     * Undocumented function
     */
    public function __construct(
          User $user,
          Order $order,
          OrderList $orderList
    )
    {
        $this->user = $user ;
        $this->order = $order ;
        $this->orderList = $orderList ;
    }

    /**
     * Product List Page
     */
    public function index(){
        $productData = DB::table('tbl_product')->get();
        $product = Session::get('Cart') ?: '';
        // Session::flush('Cart');
        
        // return view('session_cart', ['productlist' =>$productData, 'productItems' => $product]);
        return view('layouts.frontend.product', ['productlist' =>$productData, 'productItems' => $product]);
        // return view('layouts.backend.adminHome', ['productlist' =>$productData, 'productItems' => $product]);

    }

    /**
     * Cart Listing
     * 
     */
    public function getCartItems(){

    }

    /**
     * List Page
     */
    public function cartList(){
        // $productData = DB::table('tbl_product')->get();
 
        $cartProduct = Session::get('Cart') ?: '';
        return view('cart_list', ['productItems' => $cartProduct]);
    }

   /**
    * Add Cart Items
    *
    * @param Request $request
    * @return void
    */
    public function addCart(Request $request)
    {
        $productId = (int)$request->input('productId');
        $productQty = $request->input('productQty');
        $productData = DB::table('tbl_product')->find($productId);
        $productName = $productData->name;

        if (Session::has('Cart')) {
            $cartData = Session::get('Cart');
            
            if (array_key_exists($productId, $cartData)) {

                if ($cartData[$productId]['item_id'] === $productId) {
                    $cartData[$productId]['item_qty'] === $productQty;
                    $itemName = $cartData[$productId]['item_name'];
                    Session::forget('Cart');
                    session::put('Cart', $cartData);

                    return response()->json(['status' => '"' . $itemName . '" Already Added to Cart']);
                }
            } else {
                $cartData = Session::get('Cart');
                $cartData[$productData->id] = $this->setCartData($productData, $productQty);
                $cartItems =  $cartData;
                Session::forget('Cart');
                session::put('Cart', $cartData);

                return response()->json(['status' => '"' . $productName . '" Added to cart']);
            }
        } else {
            $itemListArray[$productData->id] = $this->setCartData($productData, $productQty);
            $cartItems =  $itemListArray;
            session::put('Cart', $cartItems);

            return response()->json(['status' => '"' . $productName . '" Added to cart']);
        }
    }
    
    /**
     * Set Cart Data
     *
     * @param mixed $productData
     * @param integer $productQty
     * @return array
     */
    protected function setCartData($productData, $productQty){
    return $cart =  [
            'item_id' => $productData->id,
            'item_name' => $productData->name,
            'item_price' => $productData->price,
            'item_qty' => $productQty,
            'item_image' => $productData->image,
        ];
    }

    /**
     * To remove item from cart
     *
     * @param Request $request
     * @return void
     */
    public function removeCartItem(Request $request)
    {
        $productId = (int)$request->input('productItem');
        $productData = DB::table('tbl_product')->find($productId);
        $cartData = Session::get('Cart');

        if (Session::has('Cart')) {

            if (array_key_exists($productId, $cartData)) {
                   $itemName = $cartData[$productId]['item_name'];
                    unset($cartData[$productId]);
                    Session::forget('Cart');
                    session::put('Cart', $cartData);

                    return response()->json(['status' => '"' . $itemName . '" Already Added to Cart']);
            }
        }

    }

    /**
     * To view Checkout page
     *
     * @return void
     */
    public function checkOutView() { 
        $cartProduct = Session::get('Cart') ?: '';
        $userData = Auth::user();
        if(!empty($userData)) {
        $userId = $userData->id;
        $userDetails = $this->user->getLoggedUserDetails($userId);

        return view('layouts.frontend.check_out', 
        [
            'productItems' => $cartProduct,
            'userDetails' => $userDetails,
        ]);
    }else{
        return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
    }
    }

    /**
     * Save Order items
     *
     * @param Request $request
     * @return void
     */
    public function saveOrder(Request $request)
    {
        $cartProducts = Session::get('Cart') ?: '';
        $userData = Auth::user();
        $userId = $userData->id;
        // $this->validateCustomer($request);
 
        DB::beginTransaction();

        try {
            
            if (!empty($userId)) {
                $this->updateCustomerDetails($userId, $request);
                $orderId = $this->createOrder($userId, $request);
                $orderStatus = $this->saveOrderListItems($userId, $orderId, $cartProducts);
                
                 if ($orderStatus !== 0) {
                    $cartData = Session::get('Cart');
                    Session::forget('Cart');
                 }
            }
            DB::commit();

            return redirect();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('checkout.view')->withErrors($e->getMessage()); 
        }
    }

    /**
     * Save Custormer Detail 
     *
     * @param mixed $request
     * @param integer $userId
     * @return void
     */
    protected function saveOrderListItems(int $userId, int $orderId, array $cartProducts)
    {
        if (!empty($cartProducts)) {

            foreach ($cartProducts as $cartProduct) {
                $orderItems =  [
                    'order_id' => $orderId,
                    'product_id' => $cartProduct['item_id'],
                    'price' => $cartProduct['item_price'],
                    'tax_amount' => 0,
                    'quantity' => $cartProduct['item_qty'],
                ];
             $this->orderList->createOrderList($orderItems, $userId);
            }
    }else{

        return false;
    }
    }

    /**
     * Save Custormer Detail 
     *
     * @param mixed $request
     * @param integer $userId
     * @return integer
     */
    protected function createOrder($userId, $request)
    {
        $truckingNo = rand(1111,9999);
        $orderData =  [
            'user_id' => $userId,
            'trucking_number' => 'ecom' . $truckingNo,
            'payment_mode' => $request->input('payment_mode'),
            'payment_status' => 0,
            'order_status' => 1,
        ];

      return  $this->order->orderCreate($orderData, $userId);
    }

    /**
     * Save Custormer Detail 
     *
     * @param mixed $request
     * @param integer $userId
     * @return void
     */
    protected function updateCustomerDetails($userId, $request)
    {
        $userData =  [
            'name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'pin_number' => $request->input('pin_number'),
        ];
        $this->user->updateCustomerData($userData, $userId);
    }

    /**
     * Save Custormer Detail 
     *
     * @param mixed $request
     * @param integer $userId
     * @return void
     */
    protected function validateCustomer($request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'pin_number' => 'required',
            'express_delivery' => 'required',
        ]);
    }
}
