<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_email']) && isset($_POST['agency_password']))
		{
			$aname=$_POST['agency_email'];
			$apass=$_POST['agency_password'];
			
			if(!empty($aname) && !empty($apass))
			{
			
				$query="select * from agency where agency_email='".$aname."' and agency_password='".$apass."' ";
				$result=mysqli_query($conn,$query);
				while($row=mysqli_fetch_assoc($result))
				{
					$arr[]=array("agency_id"=>$row['agency_id'],"agency_name"=>$row['agency_name'],"agency_contact_no"=>$row['agency_contact_no'],"area_id"=>$row['area_id'],"agency_img"=>$row['agency_img']);
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