<?php

################################################################################
# ime   : Class MysqlDB                                                        #
# opis  : Klasa za komunikaciju sa MySQL bazom podataka                        #
# autor : Ivan Bozajic                                                         #
# datum : 01/2023                                                              #
################################################################################

class MysqlDB
{
    static private $instance_MysqlDB = null;
    public $link;
    
    private $dbhost	     = 'localhost';
    private $dbuser 	 = 'root';
    private $dbpassword  = '';
    private $db 		 = 'soundwave_loc';
    private $dbcollation = "utf8"; // latin2
    
    /**************************************************************************/ 
    /**
     * Class constructor, object initialization
     *
     * @return void
     */
    private function __construct()
    {
        $this->link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword, $this->db) or die ("Could not connect to MySQL");
        $this->Query("SET NAMES " . $this->dbcollation);
    }
    
    /**************************************************************************/  
    /**
     * Execute SQL command
     *
     * @param  string $sql
     * @param  array $bind_param
     * @return resurce
     */
    public function Query($sql, $bind_param = null)
    {
        if(is_array($bind_param) && count($bind_param) > 0)
        {
            $stmt = mysqli_stmt_init($this->link);

            if(mysqli_stmt_prepare($stmt, $sql))
            {
                $params = array();
                $types = "";

                foreach($bind_param as $key => $param)
                {
                    $params[] = $param["param"];
                    $types .= $param["type"];
                }

                mysqli_stmt_bind_param($stmt, $types, ...$params);

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }
            else
            {
                // error report
                if(ini_get('display_errors') == "1")
                {
                    echo "================\n";
                    echo 'SQL ERROR: SQL statement failed ON QUERY: ' . $sql . "\n";
                    echo "================\n";
                }
            }
        }
        else
        {
            $result = mysqli_query($this->link, $sql);
        }

        if($result)
        {
            return $result;
        }
        else
        {
            // error report
            if(ini_get('display_errors') == "1")
            {
                echo "================\n";
                echo 'SQL ERROR: ' . mysqli_error($this->link) . ' ON QUERY: ' . $sql . "\n";
                echo "================\n";
            }
            
            return false;
        }        
    }


    /**************************************************************************/   
    /**
     * Fetch row by row of executed SQL command
     *
     * @param  mixed $result
     * @return db row resource
     */
    public function Fetch($result)
    {
        return mysqli_fetch_assoc($result);
    }

    /**************************************************************************/  
    /**
     * Return number of row from last SQL command
     *
     * @param  mixed $result
     * @return int
     */
    public function NumRows($result)
    {
        return mysqli_num_rows($result);
    }
    
    /**************************************************************************/ 
    /**
     * Build INSERT query from passed array and execute that query
     *
     * @param  string $table
     * @param  array $vars
     * @return bool
     */
    public function InsertQuery($table, $vars)
    {
        // trim i addslashes, prirpema varijabli
        foreach($vars as $key => $val)
        {
            $vars[$key] = $this->Clean($val);
        }

        $query = "INSERT INTO ".$table." (".implode(",", array_keys($vars)).") VALUES ('".implode("','", array_values($vars))."')";
        return $this->Query($query);
    }
    
    /**************************************************************************/ 
    /**
     * Build UPDATE query from passed array and execute that query
     *
     * @param  string $table
     * @param  array $vars
     * @param  mixed $updateID
     * @return bool
     */
    public function UpdateQuery($table, $vars, $updateID)
    {
        // dohvati trenutno stanje iz tablice
        $query_revision = "SELECT * FROM ".$table." WHERE id='$updateID'";
        $result_revision = $this->Query($query_revision);

        $row = $this->Fetch($result_revision);

        $query = "UPDATE ".$table." SET "; 
        
        // trim i addslashes, prirpema varijabli, gradi se query
        foreach($vars as $key => $val)
        {
            $query .= $key."='".$this->Clean($val)."',";
        }
        
        $query = trim($query, ",");
        
        if(is_array($updateID))
        {
        	$c = 1;
        	
        	foreach($updateID as $key => $val)
        	{
        		if($c == 1)
        			$query .= " WHERE ".$key."='".$this->Clean($val)."'";
        		else
        			$query .= " AND ".$key."='".$this->Clean($val)."'";	
        			
        		$c++;	
			}
		}
		else
		{
			$query .= " WHERE id='".$this->Clean($updateID)."'";
		}
        
        $result = $this->Query($query);

        // provjera da li je bilo izmjena
        if(mysqli_affected_rows($this->link) > 0)
        {
            $insVars = array();
            $insVars["table_name"] = $table;
            $insVars["row_id"]     = $updateID;

            if(is_array($row))
            {
                foreach($row as $k => $v)
                {
                    if(isset($v) && $v != "")
                        $row[$k] = iconv("ISO-8859-2", "UTF-8//TRANSLIT", $v);
                }
            }

            $insVars["row_data"] = json_encode($row);

//            $this->InsertQuery("revision_history", $insVars);
        }

        return $result;
    }
    
    /**************************************************************************/
    /**
     * Return ID of last INSERT query
     *
     * @return int
     */
    public function LastInsertID()
    {
        return mysqli_insert_id($this->link);
    } 
    
    /**************************************************************************/       
    /**
     * Basic variable preparation for prevent SQL Injection
     *
     * @param  mixed $val
     * @return void
     */
    public function Clean($val)
    {
        return mysqli_real_escape_string($this->link, trim($val));
    }

    /**************************************************************************/ 
    /**
     * Return instance of this class - Singleton Pattern
     *
     * @return void
     */
    static public function getInstance()
    {
        if(self::$instance_MysqlDB == null)
        {
            self::$instance_MysqlDB = new self;
        }
        return self::$instance_MysqlDB;
    }
}


// EXAMPE - HOW TO USE
// $db1 = MysqlDB::getInstance();

// $return = $db1->Query("SELECT * FROM wehgb");

// while($web = $db1->Fetch($return))
// {
//     echo $web["title"];
// }


?>