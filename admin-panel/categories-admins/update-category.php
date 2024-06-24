<?php require '../layout/header.php' ; ?>
<?php require '../../config.php ' ; ?>

<?php 

if(!isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'/admins/login-admins.php');
}

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        
    }

?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require'../layout/footer.php' ; ?>