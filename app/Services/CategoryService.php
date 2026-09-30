<?php

namespace App\Services;

use App\Models\Category;

class CategoryService{

    public function createCategory(array $data)
    {
        $category       =   Category::create([
            'name'      =>  $data['name'],
            'icon'      =>  $data['icon'],
            'sort_order'=>  $data['sort_order']
        ]);

        return $category;
    }

    public function listCategory(int $per_page = 15){
        return Category::with([
            
            'products.comboOptions'=> function ($query){
                $query->select('id', 'step_name', 'combo_id', 'option_product_id');
            },
            'products.comboOptions.optionProduct' => function ($query) {
                $query->select('id', 'name');
        }])->paginate($per_page);
    }

    public function categoryDetails(string $id_category ){
        return Category::findOrFail($id_category);
    }

    public function updateCategory(array $data, string $id_category){
        $category = Category::findOrFail($id_category);
        $category->update($data);

        return $category;
    }
}

?>
