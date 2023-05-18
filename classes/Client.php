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
    public $created;
    public $updated;

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