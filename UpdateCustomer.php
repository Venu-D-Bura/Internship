<?php
$con=mysqli_connect("localhost","root","");
$db=mysqli_select_db($con,"album");

$id=$_GET['id'];

$up="select photo,name,email,phone_no from registration where id=$id";
$res=mysqli_query($con,$up);
$i=mysqli_fetch_array($res);

$old_photo=$i[0];

$old_phone_no=$i[3] ;


if(isset($_POST['submit']))
{
	
	$path="C:/xampp/htdocs/myphp/PHP_PGMS/Album/Photos/";
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone_no=$_POST['phone'];
	
	$up="update registration set phone_no=$phone_no where id=$id ";
	$res=mysqli_query($con,$up);
	
	$up="select phone_no from registration where id=$id";
	$res=mysqli_query($con,$up);
	$i=mysqli_fetch_array($res);
	
	
	if( $_FILES['image']['name'] == NULL )
	{
		#echo "photo not updated or not selected";
		$up1="select phone_no,photo from registration where id=$id";
		$res1=mysqli_query($con,$up1);
		$i1=mysqli_fetch_array($res1);
		
		$t=$i1[1];
		$extension=explode(".",$t);
		$photo_name=$i1[0].".".$extension[1];
		
		#echo $phone_no."<br>";
		#echo $photo_name;
		
		$up2="update registration set photo='$photo_name' where id='$id' ";
		$res2=mysqli_query($con,$up2);
		
		
		
		if($res2)
		{
			
			if(file_exists("Album Photos/".$old_phone_no))
			{
				
				#exit();
				rename("Album Photos/$old_phone_no","Album Photos/$phone_no");
			}
		}
		else
		{
			#echo "unable to modify photo name";
			echo"<script>alert('unable to modify photo name');
				location:'Customers.php';
				</script>";
		}
		
		
		rename("Photos/".$old_photo , "Photos/".$photo_name);
		
		#echo $photo_name;
	}
	else   #for deleting old photo
	{		
		#echo "photo updated or photo is changed";
		$up="select phone_no,photo from registration where id=$id";
		$res=mysqli_query($con,$up);
		$i=mysqli_fetch_array($res);
		
		$temp=$_FILES['image']['type'];
	
		$extension=explode("/",$temp);
		$photo_name=$i[0].".".$extension[1];
		#echo $photo_name;
		
		unlink("Photos/".$old_photo );
		
		# for uploding to specific folder
		if(move_uploaded_file( $_FILES['image']['tmp_name'] , $path.$photo_name ))
		{
			
		}
		else
		{
			echo"<script>alert('unable to modify photo name');
				location:'Customers.php';
				</script>";
		}
	# /for uploding to specific folder
	
		
		
	}
	
	
	$up="update registration set photo='$photo_name', name='$name',email='$email' where id=$id ";
	$res=mysqli_query($con,$up);
	if($res){
		header("location:Customers.php");
	}
	else{
		echo"<script>alert('unable to register customer');
				location:'Customers.php';
				</script>";
	}
	
	
}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Design.css">
</head>

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
			<img src="Photos/<?php echo $i[0];?>" style='position:relative;left:30%;top:10px;width:40%;height:20%;border:2px solid black;'></img>
		
		
			<form method='post' action="" enctype="multipart/form-data">
				<input type="file" name="image" value="<?php echo $i[0]; ?>"  class="file"  > <br>
				<input type="text" name="name" value="<?php echo $i[1] ;?>" > <br>
				<input type="text" name="email" value="<?php echo $i[2] ;?>" ><br>
				<input type="number" name="phone" value="<?php echo $i[3] ;?>" ><br>
				<input type="submit" name="submit" value="submit">
			</form>
 		</div>
		
	</div>
</body>
</html>