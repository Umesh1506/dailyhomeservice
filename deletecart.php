<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id'])) 
		{
			$user_id=$_POST['user_id'];		
			
			$query="delete from cart where user_id=".$user_id."";		
			$result=mysqli_query($conn,$query);
						
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfull cart empty");
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