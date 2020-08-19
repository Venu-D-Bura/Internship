<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");



/* To delete record from album_type table */
	$id=$_GET['id'];
	
	$query3="delete from installments where id='$id'";
	$res3=mysqli_query($con,$query3);
	
	$query2="delete from payment where id='$id'";
	$res2=mysqli_query($con,$query2);
	
	$query1="delete from order_details where id='$id'";
	$res1=mysqli_query($con,$query1);
	
	
	$q="select photo from registration where id='$id'";
	$r=mysqli_query($con,$q);
	$i=mysqli_fetch_array($r);
	
	unlink("Photos/".$i[0] );
	unlink("Album Photos/".$i[0]);
	
	
	$query="delete from registration where id='$id' ";
	$res=mysqli_query($con,$query);
	
	
	
	if($res and $res1 and $res2 and $res3)
	{
		header("location:Customers.php");
	}
	else
	{
		echo "
		<script>
		alert('Unable To Delete');
		location:'Customers.php';
		</script>";
		#header("location:Customers.php");
	}

?>