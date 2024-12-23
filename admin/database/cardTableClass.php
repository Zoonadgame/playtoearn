<?php  
// CLASS TABLE USER
class cardTableClass extends connMySQLClass{
    
    // SET ATTRIBUTE TABLE NAME
    private $table_name = "card_zoonad";
    
    // CREATE DEFAULT TABLE
    public function __construct(){
        // IF TABLE DOESN'T EXISTS, CREATE TABLE!`
        if($this->checkTable($this->table_name) == 0){
            // SET QUERY
            $sql = "CREATE TABLE $this->table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                card_id VARCHAR(11) NOT NULL UNIQUE,
                card_img TEXT NOT NULL,
                card_name VARCHAR(500) NOT NULL,
                card_desc TEXT NOT NULL,
                card_category VARCHAR(11) NOT NULL,
                card_profit DOUBLE NOT NULL,
                card_start_fee DOUBLE NOT NULL,
                card_up_fee DOUBLE NOT NULL,
                card_category_unlock ENUM('INV FRIENDS', 'INV MORE FRIENDS', 'OWNED OTHER CARD', 'NONE') NOT NULL DEFAULT 'NONE',
                card_unlock_detail TEXT NOT NULL DEFAULT 'NONE',
                card_unlock_id VARCHAR(11) NOT NULL DEFAULT 'NONE',
                card_unlock_num_condition INT(11) NOT NULL DEFAULT '0',
                card_date TEXT NOT NULL
            )";
            // EXECUTE THE QUERY TO CREATE TABLE
            $this->dbConn()->query($sql);
            // CLOSE THE CONNECTION
            $this->dbConn()->close();
        }
    }

    // insert data card
    public function insertCard(string $fields, string $value){
        // query
        $sql = "INSERT INTO $this->table_name ($fields) VALUE($value)";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    // get data card
    public function selectCard(string $fields, string $key){
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
    
    // update data card
    public function updateCard(string $dataSet, string $key){
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