<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ContactsController extends ResourceController
{
    protected $modelName = 'App\Models\ContactModel';
    protected $format    = 'json';

    public function index()
    {
        return "Controller is working";
        //return $this->respond($this->model->findAll());
    }

    // ...
}