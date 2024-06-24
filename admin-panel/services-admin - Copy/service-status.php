<?php require '../layout/header.php' ; ?>
<?php require '../../auth/config.php ' ; ?>

<?php 

if(!isset($_SESSION['AdminName'])){
  header('location:'.ADMINURL.'admins/login-admins.php');
}


 if(isset($_GET['id']) AND isset($_GET['status'])){
  $id = $_GET['id'];
  $status = $_GET['status'] ;
   
  if($status == 1) {
    $update = $conn->prepare("UPDATE services SET status = 0  WHERE id = '$id'");
    $update->execute();
     header('location:show-services.php');
  }else{
    $update = $conn->prepare("UPDATE services SET status = 1  WHERE id = '$id'");
    $update->execute();
    header('location:show-services.php');
  }
  
 }
?>


 <?php require'../layout/footer.php' ; ?>