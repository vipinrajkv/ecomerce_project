<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table ='sub_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array <int, string>
     */
    protected $fillable = [
        'sub_category_name',
        'category_id',
        'status',
    ];

    public $timestamps = false;

    public function category() {
       return $this->belongsTo(Category::class,'category_id','id');
    }
    /**
     * Sub Category Creation
     *
     * @param array|null $subCategoryData
     * @return void
     */
    public function subCategoryCreate(array $subCategoryData) {
        return  $this->insert($subCategoryData);
    }

    /**
     * get all sub category Data
     *
     * 
     * @return void
     */
    public function getSubCategoryList() {
        return  $this->get()->toArray();
    }

    /**
     * get sub category item
     * @param integer $subCategoryId
     * @return object
     */
    public function getSubCategory($subCategoryId) {
        return  $this->where('id', $subCategoryId)->first();
    }

    
    /**
     * update category item
     * @param integer $productId
     * @return void
     */
    public function getSubCategoryItems(int $categoryId) {
        return  $this->where('id', $categoryId)->get();
    }

    /**
     * update sub category item
     * @param integer $subCategoryId
     * @param array $subCategoryData
     * @return void
     */
    public function subCategoryUpdate(array $subCategoryData, int $subCategoryId) {
        return  $this->where('id', $subCategoryId)->update($subCategoryData);
    }

    /**
     * delete sub category item
     * @param integer $subCategoryId
     * @return void
     * 
     */
    public function subCategoryDelete(int $subCategoryId) {
        return  $this->where('id', $subCategoryId)->delete();
    }
}
