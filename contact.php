<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MeetHub</title>
    <link rel="shortcut icon" href="img/icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MeetHub</title>
    <style>
        .container{
            min-height:89vh
        }
    </style>
  </head>
  <body>
    
    <?php 
    $showAlert=false;
require 'partials/_dbconnect.php';
        
    require 'partials/header.php';
    $showAlert=false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
      //insert into comment db
      $email=$_POST['email'];
      $queries=$_POST['queries'];
    
      
      $sql="INSERT INTO `contact` (`email`, `queries`) VALUES ('$email', '$queries');";
      mysqli_query($conn,$sql);
      $showAlert=true;
      
    
    }
  
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Thankyou for your query! You will be reverted soon.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    ?>
  }
    <div class="container">
        <h1 class="text-center">Contact us</h1>
    <form method="post">
  <div class="form-group" >
    <label for="exampleFormControlInput1" >Email address</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Your Email">
  </div>
  
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Your queries</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="queries" rows="3"></textarea>
  </div>
  <button class="btn btn-success">Submit</button>
</form>
</div>






    <?php require 'partials/footer.php' ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
