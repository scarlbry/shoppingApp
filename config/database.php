<?php
namespace config;
    use PDO;
    use PDOException;

    class Database {
        private $host = "127.0.0.1";
        private $dbName = "shoppingapp";
        private $username = "root";
        private $password = "";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Erreur lors de la connexion à la base de données: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
<?php
$nbr1= 7;
$nbr2 = 2;
$nbr3 = '4';
print $nbr1 + $nbr2.$nbr3;
?>

