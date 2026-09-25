<?php

namespace App\Services;

use App\Models\Table;

class TableService{

    public function createTable(array $data)
    {
        $table              =   Table::create([
            'table_number'  =>  $data['table_number'],
            'zone'          =>  $data['zone'],
            'status'        =>  $data['status']
        ]);

        return $table;
    }

    public function listTables(int $per_page = 15){

    return Table::paginate($per_page);

    }

    public function updateTable(array $data, string $id_table){

        $table = Table::findOrFail($id_table);
        $table->update($data);

        return $table;
    }

    public function listDetails(string $id_table){
        return  Table::findOrFail($id_table);   
    }

}

?>