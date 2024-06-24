
<?php require '../layout/header.php' ; ?>
<?php require '../../auth/config.php ' ; ?>



<?php 

  //select info form services table
  $services = $conn->query("SELECT * FROM services");
  $services->execute();
  $showServices = $services->fetchAll(PDO::FETCH_OBJ);
?>
          <div class="row pt-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">services</h5>
              <a  href="create-services.php" class="btn btn-primary mb-4 text-center float-right">Create Service</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">service title</th>
                    <th scope="col">category</th>
                    <th scope="col">status</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                 <tr>
                  <?php  foreach($showServices as $service) :?>
                    <th scope="row"><?php echo $service->id ;?></th>
                    <td><?php echo  $service->name ;?></td>
                    <td><?php  echo $service->category ;?></td>
                    <?php  if ( $service->status == 1) : ?>
                    <td><a href="service-status.php?id=<?php echo $service->id?>&status=<?php echo $service->status ; ?>" class="btn btn-danger  text-center ">unverfied</a></td>
                    <?php else : ?>
                      <td><a href="service-status.php?id=<?php echo $service->id?>&status=<?php echo $service->status ; ?>" class="btn btn-success  text-center ">verfied</a></td>
                      <?php endif ; ?>
                    <td><a href="update-service.php?id=<?php echo $service->id ?>" class="btn btn-warning  text-center ">Update</a></td>
                    <td><a href="delete-service.php?id=<?php echo $service->id ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php  endforeach ;?>
                </tbody>
              </table>  
            </div>
          </div>
        </div>
      </div>
      <?php require'../layout/footer.php' ; ?>