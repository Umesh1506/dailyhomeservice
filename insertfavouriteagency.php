<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['user_id']))
		{
			$agency_id=$_POST['agency_id'];
			$user_id=$_POST['user_id'];
			
			$query="insert into favourite_agency(agency_id,user_id) 
				VALUES('".$agency_id."','".$user_id."')";
			
			$result=mysqli_query($conn,$query);
			
			if($result)
			{
				$array=array("status"=>"200","Message"=>"Successfully favourite_agency insert");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Not inserted favourite_agency insert");
			}
		}	
		else 
		{
			$array=array("status"=>"430","Message"=>"variable Not Set");
		}	
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
echo json_encode($array);
?>