<!DOCTYPE html>
<html>
<body><?php
include '/_sql/config.php';
	
	if(isset($_POST['userout'])&&isset($_POST['passout']))
	{

		$username = mysql_real_escape_string($_POST['userout']);
		$password = mysql_real_escape_string($_POST['passout']);
	
		$selectSql=mysqli_query($conn,"SELECT resident.id, IS_RESIDENT(resident.id) verified, resident.image, resident.household_id addID, resident.username, resident.password, resident.first_name, GET_FULLNAME(resident.id,0) fullname, GET_EMPNAME(employee.id, 0) empname, GET_ADDRESS(resident.household_id) address, employee.id empid, employee.position FROM resident LEFT JOIN employee ON employee.resident_id=resident.id WHERE resident.username = '$username' AND resident.password='$password' LIMIT 1;");
		$row = mysqli_fetch_array($selectSql);
		$u_id = $row['id'];
		$u_image = $row['image'];
		$u_fullname = $row['fullname'];
		$u_firstname = $row['first_name'];
		$u_empid = $row['empid'];
		$position = $row['position'];
		$address = $row['address'];
		$addressid = $row['addID'];
		$verified = $row['verified'];
		$isEMP = is_null($position); // 1 if not employee | 0 if employee
		if($isEMP == 1)
			$isEMP = 0;
		else if($isEMP == 0) $isEMP = 1;
		if($row < 1)
		{	
			echo $username.$password."aa";
			header("Refresh: 10; url=login");
			?>
				<script>alert("Loopback Error");</script>
			<?php
		}
		else
		{
			?>
			Logging in...
			<?php 
			session_id(generateUniqueId(128));
			session_start();
			$_SESSION = array();
			setcookie("ux", session_id(), strtotime( '+1 days' ), '/');
			 $_SESSION['u_id'] = $u_id;
			 $_SESSION['u_image'] = $u_image;
			 $_SESSION['u_employeeid'] = $u_empid;
			 $_SESSION['u_username'] = $username;
			 $_SESSION['u_fullname'] = $u_fullname;
			 $_SESSION['u_firstname'] = $u_firstname;
			 $_SESSION['u_isemployee'] = $isEMP;
			 $_SESSION['u_position'] = $position;
			 $_SESSION['u_address'] = $address;
			 $_SESSION['u_addressid'] = $addressid;
			 $_SESSION['u_verified'] = $verified;
			header("Refresh: 1; url=home");
		}
	}
	else header("Refresh: 10; url=login");
	echo "1";
mysqli_close($conn);
	
	
	
	
function generateUniqueId($maxLength = null) {
    $entropy = '';

    // try ssl first
    if (function_exists('openssl_random_pseudo_bytes')) {
        $entropy = openssl_random_pseudo_bytes(64, $strong);
        // skip ssl since it wasn't using the strong algo
        if($strong !== true) {
            $entropy = '';
        }
    }

    // add some basic mt_rand/uniqid combo
    $entropy .= uniqid(mt_rand(), true);

    // try to read from the windows RNG
    if (class_exists('COM')) {
        try {
            $com = new COM('CAPICOM.Utilities.1');
            $entropy .= base64_decode($com->GetRandom(64, 0));
        } catch (Exception $ex) {
        }
    }

    // try to read from the unix RNG
    if (is_readable('/dev/urandom')) {
        $h = fopen('/dev/urandom', 'rb');
        $entropy .= fread($h, 64);
        fclose($h);
    }

    $hash = hash('whirlpool', $entropy);
    if ($maxLength) {
        return substr($hash, 0, $maxLength);
    }
    return $hash;
}
?></body>
</html>