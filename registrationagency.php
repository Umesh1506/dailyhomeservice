<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_name']) && isset($_POST['agency_email']) && 
		isset($_POST['agency_contact_no']) && isset($_POST['agency_password']) && 
		isset($_POST['area_id']) && isset($_POST['image']) &&
		isset($_POST['agency_lat']) && isset($_POST['agency_long']))
		{
			$aname=$_POST['agency_name'];		
			$acontact=$_POST['agency_contact_no'];
			$aemail=$_POST['agency_email'];
			$apassword=$_POST['agency_password'];
			$area_id=$_POST['area_id'];
			$isactive=0;
			$user_reg_date=date('y-m-d');
			$photo=NULL;
			$agency_lat=$_POST['agency_lat'];
			$agency_long=$_POST['agency_long'];
			
		
			//photo
			if(!empty($_POST['image']))
			{
				$image_base64 = base64_decode($_POST['image']);
				$photo = uniqid() . '.jpeg';
				$file = "../img/" . $photo;
				file_put_contents($file, $image_base64);				
			}
		
			$query="insert into agency(agency_name,agency_contact_no,agency_email,agency_password,area_id,agency_active,agency_reg_date,agency_img,agency_lat,agency_long) 
			VALUES('".$aname."','".$acontact."','".$aemail."','".$apassword."',".$area_id.",".$isactive.",'".$user_reg_date."','".$photo."','".$agency_lat."','".$agency_long."')";
										
			$result=mysqli_query($conn,$query);
			if($result)
			{ 	
				$query2="select Max(agency_id) as agency_id from agency";
				$max_id=mysqli_query($conn,$query2);
				if($max_id)
				{
					$row=mysqli_fetch_assoc($max_id);
					$array=array("status"=>"200","agency_id"=>$row['agency_id']);
				}
				else 
				{
					$array=array("status"=>"400","Message"=>"Failed To Fetch agency");
				}	
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