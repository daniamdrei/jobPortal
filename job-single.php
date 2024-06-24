
<?php require'header.php'; ?>
<?php require'config.php' ; ?>
<?php 
  if(isset($_GET['id'])){

    $id = $_GET['id'];
    
    // query for gitting single job
    $result =$conn->query("SELECT * FROM jobs WHERE Id ='$id'");
    $result->execute();
    $row = $result->fetch(PDO::FETCH_OBJ); 

    // query for gitting related job
    $related_jobs = $conn->query("SELECT * FROM jobs WHERE Job_Categorie = '$row->Job_Categorie '  AND status=1 AND Id!='$id'");
    $related_jobs->execute();
    $related_job = $related_jobs->fetchAll(PDO::FETCH_OBJ);
    // query for gitting  the count of related job
    $job_count = $conn->query("SELECT COUNT(*) as job_count FROM jobs WHERE Job_Categorie = '$row->Job_Categorie '  AND status=1 AND Id!='$id'");
    $job_count->execute();
    $job_num = $job_count->fetch(PDO::FETCH_OBJ);
  }
    // to applaying on a job 
    if(isset($_POST['submit_application'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $cv = $_POST['cv'];
      $worker_id = $_POST['worker_id'];
      $job_id = $_POST['job_id'];
      $job_title = $_POST['job_title'];
      $company_id = $_POST['company_id'];
      
        $insert= $conn->prepare("INSERT INTO  job_application (username, email , cv ,worker_id , job_id ,job_title, company_id  ) 
        VALUES(:username , :email , :cv ,:worker_id ,:job_id ,:job_title ,:company_id) ");
        $insert->execute([
        ':username' => $username ,
        ':email' => $email ,
        ':cv' =>$cv,
        ':worker_id'=>$worker_id,
        ':job_id'=>$job_id,
        ':job_title'=>$job_title,
        ':company_id'=>$company_id,
          ]);
        echo "<script> alert(' application sent successffuly')</script>" ;
        
        
         
    } 
    // query to select data form catagories table
    $get_categorie = $conn->query("SELECT * FROM categorie ");
        $get_categorie ->execute();
        $categories = $get_categorie->fetchAll(PDO::FETCH_OBJ);

    //checking if the user already applay for a job 
    $checking_for_application = $conn->query(" SELECT * FROM  job_application WHERE worker_id = '$_SESSION[user_id]' AND job_id = '$id' ") ;
    $checking_for_application ->execute();


    // checking if the user saved the job or not 
    $checking_for_saved_job = $conn->query(" SELECT * FROM  saved_job WHERE worker_id = '$_SESSION[user_id]' AND job_id = '$id' ") ;
    $checking_for_saved_job ->execute();
    $conn = null;

  


?>

    <!-- HOME --><script> alert</script>
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $row->job_title ;?></h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $row->job_title ;?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img style=" width: 100px; height: 100px;" src="user_img/<?php echo $row->company_image ; ?>" alt="Image">
              </div>
              <div>
                <h2><?php echo $row->job_title ;?></h2>
                <div>
                  <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?php  echo $_SESSION['user_name']?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?php echo $row->job_region ?></span>
                  <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?php echo $row->job_type ?></span></span>
                </div>
              </div>
            </div>
          </div>
    
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php  echo $row->job_description	;?></span></li>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
              <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php  echo $row->responsibilities	;?></span></li>
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php  echo $row->education_experience	;?></span></li>
                
              </ul>
            </div>

            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?php  echo $row->other_benifits	;?></span></li>
                
              </ul>
            </div>
                <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"):?>
            <div class="row mb-5">
            <?php  if($checking_for_saved_job ->rowCount() == '0' ){?>
              <div class="col-6">
                <a  href="saved_job.php?worker_id=<?php echo $_SESSION['user_id']?>&job_id=<?php echo $id?>&status=save"  class="btn btn-inline btn-light btn-md" style="padding: 13px 100px; margin-top: -15px; "><i class="icon-heart"></i>Save Job</a>
              </div>
                <?php }else {?>
                <div class="col-6">
                <a  href="saved_job.php?worker_id=<?php echo $_SESSION['user_id']?>&job_id=<?php echo $id?>&status=delete"  class="btn btn-inline btn-light btn-md " style="padding: 13px 100px; margin-top: -15px; "><i class="icon-heart text-danger "></i>Saved Job</a>
              </div>
              <?php }?>
              <div class="col-6">
                <?php  if($checking_for_application ->rowCount() == 0 ){?>
              <form action="job-single.php?id=<?php echo $id ; ?>" method="post">

              <div class="form-group">
                <input type="hidden" value="<?php echo $_SESSION['user_email']; ?>"  name="email" class="form-control" id="" placeholder="user Email">
              </div>
              <div class="form-group">
                <input type="hidden" name="username" value="<?php echo $_SESSION['user_name']; ?>" class="form-control" id="" placeholder="user Name">
                </div>
              <div class="form-group">
                <input type="hidden" name="cv" value="<?php echo $_SESSION['user_cv']; ?>" class="form-control" id="" placeholder="user cv">
              </div>
              <div class="form-group">
                <input type="hidden" name="worker_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control" id="" placeholder="worker id ">
              </div>
              <div class="form-group">
                <input type="hidden" name="job_id" value="<?php echo $id;  ?>" class="form-control" id="" placeholder="job id">
              </div>
              <div class="form-group">
                <input type="hidden" name="job_title" value="<?php echo $row->job_title ; ?>" class="form-control" id="" placeholder="job title">
              </div>
              <div class="form-group">
                <input type="hidden" name="company_id" value="<?php echo $row->company_id ; ?>" class="form-control" id="" placeholder="company id">
              </div>
              <div class="col-6">
                <button class="btn btn-inline btn-primary btn-md " style="padding: 13px 150px; margin-top: -15px;"   name="submit_application">Apply</button>
              </div>
              </form>
              <?php }else {?>
                <div class="col-6">
                <button class="btn btn-primary btn-md  disabled" style="padding:0px 20px; margin-top: -15px;">you apply to this job </button>
              </div>
              <?php  } ?>
              </div> 
            </div><!---->
              
              <?php  endif ; ?>
            
            <br><br><br>
            <?php   if(isset($_SESSION['user_name'])) : ?>
                <?php if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Company")  : ?>
                    <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id'] == $row->company_id ) :  ?>
                          <div class="row">
                          <div class="col-md-12 ">
                              <ul class="list-inline ">
                                  <li class="list-inline-item "><a href="job_update.php?id=<?php echo $row->Id ;?>" class="btn btn-success">Update</a></li>
                                  <li class="list-inline-item "><a href="job_delete.php?id=<?php echo $row->Id ; ?>" class="btn btn-danger">Delete</a></li>
                              </ul>
                          </div>
                          </div>
                  <?php  endif ;?>
                <?php  endif ; ?>
            <?php endif ; ?>
          </div>
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Published on:</strong> <?php  echo  date('M',strtotime($row->created_at)) . ',' . date('d',strtotime($row->created_at)) .','.  date('Y',strtotime($row->created_at))  ?></li>
                <li class="mb-2"><strong class="text-black">Vacancy:</strong> <?php  echo $row->vacancy ;?></li>
                <li class="mb-2"><strong class="text-black">Experience:</strong> <?php  echo $row->experience ;?></li>
                <li class="mb-2"><strong class="text-black">Job Location:</strong> <?php  echo $row->job_region ;?></li>
                <li class="mb-2"><strong class="text-black">Salary:</strong> <?php  echo $row->salary ;?></li>
                <li class="mb-2"><strong class="text-black">Gender:</strong> <?php  echo $row->gender ;?></li>
                <li class="mb-2"><strong class="text-black">Application Deadline:</strong> <?php  echo  date('M',strtotime($row->application_deadline)). ',' . date('d',strtotime($row->application_deadline)) .','.  date('Y',strtotime($row->application_deadline)) ;?></li>
                <li class="mb-2"><strong class="text-black">job catagories :</strong> <?php  echo $row->Job_Categorie ;?></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
              <div class="px-3">
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
              </div>
            </div>

            <div class="bg-light p-3 border rounded mb-4 mt-3">
            
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">catagories </h3>
              <?php  foreach ( $categories as $catagory ) :?>
              <ul class="list-unstyled pl-3 mb-0">
                <a href="show_jobs.php?name=<?php  echo $catagory->name ; ?>"><li class="mb-2"><strong class="text-black"></strong> <?php  echo $catagory->name;  ?></li></a>
              </ul>
              <?php  endforeach ;?>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">  <?php  echo $job_num->job_count ;?> Related Job </h2>
          </div>
        </div>
      
        <ul class="job-listings mb-5">
            <?php  foreach($related_job as $job):?>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php?id=<?php echo $job->Id ?>"></a>
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
                <span class="badge badge-<?php if($job->job_type == "Part Time"){ echo "success" ;}else { echo "danger";} ?>"><?php echo $job->job_type ?></span>
              </div>
            </div>
          </li>
               <?php  endforeach ;?>
          </ul>
   
      </div>
</section>


    <section class="bg-light pt-5 testimony-full">
        
        <div class="owl-carousel single-carousel">

        
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent_2.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Chris Peters, @Google</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

      </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Get The Mobile Apps</h2>
            <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
            <p class="mb-0">
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="images/apps.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
<?php require'footer.php'; ?>