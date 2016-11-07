<?php
    require_once('session.php');
	require_once('library/config.php');
	require_once('library/class.user.php');
    require_once('library/uploadProject.php');

    $auth_user = new USER();
	$project = new PROJECT();
    $db = new Database();

    $conn = $db->dbConnection();
    $user_id = $_SESSION['user_session'];

    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    $p = $project->retrieve_projects();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("library/header.php"); ?>
    <title>ProjectHunt | All Projects</title>
    <!-- My Stylesheets -->
    <link rel="stylesheet" href="css/master.css" charset="utf-8">
    <link rel="stylesheet" href="css/mainpage.css" charset="utf-8">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-light">
      <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                  <img alt="ProductHunt Logo" src="images/logo.jpg">
                </a>
            </div>
            <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
            &#9776;
          </button>
          <div class="collapse navbar-toggleable-xs pull-xs-right" id="navbar-content">
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item">
                <a class="nav-link" href="mainpage.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userProfile.php?uid=<?php echo $user_id;?>"><?php echo $userRow['user_name']; ?></a>
              </li>
              <li class="nav-item">
                  <a href="logout.php?logout=true">
                    <button type="button" name="button" class="btn btn-info">Log Out</button>
                  </a>
              </li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- NAVBAR ENDS HERE -->

    <div class="container">
        <?php
			for($i=0; $row = $p->fetch(); $i++){
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="container my-card">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <?php echo '<img src="data:image/jpeg;base64,'.$row['main_image'].'" alt="Product image" class="img-fluid center-block">';?>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
										<a href="projdesc.php?id=<?php echo $row['project_id'];?>">
  									        <h2> <?php echo $row['project_name'];?></h2>
									    </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-muted">
                                        <p><?php echo $row['short_desc']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <a href="updateLike.php?pid=<?php echo $row['project_id'];?>">
                                        <button type="button" name="button" class="btn btn-info-outline">
                                            <?php echo $row['num_likes'];?>
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="projdesc.php?id=<?php echo $row['project_id'];?>">
                                        <button type="button" name="button" class="btn btn-info-outline">
                                            Comments
                                            <i class="fa fa-comments" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="https://www.facebook.com">
                                        <button type="button" name="button" class="btn btn-info-outline">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </button>
                                    </a>
							    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
	       }
        ?>
    </div>

</body>
</html>
