<?php
    require_once('library/config.php');

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
                $num_likes = 0;
                $stmt = $this->conn->prepare("INSERT into projects(user_id,project_name, short_desc, long_desc, num_likes) VALUES (:uid, :pname, :sdesc, :ldesc, :num_likes)");
    			$stmt->execute(array(':uid'=>$user_id, ':pname'=>$pname, ':sdesc'=>$sdesc, ':ldesc'=>$ldesc, ':num_likes'=>$num_likes));
    			$row = $stmt->rowCount();

    			if($row == 1){
                    echo "<script type='text/javascript'>alert('project has been uploaded');</script>";
    			}
    			else{
   				    $user->redirect('mainpage.php');
    			}
    			return $stmt;
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}

        public function saveimage($pid,$name,$image){
            try{
                $stmt = $this->conn->prepare("UPDATE projects SET main_image_name=:name, main_image=:image WHERE project_id=:pid");
                $stmt->execute(array(':name'=>$name,':image'=>$image, ':pid'=>$pid));
                echo "uploaded";
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }


    	public function retrieve_projects(){
    		try{
    			$stmt = $this->conn->prepare("SELECT * FROM projects ORDER BY project_id DESC");
                $stmt->execute();
                return $stmt;
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}

        public function update_like_count($pid){
            try{
                $stmt = $this->conn->prepare("SELECT * FROM projects WHERE project_id=:pid");
                $stmt->execute(array(':pid'=>$pid));
                $project = $stmt->fetch(PDO::FETCH_ASSOC);
                $like_count = $project['num_likes'];
                $like_count = $like_count + 1;
                $stmt = $this->conn->prepare("UPDATE projects SET num_likes=:num_likes WHERE project_id=:pid");
                $stmt->execute(array(':num_likes'=>$like_count, ':pid'=>$pid));
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
