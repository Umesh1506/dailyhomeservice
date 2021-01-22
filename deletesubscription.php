<?php
	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['sub_id']))
		{
			$sub_id=$_POST['sub_id'];
					
			$query="select sub_end_date from subscription where sub_id='".$sub_id."' ";
			$result=mysqli_query($conn,$query);
			$unactive=1;
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				date_default_timezone_set('Asia/Calcutta'); 
				$today_date=date('Y-m-d');
				if($today_date==$row['sub_end_date'])
				{
		
					$querydelete="update subscription set sub_status='".$unactive."' where sub_id='".$sub_id."'";					
					$result2=mysqli_query($conn,$querydelete);
					if($result2)
					{
						$array=array("status"=>"200","Message"=>"Deleted Successfully");
					}						
					else
					{	
						$array=array("status"=>"600","Message"=>"Unsucessfull Deleted");
					}
				}	
				else
				{
				    $today_date1=date('Y-m-d', strtotime('+1 day', strtotime($today_date)));
				    
				    if($row['sub_end_date']==$today_date1)
				    {
				         	$array=array("status"=>"250","Message"=>"1 day remain");
				    }
				    else
				    {
					$array=array("status"=>"600","Message"=>"Days are left");
				    }
				}
			}
			else
			{
				$array=array("status"=>"700","Message"=>"There are no subscription");
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