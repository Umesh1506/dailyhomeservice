<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['product_id']))
		{
			$product_id=$_POST['product_id'];
			$totalsize = sizeof($product_id);	


			for($i=0;$i<$totalsize;$i++) 
			{
			$query="delete from agency_product where product_id=".$product_id[$i]."";	
				
				$result=mysqli_query($conn,$query);
			}
						
			
										
			$result=mysqli_query($conn,$query);
			if($result)
			{ 	
				$array=array("status"=>"200","Message"=>"Successfull product deleted");
			}
			else
			{
				$array=array("status"=>"600","Message"=>"Data not found");
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