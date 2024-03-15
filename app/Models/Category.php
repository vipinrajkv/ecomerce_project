<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table ='categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'status',
    ];

    public $timestamps = false;

    /**
     * category Creation
     *
     * @param array|null $categoryData
     * @return void
     */
    public function categoryCreate(array $categoryData) {
        return  $this->insert($categoryData);
    }

    /**
     * get all category Data
     *
     * 
     * @return void
     */
    public function getCategoryList() {
        return  $this->get()->toArray();
    }

    /**
     * get  category item
     *
     * @param integer $categoryId
     * @return void
     */
    public function getCategoryItem($categoryId = null) {
        $result = [];
        $data =   $this->where('id', $categoryId)->first();
        $result = $data ? $data->toArray() : [];
        return $result;
    }

    /**
     * update category item
     * @param integer $productId
     * @param array $categoryData
     * @return void
     */
    public function categoryUpdate(array $categoryData, int $categoryId) {
        return  $this->where('id', $categoryId)->update($categoryData);
    }

    /**
     * delete category item
     * @param integer $categoryId
     * @return void
     * 
     */
    public function categoryDelete(int $categoryId) {
        return  $this->where('id', $categoryId)->delete();
    }
}
