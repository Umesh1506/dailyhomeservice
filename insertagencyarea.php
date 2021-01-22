<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['area_id'])) 
		{
			$agency_id=$_POST['agency_id'];
			$area_id=$_POST['area_id'];
			$totalsize = sizeof($area_id);
			for($i=0;$i<$totalsize;$i++) 
			{
			
				$query="insert into area_by_agency(agency_id,area_id) 
				VALUES('".$agency_id."','".$area_id[$i]."')";
				
				$result=mysqli_query($conn,$query);
			}
			
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfully area insert");
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