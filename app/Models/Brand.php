<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table ='brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      
        'brand_name',
        'category_id',
    ];

    /**
     * get Brand Item
     *
     * @param integer $brandId
     * @return void
     */
    public function getBrandItem(int $brandId) {
      return  $this->where('id',$brandId)->first();
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
      }

    /**
     * update category item
     * @param integer $productId
     * @return void
     */
    public function getCategoryBrand(int $categoryId) {
      return  $this->where('category_id', $categoryId)->get();
    }
}
