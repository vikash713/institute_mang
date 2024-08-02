<?php 
  include_once './db.php';
  $signup = false;
  $msg= '';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $rollNo = $_POST["rollNo"];
    $emailId = $_POST["emailId"];
    $exist = false;
    if(($password == $cpassword) && $exist==false){
        $sql = "INSERT INTO `userdetails` ( `rollNo`, `name`, `email`, `courseId`, `subscription`, `id`) VALUES ( '$rollNo', '$username', '$emailId', '','',rand(200,400))";
        $sql_Create_User = "INSERT INTO `user` ( `username`, `password`, `id`) VALUES ( '$emailId', '$password', '')";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_query($conn,$sql_Create_User);
        if ($result){
            $showAlert = true;
            $signup = true;
        }else{
            $signup = false;
            $msg = 'Something went wrong!';
        }
    } else{
        $msg = 'Password and Confirm Password does not match!';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php
    include_once './partials/_nav.php';
    ?>
<?php
    if($signup){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> User hasbeen created.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if(!$signup && $msg != ''){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $msg.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
?>
<div class="container">
    <h1 class="text-center">Signup to our website</h1>
    <div class="col-3" style="margin:40px auto">
        
        <form action="./signup.php" method="post">
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" require>
            </div>
            <div class="form-group">
                <label for="username">Email Id (username)</label>
                <input type="email" class="form-control" id="username" name="emailId" aria-describedby="emailHelp" require>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" require>
            </div>
            <div class="form-group">
                <label for="cpassword"> Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" require>
            </div>
            <div class="form-group">
                <label for="roll">Roll No.</label>
                <input type="number" class="form-control" id="roll" name="rollNo" require>
            </div>
            
            <button type="submit" class="btn btn-primary">Signup</button>
            <br/>
            <br/>
            <a href="./login.php">Back to login</a>
        </form>
    </div>
</div>


<?php
 require './footer.php';
?>