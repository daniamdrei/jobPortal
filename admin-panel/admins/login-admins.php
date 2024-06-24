
<?php require '../layout/header.php';  ?>
<?php   require '../../config.php' ;?>

<?php  
if(isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'');
}

  if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
      header("location:login-admins.php?error= email is requird .");
      exit();
    }else if(empty($_POST['passw'])){
      header("location:login-admins.php?error= password is requird .");
      exit();
    }else {
        //set the data into a variables
      $email = $_POST['email'];
      $password = $_POST['passw'];
         // query to select the data from db
         $result = $conn->query("SELECT * FROM admins WHERE AdminEmail ='$email' "); 
    // $result = $conn->query("SELECT * FROM uers Where Uemail ='$email' ");  
    $result->execute();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if( $result->rowCount()>0){
      //password_verify($password,$row['Upassword'])
          if($password == $row['AdminPass']){

          $_SESSION['AdminName']= $row['AdminName'];
          $_SESSION['AdmineEmail'] = $row['AdminEmail'];

          
          header("location:".ADMINURL."");
        } else{ 
          header("location:login-admins.php?error= password or email are not correct .");
          exit();
          }    
      
          }

    }
  }


?>
<class="container-fluid"> 
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <?php if(isset($_GET['error'])){ ?>
                    <p class="alert alert-danger">  <?php echo $_GET['error']  ;?></p>
                    <?php } ?>
                    <?php  if(isset($_GET['result'])){?>
                      <p class="alert alert-success"> <?php  echo $_GET['result'] ;?> </p>
                      <?php } ?> 
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="passw" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
</div>
 </div>
</div>
<?php require '../layout/footer.php'; ?>