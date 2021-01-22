<?php
	include('connection.php');
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['agency_email']) && isset($_POST['agency_password']))
		{
			$aemail=$_POST['agency_email'];
			$apassword=$_POST['agency_password'];			
			$query="select agency_id from agency where agency_email='".$aemail."' and agency_password='".$apassword."'";
			$result=mysqli_query($conn,$query);
			$unactive=1;
			
			if($result)
			{
				$row=mysqli_fetch_assoc($result);
				$querydelete="update agency set agency_active='".$unactive."' where agency_id=".$row['agency_id'];					
			    $querydelete2="delete from agency_category where agency_id=".$row['agency_id'];
				$querydelete3="delete from agency_product where agency_id=".$row['agency_id'];
				$querydelete4="delete from area_by_agency where agency_id=".$row['agency_id'];
				$querydelete5="delete from favourite_agency where agency_id=".$row['agency_id'];
				$querydelete6="delete from feedback where feedback_agency_id=".$row['agency_id'];
		
				$result2=mysqli_query($conn,$querydelete);
				$result3=mysqli_query($conn,$querydelete2);
				$result4=mysqli_query($conn,$querydelete3);
				$result5=mysqli_query($conn,$querydelete4);
				$result6=mysqli_query($conn,$querydelete5);
				$result7=mysqli_query($conn,$querydelete6);
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