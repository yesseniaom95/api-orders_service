<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function listUser(int $per_page = 15)
    {
        
        return User::paginate($per_page);
    }

    public function registerUser(array $data)
    {
        $user = User::create(
            [
                'name'  => $data['name'],
                'email' => $data['email'],
                'role'  => $data['role'],
                'password'  => Hash::make($data['password'])
            ]);

        return $user;
    }
}