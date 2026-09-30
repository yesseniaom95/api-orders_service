<?php

namespace App\Services;

use App\Models\ComboOptions;

class ComboService{

    public function createCombo(array $data){

        $combo = ComboOptions::create([
            'combo_id'          => $data['combo_id'],
            'step_name'         => $data['step_name'],
            'option_product_id' => $data['option_product_id']
        ]);

        return $combo;
    }

    public function updateCombo(array $data, string $combo_id){

        $combo = ComboOptions::findOrFail($combo_id);
        $combo->update($data);

        return $combo;
    }

    public function listCombos(int $per_page = 15)
    {
        return ComboOptions::with(['optionProduct'])->paginate($per_page);
    }
}