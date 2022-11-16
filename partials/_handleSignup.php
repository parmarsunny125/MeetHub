<?php
$showerror="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    
    require '_dbconnect.php';
    $username=$_POST['username'];
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];
    

    //check if username already exists

    $existsql="SELECT * FROM `users` WHERE user_email= '$user_email'";
    $result=mysqli_query($conn,$existsql);
    
    $numrows=mysqli_num_rows($result);
    
     if($numrows>0){
        $showerror="Email already in use";
     }
     else{
        if($pass==$cpass){
            
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `username`, `timestamp`) VALUES ('$user_email', '$hash', '$username', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                
                $showAlert=true;
                header("Location:../index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showerror="Passwords do not match";
            

        }
     }
     header("Location:../index.php?signupsuccess=false&error=$showerror");
}

?>