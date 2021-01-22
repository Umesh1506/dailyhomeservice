<?php
	include('connection.php');
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		if(isset($_POST['user_id']) && isset($_POST['product_id']) && 
		 isset($_POST['cart_qty']) && isset($_POST['agency_id'])) 
		{	
			$user_id=$_POST['user_id'];		
			$product_id=$_POST['product_id'];
			$cart_qty=$_POST['cart_qty'];
			$agency_id=$_POST['agency_id'];
				$arr=array();
			$query1="select * from agency_product where product_id=".$_POST['product_id'];	
			$result1=mysqli_query($conn,$query1);
			$row1=mysqli_fetch_assoc($result1);
			
			$product_amount=$row1['product_price'];
			
			$query2="select * from cart where user_id=".$_POST['user_id']."  and product_id=".$_POST['product_id'];	
			$result2=mysqli_query($conn,$query2);
			
			if(!empty($result2))
			{ 	
				//  get product Quantity
				$query3="select * from cart where user_id=".$_POST['user_id']." and  product_id=".$_POST['product_id']." ";
				$result3=mysqli_query($conn,$query3);
				$row3=mysqli_fetch_assoc($result3);
	
				if($cart_qty==0)
				{
					
					$query="delete from cart where cart_id=".$row3['cart_id'];	
					$result=mysqli_query($conn,$query);
					$array=array("status"=>"600","Message"=>"remove from cart");
				}	
				else
				{
					$totalprice=$product_amount*$cart_qty;
				
					$query4="update cart set cart_qty=".$cart_qty.",cart_subtotal=".$totalprice." where cart_id = ".$row3['cart_id'];
					$result4=mysqli_query($conn,$query4);
					
					if($result4)
					{
						$array=array("status"=>"600","Message"=>"product updated");
						$queryget="select * from cart where user_id=".$_POST['user_id']." and  product_id=".$_POST['product_id']." ";
						$resultget=mysqli_query($conn,$queryget);
						while($rowget=mysqli_fetch_assoc($resultget))
						{
								$arr[]=array("cart_id"=>$rowget['cart_id'],"user_id"=>$rowget['user_id'],"agency_id"=>$rowget['agency_id'],"product_id"=>$rowget['product_id'],"cart_amount"=>$rowget['cart_amount'],"cart_qty"=>$rowget['cart_qty'],"cart_subtotal"=>$rowget['cart_subtotal'],"cart_status"=>$rowget['cart_status']);
						}
						$array=array("status"=>"200","cart Response"=>$arr);
							
						
					}
					else
					{
						$array=array("status"=>"600","Message"=>"product update fail");
					
						$totalprice=$product_amount*$cart_qty;
						
						$query5="insert into cart(user_id,agency_id,product_id,cart_amount,cart_qty,cart_subtotal,cart_status) 
						VALUES('".$user_id."','".$agency_id."','".$product_id."','".$product_amount."','".$cart_qty."',".$totalprice.",0)";
			
						$result5=mysqli_query($conn,$query5);
						if($result5)
						{
				
							$array=array("status"=>"600","Message"=>"product inserted");
							$queryget="select * from cart where user_id=".$_POST['user_id']." and  product_id=".$_POST['product_id']." ";
							$resultget=mysqli_query($conn,$queryget);
							while($rowget=mysqli_fetch_assoc($resultget))
							{
									$arr[]=array("cart_id"=>$rowget['cart_id'],"user_id"=>$rowget['user_id'],"agency_id"=>$rowget['agency_id'],"product_id"=>$rowget['product_id'],"cart_amount"=>$rowget['cart_amount'],"cart_qty"=>$rowget['cart_qty'],"cart_subtotal"=>$rowget['cart_subtotal'],"cart_status"=>$rowget['cart_status']);
							}
								$array=array("status"=>"200","cart Response"=>$arr);
						
						}
						else
						{
							$array=array("status"=>"600","Message"=>"product fail to insert");
						}
					}	
				}
			
			}
			
			else
			{
				// get product quantity
				$query6="select * from cart where user_id=".$_POST['user_id']."  and product_id=".$_POST['product_id'];	
				$result6=mysqli_query($conn,$query6);
				$row6=mysqli_fetch_assoc($result6);
				
				$totalprice=$product_amount*$cart_qty;
					
				$query5="insert into cart(user_id,product_id,cart_amount,cart_qty,cart_subtotal,cart_status) 
				VALUES('".$user_id."','".$product_id."','".$product_amount."','".$cart_qty."',".$totalprice.",0)";
			
				$result5=mysqli_query($conn,$query5);
				if($result5)
				{
				
					$array=array("status"=>"600","Message"=>"product inserted");
				}
				else
				{
					$array=array("status"=>"600","Message"=>"product fail to insert");
				}
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