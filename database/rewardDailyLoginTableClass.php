<?php  
// CLASS TABLE USER
class rewardDailyLoginTableClass extends connMySQLClass{
    
    // SET ATTRIBUTE TABLE NAME
    private $table_name = "reward_daily_login";
    
    // CREATE DEFAULT TABLE
    public function __construct(){
        // IF TABLE DOESN'T EXISTS, CREATE TABLE!`
        if($this->checkTable($this->table_name) == 0){
            // SET QUERY
            $sql = "CREATE TABLE $this->table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                reward_login_day INT(11) NOT NULL UNIQUE,
                reward_login_fee DOUBLE NOT NULL
            )";
            // EXECUTE THE QUERY TO CREATE TABLE
            if($this->dbConn()->query($sql)){
                $dataReward = [
                    [
                        "day" => "1",
                        "reward" => "5000"
                    ],
                    [
                        "day" => "2",
                        "reward" => "10000"
                    ],
                    [
                        "day" => "3",
                        "reward" => "20000"
                    ],
                    [
                        "day" => "4",
                        "reward" => "30000"
                    ],
                    [
                        "day" => "5",
                        "reward" => "50000"
                    ],
                    [
                        "day" => "6",
                        "reward" => "75000"
                    ],
                    [
                        "day" => "7",
                        "reward" => "90000"
                    ],
                    [
                        "day" => "8",
                        "reward" => "150000"
                    ],
                    [
                        "day" => "9",
                        "reward" => "300000"
                    ],
                    [
                        "day" => "10",
                        "reward" => "450000"
                    ],
                    [
                        "day" => "11",
                        "reward" => "650000"
                    ],
                    [
                        "day" => "12",
                        "reward" => "900000"
                    ],
                    [
                        "day" => "13",
                        "reward" => "1200000"
                    ],
                    [
                        "day" => "14",
                        "reward" => "2000000"
                    ],
                    [
                        "day" => "15",
                        "reward" => "3000000"
                    ]
                ];

                foreach($dataReward as $rewaardValue){
                    $numDay = $rewaardValue['day'];
                    $rewardFee = $rewaardValue['reward'];
                    $this->insertDailyRewardLogin(
                        fields: "reward_login_day, reward_login_fee",
                        value: "'$numDay', $rewardFee"
                    );
                }
            }

            // CLOSE THE CONNECTION
            $this->dbConn()->close();
        }
    }

    // insert data tap
    public function insertDailyRewardLogin(string $fields, string $value){
        // query
        $sql = "INSERT INTO $this->table_name ($fields) VALUE($value)";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    // get data tap
    public function selectDailyRewardLogin(string $fields, string $key){
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
    
    // update data tap
    public function updateDailyRewardLogin(string $dataSet, string $key){
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