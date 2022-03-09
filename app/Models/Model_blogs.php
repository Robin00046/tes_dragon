<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_blogs extends Model
{
    protected $table = "blogs";
    protected $primaryKey = "id";
    protected $allowedFields = ['category_id', 'users_id', 'title', 'disc', 'created_at', 'updated_at'];

    protected $validationRules = [
        'category_id' => 'required',
        'users_id' => 'required',
        'title' => 'required',
        'disc' => 'required',
    ];
    protected $valodationMessages = [
        'category_id' => [
            'required' => 'Silahkan Masukan Nama'
        ],
        'users_id' => [
            'required' => 'Silahkan Masukan user id'
        ],
        'title' => [
            'required' => 'Silahkan Masukan title'
        ],
        'disc' => [
            'required' => 'Silahkan Masukan disc'
        ]
    ];
}
