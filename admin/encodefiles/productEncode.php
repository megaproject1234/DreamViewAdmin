<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }

$product1=array();
$SqlQry = "SELECT * FROM product;";
          
    $stmt = $con->prepare($SqlQry);
    $stmt->execute();
    $stmt->bind_result($id,$category,$subCategory,$productName,$productCompany,$prodyctPrice,$productDescription,$productImage1);
    while($stmt->fetch()){
        $temp=[
                'id'=>$id,
                'categoryName'=>$categoryName,
                'categoryDescription'=>$categoryDescription,
                'creationDate'=>$creationDate,
                'updationDate'=>$updationDate
              ];
          
              array_push($category1, $temp);
          }
          echo json_encode($category1);

?>