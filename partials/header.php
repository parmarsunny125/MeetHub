<style>
  .welcome{
    font-size: 15px;
  }
</style>


<?php
require 'partials/_dbconnect.php';
session_start();



echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">MeetHub
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top categories
        </a>
        <ul class="dropdown-menu">';
          $sql="SELECT category_name,category_id FROM `categories` LIMIT 3";
          $result=mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '
            <li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
          };
          
          
          
        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    ';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){
      echo '<form class="d-flex my-2 my-lg-0" role="search method="get" action="search.php">
      <input class="form-control me-2" type="search" name ="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2 my-sm-0" type="submit">Search</button>
      <p class="welcome text-light my-0 mx-3">Welcome, '.$_SESSION['useremail'].'</p></form>
      <a href="partials/_logout.php"class="btn btn-outline-danger">Logout</a>
      ';
    }else{
      
      echo '<form class="d-flex" role="search" method="get" action="search.php">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2 my-sm-0" type="submit">Search</button>
      </form>
      
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>';
    
    }
    
    
    echo '

    </div>
</div>
</nav>';
include '_loginmodal.php';
include '_signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now Log in
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You Successfully logged in!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']=="Email already in use" ){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
   Email already in use! Sign up with a different email.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']=="Passwords do not match" ){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
   Passwords do not match! Please enter correct passwords.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error']=="Passwords do not match" ){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
   Passwords do not match! Please enter correct passwords.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
else if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false" && $_GET['error']=="Wrong Credentials" ){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
   Wrong Credentials Please enter correct details.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>