<?php
require_once("connection.php");
require_once("lib/function.php");
include('PHPMailer/PHPMailerAutoload.php');

if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
	if(isset($_POST['email']))
	{
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$query = "select * from user where user_email = '".$email."'";
		
		$result = mysqli_query($conn, $query);	
		if (mysqli_num_rows($result) == 1) 
		{
			
			$row = mysqli_fetch_assoc($result);

			$to = $row['user_email'];
			$arr = $row	;
			
			$otp = mt_rand(000000,999999);
			$query1 = "update user set user_otp = ".$otp.", user_otpused = 0 where 
			user_email = '".$to."'";
		
			
			$result1 = mysqli_query($conn,$query1);
			
			if ($result1)
			{
				$message = "<h3>Your new OTP is ".$otp.". Please do not share</h3>";
				$subject = "Request For OTP";		
				$mailSent = send_mail($to, $message, $subject);
				if ($mailSent)
				{
					//session_start();
					//$_SESSION['id'] = $to;
					$array=array("status"=>"200","Message"=>"Successfully otp generated");
					$array=array('status' => "200" , "otp details" => $arr);
				} 
				else
				{	
					$array=array("status"=>"300","Message"=>"not generated");
				}
				
			}			
		}	
	}
	else
	{
		$array=array("status"=>"600","Message"=>"variable not set");
	}	
}
else
{
	$array=array("status"=>"600","Message"=>"Method invalid");
}	
echo json_encode($array);
?>