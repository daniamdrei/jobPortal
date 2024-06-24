<?php require "header.php" ?>
<?php require "config.php" ?>



<?php 
if(isset($_POST['submit'])){
  if(empty($_POST['job_title']) OR empty($_POST['job_region']) OR empty($_POST['job_type'])){
    header('location:index.php');
       
  }else{
    $job_title=$_POST['job_title'];
    $job_region=$_POST['job_region'];
    $job_type = $_POST['job_type'];
    //insert for trending word
    $insert = $conn->prepare('INSERT into searches (keyword) VALUE (:keyword)');
    $insert ->execute([
         ':keyword'=>$job_title,
    ]);
   
   $select = $conn->query("SELECT * FROM jobs WHERE job_title LIKE '%$job_title%'
     AND job_region LIKE '%$job_region%' AND job_type LIKE'%$job_type%' ");
     $select->execute();
     $search = $select->fetchAll(PDO::FETCH_OBJ);
  }

}else{
    header('location:index.php');
}




?>






<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"> <?php echo $_SESSION['user_name']?></h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $_SESSION['user_name']?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
<br><br>

<ul class="job-listings mb-5">
         <?php if(count($search)>0): ?>
         <?php foreach($search as $job ): ?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id=<?php echo $job->Id ?>"></a>
            <div class="job-listing-logo">
              <img src="user_img/<?php echo $job->company_image ; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>
            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $job->	job_title ; ?></h2>
                <strong><?php echo $job->	company_name ; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span><?php echo $job->job_region ; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($job->job_type=='Part Time'){echo 'danger';}else{echo 'success' ;}?>"><?php echo $job->job_type ; ?></span>
              </div>
            </div>
            
          </li>
          <?php endforeach ; ?>
          <?php else:?>
            <div class="alert alert-danger"> there are no searches with this job  yet  </div>
            <?php endif; ?>
        </ul>



        <?php require "footer.php" ?>