<?php	
	require_once("connection.php");
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['cat_id']) && isset($_POST['agency_id']))
		{
			$cat_id=$_POST['cat_id'];
			$agency_id=$_POST['agency_id'];
			$query="select * from agency_product where cat_id=".$cat_id." And agency_id=".$agency_id."";
			$arr;
			$result=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($result))
			{
				$arr[]=array("product_id"=>$row['product_id'],
							"product_name"=>$row['product_name'],
							"product_desc"=>$row['product_desc'],
							"product_price"=>$row['product_price'],
							"product_img"=>$row['product_img'],
							"agency_id"=>$row['agency_id'],
							"cat_id"=>$row['cat_id']
					
							
							);
			}
			if(!empty($arr))
			{
				$array=array("status"=>"200","product_Response"=>$arr);
			}
			else
			{
				$array=array("status"=>"600","product_Response"=>"Invalid credential");
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