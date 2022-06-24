<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ContactModel;

class ContactsController extends ResourceController
{
    protected $modelName = 'App/Models/ContactModel';
    protected $format    = 'json';

    public function index()
    {
        $model = model(ContactModel::class);
        return json_encode($model->getContact());
    }

    // ...
}