<?php
	include('../_sql/config.php');
	if($_POST)
	{
		if($_POST['person'])
		{
			$similar = mysql_real_escape_string($_POST['person']);
			
			$result=mysqli_query($conn, "SELECT id, CONCAT(resident.family_name,', ',resident.first_name,' ', resident.middle_name) 'fullname', GET_ADDRESS(resident.id) address, household_id FROM resident LEFT JOIN (SELECT DISTINCT resident_id FROM complainant) as tableB ON resident.id = tableB.resident_id WHERE (CONCAT(resident.family_name,', ',resident.first_name,' ', resident.middle_name) LIKE '%$similar%' AND GET_TOTALVERIFIEDREQUESTS(resident.id, 1, 1) = 1) LIMIT 1;");
			while($row=mysqli_fetch_array($result))
			{
				$name = $row['fullname'];
				$copiedname = $row['fullname'];
				$b_name= '<strong>'.$similar.'</strong>';
				$final_name = str_ireplace($similar, $b_name, $name);
				?>			
				<div class="show" align="left">
					<span class="returnName" style="display:none"><?php echo $copiedname;?></span>
					<span class="returnID" style="display:none"><?php echo $row['id'];?></span> 			
					<span class="returnADD" style="display:none"><?php echo $row['address'];?></span> 	
					<span class="returnADDID" style="display:none"><?php echo $row['household_id'];?></span> 	
					<span class="acBlot"><?php echo $final_name;?></span> 
				</div>
			
		
			<?php
		
			}
		}
		
		
		
		mysqli_close($conn);
	}
?>