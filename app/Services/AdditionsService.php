<?php

namespace App\Services;

use App\Models\Additions;

class AdditionsService
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
}

