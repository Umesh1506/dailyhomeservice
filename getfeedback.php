<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_id']))
		{
			$agency_id=$_POST['agency_id'];
			
			$arr=array();
			$query="select * from feedback where feedback_agency_id ='".$agency_id."' order by feedback_time";
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{		
				$arr[]=array("feedback_id"=>$row['feedback_id'],"feedback_agency_id"=>$row['feedback_agency_id'],"feedback_user_id"=>$row['feedback_user_id'],"feedback_desc"=>$row['feedback_desc'],"feedback_time"=>$row['feedback_time'],"feedback_user_type"=>$row['feedback_user_type']);
						
			}
			if(!empty($arr))
			{
				$array=array("status"=>"200","feedback agency Response"=>$arr,"feedback");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Not response get");
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