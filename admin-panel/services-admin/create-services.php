<?php require '../layout/header.php' ; ?>
<?php require '../../auth/config.php ' ; ?>


<?php 
    if(!isset($_SESSION['AdminName'])){
    header('location:'.ADMINURL.'admins/login-admins.php');
    }
    if(isset($_POST['submit'])){

    if(empty( $_POST['name'])){
        header('location:create-services.php?error= please enter name of service');
    }else
        if(empty( $_POST['category'])){
            header('location:create-services.php?error= please enter categorys service');
            }else{
            $name = $_POST['name'];
            $category = $_POST['category'];
            $stmt= $conn->prepare("INSERT INTO services (name , category) 
            VALUES(:name , :category) ");
            $stmt->execute([
            ':name' => $name ,
            ':category'=>$category,
            ]);
            header('location:'.ADMINURL.'services-admin/show-services.php');
    

    }
   }

?>
       <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Services </h5>
          <form method="POST" action="create-services.php" enctype="multipart/form-data">
                <!-- Email input -->
                <?php  if(isset($_GET['error'])):?>
                  <p class="alert alert-danger"> <?php echo $_GET['error'] ;?></p>
                  <?php endif ; ?>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="category" id="form2Example1" class="form-control" placeholder="category" />
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require'../layout/footer.php' ; ?>