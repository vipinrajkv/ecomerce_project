<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $category;
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    /**
     * Show the form for creating category.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        $id = $request->has('id') ? $request->id : '';
        $categoryData =  [
            'category_name' => $request->input('category_name'),
            'status' => $request->input('status') ?? 1,
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ];
        // $category =  $this->category->categoryCreate($categoryData);
        try {
            $category =  $this->category->updateOrCreate(['id' => $id], $categoryData);

            if ($category) {
                return redirect()->route('category.list')->with('success', 'Data inserted/Updated Successfully');
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
    public function addCategory()
    {
        $page = 'create';

        return view('admin.category.add_edit_category', compact('page'));
    }


    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        $categories = $this->category->get();
        
        return view('admin.category.category_list',compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category =  $this->category->getCategoryList();

        if (!empty($category)) {
            return response()->json([
                'status' => 200,
                'categoryList' => $category,
                'message' => 'Category lists found',
            ], 200);
        }

        return response()->json(
            ['status' => 400,
            'message' =>  'Category lists not found',
            ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $categoryId)
    {
        $category =  $this->category->getCategoryItem($categoryId);

        if (!empty($category)) {
            return response()->json([
                'status' => 200,
                'message' => 'Category Data found',
                'CategoryData' => $category
            ], 200);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Category Data Not found',
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $categoryId)
    {
        $validator = validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $categoryData =  [
                'category_name' => $request->input('category_name'),
                'status' => $request->input('status') ?? 1,
            ];
            $category =  $this->category->categoryUpdate($categoryData, $categoryId);

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category updated successfully'
                ], 200);
            }
                return response()->json([
                    'status' => 500,
                    'message' => 'Category update failed'
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId = null)
    {
        $category =  $this->category->categoryDelete($categoryId);
        
        if ($category) {
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully'
            ], 200);
        }
            return response()->json([
                'status' => 500,
                'message' => 'Category delete failed'
            ], 500);
    }
}
