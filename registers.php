<?php require "header.php"; ?>
<?php require "config.php";?>
<?php 
if(isset($_SESSION['user_name'])){
  header('locarion:index.php');
}

if(isset($_POST['submit']))
{  
 //check if the input is empty 
if(empty($_POST['type'])){
  header("location:registers.php?error= type is requird .");
  exit();
}else if(empty($_POST['fname'] )){
  header("location:registers.php?error= name is requird .");
  exit();
}else if(empty($_POST['email'])){
  header("location:registers.php?error= email is requird .");
  exit();
}else if(empty($_POST['password1'])){
  header("location:registers.php?error= password is requird .");
  exit();
}else{
  //set the variables
  $type = $_POST['type'];
  $name =$_POST['fname'];
  $email = $_POST['email'];
  $password = $_POST['password1'];
  $re_password = $_POST['re_password'];
 // check for password match
  if ($password == $re_password){
 //query statement to insert the variables into the table
  if(strlen($email) > 25 || strlen($name) >17 ){   
  header('location:registers.php?error= the email is too big');
  }else{
        //checking for username and email availability 
        $available = $conn->query("SELECT * FROM uers WHERE Uemail = '$email' OR Uname = '$name'");
        $available->execute();
        if($available->rowCount()>0){
          header('location:registers.php?error=email or username is already taken');
        }else{
        $stmt= $conn->prepare("INSERT INTO uers (Uname, Uemail , Upassword ,Utype ) 
        VALUES(:Uname , :Uemail , :Upassword ,:Utype) ");
        $stmt->execute([
        ':Uname' => $name ,
        ':Uemail' => $email ,
        ':Upassword' =>$password,//password_hash($password ,PASSWORD_DEFAULT),
        ':Utype'=>$type,
          ]);
        $conn = null;
        }
  }
}else{
  header("location:registers.php?error= passwords are not match !! .");
  exit();
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
            <h1 class="text-white font-weight-bold">Register</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Register</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5">
            <form action="registers.php" method="post" class="p-4 border rounded">
              <?php if(isset($_GET['error'])){ ?>
                <p class ="alert alert-danger"> <?php echo $_GET['error'] ;} ?>   </p>
              <div class="row form-group ">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="type">select user type</label>
                  <select class="form-control" id="type" name="type" title="Select Region">
                    <option>Worker</option>
                    <option>Company</option>
                  </select>
                </div> 
              </div>
              <div class="row form-group ">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Username</label>
                  <input type="text" id="fname" class="form-control" placeholder="Username" name="fname">
                </div>
              </div>
                
              
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="email">Email</label>
                  <input type="text" id="email" class="form-control" placeholder="Email address" name="email">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="password1">Password</label>
                  <input type="password" id="password1" class="form-control" placeholder="Password" name="password1">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="re_password">Re-Type Password</label>
                  <input type="password" id="re_password" class="form-control" placeholder="Re-type Password" name="re_password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Sign Up" class="btn px-4 btn-primary text-white" name="submit">
                </div>
              </div>

            </form>
          </div>
      
        </div>
      </div>
    </section>
  </body>
</html>

<?php  require "footer.php"?>