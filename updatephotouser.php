<?php

	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_img']))
		{
			$email=mysqli_real_escape_string($conn,$_POST['user_email']);
			$pass=mysqli_real_escape_string($conn,$_POST['user_password']);
			$photo=NULL;			
			
			//photo
			if(!empty($_POST['user_img']))
			{
				$image_base64 = base64_decode($_POST['user_img']);
				$photo = uniqid() . '.jpeg';
				$file = "../img/" . $photo;
				file_put_contents($file, $image_base64);				
			}
			$que="select user_id from user where user_email='".$email."' and user_password='".$pass."'";
			$result=mysqli_query($conn,$que);
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$UpdateQue="update user set user_img='".$photo."' where user_id=".$row['user_id'];
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