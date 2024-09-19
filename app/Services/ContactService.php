<?php

namespace App\Services;

interface ContactService
{
    public function getAllContacts();
    public function getContactById($id);
    public function createContact(array $data);
    public function updateContact($id, array $data);
    public function deleteContact($id);
}
