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
        if ($id === null) {
            return $this->findAll();
        }

        return $this->where(['ID' => $id])->first();
    }
    
    public function updateContact($id = null, $contact = null) {
        // No Query Builder option for Update - have to run sproc

        // Connect to database
        $db = db_connect();
        
        // Prepare the Query
        $pQuery = $db->prepare(static function ($db) {
            $sql = 'CALL UpdateContact (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

            return (new Query($db))->setQuery($sql);
        });

        // Collect the Data
        if ($contact != null) {            
            $contact_id = $id;
            $first_name = $contact->first_name;
            $middle_name = $contact->middle_name;
            $last_name = $contact->last_name;
            $date_of_birth = $contact->date_of_birth;
            $address = $contact->address;
            $postcode = $contact->postcode;
            $telephone_number = $contact->telephone_number;
            $email = $contact->email;
            $active = $contact->active;
        }
        else {
//            http_response_code(500);
            return "Contact not found";
        }

        // Run the Query
        try {
            $results = $pQuery->execute($contact_id, $first_name, $middle_name, $last_name, $date_of_birth, $address, $postcode, $telephone_number, $email, $active);
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
        
        // Prepared query - avoid SQL injection
        $pQuery = $db->prepare(static function ($db) {
                return $db->table('user')->insert([
                    'name'    => 'x',
                    'email'   => 'y',
                    'country' => 'US',
            ]);
        });
    }
}