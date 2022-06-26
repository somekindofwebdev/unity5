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
        // CodeIgniter has Validation library - but it needs a form, or FormData
        // Too late to rewrite all the methods to accept FormData now!
        // Could also have done two separate server requests for validation and submission
        
        $validationErrors = $this->validateContact($contact);
        if (!empty($validationErrors)) {
            return $this->failValidationError(join(PHP_EOL, $validationErrors));
        }
        
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
        // CodeIgniter has Validation library - but it needs a form, or FormData
        // Too late to rewrite all the methods to accept FormData now!
        // Could also have done two separate server requests for validation and submission
        
        $validationErrors = $this->validateContact($contact);
        if (!empty($validationErrors)) {
            return $this->failValidationError(join(PHP_EOL, $validationErrors));
        }
        
        // Pass $contact to model for creation
        $model = model(ContactModel::class);
        return $this->response->setJSON($model->addContact($contact));
    }
    
    public function validateContact($contact) {
        $errors = [];
        
        // Check names present
        if (empty($contact->first_name)) {
            array_push($errors, "Please enter a first name");
        }
        
        if (empty($contact->last_name)) {
            array_push($errors, "Please enter a last name");
        }
        
        // Check email format
        if (!filter_var($contact->email, FILTER_VALIDATE_EMAIL)) {
           array_push($errors, "Please check email address format"); 
        }
        
        return $errors;
    }

    // ...
}