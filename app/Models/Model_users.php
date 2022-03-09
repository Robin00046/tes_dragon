<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Model_users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'password', 'crated_at', 'updated_at'
    ];
    function getEmail($email)
    {
        $builder = $this->table("users");
        $data = $builder->where("email", $email)->first();
        if (!$data) {
            throw new Exception("data otentifikasi tidak ditemukan");
        }
        return $data;
    }
}
