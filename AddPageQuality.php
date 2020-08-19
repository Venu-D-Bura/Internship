<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");
if(isset($_POST['submit'] ))
{
	if($temp)
	{
		$page_quality=$_POST['page_quality'];
		$price=$_POST['price'];
		
		$query="insert into page_quality values('$page_quality',$price)";
		$res=mysqli_query($con,$query);
		
		if($res)
		{
			header("location:DisplayPageQuality.php");
		}
		else
		{
			echo"<script>alert('Unable To insert record');</script>";
			header("location:DisplayPageQuality.php");
		}
	}	
	else
	{
		echo"<script>alert('Unable To Connect Database');</script>";
		header("location:DisplayPageQuality.php");
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
				<input type="text" name="page_quality" placeholder="Page Quality" required> <br>
				<input type="number" name="price" placeholder="Per Page Price" required><br>
				<input type="submit" name="submit" value="submit">
			</form>
		</div>
		
		
	</div>
	
	
</body>
</form>
</html>