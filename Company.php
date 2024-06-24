<?php require'header.php'; ?>
<?php require'config.php' ; ?>

<?php  

$select = $conn->query(" SELECT * FROM uers WHERE Utype = 'Company' ");
$select ->execute();
$allcompany = $select->fetchAll(PDO::FETCH_OBJ);

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

<?php foreach( $allcompany as $company ): ?>
    <section class="site-section" id="home-section">
        <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
            <div class="card p-3 py-4">
                    
                    <div class="text-center">
                        <img src="images/<?php echo $company->Uimg ?>" width="100" class="rounded-circle">
                    </div>
                    
                    <div class="text-center mt-3">
                        <h5 class="mt-2 mb-0"><?php echo $company->Uname ?></h5>
                        <div>
                        <span><?php echo $company->Utitle?></span>
                        </div>
                        <span><?php echo $company->Utype?></span>
                        <div class="px-4 mt-1">
                            <p class="fonts"><?php echo $company->Ubio?> </p>
                        </div>
                    </div>
                    <a href="Public_Profile.php?id=<?php echo $company->id?>"  target="_blank" class="btn btn-primary"> go to profile</a>
                </div>
            </div>
        </div>

        </div>
</section>
<?php endforeach ; ?>

<?php  require'footer.php'; ?>