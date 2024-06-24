<?php require'header.php'; ?>
<?php require'config.php' ; ?>

<?php 

if(isset($_GET['name'])){

    $name= $_GET['name'];
    $select = $conn->query("SELECT * FROM jobs WHERE Job_Categorie = '$name'");
    $select ->execute();
    $get_job = $select -> fetchAll(PDO::FETCH_OBJ);

    $jobs_count = $conn->query("SELECT COUNT(*) as job_count FROM jobs WHERE Job_Categorie = '$name'");
    $jobs_count ->execute();
    $get_job_count = $jobs_count->fetch(PDO::FETCH_OBJ);

}

?>


    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
        <div class="row">
        <div class="col-md-7">
            <h1 class="text-white font-weight-bold">  job in this Catagory </h1>
            <div class="custom-breadcrumbs">
                <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
                <a href="#">Job</a> <span class="mx-2 slash">/</span>
            </div>
            </div>
        </div>
        </div>
    </section>



    <section class="site-section">
    <div class="container">

        <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">  <?php  echo $get_job_count->job_count ;?> Related Job </h2>
        </div>
        </div>
        <ul class="job-listings mb-5">
            <?php  foreach($get_job as $job):?>
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id=<?php echo $job->Id?>"></a>
            <div class="job-listing-logo">
            <img style="width: 100px ; width =100px" src="user_img/<?php echo $job->company_image ; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $job->job_title; ?></h2>
                <strong><?php echo $job->company_name;?></strong>
            </div>
            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $job->job_region ; ?>
            </div>
            <div class="job-listing-meta">
                <span class="badge badge-<?php if($job->job_type == "Part Time"){ echo "success" ;}else { echo "danger";} ?>"><?php echo $job->job_type ; ?></span>
            </div>
            </div>
            </li>
            <?php  endforeach ;?>
            </ul>
        </div>
</section>

<?php require'footer.php';?>
