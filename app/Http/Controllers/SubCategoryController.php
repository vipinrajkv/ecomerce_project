<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** Models */
use App\Models\SubCategory;
use App\Models\Category;

use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    private $subCategory;
    private $category;
    public function __construct(
        SubCategory $subCategory,
        Category $category,
    ) {
        $this->category = $category;
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSubCategory()
    {
        $page = 'create';
        $categories = $this->category->get();

        return view('admin.subcategory.add_edit_sub_category',compact('categories', 'page'));
    }

    /**
     * Show the form for creating Sub Category.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function createEditSubCategory(Request $request)
    {
        $validator = validator::make($request->all(), [
            'sub_category_name' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $subCategoryData =  [
                'sub_category_name' => $request->input('sub_category_name'),
                'category_id' => $request->input('category'),
                'created_at' => date("Y/m/d"),
                'updated_at' => date("Y/m/d"),
            ];
            $subCategory =  $this->subCategory->subCategoryCreate($subCategoryData);
            if ($subCategory) {
                return redirect()->route('subcategory.list')->with('success', 'Data inserted/Updated Successfully');
            } else {
                return redirect()->back()->with('Failed', 'Data inserted/Updated Failed');
            }
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function subCategoryList()
    {
        $subCategories = $this->subCategory->with(['category'])->get();

        return view('admin.subcategory.sub_category_list',compact('subCategories'));
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory(int $id)
    {
        $page = 'edit';
        $categories = $this->category->get();
        $subCategory =  $this->subCategory->getSubCategory($id);
       
        return view('admin.subcategory.add_edit_sub_category',compact('categories', 'subCategory', 'page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $subCategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $subCategoryId = null)
    {
        $subCategory =  $this->subCategory->subCategoryDelete($subCategoryId);
        
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSubCategoryItems(int $id)
    {
        $subCategoryList = $this->subCategory->getSubCategoryItems($id);
        return response()->json(['result' => $subCategoryList]);
    }
}
