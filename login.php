<?php  require "header.php " ; ?>

<?php require "config.php" ;?>

<?php 
if(isset($_SESSION['user_name'])){
  header('location:index.php');
}

  if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
      header("location:login.php?error= email is requird .");
      exit();
    }else if(empty($_POST['password1'])){
      header("location:login.php?error= password is requird .");
      exit();
    }else {
        //set the data into a variables
      $email = $_POST['email'];
      $password = $_POST['password1'];
         // query to select the data from db
         $result = $conn->query("SELECT * FROM uers Where Uemail ='$email' "); 
    // $result = $conn->query("SELECT * FROM uers Where Uemail ='$email' ");  
    $result->execute();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if( $result->rowCount()>0){
      //password_verify($password,$row['Upassword'])
          if($password == $row['Upassword']){
          $_SESSION['user_name']= $row['Uname'];
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_type'] = $row['Utype'];
          $_SESSION['user_email'] = $row['Uemail'];
          $_SESSION['user_img'] =$row['Uimg'];
          $_SESSION['user_cv'] =$row['Ucv'];
          
          header("location:index.php");
        } else{ 
          header("location:login.php?error= password or email are not correct .");
          exit();
          }    
      
          }

    }
  }


?>
<!doctype html>
<html lang="en">
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Log In</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
      
          <div class="col-md-12">
            <form action="login.php" method="post" class="p-4 border rounded">
                <?php  if(isset($_GET['error'])){?>
                  <p class="alert alert-danger"> <?php echo $_GET['error'] ;}?> </p>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email address" name="email">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="password1">Password</label>
                  <input type="password" id="password1" class="form-control" placeholder="Password" name="password1">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Log In" class="btn px-4 btn-primary text-white" name="submit">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
    
<?php require "footer.php";?>