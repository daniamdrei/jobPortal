<?php require'header.php'; ?>
<?php require'config.php' ; ?>


<?php
    if(!isset($_SESSION['user_type']) AND $_SESSION['user_type'] !== "Company")
    {

    header('location:index.php');
    }
    if(isset($_GET['id'])){

    $id = $_GET['id'];
    if($_SESSION['user_id'] !== $id) {
        header('location:index.com');
    }
    $select = $conn->query(" SELECT *  FROM uers WHERE id = '$id' ");
    $select ->execute();
    $profile = $select->fetch(PDO::FETCH_OBJ);

    $get_applicants = $conn->query(" SELECT * FROM job_application WHERE company_id = '$id' ");
    $get_applicants->execute();
    $applicants = $get_applicants->fetchAll(PDO::FETCH_OBJ);


    }else{
        echo "404";    }

?>





<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
        <div class="row">
        <div class="col-md-7">
            <h1 class="text-white font-weight-bold"> show Applicants  </h1>
            <div class="custom-breadcrumbs">
            <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong><?php echo $profile->Uname?></strong></span>
            </div>
        </div>
        </div>
        </div>
    </section>


    <section class="site-section">
    <div class="container">
        <?php  foreach( $applicants as $jobApp):?>
        <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
            <?php  if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"):?>
            <h2 class="section-title mb-2">job saved by you  </h2>
            <?php endif ; ?>
        </div>
        </div>
        <ul class="job-listings mb-5">
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id= Id "></a>
            <div class="job-listing-logo">
            <img src="user_img/<?php echo $_SESSION['user_img'] ?> " alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                
                <strong>  <?php  echo $jobApp->job_title;  ?> </strong>
            </div>
            <div class="job-listing-meta">
            <a style="text-decoration: none;" class="" href="Public_Profile.php?id=<?php echo $jobApp->worker_id ; ?>"><strong> <?php  echo $jobApp->email;  ?></strong></a>
            </div>
            <div class="job-listing-meta">
                <a class="btn btn-success text-white" href="user_cv/<?php  echo $jobApp->cv ?>" role="button" download>Download CV</a>
                </div>
            </div>
        </ul>
      <?php endforeach ; ?>
    </div>
</section>

    <?php  require'footer.php' ;?>