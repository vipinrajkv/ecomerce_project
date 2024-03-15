<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
class ProductController extends Controller
{
    private $product;
    private $category;
    private $subCategory;

    /**
     * Undocumented function
     *
     * @param Product $product
     * @param Category $category
     */
    public function __construct(
        Product $product,
        Category $category,
        SubCategory $subCategory,
    ) {
        $this->product = $product;
        $this->category = $category;
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct()
    {
        $page = 'create';
        $categories = $this->category->get();
        $subCategories = $this->subCategory->get();

        return view('admin.products.add_edit_product',compact('categories', 'subCategories', 'page'));
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getProductItem(int $id)
    {
        $page = 'edit';
        $categories = $this->category->get();
        $subCategories = $this->subCategory->get();
        $productDetails = $this->product->getProduct($id);
       
        return view('admin.products.add_edit_product',compact('categories', 'productDetails', 'subCategories', 'page'));
    }

    /**
     * Show the form for creating product.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdateProduct(Request $request)
    {
        $rules = $this->validateRules();
        $previousProductImage = $request->previous_product_image;

        if (empty($previousProductImage)) {
            $rules['image'] = 'required';
        }

        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $id = $request->has('id') ? $request->product_id : '';
        $imgFile = $request->file('image');
        $postData = $request->except(['_token', 'id', 'previous_product_image']);
        if ($imgFile != null) {

            if (!empty($previousProductImage) && file_exists(public_path('/upimages/product/'. $previousProductImage))){
                unlink(public_path('/upimages/product/'. $previousProductImage));
            }
            $productImage = time() . '.' . $imgFile->getClientOriginalExtension();
            $destinationPath = public_path('/upimages/product');
            $imgFile->move($destinationPath, $productImage);
            $postData['image'] =  $productImage;
        }
        try {
            $product =  $this->product->updateOrCreate(['id' => $id], $postData);

            if ($product) {
                return redirect()->route('product.list')->with('success', 'Data inserted/Updated Successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error'=> $e->getMessage()]);
        }
    }


    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function productList()
    {
        // $productList = $this->product->with(['category','subCategory'])->get();
        $productList = $this->product->with(['category','subCategory'])->get();
        
        return view('admin.products.product_list',compact('productList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $productId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $productId)
    {
        $product =  $this->product->getProduct($productId);

        if ($product) {
            return response()->json(
                [   
                    'status' => 200,
                    'productItems' => $product
            ], 200);
        }

        return response()->json(
            [
                'status' => 400,
                'message' => 'Product Item not found',
            ],
            400
        );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $productId = null)
    {
        $productData =  $this->product->getProduct($productId);
        $filePath = public_path('/upimages' . '/' . $productData->image);

        if (file_exists($filePath)) {
            unlink($filePath);
            $product =  $this->product->productDelete($productId);
        } else {
            $product =  $this->product->productDelete($productId);
        }

        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted successfully'
            ], 200);
        } else {

            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @return array
     */
    public function validateRules()
    {
       $validate = [
        'name' => 'required',
        'price' => 'required',
       ];

       return $validate;
    }
}
