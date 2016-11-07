<?php
    if(isset($_GET['uid'])){
      $uid=$_GET['uid'];
    }

    if(isset($_POST['submit'])){
        if(getimagesize($_FILES['project-image']['tmp_name'])==FALSE){
            echo "Please Select Image to Upload";
        }
        else{
            $image=addslashes($_FILES['project-image']['tmp_name']);
            $image=file_get_contents($image);
            $image=base64_encode($image);
            saveimage($uid,$image);
        }
        header('Location: project-form.php');
    }

    function saveimage($uid,$image)
    {
        try{
            $dbh = new PDO("mysql:host=localhost;dbname=login", 'root', '');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE project SET main_image=:image WHERE user_id=:uid");
            $stmt->execute(array(':image'=>$image, ':uid'=>$uid));
            echo "uploaded";
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>
