<?php
    class Dogs{

        // Connection
        private $conn;

        // Table
        private $db_table = "dogs";

        // Columns
        public $id_dog;
        public $race;
        public $type_de_poil;
        public $gabarit;
        public $origine;
        public $caractere;
        public $photo;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getDogs(){
            $sqlQuery = "SELECT id_dog, race, type_de_poil, gabarit, origine, caractere, photo FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createDogs(){
            var_dump($this->gabarit);
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    race = :race,
                    type_de_poil = :type_de_poil, 
                    gabarit = :gabarit,
                    origine = :origine,
                    caractere = :caractere, 
                    photo = :photo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->race=htmlspecialchars(strip_tags($this->race));
            $this->type_de_poil=htmlspecialchars(strip_tags($this->type_de_poil));
            $this->gabarit=htmlspecialchars(strip_tags($this->gabarit));
            $this->origine=htmlspecialchars(strip_tags($this->origine));
            $this->caractere=htmlspecialchars(strip_tags($this->caractere));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            
        
            // bind data
            $stmt->bindParam(":race", $this->race);
            $stmt->bindParam(":type_de_poil", $this->type_de_poil);
            $stmt->bindParam(":gabarit", $this->gabarit);
            $stmt->bindParam(":origine", $this->origine);
            $stmt->bindParam(":caractere", $this->caractere);
            $stmt->bindParam(":photo", $this->photo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleDog(){
            $sqlQuery = "SELECT
            id_dog, 
            race, 
            type_de_poil, 
            gabarit, 
            origine, 
            caractere,
            photo
          FROM
            ". $this->db_table ."
        WHERE 
        id_dog = :id_dog 
        LIMIT 0,1";

$stmt = $this->conn->prepare($sqlQuery);

$stmt->bindParam(':id_dog', $this->id_dog);

$stmt->execute();

$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

$this->race = $dataRow['race'];
$this->type_de_poil = $dataRow['type_de_poil'];
$this->gabarit = $dataRow['gabarit'];
$this->origine = $dataRow['origine'];
$this->caractere = $dataRow['caractere'];
$this->photo = $dataRow['photo'];
}          

        // UPDATE
        public function updateDogs(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    race = :race, 
                    type_de_poil = :type_de_poil, 
                    gabarit = :gabarit, 
                    origine = :origine, 
                    caractere = :caractere,
                    photo = :photo
                    WHERE 
                    id_dog = :id_dog";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->race=htmlspecialchars(strip_tags($this->race));
            $this->type_de_poil=htmlspecialchars(strip_tags($this->type_de_poil));
            $this->gabarit=htmlspecialchars(strip_tags($this->gabarit));
            $this->origine=htmlspecialchars(strip_tags($this->origine));
            $this->caractere=htmlspecialchars(strip_tags($this->caractere));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            $this->id_dog=htmlspecialchars(strip_tags($this->id_dog));
        
            // bind data
            $stmt->bindParam(":race", $this->race);
            $stmt->bindParam(":type_de_poil", $this->type_de_poil);
            $stmt->bindParam(":gabarit", $this->gabarit);
            $stmt->bindParam(":origine", $this->origine);
            $stmt->bindParam(":caractere", $this->caractere);
            $stmt->bindParam(":photo", $this->photo);
            $stmt->bindParam(":id_dog", $this->id_dog);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteDog(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_dog = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_dog=htmlspecialchars(strip_tags($this->id_dog));
        
            $stmt->bindParam(1, $this->id_dog);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

