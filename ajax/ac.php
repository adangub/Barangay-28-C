<?php
	include('../_sql/config.php');
	if($_POST)
	{
		$similar=mysql_real_escape_string($_POST['search']) ;
		$result=mysqli_query($conn, "SELECT id, address FROM household WHERE address LIKE '%$similar%' LIMIT 1;");
		while($row=mysqli_fetch_array($result))
		{
			$address=(string)$row['address'];
			$b_address= '<strong>'.$similar.'</strong>';
			$final_address = str_ireplace($similar, $b_address, $address);
?>
		<div class="show" align="left">
			<span class="returns"><?php echo $final_address;?></span> 
			<span class="acaddress" style="display:none"><?php echo $address;?></span> 
			<span class="returnAdd" style="display:none"><?php echo $address;?></span> 
			<span class="returnID" style="display:none"><?php echo $row['id'];?><span>
		</div>
<?php
		
		}
		mysqli_close($conn);
	}
?>