<?php
    require_once("session.php");
    require_once('library/class.user.php');
    require_once("library/comment-submit.php");

    $auth_user = new USER();
    $new_comment = new COMMENT();
    $db = new Database();

    $conn = $db->dbConnection();
	$user_id = $_SESSION['user_session'];

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_GET['id'])){
        $pid = $_GET['id'];
    }

    if(isset($_POST['comment-submit'])){
      	$comment = strip_tags($_POST['comment']);
      	if($new_comment->comment_submit($comment, $pid)){
      		$new_comment->redirect("projdesc.php?id=$pid");
      	}
      	else{
      		$message = "wrong details!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
      	}
    }

    $result = $conn->prepare("SELECT project_name, long_desc, main_image FROM projects WHERE project_id=$pid");
    $result->execute();
    $p = $result->fetch();

    $stmt = $conn->prepare("SELECT image FROM users WHERE user_id=$user_id");
    $stmt->execute();
    $img = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("library/header.php"); ?>
    <title>ProjectHunt | Project Page</title>
    <!-- My Stylesheets -->
    <link rel="stylesheet" href="css/master.css" charset="utf-8">
    <link rel="stylesheet" href="css/project-description.css" charset="utf-8">
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
                <a class="nav-link" href="mainpage.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userProfile.php"><?php echo $userRow['user_name']; ?></a>
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

    <div class="project-details container">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <h2 align="left"><?php echo $p['project_name'];?> </h2>
            </div>
        </div>
        <div class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <?php echo '<img src="data:image/jpeg;base64,'.$p['main_image'].'" alt="Product image" class="img-fluid center-block">';?>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="description">
            <h2>Description</h2>
            <p>
              <?php echo $p['long_desc'];?>
            </p>
            <div class="comments">
              <div class="container">
                <?php
                    $comments = $new_comment->comment_retrieve($pid);
                    foreach($comments as $key=>$value){
                        foreach ($value as $com => $val) {
                ?>
                            <div class='row'>
                                    <div>
                                        <?php
                                        echo '<img src="data:image/jpeg;base64,'.$img['image'].'" class="left-img" id="circle" alt="Profile Picture">';
                                        ?>
                                    </div>
                          			<div class='left-msg'><?php echo $val; ?></div>
                            </div>
                <?php
                        }
                    }
                ?>
                  <h2>Leave a comment</h2>
                  <form method="post" name="comment-submit-form">
                    <div class="form-group">
                      <input type="text" name="comment" placeholder="Write a comment" class="form-control" size="100">
                      </div>
                    <input type="submit" name="comment-submit" value="Send">
                  </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
