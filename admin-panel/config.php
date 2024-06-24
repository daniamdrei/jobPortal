<?php 
//set the connection
$servername = "localhost";
$username = "root";
$password="";
$dbname = "serviceweb";                           
try{
     //connction
$conn =new PDO("mysql:host=$servername;dbname=$dbname",$username , $password) ;
//set the pdo error mode to exception 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "connection succesfully";

}catch(PDOException $e){
    echo $e->getMessage();
}
?>