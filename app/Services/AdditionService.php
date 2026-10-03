<?php

namespace App\Services;

use App\Models\Additions;

class AdditionService
{
    public function createAdditions(array $data)
    {
        $addition = Additions::create(
            [
                'name'              => $data['name'],
                'additional_price'  => $data['additional_price'],
                'product_id'        => $data['product_id']
            ]);
        
        return $addition;
    }

    public function updateAddition(array $data, string $addition_id){
        $addition = Additions::findOrFail($addition_id);
        $addition->update($data);

        return $addition;
    }
}

