<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CarSegment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentRate extends Model
{
    use HasFactory;
    protected $table ='rent_rates';

    protected $fillable = [   
        'category_id',
        'brand_id',
        'car_id',
        'rate_per_hr',
        'rate_per_day',
    ];

    /**
     * category relationship
     *
     * @return void
     */
    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    /**
     * brand relationship
     *
     * @return void
     */
    public function brand() {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    /**
     * Car segment relationship
     *
     * @return void
     */
    public function car() {
        return $this->belongsTo(CarSegment::class,'car_id','id');
    }

    

    /**
     * get Car Rent Details
     *
     * @param integer $rentId
     * @return object
     */
    public function getCarRent(int $rentId) {
        return  $this->where('id',$rentId)->first();
      }
}
