<?php 
require 'header.php' ;
require 'config.php';        
?>


<?php 
if(isset($_GET['id'])){
        $id = $_GET['id'];
         //fetch data form user table
        $result = $conn->query("SELECT * FROM uers WHERE id ='$id'");
        $result->execute();
        $rows = $result->fetch(PDO::FETCH_OBJ);

        // fetch data from  jobs table
        $jobs = $conn->query("SELECT * FROM jobs WHERE 	company_id = '$id' AND status = 1 LIMIT 6");
        $jobs->execute();
        $alljob = $jobs->fetchAll(PDO::FETCH_OBJ);



        
    }else{
        echo "error 404";
    }
    
?>

 <!-- HOME -->  
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


<section class="site-section" id="home-section">
        <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
            <div class="card p-3 py-4">
                    
                    <div class="text-center">
                        <img src="images/<?php echo $rows->Uimg ?>" width="100" class="rounded-circle">
                    </div>
                    
                    <div class="text-center mt-3">
                        <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == 'Worker'){?>
                        <a class="btn btn-primary" href="user_cv/<?php echo $rows->Ucv;  ?>" role="button" download> Download CV</a>
                        <?php } ?>
                        <h5 class="mt-2 mb-0"><?php echo $rows->Uname ?></h5>
                        <div>
                        <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == 'Worker'){?>
                        <span><?php echo $rows->Utitle?></span>
                        <?php } ?>
                        </div>
                        <span><?php echo $rows->Utype?></span>
                        <div class="px-4 mt-1">
                            <p class="fonts"><?php echo $rows->Ubio?> </p>
                        </div>
                        <div class="px-3">
                    <a href="<?php echo $rows->Ufacbook?>" class="pt-3 pb-3 pr-3 pl-0 underline-none"><span class="icon-facebook"></span></a>
                    <a href="<?php echo $rows->UTtiwtter?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                    <a href="<?php echo $rows->UlinkedIn?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                </div>
                        
                    
                        
                    </div>
                    
                
                    
                    
                </div>
            </div>
        </div>

        
      </div>
</section>

<!--created a new post job -->
<section class="site-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <?php  if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Company" AND $_SESSION['user_id'] == $id):?>
            <h2 class="section-title mb-2">job posted by this company </h2>
            <?php endif ; ?>
          </div>
        </div>
        <?php  foreach($alljob as $onejob):?>
        <ul class="job-listings mb-5">
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id=<?php echo $onejob->Id ?>"></a>
            <div class="job-listing-logo">
              <img src="user_img/<?php echo $_SESSION['user_img'] ; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $onejob->job_title; ?></h2>
                <strong><?php echo $_SESSION['user_name']; ?></strong>
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

<?php require 'footer.php'; ?>