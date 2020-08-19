<?php
$sid=$sname="";
$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");

if($temp){
	if(isset($_POST['b1']))
	{
		#$image=$_POST['image'];
		
		$temp=$_FILES['image']['type'];
		$extension=explode("/",$temp);
		#print_r($extension);
		
		$cname=$_POST['u2'];
		$cemail=$_POST['u3'];
		$phno=$_POST['u4'];
		
		$path="C:/xampp/htdocs/myphp/PHP_PGMS/Album/Photos/";
		$photo_name=$phno.".".$extension[1];
		#echo $_FILES['image']['name'] ;

		if(move_uploaded_file( $_FILES['image']['tmp_name'] , $path.$photo_name ))
		{
			
		}
		else
		{
			echo "
			<script>
			alert('Unable to customer photo');
			location:'CustomerRegistration.php';
			</script>";
		}
		

		$qu="insert into registration (photo,name,email,phone_no) values('$photo_name','$cname','$cemail',$phno)";
		
		if(mysqli_query($con,$qu))
		{
			header("location:Customers.php");
		}
		else
		{
			echo "
			<script>
			alert('Unable to register customer');
			location:'CustomerRegistration.php';
			</script>";
			#header("location:CustomerRegistration.php")
		}
		
	}
}
else
{
	echo "
		<script>
		alert('Unable to connect with the database12345');
		location:'CustomerRegistration.php';
		</script>";
}
?>
<html>
<head>
	<link rel="stylesheet" href="design.css">
</head>

<body bgcolor="grey">

	<div class="main">
	
		<!--
		<div class="sidenav">
			<a href="Order.php">ORDERS</a>
			<a href="DisplayAlbumType.php">ALBUM TYPE</a>
			<a href="DisplayAlbumSize.php">ALBUM SIZE</a>
			<a href="DisplayPageQuality.php">PAGE QUALITY</a>
		</div>
		-->
		
		<?php
		require('Menu.html');
		?>

		<div class="div_form_input">
			
				<center>
				<h2 style='padding-top:5%;'>Customer Registration</h2>
				</center>
						<form name="f1" method="post" action="" enctype="multipart/form-data">
								
								<div style="
									position: absolute;
									background-color: transparent;
									width: 40%;
									height: auto;
									margin-left: 24%;
									margin-top: 1.5%;
									font: 600 80% Arial;
									color:black;
								">Upload Photo</div>
								<input type="file" name="image" class='file' required><br><br>
								
								<div class='title_input'>Customer Name</div>
								<input type="text" name="u2" placeholder="Customer Name"required><br><br>
								<div class='title_input'>Customer E-mail</div>
								<input type="email" name="u3" placeholder="Customer E-Mail" required><br><br>
								<div class='title_input'>Phone No</div>
								<input type="number" name="u4" placeholder="Phone No." required><br><br>
								<input type="submit" name="b1" value="Submit"><br>
							
						</form>
			<div class='display_button_content'>
				<a href='Customers.php' class='display_anchor'><button class='display_button'>Display</button></a>
			</div>
			
		</div>
	</div>
</body>
</html>