<?php require'layout/header.php' ?>
<?php require '../config.php ' ; ?>
            

<?php 
if(!isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'/admins/login-admins.php');
}
//count number of job in the data base
 $jobs = $conn->query("SELECT count(*) AS jobcount FROM jobs");
 $jobs->execute();
 $countjobs = $jobs->fetch(PDO::FETCH_OBJ);
 
 //count number of catagories in the data base
 $categories = $conn->query("SELECT count(*) AS categoriecount FROM categorie");
 $categories->execute();
 $categoriecount = $categories->fetch(PDO::FETCH_OBJ);

 //count number of admin in the data base 
 $admins=$conn->query("SELECT count(*) AS adminscount FROM admins");
 $admins->execute();
 $adminscount = $admins->fetch(PDO::FETCH_OBJ);

?>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Jobs</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of jobs: <?php echo $countjobs->jobcount ;  ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $categoriecount->categoriecount; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins:  <?php echo $adminscount->adminscount ;  ?></p>
              
            </div>
          </div>
        </div>
      </div>
     <!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require'layout/footer.php' ; ?>