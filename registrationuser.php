<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_fname']) && isset($_POST['user_lname']) && 
		isset($_POST['user_contact']) && isset($_POST['user_email']) && 
		isset($_POST['user_password']) && isset($_POST['user_dob']) && 
		isset($_POST['area_id']) && isset($_POST['image']) &&
		isset($_POST['user_lat']) && isset($_POST['user_long']))
		{
			$ufname=$_POST['user_fname'];
			$ulname=$_POST['user_lname'];
			$ucontact=$_POST['user_contact'];
			$uemail=$_POST['user_email'];
			$upassword=$_POST['user_password'];
			$udob=$_POST['user_dob'];
			$area_id=$_POST['area_id'];
			$isactive=0;
			$user_reg_date=date('y-m-d');
			$role_id=1;		
			$photo=NULL;
			$user_lat=$_POST['user_lat'];
			$user_long=$_POST['user_long'];
			
			
			//photo
			if(!empty($_POST['image']))
			{
				$image_base64 = base64_decode($_POST['image']);
				$photo = uniqid() . '.jpeg';
				$file = "../img/" . $photo;
				file_put_contents($file, $image_base64);				
			}
			
			
			$query="insert into user(user_fname,user_lname,user_contact_no,user_email,user_password,user_dob,area_id,user_active,user_reg_date,role_id,user_img,user_lat,user_long) 
			VALUES('".$ufname."','".$ulname."','".$ucontact."','".$uemail."','".$upassword."','".$udob."',".$area_id.",".$isactive.",'".$user_reg_date."','".$role_id."','".$photo."','".$user_lat."','".$user_long."')";
				
			$result=mysqli_query($conn,$query);
			
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfully Registration");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Data not found");
			}
		}	
		else
		{
			$array=array("status"=>"400","Message"=>"Variable are not set");
		}
		
	}
	else
	{
		$array=array("status"=>"500","Message"=>"Invalid Method");
	}
	echo json_encode($array);
?>