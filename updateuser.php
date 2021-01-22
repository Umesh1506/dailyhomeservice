<?php

	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_fname']) && isset($_POST['user_lname']) && 
		isset($_POST['user_contact']) && isset($_POST['user_email']) && 
		isset($_POST['user_password']) && isset($_POST['user_dob']) && 
		isset($_POST['area_id']) && isset($_POST['user_npassword']))
		{
			$ufname=$_POST['user_fname']; 
			$ulname=$_POST['user_lname'];
			$ucontact=$_POST['user_contact'];
			$area_id=$_POST['area_id'];
			$date=$_POST['user_dob'];
			$email=mysqli_real_escape_string($conn,$_POST['user_email']);
			$pass=mysqli_real_escape_string($conn,$_POST['user_password']);
			$npass=mysqli_real_escape_string($conn,$_POST['user_npassword']);
		
					
			
			$que="select user_id from user where user_email='".$email."' and user_password='".$pass."'";
			$result=mysqli_query($conn,$que);
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$UpdateQue="update user set user_fname='".$ufname."',user_lname='".$ulname."',user_contact_no='".$ucontact."',area_id='".$area_id."',user_dob='".$date."',user_password='".$npass."' where 
							user_id=".$row['user_id'];
				$upResult=mysqli_query($conn,$UpdateQue);
				if($upResult)
				{
					$array=array("status"=>"200","Message"=>"SuccessFully Update!");	
				}else 
				{		
					$array=array("status"=>"600","Message"=>"Update Failed!");
				}			
			}
			else 
			{
				$array=array("status"=>"405","Message"=>"No User Available!");
			}
		}else 
	{
		$array=array("status"=>"430","Message"=>"variable Not Set");
	}
	}else 
	{
		$array=array("status"=>"500","Message"=>"Invaild Method");
	}	
echo json_encode($array);
?>