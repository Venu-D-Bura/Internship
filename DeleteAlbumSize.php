<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");



/* To delete record from album_size table */
	
	$a=$_GET['a'];
	$query="delete from album_size where album_size='$a'";
	$res=mysqli_query($con,$query);
	if($res)
	{
		header("location:DisplayAlbumSize1.php");
	}
	else
	{
		echo "<script>
		alert('Unable To Delete');
		location:'DisplayAlbumSize1.php';
		</script>";
		#header("location:DisplayAlbumSize1.php");
	}

?>