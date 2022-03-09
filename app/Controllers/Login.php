<?php

namespace App\Controllers;

use App\Models\Model_users;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Silahkan Masukkan Email',
                    'valid_email' => 'Email Salah',
                ]
            ],
            'password' => [
                'rules' => 'required'
            ]
        ];
        $validation->setRules($aturan);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }
        $model = new Model_users();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->getEmail($email);
        if ($data['password'] != md5($password)) {
            return $this->fail("Password tidak sesuai");
        }

        helper('jwt');
        $response = [
            'message' => 'otentikasi berhassil dilakukan',
            'data' => $data,
            'access_token' => createJWT($email)
        ];
        return $this->respond($response);
    }
}
