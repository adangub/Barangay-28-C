
<?php
if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
	{
include '../_sql/config.php';
require('../fpdf.php');
date_default_timezone_set('Asia/Hong_Kong');
$requestID = 'a';
if(isset($_POST['requestID']) && isset($_POST['ctcno']) && isset($_POST['ctcdate']) && isset($_COOKIE['ux'])){
	if($_POST['reqType']=='Barangay Clearance Request'){
		$requestID = mysql_real_escape_string($_POST['requestID']);
		$ctcno = mysql_real_escape_string($_POST['ctcno']);
		$ctcdate = mysql_real_escape_string($_POST['ctcdate']);

		$selectSql=mysqli_query($conn,"SELECT * from requests where id = '$requestID';");
			$row = mysqli_fetch_array($selectSql);
			$id = $row['id'];
			$date = $row['date'];
			$resident_id = $row['resident_id'];

		$selectSql=mysqli_query($conn,"SELECT * from resident where id = '$resident_id';");
			$row = mysqli_fetch_array($selectSql);
			$household_id = $row['household_id'];
			$first_name = $row['first_name'];
			$middle_name = $row['middle_name'];
			$family_name = $row['family_name'];
			$full_name = $first_name.' '.$middle_name.' '.$family_name;
			
		$selectSql=mysqli_query($conn,"SELECT * from household where id = '$household_id';");
			$row = mysqli_fetch_array($selectSql);
			$address = $row['address'];
			$purokNo = $row['purokNo'];
			
		//=======================================================================================================
		require('pdf/writetag.php');


		$year = date("Y");
		$month= date("F");
		$day= date("dS");


		$pdf=new PDF_WriteTag();
		$pdf->SetMargins(22,0,22);
		$pdf->SetFont('times','',13);
		$pdf->AddPage();

		$pdf->Image('../img/logobnw.png', 20, 60, 170, 170); 

		// Stylesheet
		$pdf->SetStyle("n","times","none",13,"0,0,0",0);
		$pdf->SetStyle("s","times","none",11,"0,0,0",0);
		$pdf->SetStyle("sp","times","none",11,"0,0,0",15);
		$pdf->SetStyle("spr","times","none",11,"0,0,0",30);
		$pdf->SetStyle("p","times","none",13,"0,0,0",15);
		$pdf->SetStyle("h1","times","",20,"0,0,0",0);
		$pdf->SetStyle("u","times","U",0,"0,0,0");
		$pdf->SetStyle("b","times","B",0,"0,0,0");


		$pdf->Ln(12);

		// Text
		$pdf->WriteTag(0,10,'<h1><b><u>BARANGAY CLEARANCE</u></b></h1>',0,"C",0,0);
		$pdf->Ln(8);

		$pdf->WriteTag(0,10,'<n>TO WHOM IT MAY CONCERN:</n>',0,"J",0,0);
		$pdf->Ln(4);

		$txt='<p>THIS IS TO CERTIFY that <u><b>'.strtoupper($full_name).'</u></b> according to the records available in this Barangay, is a resident of <u><b>'.$address.'</u></b>, Davao City, Purok No. <u><b>'.$purokNo.'</u></b> of Barangay 28-C, Poblacion District, Davao City with Community Tax Certificate No. <u><b>'.$ctcno.'</u></b> issued at Davao City on <u><b>'.$ctcdate.'</b></u>, has not been convicted of any crime nor is there any pending criminal or civil case against him/her before this Barangay.</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(6);

		$txt='<p>This CERTIFICATION is issued upon his/her request for whatever legal purpose this may serve him/her best.</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(1);


		$txt='<p>Given this '.$day.' day of '.$month.', '.$year.' at Barangay 28-C, D. Suazo St., Davao City, Philippines.</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(12);

		$txt='<n><u><b>'.strtoupper($full_name).'</u></b></n>';
		$pdf->WriteTag(0,2,$txt,0,"C",0,0);
		$pdf->Ln(4);

		$txt='<n>Signature of Applicant over Printed Name</n>';
		$pdf->WriteTag(0,2,$txt,0,"C",0,0);
		$pdf->Ln(4);
		
		$pdf->Cell(60);
		$pdf->Cell(47,27,'',1,1,'C');

		$pdf->Ln(4);
		$txt='<s>Right Hand Thumb Mark</s>';
		$pdf->WriteTag(0,2,$txt,0,"C",0,0);
		$pdf->Ln(16);

		$pdf->WriteTag(0,2,'<n><b>Major NELLIEGAR C UNCIANO PA (Ret)</b></n>',0,"R",0,0);
		$pdf->Ln(3);
		$pdf->WriteTag(0,2,'<spr><s>Punong Barangay</spr>',0,"R",0,0);

		$pdf->Ln(8);
		$pdf->WriteTag(0,2,'<s>Note:</s>',0,"L",0,0);

		$pdf->Ln(8);
		$pdf->WriteTag(0,2,'<sp>Not valid without seal</sp>',0,"J",0,0);
		$pdf->Ln(4);

		$pdf->Output();
	}
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================
		//=======================================================================================================		
	if($_POST['reqType']=='Residency Request'){
		$requestID = mysql_real_escape_string($_POST['requestID']);
		$ctcno = mysql_real_escape_string($_POST['ctcno']);
		$ctcdate = mysql_real_escape_string($_POST['ctcdate']);
		
		if($ctcno=='__________')
			$ctcno='the Barangay.';
		if($ctcdate=='_______')
			$ctcdate='upon request of the said applicant.';
		$selectSql=mysqli_query($conn,"SELECT * from requests where id = '$requestID';");
			$row = mysqli_fetch_array($selectSql);
			$id = $row['id'];
			$date = $row['date'];
			$resident_id = $row['resident_id'];

		$selectSql=mysqli_query($conn,"SELECT * from resident where id = '$resident_id';");
			$row = mysqli_fetch_array($selectSql);
			$household_id = $row['household_id'];
			$first_name = $row['first_name'];
			$middle_name = $row['middle_name'];
			$family_name = $row['family_name'];
			$full_name = $first_name.' '.$middle_name.' '.$family_name;
			
		$selectSql=mysqli_query($conn,"SELECT * from household where id = '$household_id';");
			$row = mysqli_fetch_array($selectSql);
			$address = $row['address'];
			$purokNo = $row['purokNo'];
			
		//=======================================================================================================
		require('pdf/writetag.php');


		$year = date("Y");
		$month= date("F");
		$day= date("dS");


		$pdf=new PDF_WriteTag();
		$pdf->SetMargins(22,0,22);
		$pdf->SetFont('times','',13);
		$pdf->AddPage();

		$pdf->Image('../img/logobnw.png', 20, 60, 170, 170); 

		// Stylesheet
		$pdf->SetStyle("n","times","none",13,"0,0,0",0);
		$pdf->SetStyle("s","times","none",11,"0,0,0",0);
		$pdf->SetStyle("sp","times","none",11,"0,0,0",15);
		$pdf->SetStyle("spr","times","none",11,"0,0,0",30);
		$pdf->SetStyle("p","times","none",13,"0,0,0",15);
		$pdf->SetStyle("h1","times","",20,"0,0,0",0);
		$pdf->SetStyle("u","times","U",0,"0,0,0");
		$pdf->SetStyle("b","times","B",0,"0,0,0");


		$pdf->Ln(12);

		// Text
		$pdf->WriteTag(0,10,'<h1><b><u>CERTIFICATION</u></b></h1>',0,"C",0,0);
		$pdf->Ln(8);

		$pdf->WriteTag(0,10,'<n>TO WHOM IT MAY CONCERN:</n>',0,"J",0,0);
		$pdf->Ln(4);

		$txt='<p>THIS IS TO CERTIFY that <u><b>'.strtoupper($full_name).'</u></b> a bonafide resident of '.$address.', Purok '.$purokNo.' Brgy. 28-C, Davao City.';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(6);

		$txt='<p>FURTHER CERTIFIES that he/she belongs to '.$ctcno.'</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(6);
		
		$txt='<p>This certification is issued '.$ctcdate.'</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(6);


		$txt='<p>Given this <b>'.$day.'</b> day of <b>'.$month.' '.$year.'</b> at the Office of the Punong Barangay, Davao City, Philippines.</p>';
		$pdf->WriteTag(0,8,$txt,0,"J",0,0);
		$pdf->Ln(12);
		$pdf->Ln(12);
		$pdf->Ln(16);

		$pdf->WriteTag(0,2,'<n><b>Major NELLIEGAR C UNCIANO PA (Ret)</b></n>',0,"R",0,0);
		$pdf->Ln(3);
		$pdf->WriteTag(0,2,'<spr><s>Punong Barangay</spr>',0,"R",0,0);

		$pdf->Ln(8);
		$pdf->WriteTag(0,2,'<s>Note:</s>',0,"L",0,0);

		$pdf->Ln(8);
		$pdf->WriteTag(0,2,'<sp>Not valid without seal</sp>',0,"J",0,0);
		$pdf->Ln(4);

		$pdf->Output();
	}
	
	
}

if(isset($_POST['blotterid']) && $_POST['transactionType']=='blotter'){
	$blotterid = mysql_real_escape_string($_POST['blotterid']);
	
	$selectSql=mysqli_query($conn,"SELECT * from blotter where id = '$blotterid';");
		$row = mysqli_fetch_array($selectSql);
		$complaint = $row['complaint'];
		$date_ = $row['date'];
		$complainant_id = $row['complainant_id'];

	$selectSql=mysqli_query($conn,"SELECT * from resident where id = '$complainant_id';");
		$row = mysqli_fetch_array($selectSql);
		$first_name = $row['first_name'];
		$middle_name = $row['middle_name'];
		$family_name = $row['family_name'];
		$full_name = $first_name.' '.$middle_name.' '.$family_name;
		
	$selectSql=mysqli_query($conn,"SELECT * from respondents where blotter_id = '$blotterid';");
		$row = mysqli_fetch_array($selectSql);
		$resident_id = $row['resident_id'];
		
	//=======================================================================================================
	require('pdf/writetagblotter.php');
	$date = date_create($date_);

	$pdf=new PDF_WriteTag();
	$pdf->SetMargins(22,0,22);
	$pdf->SetFont('times','',13);
	$pdf->AddPage();

	// Stylesheet
	$pdf->SetStyle("n","times","none",13,"0,0,0",0);
	$pdf->SetStyle("s","times","none",11,"0,0,0",0);
	$pdf->SetStyle("sp","times","none",11,"0,0,0",15);
	$pdf->SetStyle("spr","times","none",11,"0,0,0",25);
	$pdf->SetStyle("bpr","times","none",11,"0,0,0",15);
	$pdf->SetStyle("p","times","none",13,"0,0,0",15);
	$pdf->SetStyle("pl","times","none",13,"0,0,0",8);
	$pdf->SetStyle("h1","times","",20,"0,0,0",0);
	$pdf->SetStyle("u","times","U",0,"0,0,0");
	$pdf->SetStyle("b","times","B",0,"0,0,0");

	$year = date("Y");
	$month= date("F");
	$day= date("dS");
	
	$pdf->Ln(5);

	// Text
	$pdf->WriteTag(0,5,'<n>Republic of the Philippines</n>',0,"C",0,0);
	$pdf->Ln(2);
	$pdf->WriteTag(0,5,'<n>City of Davao</n>',0,"C",0,0);
	$pdf->Ln(1);
	$pdf->WriteTag(0,5,'<n>OFFICE OF THE PUNONG BARANGAY</n>',0,"C",0,0);
	$pdf->Ln(2);
	$pdf->WriteTag(0,5,'<n>Barangay 28-C'.$resident_id.'</n>',0,"C",0,0);
	$pdf->Ln(6);

	$pdf->WriteTag(0,0,'<n>TO</n>',0,"J",0,0);
	$pdf->Ln(0);
	$selectSqli=mysqli_query($conn,"SELECT * from respondents where blotter_id = '$blotterid';");
	while($whi = mysqli_fetch_array($selectSqli)){
		$resident_id = $whi['resident_id'];
		
		$selectSql=mysqli_query($conn,"SELECT * from resident where id = '$resident_id';");
		$row = mysqli_fetch_array($selectSql);
		$resident = $row['id'];
		$first_name = $row['first_name'];
			$middle_name = $row['middle_name'];
			$family_name = $row['family_name'];
			$full_name_respondents = $first_name.' '.$middle_name.' '.$family_name;
		
		
		$pdf->WriteTag(0,1,'<p><u>'.$full_name_respondents.'</u></p>',0,"J",0,0);
		$pdf->Ln(6);
	}
		
	$pdf->Ln(5);
	$pdf->WriteTag(0,0,'<n>RE: DIALOGUE</n>',0,"J",0,0);
	$pdf->Ln(10);
	
	$pdf->WriteTag(0,0,'<n>DATE: <u>'.date_format($date, 'M j Y').'</u></n>',0,"J",0,0);
	$pdf->Ln(10);
	
	$pdf->WriteTag(0,0,'<h1><b>_______________________________________________</b></h1>',0,"C",0,0);
	$pdf->Ln(10);
	
	$txt='<p>'.$complaint.'</p>';
	$pdf->WriteTag(0,8,$txt,0,"J",0,0);
	
	$pdf->Ln(1);
	$pdf->WriteTag(0,8,'<p>Issued this '.$day.' day of '.$month.', '.$year.' at the Barangay Hall of Barangay 28-C, Poblacion District, Davao City.</p>',0,"J",0,0);
	
	$pdf->Ln(1);
	$pdf->WriteTag(0,8,'<p>Please appear for a dialogue in the name of Law.</p>',0,"J",0,0);
	$pdf->Ln(14);
	
	
	
	$pdf->Output();
}
}
else die("<script>location.href = 'index.php'</script>");
										
?>