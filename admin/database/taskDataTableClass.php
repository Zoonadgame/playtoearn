<?php  
// CLASS TABLE USER
class taskDataTableClass extends connMySQLClass{
    
    // SET ATTRIBUTE TABLE NAME
    private $table_name = "task_data_zoonad";
    
    // CREATE DEFAULT TABLE
    public function __construct(){
        // IF TABLE DOESN'T EXISTS, CREATE TABLE!`
        if($this->checkTable($this->table_name) == 0){
            // SET QUERY
            $sql = "CREATE TABLE $this->table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                task_id VARCHAR(11) NOT NULL UNIQUE,
                task_name VARCHAR(250) NOT NULL,
                task_icon TEXT NOT NULL,
                task_desk TEXT NOT NULL,
                task_type ENUM('link','inv friends', 'have friends') NOT NULL,
                task_category ENUM('YT', 'OTHER') NOT NULL,
                task_condition TEXT NOT NULL,
                task_reward DOUBLE NOT NULL,
                task_date_create TEXT NOT NULL,
                task_date_expired TEXT NOT NULL
            )";
            // EXECUTE THE QUERY TO CREATE TABLE
            $this->dbConn()->query($sql);
            // CLOSE THE CONNECTION
            $this->dbConn()->close();
        }
    }

    // insert data task
    public function insertTaskData(string $fields, string $value){
        // query
        $sql = "INSERT INTO $this->table_name ($fields) VALUE($value)";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    // get data task
    public function selectTaskData(string $fields, string $key){
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
    
    // update data task
    public function updateTaskData(string $dataSet, string $key){
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