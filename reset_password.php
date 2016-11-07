<?php require_once("library/class.user.php"); ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php require_once("library/header.php"); ?>
    <title>ProjectHunt | Reset Password</title>
</head>
<body>
    <?php
        //Check if the form was submitted
        if(isset($_POST['email'])){
            //Trim the post value and verify it is not empty
            $postEmail = trim($_POST['email']);
            if(empty($postEmail)){
                //Email was empty
                echo 'please enter email';
            }
            else{
                //Run select query using email
                $getData = DB::getInstance()->query("SELECT * FROM users WHERE email='{$postEmail}'");
                //Check if query passed
                if(!$getData){
                    //Query failed
                     echo 'select query failed';
                }
                elseif(!$getData->count()) {
                    //No records returned
                     echo 'email not found';
                }
                else {
                    foreach($getData->results() as $row) {
                        $full_name = $row->full_name;
                        $email     = $row->email;
                    }

                    $salt = Hash::salt(32);
                    $new_password = Hash::make(rand(999, 999999),$salt);
                                $temp_pass    = substr($new_password, 0, 8);

                    $updatePass = DB::getInstance()->query("UPDATE users SET password = '{$new_password}', salt = '{$salt}' WHERE email='{$email}'");

                    //Check if query passed
                    if(!$updatePass) {
                        //Query failed
                         echo 'updated query failed';
                    }

                    else {
                        //Send confirmation email
                        $to = $email;
                        $subject = "Password Reset";
                        $body = "Hello {$full_name},\n\nYour new password is: {$temp_pass}\n\n-mycomp";

                        if(!mail($to, $subject, $body)) {
                             echo 'error sending email';
                        }

                        else {
                             echo 'an email has been sent';
                        }
                    }
                }
            }
        }
    ?>

    <form action="" method="post">
        <span>Enter your email address:<span><br>
        <input type="text" name="email" size="40"><br>
        <input type="submit" value="Recover">
    </form>
</body>
</html>
