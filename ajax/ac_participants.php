<?php
	include('../_sql/config.php');
	if($_POST)
	{
		$similar = mysql_real_escape_string($_POST['search']);
		$pID = mysql_real_escape_string($_POST['program']);
			
		$result=mysqli_query($conn, "SELECT id resid, CONCAT(family_name,', ',first_name,' ', middle_name) 'fullname' FROM resident WHERE ((CONCAT(family_name,', ',first_name,' ', middle_name) LIKE '%$similar%' OR id LIKE '%$similar%') AND id NOT IN (SELECT resident_id FROM participants WHERE program_id = '$pID')) LIMIT 1;");
		while($row=mysqli_fetch_array($result))
		{
			$name = $row['fullname'].' (ID: '.$row['resid'].')';
			$copiedname = $row['fullname'];
			$b_name= '<strong>'.$similar.'</strong>';
			$final_name = str_ireplace($similar, $b_name, $name);
?>			
		<div class="show" align="left">
			<?php echo $copiedname;?>
			<span class="returnName" name="returnName" style="display:none"><?php echo $copiedname;?></span> 
			<span class="returnID" style="display:none"><?php echo $row['resid'];?></span> 
		</div>
<?php
		
		}
		mysqli_close($conn);
	}
?>