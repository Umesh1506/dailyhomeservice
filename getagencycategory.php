<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id'])) 
		{
			$agency_id=$_POST['agency_id'];
			
				
			$query="select * from agency_category where agency_id=".$agency_id."";	
			$result=mysqli_query($conn,$query);
			
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("cat_id"=>$row['cat_id']);
			}
			
			if($result)
			{ 	
				$array=array("status"=>"200","cat Response"=>$arr);
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