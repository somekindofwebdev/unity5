<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
//use CodeIgniter\API\ResponseTrait;
use App\Models\ContactModel;

class ContactsController extends ResourceController
{
    protected $modelName = 'App/Models/ContactModel';
    protected $format    = 'json';

    public function index()
    {
        header("Content-Type: application/json");
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->getContact());
    }
    
    public function update($id = null) {
        return "sdf";
    }

    // ...
}