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
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php require 'partials/_dbconnect.php' ?>
    <?php require 'partials/header.php' ?>
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $thread_user_id=$row['thread_user_id'];

            //Query the users table to find out the name of the thread poster
            $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $posted_by=$row2['username'];
          }
    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    
    if($method=='POST'){
        //insert into comment db
        $comment=$_POST['comment'];
        $comment=str_replace("<","&lt","$comment");
        $comment=str_replace(">","&gt","$comment");

        $sno=$_POST["sno"];
        
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }
    ?>


    <!-- Slider starts here -->

    <!-- Categories start here -->

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Any material which constitutes defamation, harassment, or abuse is strictly prohibited. Material that is sexually or otherwise obscene, racist, or otherwise overly discriminatory is not permitted on these forums. This includes user pictures. Use common sense while posting.
This is a web site for accountancy professionals.</p>
<p class="lead">
Posted by:<b> <?php echo $posted_by;?>
</b>
</p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){
        echo 
        '<div class="container">
            <h1 class="py-2">Post a comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post" >
                
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Type your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>';

    }else{
        echo '<div class="container">
        <h1 class="py-2">Post a comment</h1>
        <p class="lead">You are not logged in. Please login to continue</p>
        </div>';
    }

    ?>
    
    <div class="container" id="ques">
        <h1>Discussions</h1>
         <?php
    $id=$_GET['threadid']; 
    $sql="SELECT * FROM `comments` WHERE thread_id=$id";
    $noresult=true;
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
              $noresult=false;
            $id=$row['comment_id'];
            $content=$row['comment_content'];
            $comment_time=$row['comment_time'];
            $thread_user_id=$row['comment_by'];
            $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            
            
        
            echo '<div class="media my-3">
                <img class="mr-3" src="img/profile.webp" width="54px" alt="Generic placeholder image">
                <div class="media-body">
                <p class="font-weight-bold my-0">Commented by '.$row2['username'].' at '.$comment_time.'.</p>
                <p>'.$content.'</p>
                </div>
            </div>';
          }
          if($noresult){
            echo '<div class="jumbotron bg-dark text-white jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Threads Found</h1>
              <p class="lead">Be the first person to as the question.</p>
            </div>
          </div>';
          }
    
        ?> 

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