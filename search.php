<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MeetHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"> -->

    <title>MeetHub</title>
    <style>
        #ques{
            min-height: 433px;
        }
        #maincontainer{
            min-height:89vh
        }
    </style>
</head>

<body>
    
    
    
    
    <?php require 'partials/_dbconnect.php'?>
    <?php require 'partials/_handleLogin.php';?>
    <?php require 'partials/header.php' ?>
    <?php if($wrong_cred){
        echo'<div class="alert alert-danger" role="alert">
        Wrong Credentials!
      </div>';
    }
    ?>
    

    <!-- Search results -->
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET["search"] ?>"</em> </h1>
    <?php
    $noresults=true;
    $search = $_GET["search"];
    $sql="SELECT * FROM threads where match(thread_title,thread_desc)against('$search')";
    $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
              $title=$row['thread_title'];
              $desc=$row['thread_desc'];
              $thread_id=$row['thread_id'];
              $url="thread.php?threadid=".$thread_id;
              
                $noresults=false;

            
            

            
            echo '<div class="result">
            <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
            <p>'.$desc.'</p>
            </div>';
            }
            if($noresults){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Results Found</h1>
                  <p class="lead">Make sure that all the words are spelled correctly.</p>
                </div>
              </div>';
            }
            
          
    ?>
        
    </div>






    <?php require 'partials/footer.php' ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    

</body>

</html>