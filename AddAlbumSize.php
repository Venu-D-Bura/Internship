<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");
if(isset($_POST['submit'] ))
{
	if($temp)
	{
		$album_size=$_POST['album_size'];
		$album_price=$_POST['album_price'];
		
		$query="insert into album_size values('$album_size',$album_price)";
		$res=mysqli_query($con,$query);
		
		if($res)
		{
			header("location:DisplayAlbumSize.php");
		}
		else
		{
			echo"<script>alert('Unable To insert record');</script>";
			header("location:DisplayAlbumSize.php");
		}
	}	
	else
	{
		echo"<script>alert('Unable To Connect Database');</script>";
		header("location:DisplayAlbumSize.php");
	}
}



?>

<html>
<head><link rel="stylesheet" href="Design.css"></head>
<body>
	
	<div class="main">
	
		<!--
		<div class="sidenav">
			<a href="Order.php">ORDERS</a>
			<a href="DisplayAlbumType.php">ALBUM TYPE</a>
			<a href="DisplayAlbumSize.php">ALBUM SIZE</a>
			<a href="DisplayPageQuality.php">PAGE QUALITY</a>
		</div>
		or
		-->
		
		<?php
		require('Menu.html');
		?>

		<div class="div_form_input">
			<form method='post' action="">
				<input type="text" name="album_size" placeholder="Album Size" required> <br>
				<input type="number" name="album_price" placeholder="Album Price" required><br>
				<input type="submit" name="submit" value="submit">
			</form>
		</div>
		
		
	</div>
	
	
</body>
</form>
</html>