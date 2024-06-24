<?php require '../layout/header.php' ; ?>
<?php require '../../auth/config.php ' ; ?>

<?php 
  

  if(!isset($_SESSION['AdminName'])){
    header('location:'.ADMINURL.'/admins/login-admins.php');
   }

   
 $select = $conn->query("SELECT * FROM worker ");
 $select->execute();
 $workers = $select->fetchAll(PDO::FETCH_OBJ);

?>
          <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Worker</h5>
             <a  href="<?php echo ADMINURL?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">show worker request</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">age</th>
                    <th scope="col">service type</th>
                    <th scope="col">rating</th>
                    <th scope="col">location</th>
                    <th scope="col">delete</th>

                    
                  </tr>
                </thead>
                
                <tbody>
                  <tr>
                  <?php foreach( $workers as $worker) : ?>
                    <th scope="row"><?php  echo $worker->id ; ?></th>
                    <td> <img class="rounded-circle w-50 h-50" src="../../img/team-1.jpg" alt="image"></td>
                    <td> <?php echo $worker->name ;  ?></td>
                    <td> <?php echo $worker->email ;  ?></td>
                    <td> <?php echo $worker->Phone ;  ?></td>
                    <td> <?php echo $worker->age ;  ?></td>
                    <td> <?php echo $worker->servicetype ;  ?></td>
                    <td> <?php echo $worker->rating ;  ?></td>
                    <td> <?php echo $worker->location ;  ?></td>
                    <td> <a href="delete-service.php?id=<?php echo $worker->id ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach ;  ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>




<?php  require '../layout/footer.php' ;?>