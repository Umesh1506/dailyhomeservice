<?php

	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_name'])  && isset($_POST['agency_contact_no']) && 
		isset($_POST['agency_email']) && isset($_POST['agency_password']) && 
		isset($_POST['area_id']) && isset($_POST['agency_npassword']))
		{
			$aname=$_POST['agency_name']; 
			$acontact=$_POST['agency_contact_no'];
			$area_id=$_POST['area_id'];
			$email=mysqli_real_escape_string($conn,$_POST['agency_email']);
			$pass=mysqli_real_escape_string($conn,$_POST['agency_password']);
			$npass=mysqli_real_escape_string($conn,$_POST['agency_npassword']);
			
			$que="select agency_id from agency where agency_email='".$email."' and agency_password='".$pass."'";
			$result=mysqli_query($conn,$que);
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$UpdateQue="update agency set agency_name='".$aname."',agency_contact_no='".$acontact."',area_id='".$area_id."',agency_password='".$npass."' where 
							agency_id=".$row['agency_id'];
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