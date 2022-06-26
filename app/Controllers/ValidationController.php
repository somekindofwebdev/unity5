<?php

/*
Codeigniter offers a validation class, but it seems to necessitate a page refresh -
we need to do it with AJAX, so it's hand-coded here
*/
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
//use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;

class ValidationController extends ResourceController
{
    // Set model to use, and data return format
    protected $modelName = 'App/Models/ContactModel';
    protected $format    = 'json';
    
    // HTTP POST Route: Validation
    public function validate() {
        // Get $contact from request body
        $request = service('request');
        $contact = $request->getJSON();
        
        // Execute getContact method to retrieve contacts from database
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->getContact());
    }
}