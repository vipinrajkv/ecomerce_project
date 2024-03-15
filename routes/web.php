<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productlist', 'App\Http\Controllers\SessionCartController@index')->name('productlist');
Route::get('/cartlist', 'App\Http\Controllers\SessionCartController@cartList')->name('cartlist');
Route::post('/session_cart', 'App\Http\Controllers\SessionCartController@addCart')->name('session.cart');
Route::post('/remove_cart_item', 'App\Http\Controllers\SessionCartController@removeCartItem')->name('remove.cart.item');
Route::get('/checkout-view', 'App\Http\Controllers\SessionCartController@checkOutView')->name('checkout.view');
Route::post('/save-order', 'App\Http\Controllers\SessionCartController@saveOrder')->name('save.order');

Route::middleware(['auth', 'role:admin|employee'])->group(function (){
//Admin product routes
Route::group(['prefix' => 'product'], function () {
    Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/create-product', [App\Http\Controllers\ProductController::class, 'createOrUpdateProduct'])->name('create.product');
    Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'getProductItem'])->name('edit.product');
    Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'deleteProductrItem'])->name('delete.product');
    Route::get('/product-list', [App\Http\Controllers\ProductController::class, 'productList'])->name('product.list');
});
//Category related routes
Route::group(['prefix' => 'category'], function () {
    Route::get('/add-category', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('add.category');
    Route::post('/create-category', [App\Http\Controllers\CategoryController::class, 'createEditCategory'])->name('create.category');
    Route::get('/edit-category/{id}', [App\Http\Controllers\CategoryController::class, 'getCategory'])->name('edit.category');
    Route::get('/delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('delete.category');
    Route::get('/category-list', [App\Http\Controllers\CategoryController::class, 'categoryList'])->name('category.list');
});
//Category related routes
Route::group(['prefix' => 'subcategory'], function () {
    Route::get('/add-subcategory', [App\Http\Controllers\SubCategoryController::class, 'addSubCategory'])->name('add.subcategory');
    Route::post('/create-subcategory', [App\Http\Controllers\SubCategoryController::class, 'createEditSubCategory'])->name('create.edit.subcategory');
    Route::get('/edit-subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'getSubCategory'])->name('edit.subcategory');
    Route::get('/delete-subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'deleteSubCategory'])->name('delete.subcategory');
    Route::get('/subcategory-list', [App\Http\Controllers\SubCategoryController::class, 'SubCategoryList'])->name('subcategory.list');
    Route::get('/get-subcategories/{id}', [App\Http\Controllers\SubCategoryController::class, 'getSubCategoryItems'])->name('get-subcategory-items');
});
//Order related routes
Route::group(['prefix' => 'orders'], function () {    
    // Route::post('/create-subcategory', [App\Http\Controllers\SubCategoryController::class, 'createEditSubCategory'])->name('create.edit.subcategory');
    Route::get('/view-order/{id}', [App\Http\Controllers\OrderController::class, 'getOrderDetails'])->name('view.order');
    Route::get('/order-list', [App\Http\Controllers\OrderController::class, 'getAllOrders'])->name('order.list');
});

//Role related routes
Route::group(['prefix' => 'users'], function () {    
    Route::get('/view-user/{id}', [App\Http\Controllers\UsersController::class, 'getUser'])->name('view.user');
    Route::get('/users-list', [App\Http\Controllers\UsersController::class, 'getAllUsers'])->name('users.list');
    Route::post('/create-update-user', [App\Http\Controllers\UsersController::class, 'editUser'])->name('create.update.user');
});

//Role related routes
Route::group(['prefix' => 'roles'], function () {
    Route::get('/add-role', [App\Http\Controllers\RoleController::class, 'addRole'])->name('add.role');    
    Route::get('/view-role/{id}', [App\Http\Controllers\RoleController::class, 'getRole'])->name('view.role');
    Route::get('/roles-list', [App\Http\Controllers\RoleController::class, 'getAllRoles'])->name('roles.list');
    Route::post('/update-role', [App\Http\Controllers\RoleController::class, 'addOrEditRole'])->name('create.update.roles');
});

});





Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\ProductController::class, 'productList'])->name('home');
