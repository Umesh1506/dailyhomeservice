<?php
require_once('notification/firebase.php');
require_once('notification/push.php');
require_once("connection.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(isset($_POST['agency_id']) && isset($_POST['message']) && isset($_POST['title']) )
	{
			$uid=$_POST['agency_id'];
			$title =  $_POST['title'];
			$message =$_POST['message'];
			
		
			$query = "select agency_name,agency_devicetoken from agency where agency_id = ".$uid;
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			$user_devicetoken =$row['agency_devicetoken'];
			$user_fname = $row['agency_name'];
			
			// Push Notification
			$firebase = new Firebase();
			$push = new Push();			
			$push_type = "individual";
			
			$payload = array();
			$payload['team'] = 'India';
			$payload['score'] = '5.6';
			
			
			$push->setTitle($title);
			
			$push->setMessage($message);
			$push->setImage('http://api.androidhive.info/images/minion.jpg');
			$push->setIsBackground(FALSE);
			$push->setPayload($payload);

			$json = '';
			$response = '';

			if ($push_type == 'topic')
				{
				$json = $push->getPush();
				echo $response = $firebase->sendToTopic('global', $json);
			} 
			else if ($push_type == 'individual') {
				$json = $push->getPush();
				$devicetoken = isset($user_devicetoken) ? $user_devicetoken : '';		
				echo $response = $firebase->send($user_devicetoken, $json);
				die;
				
			}
		}
		else
		{
			$array=array("status"=>"500","Message"=>"variables are not set");
		}
	}
	else
	{
		$array=array("status"=>"400","Message"=>"Invalid Method");
	}
	echo json_encode($array);
			
			?>