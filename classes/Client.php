<?php

namespace classes;

class Client
{
    // Columns
    public $codeClient;
    public $nom;
    public $prenoms;
    public $email;
    public $dateNaissance;
    public $designation;
    public $created;
    public $updated;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

}