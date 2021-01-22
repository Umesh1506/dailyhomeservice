<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']) && isset($_POST['user_id']) && isset($_POST['feedback_desc'])  && isset($_POST['feedback_user_type']))
		{
			$agency_id=$_POST['agency_id'];
			$user_id=$_POST['user_id'];
			$feedback_desc=$_POST['feedback_desc'];
			date_default_timezone_set('Asia/Calcutta'); 
			$feedback_time=date('Y-m-d H:i:s');
			$feedback_user_type=$_POST['feedback_user_type'];
			
			 $query="insert into feedback(feedback_agency_id,feedback_user_id,feedback_desc,feedback_time,feedback_user_type) 
				VALUES('".$agency_id."',".$user_id.",'".$feedback_desc."','".$feedback_time."','".$feedback_user_type."')";
			$result=mysqli_query($conn,$query);
			
			if($result)
			{
				$array=array("status"=>"200","Message"=>"Successfully feedback insert");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Not inserted feedback insert");
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