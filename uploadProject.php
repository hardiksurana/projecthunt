<?php
    require_once('config.php');

    class PROJECT{
    	private $conn;
    	public function __construct(){
    		$database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
        }

    	public function runQuery($sql){
    		$stmt = $this->conn->prepare($sql);
    		return $stmt;
    	}

    	public function upload_project($user_id, $pname, $sdesc, $ldesc){
    		try{
                $stmt = $this->conn->prepare("INSERT into projects(user_id,project_name, short_desc, long_desc) VALUES (:uid,:pname, :sdesc, :ldesc)");
    			$stmt->execute(array(':uid'=>$user_id, ':pname'=>$pname, ':sdesc'=>$sdesc, ':ldesc'=>$ldesc));
    			$row=$stmt->rowCount();

    			if($row==1){
                    echo "<script type='text/javascript'>alert('project has been uploaded');</script>";
    			}
    			else{
    				 $user->redirect('mainpage.php');
                    echo "<script type='text/javascript'>alert('project was not uploaded');</script>";
    			}
    			return $stmt;
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}

    	function retrieve_projects(){
    		try{
    			$stmt = $this->conn->prepare("SELECT * FROM projects ORDER BY project_id DESC");
                $stmt->execute();
                return $stmt;
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}

    	public function redirect($url){
    		header("Location: $url");
    	}
    }
?>
