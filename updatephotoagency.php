<?php

	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_email']) && isset($_POST['agency_password']) && 
		 isset($_POST['agency_img']))
		{
			$email=mysqli_real_escape_string($conn,$_POST['agency_email']);
			$pass=mysqli_real_escape_string($conn,$_POST['agency_password']);
			$photo=NULL;
					
			
			//photo
			if(!empty($_POST['agency_img']))
			{
			
				$image_base64 = base64_decode($_POST['agency_img']);
				$photo = uniqid() . '.jpeg';
				$file = "../img/" . $photo;
				file_put_contents($file, $image_base64);				
			}
	
			$que="select agency_id from agency where agency_email='".$email."' and agency_password='".$pass."'";
			$result=mysqli_query($conn,$que);
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$UpdateQue="update agency set agency_img='".$photo."' where agency_id=".$row['agency_id'];
				$upResult=mysqli_query($conn,$UpdateQue);
				if($upResult)
				{
					$array=array("status"=>"200","Message"=>"SuccessFully Update photo!");	
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