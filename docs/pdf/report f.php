<?php
include '../_sql/config.php';
require('../fpdf.php');
date_default_timezone_set('Asia/Hong_Kong');
$requestID = 'a';

if(isset($_POST['rMonth']) && isset($_POST['rYear']) && isset($_POST['rType'])){
	$month = mysqli_real_escape_string($conn, $_POST['rMonth']);
	$year = mysqli_real_escape_string($conn, $_POST['rYear']);
	$type = mysqli_real_escape_string($conn, $_POST['rType']);

	$datetoget = $year.'-'.$month.'-29';
	
	$dateto = date_create($datetoget);
	
	$monthtoget = date_format($dateto, 'F');
	$yeartoget = date_format($dateto, 'Y');
		
	//=======================================================================================================
	require('pdf/writetagreport.php');
	
	$pdf=new PDF_WriteTag();
	$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
	$header = array('Full Name', 'Gender', 'Gender', 'Gender');
	$pdf->SetFont('Arial','',14);
	//$pdf->AddPage();
	//$txt = 'Austria;Vienna;83859;8075
	//Belgium;Brussels;30518;10192';
	//$pdf->BasicTable($header,$txt);
	$pdf->SetMargins(15,22,15,22);
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


	// Text
	$pdf->WriteTag(0,5,'<n>'.$type.' Report as of '.$monthtoget.' '.$yeartoget.'</n>',0,"C",0,0);
	$pdf->Ln(2);
	$pdf->WriteTag(0,5,'<n>City of Davao</n>',0,"C",0,0);
	$pdf->Ln(1);
	$pdf->WriteTag(0,5,'<n>OFFICE OF THE PUNONG BARANGAY</n>',0,"C",0,0);
	$pdf->Ln(2);
	$pdf->WriteTag(0,5,'<n>Barangay 28-C</n>',0,"C",0,0);
	$pdf->Ln(6);
	
	if($type == "Residency")
	{
		$selectSql=mysqli_query($conn,"SELECT regdate, gender, birth_date, birth_place, precinctNo, civilstatus, email, contact_number, GET_FULLNAME(id,1) cname FROM resident WHERE MONTH(regdate) = '$month' AND YEAR(regdate) = '$year';");
		$pdf->SetFont('times','',12);
		$pdf->SetWidths(array(45,32,23,19,16,21,26));
		$pdf->Row(array('Full name','Birth Place','Birthday','Gender','Precinct','Status','Contact'));
		while($row = mysqli_fetch_array($selectSql))
		{
			$fullname = $row['cname'];
			$gender = $row['gender'];
			$birth_date = $row['birth_date'];
			$birth_place = $row['birth_place'];
			$precinctNo = $row['precinctNo'];
			$civilstatus = $row['civilstatus'];
			$email = $row['email'];
			$contact_number = $row['contact_number'];
			
			
			$residencydate = date_create($row['regdate']);
			$residencybirthdate = date_format(date_create($row['birth_date']), 'M j Y');
			
			$residencyday = date_format($residencydate, 'j');
			$residencymonth = date_format($residencydate, 'F');
			
			
			
			$pdf->SetFont('times','',11);
			srand(microtime()*1000000);
			
			$pdf->Row(array($fullname,$birth_place,$residencybirthdate,$gender,$precinctNo,$civilstatus,$contact_number));
		}
	
	}
	else if($type == "Transactions")
	{
		$selectSql=mysqli_query($conn,"SELECT GET_FULLNAME(transactions.resident_id, 0) cname, transactions.resident_id, requests.id, requests.optional_comment, request_type.request_name, requests.date 'request_date', requests.verified, requests.transactions_id, transactions.amount, transactions.date 'transactions_date', GET_EMPNAME(transactions.employee_id,0) 'empname' FROM transactions INNER JOIN requests ON requests.transactions_id=transactions.id  INNER JOIN request_type ON requests.request_type_id = request_type.id WHERE MONTH(transactions.date) = '$month' AND YEAR(transactions.date) = '$year'");
		$pdf->SetFont('times','',12);
		$pdf->SetWidths(array(25,45,40,60,17));
		$pdf->Row(array('Date', 'Request Type','Resident','Attended by', 'Amount'));
		while($row = mysqli_fetch_array($selectSql))
		{
			$date = $row['transactions_date'];
			$date = strtotime($date);
			$resident_name = $row['cname'];
			$employee_name = $row['empname'];
			$request_name = $row['request_name'];
			$amount = $row['amount'];
			$verified =$row['verified'];
			if($verified == 0)
				$verified == "Pending";
			else if($verified == 1)
				$verified == "Approved";
			else $verified == "Denied";
			
			
			
			
			
			$date = date("F d, Y", $date);
			
			$amount = number_format($amount, 2);
			
			
			
			$pdf->SetFont('times','',11);
			srand(microtime()*1000000);
			
			$pdf->Row(array($date, $request_name, $resident_name,$employee_name,$amount));
		}
	}
	else if($type == "Blotter")
	{
		$selectSql=mysqli_query($conn,"SELECT *, GET_COMPLAINANTNAME(complainant_id) cname FROM blotter WHERE MONTH(date) = '$month' AND YEAR(date) = '$year'");
		$pdf->SetFont('times','',12);
		$pdf->SetWidths(array(25,50,45,40));
		$pdf->Row(array('Date','Complaint','Complainant', 'Status'));
		while($row = mysqli_fetch_array($selectSql))
		{
			$date = $row['date'];
			$complaint_type_id = $row['complaint_type_id'];
			$complainant_id = $row['complainant_id'];
			$status = $row['status'];
			
			$req=mysqli_query($conn,"SELECT complaint_name FROM complaint_type WHERE id = '$complaint_type_id'");
			$reqrow = mysqli_fetch_array($req);
			$complaint_name = $reqrow['complaint_name'];
			
			$req=mysqli_query($conn,"SELECT complainant_name FROM complainant WHERE id = '$complainant_id'");
			$reqrow = mysqli_fetch_array($req);
			$complainant_name = $reqrow['complainant_name'];
			
			$blotterdate = date_create($row['date']);
			$blotterday = date_format($blotterdate, 'F j');
			
			
			$pdf->SetFont('times','',11);
			srand(microtime()*1000000);
			
			$pdf->Row(array($blotterday,$complaint_name,$complainant_name,$status));
			
		}
	}
	
	//while(query row)
		
	//every writetag dapat within <n></n> or refer nalng sa SetStyle at line 27-36
	
	
	
	
	$pdf->Output();
}
?>