<?php
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"album");

$r=$_GET['a'];

$up="select * from album_type where album_type_name='$r' ";
$res=mysqli_query($con,$up);
$i=mysqli_fetch_array($res);

if(isset($_POST['submit']))
{
	$m=$_POST['a'];
	$n=$_POST['b'];
	
	$up="update album_type set album_type_name='$m',price='$n' where album_type_name='$r' ";
	$res=mysqli_query($con,$up);
	
	if($res){
		header("location:DisplayAlbumType1.php");
	}
	else{
		echo"<script>alert('Unable update the album type');
				location:'DisplayAlbumType1.php';
				</script>";
	}
	
	
}
?>
<html>
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
				<input type="text" name="a" value="<?php echo $i[0] ;?>" > <br>
				<input type="text" name="b" value="<?php echo $i[1] ;?>" ><br>
				<input type="submit" name="submit" value="submit">
			</form>
 		</div>
		
	</div>
</body>
</html>