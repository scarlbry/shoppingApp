<?php

namespace controllers;
use PDO;
use classes\Client;

class ClientController extends BaseController
{
    protected $db_table = "client";
    protected $primary_key = "code_client";
    protected $fields = [
          "nom" => "Nom",
          "prenoms" => "Prénoms",
          "email" => "Nom",
          "dateNaiss" => "Nom",
          "created" => "Nom",
          "updated" => "Nom",
          "codeClient" => "Code du client",
          ];

    public function __construct( $db){
        parent::__construct($db);
    }

}