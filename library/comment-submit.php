<?php
    require_once('library/config.php');

    class COMMENT{
    	private $conn;

    	public function __construct(){
    		$database = new Database();
    		$db = $database->dbConnection();
    		$this->conn = $db;
        }

    	public function comment_submit($comment, $pid){
    		try{
    			$stmt = $this->conn->prepare("INSERT INTO comments(comment,project_id) VALUES(:comment,:pid)");
    			$stmt->execute(array(':comment'=>$comment, ':pid'=>$pid));
    			return $stmt;
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}

    	public function comment_retrieve($pid){
            try{
        		$stmt = $this->conn->prepare("SELECT comment FROM comments WHERE project_id=:pid");
                $stmt->execute(array(':pid'=>$pid));
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $projects;
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
