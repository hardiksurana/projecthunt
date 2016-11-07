<?php
    if(isset($_GET['uid'])){
        $uid=$_GET['uid'];
    }

    if(isset($_POST['submit'])){
        if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
            echo "Please Select Image to Upload";
        }
        else{
            $image=addslashes($_FILES['image']['tmp_name']);
            $name=addslashes($_FILES['image']['name']);
            $image=file_get_contents($image);
            $image=base64_encode($image);
            echo "$name";
            saveimage($uid,$name,$image);
        }
        header('Location: userProfile.php');
    }

    function saveimage($uid,$name,$image){
        try{
        $dbh = new PDO("mysql:host=localhost;dbname=login", 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE users SET image_name=:name, image=:image WHERE user_id=:uid");
        $stmt->execute(array(':name'=>$name,':image'=>$image, ':uid'=>$uid));
        echo "uploaded";
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>
