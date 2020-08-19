<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");



/* To delete record from album_type table */
	
	$a=$_GET['a'];
	$query="delete from album_type where album_type_name='$a'";
	$res=mysqli_query($con,$query);
	if($res)
	{
		header("location:DisplayAlbumType1.php");
	}
	else
	{
		echo "
		<script>
		alert('Unable To Delete');
		location:'DisplayAlbumType1.php';
		</script>";
		#header("location:DisplayAlbumType1.php");
	}

?>