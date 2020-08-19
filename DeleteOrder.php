<?php

$con=mysqli_connect("localhost","root","");
$temp=mysqli_select_db($con,"album");



/* To delete record from album_type table */
	
	$id=$_GET['id'];
	$order_id=$_GET['order_id'];
	
	$q="select o.album_photo,r.phone_no from order_details o join registration r where r.id='$id' and o.order_id='$order_id'";
	$r=mysqli_query($con,$q);
	$i=mysqli_fetch_array($r);
	
	unlink("Album Photos/"."$i[1]/"."$i[0]");
	
	$q="select ordered_date from order_details where id='$id' and order_id='$order_id' ";
	$r=mysqli_query($con,$q);
	$t=mysqli_fetch_array($r);
	$ordered_date=$t[0];
	
	$q2="select payment_id from payment where id='$id' and ordered_date='$ordered_date' ";
	$r2=mysqli_query($con,$q2);
	$t2=mysqli_fetch_array($r2);
	$payment_id=$t2[0];
	
	$query3="delete from installments where id='$id' and payment_id='$payment_id' ";
	$res3=mysqli_query($con,$query3);
	
	$q1="delete from payment where id='$id' and ordered_date='$ordered_date' ";
	$r1=mysqli_query($con,$q1);
	
	
	if($r1 and $res3){
		$query="delete from order_details where id='$id' and order_id='$order_id' ";
		$res=mysqli_query($con,$query);
		if($res)
		{
			header("location:Display.php");
		}
		else
		{
			echo "
			<script>
			alert('Unable To Delete');
			location:'Display.php';
			</script>";
			#header("location:Display.php");
		}
	}
	else{
		echo "
			<script>
			alert('Unable To Delete');
			location:'Display.php';
			</script>";
		#header("location:Display.php");
	}
	
?>