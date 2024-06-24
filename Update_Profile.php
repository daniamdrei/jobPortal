
<?php require 'header.php' ;?>
<?php require 'config.php'; ?>
<?php
    //check if id is selected and used it to select the info of it 
   if(isset($_GET['Upid'])){
        $id = $_GET['Upid'];
        $result = $conn->query("SELECT * FROM uers WHERE id = '$id'");
        $result->execute();
        $row = $result->fetch(PDO::FETCH_OBJ);
    }else{
        echo "404";
    }
     
    if(isset($_POST['submit'])){
        if(empty($_POST['name']) AND empty($_POST['email'])){
            header('location:Update_Profile.php?error= name or email is empty !');
        }else{
        $name = $_POST['name'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $bio = $_POST['bio'];
        $facbook = $_POST['facbook'];
        $tiwtter = $_POST['tiwtter'];
        $linkedin= $_POST['linkedin'];
        $img = $_FILES['img']['name'];
        //لحتى امنع الايرور بس اسجل دخول للشركة
        if( $row->Utype == "Worker"){
            $cv = $_FILES['Cv']['name'] ;
        }
        else {
            $cv ="NULL" ;
        }
        //حفط رابط الملف داخل متغير
        $dir_img = 'user_img/'.basename($img);
        $dir_cv = 'user_cv/'.basename($cv);
        $Update = $conn->prepare("UPDATE uers SET Uname = :Uname , Uemail = :Uemail , Uimg = :Uimg ,
            Ucv = :Ucv ,Utitle  = :Utitle ,Ubio = :Ubio , UlinkedIn = :UlinkedIn  , UTtiwtter =:UTtiwtter  WHERE id = '$id' ");
            //  if statement to insure that if the user not updating the info , it wont be gone or become empty 
            if(!empty($img) OR !empty($cv)){
            unlink("user_cv/".$row->Ucv."");
            unlink("user_img/".$row->Uimg."");
            $Update->execute([
            ":Uname" =>$name  ,
            ":Uemail" =>$email  ,
            ":Uimg" =>$img  ,
            ":Ucv" =>$cv  ,
            ":Utitle" =>$title  ,
            ":Ubio" =>$bio  ,
            ":UlinkedIn" =>$linkedin  ,
            ":UTtiwtter" => $tiwtter ,
            ]);
            $conn =null;
        }else{
            $Update->execute([
                ":Uname" =>$name  ,
                ":Uemail" =>$email  ,
                ":Uimg" =>$row->Uimg  ,
                ":Ucv" =>$row->Ucv  ,
                ":Utitle" =>$title  ,
                ":Ubio" =>$bio  ,
                ":UlinkedIn" =>$linkedin  ,
                ":UTtiwtter" => $tiwtter ,
                ]);
                $conn =null;
        }
        //  لحتى اضمن انه الصورة الجديدة ما بتنحفط بالملف , بل يتم استبدالها 
        if(move_uploaded_file($_FILES['img']['tmp_name'],$dir_img)){
            header('location:index.php');
        }
    } 
    

        }
?>




    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
        <div class="container">
        <div class="row">
            <div class="col-md-7">
            <h1 class="text-white font-weight-bold">update profile</h1>
            <div class="custom-breadcrumbs">
                <a href="#">Home</a> <span class="mx-2 slash">/</span>
                <span class="text-white"><strong>update profile</strong></span>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section class="site-section" id="next-section">
        <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
            <form action="Update_Profile.php?Upid=<?php echo $id ;?>"  method="POST" enctype="multipart/form-data" class="">
                <?php  if(isset($_GET['error'])){?>
                    <p class="alert alert-danger"> <?php echo $_GET['error'] ;}?></p>
                <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="text-black" for="name">User Name </label>
                    <input type="text" id="name" class="form-control" name ="name" value=<?php echo $row->Uname ?> >
                </div>
                <div class="col-md-6">
                    <label class="text-black" for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email" value=<?php echo $row->Uemail?>>
                </div>
                </div>
                <?php  if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"){?>
                <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="title">Title</label> 
                    <input type="text" id="title" class="form-control" name="title" value=<?php echo $row->Utitle?>>
                </div>
                </div>
                <?php }else { ?>
                    <div class="row form-group">
                <div class="col-md-12">
                    <input type="hidden" id="title" class="form-control" name="title" value="NULL">
                </div>
                </div>
                <?php } ?>
                <div class="row form-group">
                    <div class="col-md-6">
                    <label class="text-black" for="img">chose your photo</label> 
                    <input type="file" id="img" class="form-control" name="img">
                    </div>
                    <?php  if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] == "Worker"){?>
                <div class="col-md-6">
                    <label class="text-black" for="Cv">Cv</label> 
                    <input type="file"  id="Cv" class="form-control" name="Cv">
                </div>
                <?php } else { ?>
                    <div class="col-md-6">
                    <input type="hidden" id="Cv" value ="NULL" class="form-control" name="Cv">
                </div>
                <?php } ?>
                </div>
                <div class="row form-group">
                <div class="col-md-4 mb-3">
                    <label class="text-black" for="facbook">Facbook </label>
                    <input type="text" id="facbook" class="form-control" name ="facbook">
                </div>
                <div class="col-md-4">
                    <label class="text-black" for="tiwtter">Tiwtter</label>
                    <input type="text" id="tiwtter" class="form-control" name="tiwtter">
                </div>
                <div class="col-md-4">
                    <label class="text-black" for="linkedin">Linkedin</label>
                    <input type="text" id="linkedin" class="form-control" name="linkedin">
                </div>
                </div>

                <div class="row form-group">
                <div class="col-md-12">
                    <label class="text-black" for="bio" >Bio</label> 
                    <textarea name="bio" id="bio" cols="60" rows="7" class="form-control" value=""><?php echo $row->Ubio?></textarea>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-md-4 ">
                    <input type="submit" value="submit" class="btn btn-primary btn-md text-white" name="submit">
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </section>

    <section class="site-section bg-light">
        <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3">Happy Candidates Says</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
                <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
                </blockquote>
                <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                    <h3>Elisabeth Smith</h3>
                    <span class="position">Creative Director</span>
                </div>
                </div>
            </div>
            </div>

            <div class="col-lg-6">
            <div class="block__87154 bg-white rounded">
                <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
                </blockquote>
                <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_2.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                    <h3>Chris Peter</h3>
                    <span class="position">Web Designer</span>
                </div>
                </div>
            </div>
            </div>


        </div>
        </div>
    </section>
    
    
    <?php require 'footer.php' ?> 
</body>
</html>