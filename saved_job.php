<?php require'header.php'; ?>
<?php require'config.php' ; ?>
<?php 

if(isset($_GET['worker_id']) AND  isset($_GET['job_id']) AND isset($_GET['status']))
    {

        $job_id = $_GET['job_id'];
        $worker_id = $_GET['worker_id'];
        $status = $_GET['status'] ;
        
        if($status == "save"){
        $insert= $conn->prepare("INSERT INTO  saved_job (job_id, worker_id ) 
        VALUES(:job_id , :worker_id	) ");
        $insert->execute([
        ':job_id' => $job_id ,
        ':worker_id' => $worker_id ,
        ]);
        header('location:job-single.php?id='.$job_id.'');
    }
    else{
        $delete= $conn->prepare("DELETE FROM saved_job WHERE job_id = '$job_id' AND worker_id = '$worker_id' ") ;
        $delete->execute(); 
        header('location:job-single.php?id='.$job_id.'');

    }
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
     //fetch data form user table
    $result = $conn->query("SELECT * FROM uers WHERE id ='$id'");
    $result->execute();
    $rows = $result->fetch(PDO::FETCH_OBJ);

        $jobs = $conn->query("SELECT * FROM jobs WHERE 	company_id = '$id' AND status = 1 LIMIT 5");
        $jobs->execute();
        $alljob = $jobs->fetchAll(PDO::FETCH_OBJ);

    // grabbing saved job  SELECT jobs.Id AS id , jobs.company_image AS company_image , jobs.company_name AS company_name, jobs.job_region AS job_region FROM jobs JOIN saved_job ON jobs.Id = saved_job.worker_id WHERE worker_id =2;
    $saved_job = $conn->query("SELECT jobs.Id AS id , jobs.company_image AS company_image , jobs.company_name AS company_name, jobs.job_region AS job_region , jobs.job_type as job_type , jobs.job_title AS job_title 
        FROM jobs JOIN saved_job ON jobs.Id = saved_job.job_id WHERE worker_id = '$id'");
    $saved_job ->execute();
    $Sjobs = $saved_job->fetchAll(PDO::FETCH_OBJ);

}
?>


<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
        <div class="row">
        <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Saved Job </h1>
            <div class="custom-breadcrumbs">
            <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong><?php echo $_SESSION['user_name']?></strong></span>
            </div>
        </div>
        </div>
        </div>
    </section>

    <section class="site-section">
    <div class="container">

        <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
            <?php  if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"):?>
            <h2 class="section-title mb-2">job saved by you  </h2>
            <?php endif ; ?>
        </div>
        </div>
        <?php  foreach($Sjobs as $onejob):?>
        <ul class="job-listings mb-5">
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id=<?php echo $onejob->Id ?>"></a>
            <div class="job-listing-logo">
            <img src="user_img/<?php echo $onejob->company_image ;?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $onejob->job_title; ?></h2>
                <strong><?php echo $onejob->company_name; ?></strong>
            </div>
            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $onejob->job_region; ?>
            </div>
            <div class="job-listing-meta">
                <span class="badge badge-<?php if($onejob->job_type == "Part Time"){ echo "danger" ;}else { echo "success";} ?>"><?php echo $onejob->job_type; ?></span>
            </div>
            </div>
        </ul>
        <?php  endforeach ;?>
    </div>
</section>
<?php  require "footer.php"; ?>

