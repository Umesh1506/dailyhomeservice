<?php 
session_start();
require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(isset($_POST['email'])  && isset($_POST['newpassword']) 
		&& isset($_POST['cpassword']))
		{

			$id=$_POST['email'];
			$nPass = $_POST['newpassword'];
			$cPass = $_POST['cpassword'];
			$active=0;
			if ($nPass != $cPass) 
			{
				$array=array("status"=>"600","Message"=>"password not same");
			}
			else
			{
				$query = "update user set user_otpused = 1, 
				user_password = '".$nPass."' where user_email='".$id."'";
				$result = mysqli_query($conn,$query);
				
			
				if($result)
				{		
					$array=array("status"=>"200","Message"=>"password changed");
				}	
				else
				{
					$array=array("status"=>"300","Message"=>"password failed changed");
				}
			}
		}
		else
		{
			$array=array("status"=>"400","Message"=>"variable not set");
		}
	}
	else
	{
		$array=array("status"=>"500","Message"=>"Invalid method");
	}

echo json_encode($array);
?>
