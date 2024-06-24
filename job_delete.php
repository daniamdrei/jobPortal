<?php require'header.php'; ?>
<?php require'config.php' ; ?>
<?php 

if(isset($_SESSION['user_type']) AND $_SESSION['user_type'] !== "Company"){
    
  header('location:index.php');
}

  if(isset($_GET['id'])){

    $id = $_GET['id'];
      $result = $conn->query("DELETE FROM jobs WHERE Id ='$id' ");
      $result->execute();
      header( 'location:index.php' );
  }
  else {

    echo "404";
  }
  ?>