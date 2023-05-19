<?php

namespace classes;

use controllers\BaseController;

class Client extends BaseController
{
    // Columns
    public $codeClient;
    public $nom;
    public $prenoms;
    public $email;
    public $dateNaiss;
    public $created_at;
    public $updated_at;


    protected $db_table = "client";
    protected $primary_key = "code_client";
    protected $fields = [
        "nom" => "Nom",
        "prenoms" => "Prénoms",
        "email" => "Nom",
        "dateNaiss" => "Nom",
        "created_at" => "Nom",
        "updated_at" => "Nom",
        "codeClient" => "Code du client",
    ];

    public function fromArray(Array $properties=array()){
//        foreach($properties as $key => $value){
//            $this->{$key} = $value;
//        }
    }

    /**
     * @param $codeClient
     * @param $nom
     * @param $prenoms
     * @param $email
     * @param $dateNaiss
     * @param $created
     */
    /*
    public function __construct($codeClient, $nom, $prenoms, $email, $dateNaiss, $created)
    {
        $this->codeClient = $codeClient;
        $this->nom = $nom;
        $this->prenoms = $prenoms;
        $this->email = $email;
        $this->dateNaiss = $dateNaiss;
        $this->created = $created;
    }*/


}