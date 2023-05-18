<?php

namespace controllers;

use PDO;

class BaseController
{
    // Connection
    protected $conn;

    // Table
    protected $db_table  ;
    protected $primary_key  ;
    protected  $fields = [];
    protected  $attributes = [];

// Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function attributes () {
        $attributes = get_object_vars($this);
    }

    // List ALL
    public function listAll($conditions){
        $keys = self::selectList();
       self::attributes () ;
        $query = "SELECT $keys 
                    FROM  $this->db_table  
                    ";
        if(is_array($conditions)){
            $query .= " WHERE ";
            foreach ($conditions as $key => $value){
                 $query .= " $key = :$key";
            }
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute($conditions);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }
// CREATE
    public function add(){
        self::attributes () ;
        $query = "INSERT INTO
                        ". $this->db_table ."
                        VALUES(
                        ";
        $params = [];

        if(is_array($this->attributes)){
            foreach ($this->attributes as $key => $value){
                if(!empty($value) ){
                    $query .= " $key = :$key
                ";
                  $params[":$key"] =   htmlspecialchars(strip_tags($value));
                }
            }
        }
        $query .= "";

        $stmt = $this->conn->prepare($query);

        // bind data

        if($stmt->execute($params)){
            return true;
        }
        return false;
    }

    /***
     * @return string
     */
    private  function  selectList(){
        return implode(",",array_keys($this->fields));
    }
    // UPDATE

    /***
     * @return mixed
     */
    public function view(){
        $keys = self::selectList();
        $query = "SELECT 
                        $keys
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       $this->primary_key = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->codeClient);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE

    /***
     * @param array attributes
     * @return bool
     */
    public function update(  $attributes){
        $query = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function delete($id){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE $this->primary_key = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($id));

        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}