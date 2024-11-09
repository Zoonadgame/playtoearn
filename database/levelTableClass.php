<?php  
// CLASS TABLE USER
class levelTableClass extends connMySQLClass{
    
    // SET ATTRIBUTE TABLE NAME
    private $table_name = "level_zoonad";
    
    // CREATE DEFAULT TABLE
    public function __construct(){
        // IF TABLE DOESN'T EXISTS, CREATE TABLE!`
        if($this->checkTable($this->table_name) == 0){
            // SET QUERY
            $sql = "CREATE TABLE $this->table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                level_name VARCHAR(250) NOT NULL UNIQUE,
                level_coin DOUBLE NOT NULL
            )";
            // EXECUTE THE QUERY TO CREATE TABLE
            $createTable = $this->dbConn()->query($sql);
            if($createTable){
                $name = array(
                    "Sproutling",
                    "Leafwatcher",
                    "Trailblazer",
                    "Woodland Scout",
                    "Canopy Ranger",
                    "Jungle Stalker",
                    "Savanna Sentinel",
                    "Beastmaster",
                    "Wildheart Warden",
                    "Primeval Guardian",
                    "Elder of the Wilds"
                );
                $coin = array(
                    "0",
                    "1000",
                    "50000",
                    "100000",
                    "5000000",
                    "10000000",
                    "500000000",
                    "1000000000",
                    "50000000000",
                    "100000000000",
                    "5000000000000"
                );
                foreach($name as $key => $valName){
                    $valCoin = $coin[$key];
                    $this->insertLevel(
                        fields: "level_name, level_coin",
                        value: "'$valName', '$valCoin'"
                    );
                }
            }
            // CLOSE THE CONNECTION
            $this->dbConn()->close();
        }
    }

    // insert data lvl
    public function insertLevel(string $fields, string $value){
        // query
        $sql = "INSERT INTO $this->table_name ($fields) VALUE($value)";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    // get data lvl
    public function selectLevel(string $fields, string $key){
        // query
        $sql = "SELECT $fields FROM $this->table_name WHERE $key";
        // EXECUTE QUERY
        $exe = $this->dbConn()->query($sql);
        // SET DATA FROM TABLE
        while($rows = $exe->fetch_assoc()){
            $data[] = $rows;
        }
        // GET DATA TABLE
        $result["data"] = $data;
        // GET NUMS ROW TABLE
        $result["row"] = $exe->num_rows;
         // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $result;
    }
    
    // update data lvl
    public function updateLevel(string $dataSet, string $key){
        // query
        $sql = "UPDATE $this->table_name SET $dataSet WHERE $key";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }
}

?>