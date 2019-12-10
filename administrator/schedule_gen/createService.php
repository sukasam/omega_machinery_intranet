<?php 
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
	include_once ("config.php");
	include_once ("config2.php");
    //include_once("../mpdf54/mpdf.php");
	include_once('../vendor/autoload.php');

	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);


	$domain = $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
    $domain = str_replace("schedule_gen","service_report_api",$domain);
    $domain = str_replace("createService","update",$domain);
	$url = $domain;

	// echo $url;
	// exit();
	

	$getMonth = $_GET['month']-1;
	$getYear = $_GET['year'];

	

	$quGen = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$_GET['loccontact']."' AND year = '".$getYear."'");
	$numCreated = mysqli_num_rows($quGen);
	
	if($numCreated == 0){
		
		/*$condition = " AND (service_month != '0' AND service_month != '')";
		$condition.= " AND (service_type != '0' AND service_type != '')";

		$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." AND status_use != '2' AND status_use != '1' ORDER BY `cd_province` ,`loc_name` ASC;";

		$quSched = mysqli_query($conn,$sqlSched);

		$runRow = 1;
		$svGenID = 606;
		$thdate = "SR ".substr(date("Y")+543,2)."/".date("m")."/";
		
		  while($rowSched = mysqli_fetch_array($quSched)){
			  
			  set_time_limit(0);
			  
			  if(getScheduleService($rowSched['service_month'],$getMonth,$rowSched['service_type']) == 1){

				  if(getCheckProGen($conn,$rowSched['cpro1'],$rowSched['fs_id']) == 1){

					$_POST['sr_stime'] = date("Y-m-d");
					$_POST['job_open'] = date("Y-m-d");
					$_POST['job_close'] = date("Y-m-d");
					$_POST['job_balance'] = date("Y-m-d");
					
					$_POST['cd_names'] = urldecode($rowSched['cd_name']);
					$_POST['loc_pro'] = urldecode(get_proname($conn,$rowSched['cpro1']));
					$_POST['loc_seal'] = urldecode($rowSched['pro_pod1']);
					$_POST['loc_sn'] = urldecode($rowSched['pro_sn1']);
					$_POST['loc_contact'] = urldecode($rowSched['technic_service']);
					$_POST['fo_id'] = urldecode($rowSched['fs_id']);
					$_POST['cus_id'] = urldecode($rowSched['fo_id']);
					$_POST['sr_ctype'] = urldecode($rowSched['service_type']);
					$_POST['sr_ctype2'] = urldecode($rowSched['ctype']);

					//ADD DB
					//$_POST['sv_id'] = check_servicereport($conn);
					$_POST['sv_id'] = $thdate.sprintf("%03d",$svGenID);
					$svGenID++;
					if(get_lastservice_s($conn,$_POST['cus_id'],"") != ""){
						$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
					}else{
						$_POST['job_last'] = date("Y-m-d");
					}
					
					$_POST['approve'] = 0;
					$_POST['supply'] = 0;
					$_POST['st_setting'] = 0;
					
					include "../include/m_add2.php";
					
					$id = mysqli_insert_id($conn);
						
					include_once("../mpdf54/mpdf.php");
					
					include("form_serviceopen.php");
					$mpdf=new mPDF('UTF-8'); 
					$mpdf->SetAutoFont();
					$mpdf->WriteHTML($form);
					$chaf = str_replace("/","-",$_POST['sv_id']); 
					$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
					
					//echo $_POST['sv_id'];
					
					@mysqli_query($conn,"INSERT INTO `service_schedule` (`id`, `month`, `year`, `technician`, `sv_id`, `fo_id`, `pdf`, `created`) VALUES (NULL, '".date("m")."', '".date("Y")."', '".$_POST['loc_contact']."', '".$_POST['sv_id']."', '".$_POST['fo_id']."', '".$chaf.".pdf', CURRENT_TIMESTAMP);");
					
					$pid = mysqli_insert_id($conn);

				  }

				  //sleep(1);

				  if(getCheckProGen($conn,$rowSched['cpro2'],$rowSched['fs_id']) == 1){


					$_POST['sr_stime'] = date("Y-m-d");
					$_POST['job_open'] = date("Y-m-d");
					$_POST['job_close'] = date("Y-m-d");
					$_POST['job_balance'] = date("Y-m-d");
					
					$_POST['cd_names'] = urldecode($rowSched['cd_name']);
					$_POST['loc_pro'] = urldecode(get_proname($conn,$rowSched['cpro2']));
					$_POST['loc_seal'] = urldecode($rowSched['pro_pod2']);
					$_POST['loc_sn'] = urldecode($rowSched['pro_sn2']);
					$_POST['loc_contact'] = urldecode($rowSched['technic_service']);
					$_POST['fo_id'] = urldecode($rowSched['fs_id']);
					$_POST['cus_id'] = urldecode($rowSched['fo_id']);
					$_POST['sr_ctype'] = urldecode($rowSched['service_type']);
					$_POST['sr_ctype2'] = urldecode($rowSched['ctype']);

					//ADD DB
					//$_POST['sv_id'] = check_servicereport($conn);
					$_POST['sv_id'] = $thdate.sprintf("%03d",$svGenID);
					$svGenID++;
					if(get_lastservice_s($conn,$_POST['cus_id'],"") != ""){
						$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
					}else{
						$_POST['job_last'] = date("Y-m-d");
					}
					
					$_POST['approve'] = 0;
					$_POST['supply'] = 0;
					$_POST['st_setting'] = 0;
					
					include "../include/m_add2.php";
					
					$id = mysqli_insert_id($conn);
						
					include_once("../mpdf54/mpdf.php");
					
					include("form_serviceopen.php");
					$mpdf=new mPDF('UTF-8'); 
					$mpdf->SetAutoFont();
					$mpdf->WriteHTML($form);
					$chaf = str_replace("/","-",$_POST['sv_id']); 
					$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
					
					//echo $_POST['sv_id'];
					
					@mysqli_query($conn,"INSERT INTO `service_schedule` (`id`, `month`, `year`, `technician`, `sv_id`, `fo_id`, `pdf`, `created`) VALUES (NULL, '".date("m")."', '".date("Y")."', '".$_POST['loc_contact']."', '".$_POST['sv_id']."', '".$_POST['fo_id']."', '".$chaf.".pdf', CURRENT_TIMESTAMP);");
					
					$pid = mysqli_insert_id($conn);

				  }

				 // sleep(1);

			  }  
	      }
		 
		  //sleep(3);
		  //genFile($getMonth,$_GET['loccontact']);
		
			echo "<script>window.opener.location.reload();window.close();</script>";
		 
		  */
		}else{
			
			genFile($conn,$getMonth,$_GET['loccontact'],$getYear);
			
		}
	
	
	function genFile($conn,$getMonth,$loccontact,$getYear){
		
		// and now we can use library
		$pdf = new \Jurosh\PDFMerge\PDFMerger;

		
		$quGen2 = mysqli_query($conn,"SELECT * FROM service_schedule WHERE month = '".$getMonth."' AND technician = '".$loccontact."' AND year = '".$getYear."'");
		 $numCreated2 = mysqli_num_rows($quGen2);
			
		
		 while($rowGen2 = mysqli_fetch_array($quGen2)){
			//set_time_limit(0);
			$pdf->addPDF("../../upload/service_report_open/".$rowGen2['pdf'], 'all');
		 }

		// call merge, output format `file`
		$pdf->merge("file", "../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");

		//echo "<script>window.opener.location.reload();window.close();</script>";

		header("Location:../../upload/schedule/service_report_".date("Y-m")."_".$loccontact.".pdf");

	}
  


?>