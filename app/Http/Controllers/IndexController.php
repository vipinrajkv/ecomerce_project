<?php

namespace App\Http\Controllers;
/** Models */
use App\Models\RentRate;
use App\Models\CarSegment;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Psy\CodeCleaner\IssetPass;

class IndexController extends Controller
{
    private $rentRate;
    private $carSegment;
    private $brand;
    private $category;

    /**
     * Construct function
     *
     * 
     */
    public function __construct(
        RentRate $rentRate,
        CarSegment $carSegment,
        Brand $brand,
        Category $category,
    ){
        $this->rentRate = $rentRate;
        $this->carSegment = $carSegment;
        $this->brand = $brand;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function carFilter(Request $request)
    {
        $query = $this->carSegment->with(['category', 'brand', 'carRent'])->get();

        if (isset($request->category)) {
          return  $query->where('category_id', $request->category);
        }
        $carsLists = $query;
        $categories = $this->category->get();
        // dd($carsLists);
        return view('frontend.car_booking_filter',
         [
            'categories' => $categories,
            'carsLists' => $carsLists
         ]);
    }
}
