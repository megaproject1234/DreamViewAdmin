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

if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$description=$_POST['description'];
$sql=mysqli_query($con,"insert into category(categoryName,categoryDescription) values('$category','$description')");
$_SESSION['msg']="Category Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from category where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Category deleted !!";
		  }

$category1=array();
$SqlQry = "SELECT * FROM category;";

$stmt = $con->prepare($SqlQry);
$stmt->execute();
$stmt->bind_result($id,$categoryName,$categoryDescription,$creationDate,$updationDate);
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