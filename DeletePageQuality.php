<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");



/* To delete record from page quality table */
	
	$a=$_GET['a'];
	$query="delete from page_quality where page_quality='$a'";
	$res=mysqli_query($con,$query);
	if($res)
	{
		header("location:DisplayPageQuality1.php");
	}
	else
	{
		echo "
			<script>
			alert('Unable To Delete');
			location:'DisplayPageQuality1.php';
			</script>";
		#header("location:DisplayPageQuality1.php");
	}

?>