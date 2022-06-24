<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'Contacts';
    
    public function getContact($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->where(['ID' => $id])->first();
    }
}