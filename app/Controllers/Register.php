<?php

namespace App\Controllers;

use App\Models\Model_users;
use CodeIgniter\API\ResponseTrait;
use Exception;
use \Firebase\JWT\JWT;

class Register extends BaseController
{
    use ResponseTrait;
    public function index()
    {

        $rules = [
            "name" => "required",
            "email" => "required|valid_email|is_unique[users.email]|min_length[6]",
            "password" => "required",
        ];

        $messages = [
            "name" => [
                "required" => "name is required"
            ],
            "email" => [
                "required" => "Email required",
                "valid_email" => "Email address is not in format"
            ],
            "password" => [
                "required" => "password is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {

            $Model_users = new Model_users();

            $data = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "password" => md5($this->request->getVar("password")),
            ];

            if ($Model_users->insert($data)) {
                helper('jwt');
                $response = [
                    'status' => 200,
                    "error" => false,
                    'messages' => 'Successfully, user has been registered',
                    'data' => [],
                    'access_token' => createJWT($data)
                ];
            } else {

                $response = [
                    'status' => 500,
                    "error" => true,
                    'messages' => 'Failed to create user',
                    'data' => []
                ];
            }
        }
        return $this->respondCreated($response);
    }
}
