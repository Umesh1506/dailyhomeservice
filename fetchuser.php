<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_email']) && isset($_POST['user_password']))
		{
			$uname=$_POST['user_email'];
			$pass=$_POST['user_password'];
			
			if(!empty($uname) && !empty($pass))
			{
			
				$query="select * from user where user_email='".$uname."' and user_password='".$pass."' ";
				$result=mysqli_query($conn,$query);
				while($row=mysqli_fetch_assoc($result))
				{
					$arr[]=array("user_id"=>$row['user_id'],"user_fname"=>$row['user_fname'],"user_lname"=>$row['user_lname'],"user_contact_no"=>$row['user_contact_no'],"user_dob"=>$row['user_dob'],"area_id"=>$row['area_id'],"user_img"=>$row['user_img']);
				}
				if(!empty($arr))
				{
					$array=array("status"=>"200","Fetch Response"=>$arr);
				}
				else
				{
					$array=array("status"=>"600","Fetch Response"=>"No Details Fetch");
				}
			}
			else
			{
				$array=array("status"=>"300","Message"=>"Variable is empty");
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