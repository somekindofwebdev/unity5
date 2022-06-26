<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;

class ContactModel extends Model
{
    protected $table = 'Contacts';
    
    // TODO connect to db in constructor
    
    public function getContact($id = null)
    {
        // TODO don't need the $id - always returns all in the final app
        if ($id === null) {
            return $this->findAll();
        }

        return $this->where(['ID' => $id])->first();
    }
    
    public function updateContact($id = null, $contact = null) {

        // Connect to database
        $db = db_connect();
        
        // Gather values
        $data = [
            'first_name' => $contact->first_name,
            'middle_name' => $contact->middle_name,
            'last_name' => $contact->last_name,
            'date_of_birth' => $contact->date_of_birth,
            'address' => $contact->address,
            'postcode' => $contact->postcode,
            'telephone_number' => $contact->telephone_number,
            'email' => $contact->email,
            'active' => $contact->active
        ];
        

        // Run the Query
        try {
            $db->table('Contacts')->update($data, ['contact_id' => $id]);
            return "Contact updated";
        }
        catch (Exception $ex) {
//            http_response_code(500);
            return "DB error";
        }
    }
    
    public function addContact($contact = null) {
        // Connect to the database
        $db = db_connect();
        
        $data = [
                    'first_name' => $contact->first_name,
                    'middle_name' => $contact->middle_name,
                    'last_name' => $contact->last_name,
                    'date_of_birth' => $contact->date_of_birth,
                    'address' => $contact->address,
                    'postcode' => $contact->postcode,
                    'telephone_number' => $contact->telephone_number,
                    'email' => $contact->email,
                    'active' => $contact->active
        ];

        // Run the Query
        try {
            $db->table('Contacts')->insert($data);
            return json_encode($db->insertID());
        }
        catch (Exception $ex) {
//            http_response_code(500);
            return "DB error";
        }
        
    }
}