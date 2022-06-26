<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
//use CodeIgniter\API\ResponseTrait;
use App\Models\ContactModel;
use CodeIgniter\HTTP\IncomingRequest;

class ContactsController extends ResourceController
{
    // Set model to use, and data return format
    protected $modelName = 'App/Models/ContactModel';
    protected $format    = 'json';
    
    // TODO Set $model in the constructor

    // HTTP GET Route: Contacts
    public function index()
    {
        // Explicitly return JSON
        header("Content-Type: application/json");
        
        // Execute getContact method to retrieve contacts from database
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->getContact());
    }
    
    // HTTP PATCH Route: Contacts/id
    public function update($id = null) {
        
        // Get $contact from request body
        $request = service('request');
        $contact = $request->getJSON();
        
        // Error if contact not received
        if ($contact == null) { return "Contact not received"; }
        
        // Validate
        
        // Pass $contact to model for update
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->updateContact($id, $contact));
        
        // TODO error handling
    }
    
    // HTTP POST Route: Contacts
    public function create() {
        // TODO DRY this
        
        // Explicitly return JSON
        header("Content-Type: application/json");
        
        // Get $contact from request body
        $request = service('request');
        $contact = $request->getJSON();
        
        // Error if contact not received
        if ($contact == null) { return "Contact not received"; }
        
        // Validate
        
        // Pass $contact to model for creation
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->addContact($contact));
    }

    // ...
}