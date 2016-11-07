<?php
    require_once('session.php');
    require_once('library/uploadProject.php');

	$project = new PROJECT();
    $user_id = $_SESSION['user_session'];

    if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
        $project->update_like_count($pid);
        $project->redirect('mainpage.php');
    }
    else{
        $project->redirect('mainpage.php');
    }

?>
