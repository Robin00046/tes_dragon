<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_category extends Model
{
    protected $table = "Category";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', 'created_at', 'updated_at'];

    protected $validationRules = [
        'name' => 'required'
    ];
    protected $valodationMessages = [
        'name' => [
            'required' => 'Silahkan Masukan Nama'
        ]
    ];
}
