<?php
    require_once("session.php");
    require_once('library/class.user.php');
    require_once('library/uploadProject.php');

    $project = new PROJECT();
    $auth_user = new USER();
    $db = new Database();

    $conn = $db->dbConnection();
    $user_id = $_SESSION['user_session'];

    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['project-submit'])){
    	$pname = strip_tags($_POST['project_name']);
    	$sdesc = strip_tags($_POST['short_desc']);
        $ldesc = strip_tags($_POST['long_desc']);

        $image=addslashes($_FILES['image']['tmp_name']);
        $name=addslashes($_FILES['image']['name']);
        $image=file_get_contents($image);
        $image=base64_encode($image);


    	if($pname == ""){
    		$message = "Please provide project name.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else if($sdesc == ""){
    		$message = "Please provide short description.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
    	else if($ldesc == ""){
    		$message = "Please provide long description.";
            echo "<script type='text/javascript'>alert('$message');</script>";
    	}
      else if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
        $message = "Please Select Image to Upload";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    	else{
    		try{
                $project->upload_project($user_id, $pname, $sdesc, $ldesc);
                $stmt = $conn->prepare("SELECT * FROM projects WHERE project_name=:pname");
                $stmt->execute(array(':pname'=>$pname));
                $ps = $stmt->fetch(PDO::FETCH_ASSOC);
                $pid = $ps['project_id'];
                $project->saveimage($pid,$name,$image);
                $project->redirect('userProfile.php?uid='.$user_id);
    		}
    		catch(PDOException $e){
    			echo $e->getMessage();
    		}
    	}
    }
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once("library/header.php"); ?>
    <title>ProjectHunt | Upload Project</title>
    <!-- My Stylesheets -->
    <link rel="stylesheet" href="css/master.css" charset="utf-8">
    <link rel="stylesheet" href="css/project-form.css" charset="utf-8">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-light">
      <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                  <img src="images/logo.jpg" alt="ProductHunt Logo">
                </a>
            </div>
            <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
            &#9776;
          </button>
          <div class="collapse navbar-toggleable-xs pull-xs-right" id="navbar-content">
            <ul class="nav navbar-nav pull-sm-right">
              <li class="nav-item">
                <a class="nav-link" href="mainpage.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userProfile.php?uid=<?php echo $user_id;?>"><?php echo $userRow['user_name']; ?></a>
              </li>
              <li class="nav-item">
                  <a href="homepage.php">
                    <button type="button" name="button" class="btn btn-info">Log Out</button>
                  </a>
              </li>
            </ul>
          </div>
      </div>
    </nav>

    <!-- Project Details Form -->
    <h2 class="project-heading">Enter Project Details</h2>
    <div class="container project-form">
        <form id="project-form" role="form" method="post" enctype="multipart/form-data">
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Project Name</label>
            <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Enter Project Name">
            <small class="text-muted">Let it be cool!</small>
          </fieldset>
          <fieldset class="form-group">
            <label for="shortDescription">Short Description</label>
            <textarea class="form-control" id="short_desc" name="short_desc" rows="1"></textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="longDescription">Long Description</label>
            <textarea class="form-control" id="long_desc" name="long_desc" rows="3"></textarea>
          </fieldset>
          <fieldset class="form-group">
            <label for="fileUpload">Upload Images and Videos</label>
            <input type="file" class="form-control-file" id="fileUpload" name="image">
          </fieldset>
          <fieldset class="form-group">
            <input type="submit" name="project-submit" id="project-submit" class="form-control btn btn-lg btn-info" value="Upload Project">
          </fieldset>
        </form>
    </div>
    <!-- Project Details Form Ends Here-->

</body>
</html>
