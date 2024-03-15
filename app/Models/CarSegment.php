<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Brand;
use App\Models\RentRate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSegment extends Model
{
    use HasFactory;
    protected $table ='cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_name',
        'category_id',
        'brand_id',
        'car_image',
        'fuel_type',
        'model_year',
    ];

    public function category() {
      return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand() {
      return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function carRent() {
      return $this->belongsTo(RentRate::class,'id','id');
    }

    /**
     * get Car Item Details
     *
     * @param integer $carId
     * @return object
     */
    public function getCarItem(int $carId) {
      return  $this->where('id',$carId)->first();
    }

    // public function category() {
    //     return $this->belongsTo(Category::class,'category_id','id');
    //  }
}
