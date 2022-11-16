<?php

$wrong_cred=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    
    
    $email=$_POST['loginEmail'];
    $sql="SELECT * FROM users WHERE user_email='$email'";
    $result=mysqli_query($conn,$sql);
    $numrows=mysqli_num_rows($result);
    
     if($numrows==1){
        $username=$_POST['username'];
        
        $pass=$_POST['loginPass'];
        
        
        $row=mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']=$row['sno'];
                $_SESSION['useremail']=$email;
                $_SESSION['username']=$username;

                
            }
            header("Location:../index.php?loginsuccess=true");
        }
        else{
            $wrong_cred="Wrong Credentials";
            header("Location:../index.php?loginsuccess=false&error=$wrong_cred");
          }
        
            
        
     
}
?>