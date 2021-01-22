<?php
	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_email']) && isset($_POST['user_password']))
		{
			$uemail=$_POST['user_email'];
			$upassword=$_POST['user_password'];			
			$query="select user_id from user where user_email='".$uemail."' and user_password='".$upassword."'";
			$result=mysqli_query($conn,$query);
			$unactive=1;
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$querydelete="update user set user_active='".$unactive."' where user_id=".$row['user_id'];					
				$result2=mysqli_query($conn,$querydelete);
				if($result2)
				{ 	
					$querydelete2="delete from feedback where feedback_user_id=".$row['user_id'];
					$querydelete3="delete from favourite_agency where user_id=".$row['user_id'];
					$result3=mysqli_query($conn,$querydelete2);
					$result4=mysqli_query($conn,$querydelete3);
					$array=array("status"=>"200","Message"=>"Deleted Successfully");
				}
				else
				{
					$array=array("status"=>"600","Message"=>"Unsucessfull Deleted");
				}
			}
			else
			{
				$array=array("status"=>"700","Message"=>"There are no user");
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