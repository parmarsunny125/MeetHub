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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

        
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
    $id=$_GET["catid"];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result)){
            $catname=$row['category_name'];
            $catdesc=$row['category_description'];
          }
    ?>


    <!-- Slider starts here -->
    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    
    $showAlert=false;
    if($method=='POST'){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $sno=$_POST["sno"];
        
        

        $th_title=str_replace("<","&lt","$th_title");
        $th_title=str_replace(">","&gt","$th_title");

        $th_desc=str_replace("<","&lt","$th_desc");
        $th_desc=str_replace(">","&gt","$th_desc");
        $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
       
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added! Please wait for the community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }
    ?>

    <!-- Categories start here -->

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> Forums</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>By joining and using these forum, you agree that you have read and will follow the rules and guidelines set for these peer discussion groups. You also agree to reserve forum discussions for topics best suited to the medium. This is a great medium with which to solicit the advice of your peers, benefit from their experience, and participate in an ongoing conversation.</p>
            
        </div>
    </div>
    <!-- <?php echo $_SERVER['REQUEST_URI']?> -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){

        echo '<div class="container">
            <h1 class="py-2">Start a discussion</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp"
                        placeholder="Title">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and chrisp as
                        possible.</small>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Elaborate your problem</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
    ?>
    <div class="container" id="ques">
        <h1>Browse Qustions</h1>
        <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result=mysqli_query($conn,$sql);
    $noresult=true;
          while($row=mysqli_fetch_assoc($result)){
            $noresult=false;
            $id=$row['thread_id'];
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $thread_time=$row['timestamp'];
            $thread_user_id=$row['thread_user_id'];
            $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            

            
        
            echo '<div class="media my-3">
                <img class="mr-3" src="img/profile.webp" width="54px" alt="Generic placeholder image">
                <div class="media-body">'.
                
                    '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                    '.$desc.'</div>'.'<p class="font-weight-bold my-0">Asked by '.$row2['username'].' at '.$thread_time.'.</p>
            </div>';
          }
          if($noresult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Threads Found</h1>
              <p class="lead">Be the first person to as the question.</p>
            </div>
          </div>';
          }
    
        ?>
     </div>

<?php require 'partials/footer.php' ?>

    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    

</body>

</html>