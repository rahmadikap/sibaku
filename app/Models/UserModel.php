<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['username', 'password']; 
    protected $beforeInsert = ['hashPassword']; 
    protected $beforeUpdate = ['hashPassword']; 

    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }

    public function validateUser($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
