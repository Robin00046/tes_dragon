<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Model_category;
use CodeIgniter\HTTP\Response;

class Category extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new Model_category();
    }
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data Tidak ditemukan untuk id $id");
        }
    }
    public function create()
    {
        // $data = [
        //     'name' => $this->request->getVar('name'),
        //     'created_at' => $this->request->getVar('created_at'),
        // ];
        $data = $this->request->getPost();
        // $this->model->save($data);
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error'  => null,
            'messeges' => [
                'success' => 'berhasil memasukan data Category'
            ]
        ];
        return $this->respond($response);
    }
    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $isexis = $this->model->where('id', $id)->findAll();
        if (!$isexis) {
            return $this->failNotFound("Tidak Ditemukan untuk id $id");
        }
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error'  => null,
            'messeges' => [
                'success' => "Data catergory id $id berhasil di update"
            ]
        ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error'  => null,
                'messeges' => [
                    'success' => 'berhasil Dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Tidak Ditemukan');
        }
    }
}
