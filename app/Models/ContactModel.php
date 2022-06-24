<?php

use CodeIgniter\Model;

class ContactModel extends Model
{
    public function getContact($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}