<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='tbl_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'price',
        'category_id',
        'sub_category_id',
    ];

    public $timestamps = false;

    
    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
  
    public function subCategory() {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
    /**
     * product Creation
     *
     * @param array|null $productData
     * @return void
     */
    public function productCreate(array $productData) {
        return  $this->insert($productData);
    }

    /**
     * get all productd
     *
     * 
     * @return void
     */
    public function getProductList() {
        return  $this->get()->toArray();
    }

    /**
     * get product item
     * @param integer $productId
     * @return object
     */
    public function getProduct($productId) {
        return  $this->where('id', $productId)->first();
    }

    /**
     * update product item
     * @param integer $productId
     * @param array $productData
     * @return void
     */
    public function productUpdate(array $productData, int $productId) {
        return  $this->where('id', $productId)->update($productData);
    }

    /**
     * delete product item
     * @param integer $productId
     * @return void
     * 
     */
    public function productDelete(int $productId) {
        return  $this->where('id', $productId)->delete($productId);
    }
}
