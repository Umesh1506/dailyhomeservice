<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['cat_id'])) 
		{
			$agency_id=$_POST['agency_id'];
			$cat_id=$_POST['cat_id'];
			$totalsize = sizeof($cat_id);
			
			for($i=0;$i<$totalsize;$i++) 
			{
				
				$query="insert into agency_category(agency_id,cat_id) 
					VALUES('".$agency_id."','".$cat_id[$i]."')";
				
				$result=mysqli_query($conn,$query);
			}
			
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfully category insert");
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