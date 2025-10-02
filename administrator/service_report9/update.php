<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	if ($_POST["mode"] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['sr_stime']);
		$_POST['sr_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_open']);
		$_POST['job_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_close']);
		$_POST['job_close']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_balance']);
		$_POST['job_balance']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date2']);
		$_POST['loc_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date3']);
		$_POST['loc_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date4']);
		$_POST['loc_date4']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sell_date']);
		$_POST['sell_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST['price_quo'] = number_format($_POST['price_quo'],2,".","");
		$_POST['w1'] = number_format($_POST['w1'],2,".","");
		$_POST['w2'] = number_format($_POST['w2'],2,".","");
		$_POST['w3'] = number_format($_POST['w3'],2,".","");
		$_POST['w4'] = number_format($_POST['w4'],2,".","");
		$_POST['w5'] = number_format($_POST['w5'],2,".","");
		$_POST['w6'] = number_format($_POST['w6'],2,".","");
		$_POST['w7'] = number_format($_POST['w7'],2,".","");
		$_POST['w8'] = number_format($_POST['w8'],2,".","");

		$_POST['x1'] = number_format($_POST['x1'],2,".","");
		$_POST['x2'] = number_format($_POST['x2'],2,".","");
		$_POST['x3'] = number_format($_POST['x3'],2,".","");
		$_POST['x4'] = number_format($_POST['x4'],2,".","");
		$_POST['x5'] = number_format($_POST['x5'],2,".","");
		$_POST['x6'] = number_format($_POST['x6'],2,".","");

		$_POST['y1'] = number_format($_POST['y1'],2,".","");
		$_POST['y2'] = number_format($_POST['y2'],2,".","");
		$_POST['y3'] = number_format($_POST['y3'],2,".","");
		$_POST['y4'] = number_format($_POST['y4'],2,".","");
		$_POST['y5'] = number_format($_POST['y5'],2,".","");
		$_POST['y6'] = number_format($_POST['y6'],2,".","");
		
		$_POST['z1'] = number_format($_POST['z1'],2,".","");
		$_POST['z2'] = number_format($_POST['z2'],2,".","");
		$_POST['z3'] = number_format($_POST['z3'],2,".","");
		$_POST['z4'] = number_format($_POST['z4'],2,".","");
		$_POST['z5'] = number_format($_POST['z5'],2,".","");
		$_POST['z6'] = number_format($_POST['z6'],2,".","");

		if ($_POST["mode"] == "add") { 
			
			$_POST['approve'] = 0;
			$_POST['st_setting'] = 0;
			$_POST['supply'] = 0;
			
			if($_POST['cus_id'] == ""){
				$_POST['cus_id'] = 1;
			}
		
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			$_POST['detail_comment'] = nl2br($_POST['detail_comment']);
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];
			
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
			
			
			//job_balance up to cs_ship
			//sr_stime up to cs_setting
			
			@mysqli_query($conn,"UPDATE `s_first_order` SET `cs_ship` = '".$_POST['job_balance']."',`cs_setting` = '".$_POST['sr_stime']."'  WHERE `s_first_order`.`fo_id` = ".$_POST['cus_id'].";");
			
			
			include "../include/m_add.php";
			
			
			$id = mysqli_insert_id($conn);
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report9sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '".$prices[$a]."', '".$amounts[$a]."', '".$opens[$a]."', '0');");
					// @mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				}
			}
				
			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
		if ($_POST["mode"] == "update" ) {
			
			$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
			$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);
			$_POST['detail_comment'] = nl2br($_POST['detail_comment']);
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];
			$rid = $_POST['r_id'];
			
			$_POST['job_last'] = get_lastservice_f($conn,$_POST['cus_id'],$_POST['sv_id']);
			
			$filename = "";
			
			
			$sql2 = "select * from s_service_report9sub where sr_id = '".$_REQUEST[$PK_field]."'";
			$quPro = @mysqli_query($conn,$sql2);
			// while($rowPro = mysqli_fetch_array($quPro)){
			// 	@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'".$rowPro['opens']."' WHERE `group_id` = '".$rowPro['lists']."';");
			// }
			
			@mysqli_query($conn,"DELETE FROM `s_service_report9sub` WHERE `sr_id` = '".$_REQUEST[$PK_field]."'");
			
			//job_balance up to cs_ship
			//sr_stime up to cs_setting
			
			@mysqli_query($conn,"UPDATE `s_first_order` SET `cs_ship` = '".$_POST['job_balance']."',`cs_setting` = '".$_POST['sr_stime']."'  WHERE `s_first_order`.`fo_id` = ".$_POST['cus_id'].";");
			
			 
			include ("../include/m_update.php");

//			if ($_FILES['ufimages']['name'] != "") { 
//				$mname="";	
//				$mname=gen_random_num(5);
//				$a_size = array('600');	
//				$filename = "";
//					foreach($a_size as $key => $value) {
//						$path = "../../upload/install/".$value."/";
//						$quality = 80;
//						if($filename == "")	
//							$name_data=explode(".",$_FILES['ufimages']['name']);
//							$type=$name_data[1];
//							$filename =$mname.".".$type;
//							list($width, $height) = getimagesize($_FILES['ufimages']['name']);
//							$sizes = $value;
//							uploadfile($path,$filename,$_FILES['ufimages']['tmp_name'],$sizes, $quality);
//					} // end foreach				
//					$sql = "update $tbl_name set u_images = '$filename' where $PK_field = '".$_POST[$PK_field]."' ";
//					@mysqli_query($conn,$sql);				
//					
//					$_POST['filenames'] = '<br /><br />
//						<table width="100%" border="0" cellspacing="0" cellpadding="0">
//						  <tr>
//							<td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
//						  </tr>
//						  <tr>
//							<td style="text-align:center;font-size:12px;"><img src="'.$path.$filename.'" width="600"></td>
//						  </tr>
//						</table>';
//						
//				} // end if ($_FILES[file1][name] != "")
//				else{
//					if(!empty($_POST['u_images'])){
//						$_POST['filenames'] = '<br /><br />
//						<table width="100%" border="0" cellspacing="0" cellpadding="0">
//						  <tr>
//							<td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
//						  </tr>
//						  <tr>
//							<td style="text-align:center;font-size:12px;"><img src="'.$path.$_POST['u_images'].'" width="600"></td>
//						  </tr>
//						</table>';
//					}else{
//						$_POST['filenames'] = '';
//					}
//				}
			
			if ($_FILES['ufimages']['name'] != "") { 
					
					$mname="";
					$mname=gen_random_num(5);
					$filename = "";
					if($filename == "")
					$name_data=explode(".",$_FILES['ufimages']['name']);
					$type = $name_data[1];
					$filename = $mname.".".$type;
					
					$target_dir = "../../upload/install/";
					$target_file = $target_dir . basename($filename);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["ufimages"]["tmp_name"]);
					
					@move_uploaded_file($_FILES["ufimages"]["tmp_name"], $target_file);
					$sql = "update $tbl_name set u_images = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
					@mysqli_query($conn, $sql);	
				
					$_POST['filenames'] = $filename;

					//resize_crop_image(800, 533, $target_file, $target_file);
	
			} // end if ($_FILES[fimages][name] != "")
			else{
				$_POST['filenames'] = $_POST['u_images'];
			}

			if ($_FILES['ufimages2']['name'] != "") { 
					
				$mname="";
				$mname=gen_random_num(5);
				$filename = "";
				if($filename == "")
				$name_data=explode(".",$_FILES['ufimages2']['name']);
				$type = $name_data[1];
				$filename = $mname.".".$type;
				
				$target_dir = "../../upload/install/";
				$target_file = $target_dir . basename($filename);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["ufimages2"]["tmp_name"]);
				
				@move_uploaded_file($_FILES["ufimages2"]["tmp_name"], $target_file);
				$sql = "update $tbl_name set u_images2 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
				@mysqli_query($conn, $sql);	
			
				$_POST['filenames2'] = $filename;

				//resize_crop_image(800, 533, $target_file, $target_file);

		} // end if ($_FILES[fimages][name] != "")
		else{
			$_POST['filenames2'] = $_POST['u_images2'];
		}

		if ($_FILES['ufimages3']['name'] != "") { 
			$mname="";
			$mname=gen_random_num(5);
			$filename = "";
			if($filename == "")
			$name_data=explode(".",$_FILES['ufimages3']['name']);
			$type = $name_data[1];
			$filename = $mname.".".$type;
			
			$target_dir = "../../upload/install/";
			$target_file = $target_dir . basename($filename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["ufimages3"]["tmp_name"]);
			
			@move_uploaded_file($_FILES["ufimages3"]["tmp_name"], $target_file);
			$sql = "update $tbl_name set u_images3 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
			@mysqli_query($conn, $sql);	
			
			$_POST['filenames3'] = $filename;
			
			//resize_crop_image(800, 533, $target_file, $target_file);
		} // end if ($_FILES[fimages][name] != "")
		else{
			$_POST['filenames3'] = $_POST['u_images3'];
		}
			
			$id = $_REQUEST[$PK_field];		
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report9sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '".$prices[$a]."', '".$amounts[$a]."', '".$opens[$a]."', '0');");
					// @mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
				}
						
			}	

			include_once("../mpdf54/mpdf.php");
			include_once("form_serviceopen.php");
			$mpdf=new mPDF('UTF-8'); 
			$mpdf->SetAutoFont();
			// $mpdf->SetHTMLHeader('<div><img src="../images/form/header_service_report9.png" width="100%" border="0" /></div>');
			$mpdf->WriteHTML($form);
			$chaf = preg_replace("/\//","-",$_POST['sv_id']); 
			$mpdf->Output('../../upload/service_report_open/'.$chaf.'.pdf','F');
			
			header ("location:index.php?" . $param); 
		}
		
	}
	if ($_GET["mode"] == "add") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");
	}
	if ($_GET["mode"] == "update") { 
		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array ($query)) { 
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) { 
				$$value = $rec[$value];
			}
		}
		
		$a_sdate=explode("-",$sr_stime);
		$sr_stime=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_open);
		$job_open=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_close);
		$job_close=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_balance);
		$job_balance=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date2);
		$loc_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date3);
		$loc_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$loc_date4);
		$loc_date4=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$sell_date);
		$sell_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
		$ckf_list = explode(',',$ckf_list);
		
	}
	
	//--------------------------------------------------------------------------------
	if($_GET['del_id'] <> ""){	
		$a_size = array('100');	
		foreach($a_size as $key => $value) {	
			if(file_exists("../../upload/install/".$_GET['del_id']))
			@unlink("../../upload/install/".$_GET['del_id']);		
		}	
			$sql = "update $tbl_name set u_images ='' where $PK_field = '".$_GET[$PK_field]."' ";
			@mysqli_query($conn,$sql);	
			 
		    @header ("location:update.php?mode=update&sr_id=".$_GET['sr_id'].""); 
	}
	if($_GET['del_id2'] <> ""){	
		$a_size = array('100');	
		foreach($a_size as $key => $value) {	
			if(file_exists("../../upload/install/".$_GET['del_id2']))
			@unlink("../../upload/install/".$_GET['del_id2']);		
		}	
			$sql = "update $tbl_name set u_images2 ='' where $PK_field = '".$_GET[$PK_field]."' ";
			@mysqli_query($conn,$sql);	
			 
		    @header ("location:update.php?mode=update&sr_id=".$_GET['sr_id'].""); 
	}
	if($_GET['del_id3'] <> ""){	
		$a_size = array('100');	
		foreach($a_size as $key => $value) {	
			if(file_exists("../../upload/install/".$_GET['del_id3']))
			@unlink("../../upload/install/".$_GET['del_id3']);		
		}	
			$sql = "update $tbl_name set u_images3 ='' where $PK_field = '".$_GET[$PK_field]."' ";
			@mysqli_query($conn,$sql);	
			 
		    @header ("location:update.php?mode=update&sr_id=".$_GET['sr_id'].""); 
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php   echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}		
}	

	function CountChecks(whichlist,maxchecked,latestcheck,numsa) {
	
	var listone = new Array();
 	
	for (var t=1;t<=numsa;t++){
		listone[t-1] = 'checkbox'+t;
	}
	
	// End of customization.
	var iterationlist;
	eval("iterationlist="+whichlist);
	var count = 0;
	for( var i=0; i<iterationlist.length; i++ ) {
	   if( document.getElementById(iterationlist[i]).checked == true) { count++; }
	   if( count > maxchecked ) { latestcheck.checked = false; }
	   }
	if( count > maxchecked ) {
	  // alert('Sorry, only ' + maxchecked + ' may be checked.');
	   }
	}
	
</script>
<SCRIPT language=Javascript>
      function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

	  function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}


</SCRIPT>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php   echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php   echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php   echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><style>
	.bgheader{
		font-size:12px;
		position:absolute;
		margin-top:98px;
		padding-left:586px;
	}
	table tr td{
		vertical-align:top;
		padding:5px;
	}	
	.tb1{
		margin-top:5px;
	}
	.tb1 tr td{
		border:1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
  	}	
	.cdetail ul li{
		list-style:none;
		
	}
	.cdetail2 ul li{
		list-style:none;
		float:left;
	}
	.clear{
		margin:0;
		padding:0;
		clear:both;	
	}
	
	.tblf5{
		border: 1px solid #000000;
		font-size:12px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<div style="position:relative;text-align:center;">
            	<img src="../images/form/header_service_report9.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td><strong>ชื่อลูกค้า :</strong> 
            	<!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php   
						$qu_cusf = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY cd_name ASC");
						while($row_cusf = @mysqli_fetch_array($qu_cusf)){
							?>
							<option value="<?php   echo $row_cusf['fo_id'];?>" <?php   if($row_cusf['fo_id'] == $cus_id){echo 'selected';}?>><?php   echo $row_cusf['cd_name']." (".$row_cusf['loc_name'].")";?></option>
							<?php  
						}
					?>
                </select>-->
                <input name="cd_names" type="text" id="cd_names"  value="<?php   echo get_customername($conn,$cus_id);?>" style="width:50%;" readonly>
                <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php   echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td><strong>ประเภทบริการลูกค้า :</strong> 
            	<select name="sr_ctype" id="sr_ctype">
                	<!--<option value="">กรุณาเลือก</option>-->
                	<?php   
						$qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
						while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
							?>
							<option value="<?php   echo $row_cusftype['group_id'];?>" <?php   if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php   echo $row_cusftype['group_name'];?></option>
							<?php  
						}
					?>
                </select>
                <strong>ประเภทลูกค้า :</strong>
            	<select name="sr_ctype2" id="sr_ctype2">
            	  <!--<option value="">กรุณาเลือก</option>-->
            	  <?php   
						$qu_cusftype2 = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)){
							if(substr($row_cusftype2['group_name'],0,2) == "SR"){
							?>
            	  <option value="<?php   echo $row_cusftype2['group_id'];?>" <?php   if($row_cusftype2['group_id'] == $sr_ctype2){echo 'selected';}?>><?php   echo $row_cusftype2['group_name'];?></option>
            	  <?php  
							}
						}
					?>
          	  </select>
                </td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php   echo $finfo['cd_address'];?></span></td>
            <td><strong>เลขที่บริการ : <input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo check_servicereportinstall($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;"><!--<input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo "SR";}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">-->&nbsp;&nbsp;เลขที่สัญญา  :</strong> <span id="contactid"><?php   echo $finfo['fs_id'];?></span></td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> <span id="cusprovince"><?php   echo province_name($conn,$finfo['cd_province']);?></span></td>
            <td><strong>วันที่  :</strong> <span id="datef"></span><input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script></td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <span id="custel"><?php   echo $finfo['cd_tel'];?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php   echo $finfo['cd_fax'];?></span></td>
            <td><strong>วันติดตั้ง :</strong> <span id="datet"></span>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>
              <strong> วันที่ส่งงาน  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>
            </span>
              </td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php   echo $finfo['c_contact'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php   echo $finfo['c_tel'];?></span></td>
            <td>
			  <strong>เลขที่ใบงาน : </strong>
              <input type="text" name="srid" value="<?php   echo $srid;?>" id="srid" class="inpfoder">
			  &nbsp;&nbsp;&nbsp;&nbsp;
			  <strong>เสนอราคางานติดตั้ง :</strong>
			  <input type="text" name="price_quo" value="<?php   echo $price_quo;?>" id="price_quo" class="inpfoder">
            </td>
          </tr>
          <?php   
		  	if($_GET['mode'] == "update"){
				?>
				<tr class="formFields">
            <td nowrap class="name">
			<strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php   echo $finfo['loc_name'];?></span><br />
          <br>
          <strong>เลือกสินค้า :</strong>
          <span id="prolist">
          		<?php   
				$prolist = get_profirstorder($conn,$cus_id);
				//$lispp = explode(",",$prolist);
				$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','".$cus_id."')\">
								<option value=\"\">กรุณาเลือก</option>       
							 ";
				for($i=0;$i<count($prolist);$i++){
					$plid .= "<option value=".$i.">".get_proname($conn,$prolist[$i])."</option>";
				}	
				echo $plid .=	 "</select>";
						?>
          </span>
          <br>
          <br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
            <input type="text" name="loc_pro" value="<?php   echo $loc_pro;?>" id="loc_pro" class="inpfoder" style="width:50%;">
            </span><br>
            <br />
            <strong>รุ่นเครื่อง : </strong><span id="lpa2"><input type="text" name="loc_seal" value="<?php   echo $loc_seal;?>" id="loc_seal" class="inpfoder" style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><input type="text" name="loc_sn" value="<?php   echo $loc_sn;?>" id="loc_sn" class="inpfoder" style="width:20%;"></span><br /><br />
            <strong>เครื่องป้อนน้ำยา : </strong><input type="text" name="loc_clean" value="<?php   echo $loc_clean;?>" id="loc_clean" class="inpfoder" style="width:50%;"><br />
            <br>
            <strong>ช่างติดตั้ง :</strong>
            <select name="loc_contact" id="loc_contact">
                	<option value="">กรุณาเลือก</option>
                	<?php   
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
							<option value="<?php   echo $row_custec['group_id'];?>" <?php   if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php   echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
							<?php  
						}
					?>
                </select>
			</td>
            <td>
				<ui>
					<li style="list-style:none;display: inline;float: left;">
						<span class="name"><strong>รูปภาพประกอบงาน 1</strong></span><br>
              	<input name="ufimages" type="file" id="ufimages">
             	 <br>
				<?php  
				if($u_images != ""){?>
					<img src="../../upload/install/<?php   echo $u_images?>" width="155"><br/>[<a href="?mode=<?php   echo $_GET["mode"]?>&<?php   echo $PK_field?>=<?php   echo $$PK_field;?>&<?php   echo $FR_field?>=<?php   echo $$FR_field;?>&del_id=<?php   echo $u_images;?>&page=<?php   echo $page;?>">Delete</a>]
				<?php  }?>
				<input name="u_images" type="hidden" value="<?php echo $u_images; ?>">
					</li>
					<li style="list-style:none;display: inline;float: left;">
						<span class="name"><strong>รูปภาพประกอบงาน 2</strong></span><br>
              	<input name="ufimages2" type="file" id="ufimages2">
             	 <br>
				<?php  
				if($u_images2 != ""){?>
					<img src="../../upload/install/<?php   echo $u_images2?>" width="155"><br/>[<a href="?mode=<?php   echo $_GET["mode"]?>&<?php   echo $PK_field?>=<?php   echo $$PK_field;?>&<?php   echo $FR_field?>=<?php   echo $$FR_field;?>&del_id2=<?php   echo $u_images2;?>&page=<?php   echo $page;?>">Delete</a>]
				<?php  }?>
				<input name="u_images2" type="hidden" value="<?php echo $u_images2; ?>">
					</li>
					<li style="list-style:none;display: inline;float: left;">
						<span class="name"><strong>รูปภาพประกอบงาน 3</strong></span><br>
              	<input name="ufimages3" type="file" id="ufimages3">
             	 <br>
				<?php  
				if($u_images3 != ""){?>
					<img src="../../upload/install/<?php   echo $u_images3?>" width="155"><br/>[<a href="?mode=<?php   echo $_GET["mode"]?>&<?php   echo $PK_field?>=<?php   echo $$PK_field;?>&<?php   echo $FR_field?>=<?php   echo $$FR_field;?>&del_id3=<?php   echo $u_images3;?>&page=<?php   echo $page;?>">Delete</a>]
				<?php  }?>
				<input name="u_images3" type="hidden" value="<?php echo $u_images3; ?>">
					</li>
					<li style="list-style:none;display: inline;clear: both;">
						
					</li>
				</ui>
			</td>
          </tr>
				<?php  	
			}
		  ?>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="36%">
			<strong>สรุปค่าใช้จ่าย : ควบคุมงาน (Hardteam)</strong>
			<br><br>
			ค่าน้ำมัน: <input type="text" name="x1" value="<?php   echo $x1;?>" id="x1" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าทางด่วน: <input type="text" name="x2" value="<?php   echo $x2;?>" id="x2" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าเบี้ยเลี้ยง: <input type="text" name="x3" value="<?php   echo $x3;?>" id="x3" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าที่พัก: <input type="text" name="x4" value="<?php   echo $x4;?>" id="x4" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายเบ็ดเตล็ด: <input type="text" name="x5" value="<?php   echo $x5;?>" id="x5" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายอื่นๆ: <input type="text" name="x6" value="<?php   echo $x6;?>" id="x6" class="inpfoder" style="width:20%;">
			<br><br>
			รวมค่าใช้จ่าย (Hardteam) <strong>
				<?php   
				$sum_x = $x1+$x2+$x3+$x4+$x5+$x6;
				echo number_format($sum_x,2);?> บาท
				</strong>

		</td>
        <td width="38%">
			<strong>สรุปค่าใช้จ่าย : ส่วนงานติดตั้ง</strong>
			<br><br>
			ค่าน้ำมัน: <input type="text" name="y1" value="<?php   echo $y1;?>" id="y1" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าทางด่วน: <input type="text" name="y2" value="<?php   echo $y2;?>" id="y2" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าเบี้ยเลี้ยง: <input type="text" name="y3" value="<?php   echo $y3;?>" id="y3" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าที่พัก: <input type="text" name="y4" value="<?php   echo $y4;?>" id="y4" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายเบ็ดเตล็ด: <input type="text" name="y5" value="<?php   echo $y5;?>" id="y5" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายอื่นๆ: <input type="text" name="y6" value="<?php   echo $y6;?>" id="y6" class="inpfoder" style="width:20%;">
			<br><br>
			รวมค่าใช้จ่าย (งานติดตั้ง) <strong>
				<?php   
				$sum_y = $y1+$y2+$y3+$y4+$y5+$y6;
				echo number_format($sum_y,2);?> บาท
				</strong>
			<!-- <strong>ปริมาณน้ำยา</strong><br /><br />
            <strong>ปริมาณน้ำยาล้าง : </strong><input type="text" name="cl_01" value="<?php   echo $cl_01;?>" id="cl_01" class="inpfoder" style="width:20%;"> <strong>ml / rack</strong><br /><br />
            <strong>ปริมาณน้ำยาช่วยแห้ง : </strong><input type="text" name="cl_02" value="<?php   echo $cl_02;?>" id="cl_02" class="inpfoder" style="width:20%;"> <strong>ml / rack</strong><br /><br />
            <strong>ความเข้มข้น : </strong><input type="text" name="cl_03" value="<?php   echo $cl_03;?>" id="cl_03" class="inpfoder" style="width:20%;"> <strong>%</strong><br /><br />
            <strong>สต๊อกน้ำยา C =</strong> <input type="text" name="cl_04" value="<?php   echo $cl_04;?>" id="cl_04" class="inpfoder" style="width:5%;"> <strong>ถัง R = </strong><input type="text" name="cl_05" value="<?php   echo $cl_05;?>" id="cl_05" class="inpfoder" style="width:5%;"> <strong>ถัง A =</strong> <input type="text" name="cl_06" value="<?php   echo $cl_06;?>" id="cl_06" class="inpfoder" style="width:5%;"> <strong>ถัง</strong><br />
            <strong><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong><input type="text" name="cl_07" value="<?php   echo $cl_07;?>" id="cl_07" class="inpfoder" style="width:5%;"> <strong> ถัง RG = </strong><input type="text" name="cl_08" value="<?php   echo $cl_08;?>" id="cl_08" class="inpfoder" style="width:5%;"> <strong> ถัง </strong> -->
        </td>
        <td width="26%">
			<strong>สรุปค่าใช้จ่าย : ส่วนงามแก้ไข</strong>
			<br><br>
			ค่าน้ำมัน: <input type="text" name="z1" value="<?php   echo $z1;?>" id="z1" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าทางด่วน: <input type="text" name="z2" value="<?php   echo $z2;?>" id="z2" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าเบี้ยเลี้ยง: <input type="text" name="z3" value="<?php   echo $z3;?>" id="z3" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าที่พัก: <input type="text" name="z4" value="<?php   echo $z4;?>" id="z4" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายเบ็ดเตล็ด: <input type="text" name="z5" value="<?php   echo $z5;?>" id="z5" class="inpfoder" style="width:20%;">
			<br><br>
			ค่าใช้จ่ายอื่นๆ: <input type="text" name="z6" value="<?php   echo $z6;?>" id="z6" class="inpfoder" style="width:20%;">
			<br><br>
			รวมค่าใช้จ่าย (งานแก้ไข) <strong>
				<?php   
				$sum_z = $z1+$z2+$z3+$z4+$z5+$z6;
				echo number_format($sum_z,2);?> บาท
				</strong>
			<!-- <p><strong>- ค่าทางด่วน :</strong>
            <input type="text" name="mn_1" value="<?php   echo $mn_1;?>" id="mn_1" class="inpfoder" style="width:20%;">
          <strong>บาท</strong></p>
          <p><strong>- ค่าที่พัก : </strong>
            <input type="text" name="mn_2" value="<?php   echo $mn_2;?>" id="mn_2" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- ค่านำมัน : </strong>
            <input type="text" name="mn_3" value="<?php   echo $mn_3;?>" id="mn_3" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- ค่าแก๊ส : </strong>
            <input type="text" name="mn_5" value="<?php   echo $mn_5;?>" id="mn_5" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>- อื่นๆ</strong>
            <strong>:</strong>
            <input type="text" name="mn_4" value="<?php   echo $mn_4;?>" id="mn_4" class="inpfoder" style="width:20%;">
            <strong>บาท</strong></p>
          <p><strong>รวมมูลค่า&nbsp;<?php   echo number_format($mn_1+$mn_2+$mn_3+$mn_4+$mn_5,2);?>&nbsp;บาท</strong></p> -->
		</td>
      </tr>
    </table>
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;"><br>
      รายละเอียดการใช้อะไหล่ - อุปกรณ์</span>
      <br>
      <br>
    </center>
    <div style="text-align:right;margin-bottom:10px;">
      <button type="button" onclick="addRow()" style="background-color:#4CAF50;color:white;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;margin-right:5px;">+ เพิ่มรายการ</button>
      <button type="button" onclick="removeRow()" style="background-color:#f44336;color:white;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;">- ลบรายการ</button>
    </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" style="text-align:center;margin-top:5px;">
      <thead>
        <tr>
          <td width="4%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ลำดับ</strong></td>
          <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>Code</strong></td>
          <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><strong>รายการ</strong></td>
          <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>สถานที่จัดเก็บ</strong></td>
          <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>หน่วยนับ</strong></td>
          <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>คงเหลือ Stock</strong></td>
          <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ราคา/หน่วย</strong></td>
          <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนเบิก</strong></td>
          <!--<td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนคงเหลือ</strong></td>-->
        </tr>
      </thead>
      <tbody>
        <?php   
		 $qu = @mysqli_query($conn,"SELECT * FROM s_service_report9sub WHERE sr_id = '".$sr_id."' ORDER BY r_id ASC");
		 $numRows = @mysqli_num_rows($qu);
		 while($row_sub = @mysqli_fetch_array($qu)){
			 $brid[] = $row_sub['r_id'];
			 $bcodes[] = $row_sub['codes'];
			 $blists[] = $row_sub['lists'];
			 $bunits[] = $row_sub['units'];
			 $bprices[] = $row_sub['prices'];
			 $bamounts[] = $row_sub['amounts'];
			 $bopens[] = $row_sub['opens'];
			 $bremains[] = $row_sub['remains'];
	     }
		 if($numRows == 0){
			$numRows = 10;
		 }
		 for($i=1;$i<=$numRows;$i++){
		?>
		<tr >
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><?php   echo $i;?></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="codes[]" id="codes<?php   echo $i;?>" value="<?php   echo $bcodes[$i-1];?>" style="width:100%" readonly><input type="hidden" name="r_id[]" value="<?php   echo $brid[$i-1]?>"></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
        <span id="listss<?php   echo $i;?>"><select name="lists[]" id="lists<?php   echo $i;?>" class="inputselect" style="width:92%" onchange="showspare(this.value,'<?php   echo "codes".$i;?>','<?php   echo "units".$i;?>','<?php   echo "prices".$i;?>','<?php   echo "amounts".$i;?>','<?php   echo $i;?>','<?php echo "locations".$i;?>')">
        <option value="">กรุณาเลือกรายการอะไหล่</option>
                <?php  
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE `typespar` != '2' ORDER BY group_name ASC");
					while($row_spare = @mysqli_fetch_array($qucgspare)){
					  ?>
					  	<option value="<?php   echo $row_spare['group_id'];?>" <?php   if($blists[$i-1] == $row_spare['group_id']){echo 'selected';}?>><?php   echo $row_spare['group_name'];?></option>
					  <?php  	
					}
				?>
            </select></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?resdata=<?php   echo $i;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
         <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="locations[]" id="locations<?php echo $i;?>" value="<?php   echo get_nameStock($conn,$blists[$i-1]);?>" style="width:100%;text-align:center;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="units[]" id="units<?php   echo $i;?>" value="<?php   echo $bunits[$i-1];?>" style="width:100%;text-align:center;" readonly></td>
		<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="amounts[]" id="amounts<?php   echo $i;?>" value="<?php   echo getStockSpar($conn,$blists[$i-1]);?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="prices[]" id="prices<?php   echo $i;?>" value="<?php   if($bprices[$i-1] != 0){echo $bprices[$i-1];}?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="opens[]" id="opens<?php   echo $i;?>" value="<?php   if($bopens[$i-1] != 0){echo $bopens[$i-1];}?>" style="width:100%;text-align:right;" onkeypress="return isNumberKey(event)"></td>
        <!--<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="remains[]" id="remains" value="<?php   if($bremains[$i-1] != 0){echo $bremains[$i-1];}?>" style="width:100%;text-align:right;"><input type="hidden" name="r_id[]" value="<?php   echo $brid[$i-1]?>"></td>-->
        </tr>
				<?php  	
				$sumlistTotal += $bopens[$i-1] * $bprices[$i-1];
			}
		?>
      </tbody>
        <tr >
			<td rowspan="3" colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:left;vertical-align:top;">
				<strong>รายละเอียดเพิ่มเติม</strong>
				<textarea name="detail_comment" class="inpfoder" id="detail_comment" style="width:100%;height:100px;background:#FFFFFF;font-size:14px;font-family:Verdana, Geneva, sans-serif;"><?php   echo strip_tags($detail_comment);?></textarea>
			</td>
			<td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>รวมจำนวนที่เบิก</strong></td>
			<td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo count($blists);?> รายการ</strong></td>
			</tr>
        <tr >
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></td>
          <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($sumlistTotal,2);?> บาท</strong></td>
          </tr>
        <tr >
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>ใช้จ่ายรวม (ค่าอะไหล่และอื่นๆ (จากช่างค่าน้ำมัน, ค่าทางด่วน, ที่พัก))</strong></td>
          <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($sum_x+$sum_y+$sum_z,2);?> บาท</strong></td>
        </tr>
		<tr>
			<td rowspan="3" colspan="3" style="border:1px solid #000000;font-size:14px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:left;vertical-align:top;">
				<strong>แยกส่วน คชจ.ติดตั้ง-โปรเจ็ค:</strong><br/>
				1. ค่าอุปกรณ์ติดตั้ง-ระบบไฟฟ้า
				<input type="text" name="w1" value="<?php   echo $w1;?>" id="w1" class="inpfoder" style="font-size:14px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				5. ค่าขนส่งจ้างนอก: 
				<input type="text" name="w5" value="<?php   echo $w5;?>" id="w5" class="inpfoder" style="font-size:14px;">
				<br/>
				2. ค่าอุปกรณ์ติดตั้ง-ระบบประปา: 
				<input type="text" name="w2" value="<?php   echo $w2;?>" id="w2" class="inpfoder" style="font-size:14px;">
				&nbsp;&nbsp;
				6. ค่าที่พัก: 
				<input type="text" name="w6" value="<?php   echo $w6;?>" id="w6" class="inpfoder" style="font-size:14px;">
				<br/>
				3. ค่าอุปกรณ์สิ้นเปลือง: 
				<input type="text" name="w3" value="<?php   echo $w3;?>" id="w3" class="inpfoder" style="font-size:14px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				7. ค่าโอที/เบี้ยเลี้ยง: 
				<input type="text" name="w7" value="<?php   echo $w7;?>" id="w7" class="inpfoder" style="font-size:14px;">
				<br/>
				4. ค่าน้ำมัน+ทางด่วน: 
				<input type="text" name="w4" value="<?php   echo $w4;?>" id="w4" class="inpfoder" style="font-size:14px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				8. คชจ.อื่นๆ: 
				<input type="text" name="w8" value="<?php   echo $w8;?>" id="w8" class="inpfoder" style="font-size:14px;">
				<br/>
				<strong>รวมยอด คชจ. 
					<?php   $sum_w = $w1+$w2+$w3+$w4+$w5+$w6+$w7+$w8;
					echo number_format($sum_w,2);?> บาท</strong>
			</td>
			<td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>รวมค่าอะไหล่ + ค่าน้ำมัน + ค่าที่พัก + ค่าทางด่วน + อื่นๆ</strong></td>
			<td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($sum_w,2);?> บาท</strong></td>
		</tr>
		<tr>
			<td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>ใบเสนอราคาที่ได้รับ อนุมัติ</strong></td>
			<td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($price_quo,2);?> บาท</strong></td>
		</tr>
		<tr>
			<td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong>ส่วนต่าง คชจ.กับ ราคาค่าติดตั้ง</strong></td>
			<td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format((($price_quo-$sum_w)*100)/$price_quo,2);?> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($price_quo-$sum_w,2);?> บาท</strong></td>
		</tr>
      </table>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
	  <tr>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >
                  <select name="loc_contact2" id="loc_contact2" style="width:50%;">
                      <?php   
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
                      <option value="<?php   echo $row_custec['group_id'];?>" <?php   if($row_custec['group_id'] == $loc_contact2){echo 'selected';}?>><?php   echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                      <?php  
						}
					?>
                  </select>
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างเบิก</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>
                  <input type="text" name="loc_date2" readonly value="<?php  if($loc_date2==""){echo date("d/m/Y");}else{ echo $loc_date2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date2'});</script></td>
              </tr>
            </table>

        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
				<select name="cs_sell" id="cs_sell" class="inputselect" style="width:50%;">
                    <?php   
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician WHERE 1 AND user_service='1' ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							?>
                    <option value="<?php   echo $row_custec['group_id'];?>" <?php   if($row_custec['group_id'] == $cs_sell){echo 'selected';}?>><?php   echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                    <?php  
						}
					?>
                  </select>
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จ่ายอ่ะไหล่</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="sell_date" readonly value="<?php  if($sell_date==""){echo date("d/m/Y");}else{ echo $sell_date;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sell_date'});</script></td>
              </tr>
            </table>
        </td>
        <td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
			  <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top: 15px;"><strong >
				  <?php 
				  if($loc_contact3 != 0){
					?>
					<?php echo get_technician_name($conn,$loc_contact3);?>
					<?php
				  }else{
					  echo "<br>";
				  }
				  ?>
				  <input type="hidden" name="loc_contact3" value="<?php echo $loc_contact3;?>">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ หัวหน้าฝ่ายติดตั้ง - โปรเจ็ค</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="loc_date3" readonly value="<?php  if($loc_date3==""){echo date("d/m/Y");}else{ echo $loc_date3;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date3'});</script></td>


              </tr>
            </table>
        </td>
		<td width="25%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
			  <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top: 15px;"><strong >
				  <?php 
				  if($loc_contact4 != 0){
					?>
					<?php echo get_technician_name($conn,$loc_contact4);?>
					<?php
				  }else{
					  echo "<br>";
				  }
				  ?>
				  <input type="hidden" name="loc_contact4" value="<?php echo $loc_contact4;?>">
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ GM แผนกช่าง</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="loc_date4" readonly value="<?php  if($loc_date4==""){echo date("d/m/Y");}else{ echo $loc_date4;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date4'});</script></td>


              </tr>
            </table>
        </td>
      </tr>
</table></td>
          </tr>
        </table>
        </fieldset>
    </div><br>
    <div class="formArea">
	  <input type="button" value="Submit" id="submitF" class="button" onclick="submitForm()">
      <input type="reset" name="Reset" id="resetF" value="Reset" class="button">
      <?php  
			$a_not_exists = array();
			post_param($a_param,$a_not_exists); 
			?>

     <input name="mode" type="hidden" id="mode" value="<?php   echo $_GET["mode"];?>">  
      <input name="detail_recom2" type="hidden" id="detail_recom2" value="<?php   echo strip_tags($detail_recom2);?>">
	  <input name="st_setting" type="hidden" id="    border: 1px solid;" value="<?php   echo $st_setting;?>">       
      <input name="approve" type="hidden" id="approve" value="<?php   echo $approve;?>">  
      <input name="supply" type="hidden" id="supply" value="<?php   echo $supply;?>">        
    
      <input name="<?php   echo $PK_field;?>" type="hidden" id="<?php   echo $PK_field;?>" value="<?php   echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>

<script type="text/javascript">
var rowCount = <?php echo isset($numRows) ? $numRows : 10; ?>;

function addRow() {
    var table = document.getElementById('dataTable');
    var tbody = table.getElementsByTagName('tbody')[0];
    if (!tbody) {
        tbody = document.createElement('tbody');
        table.appendChild(tbody);
    }
    
    rowCount++;
    var newRow = tbody.insertRow(-1);
    newRow.innerHTML = getRowHTML(rowCount);
    
    // Update row numbers
    updateRowNumbers();
}

function removeRow() {
    var table = document.getElementById('dataTable');
    var tbody = table.getElementsByTagName('tbody')[0];
    if (tbody && tbody.rows.length > 1) {
        tbody.deleteRow(tbody.rows.length - 1);
        rowCount--;
        updateRowNumbers();
    } else {
        alert('ไม่สามารถลบรายการได้ ต้องมีอย่างน้อย 1 รายการ');
    }
}

function getRowHTML(rowNum) {
    var html = '<tr>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">' +
            rowNum +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="codes[]" id="codes' + rowNum + '" value="" style="width:100%" readonly>' +
            '<input type="hidden" name="r_id[]" value="">' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<span id="listss' + rowNum + '">' +
                '<select name="lists[]" id="lists' + rowNum + '" class="inputselect" style="width:92%" onchange="showspare(this.value,\'codes' + rowNum + '\',\'units' + rowNum + '\',\'prices' + rowNum + '\',\'amounts' + rowNum + '\',\'' + rowNum + '\',\'locations' + rowNum + '\')">' +
                    '<option value="">กรุณาเลือกรายการอะไหล่</option>' +
                    getSparePartOptions() +
                '</select>' +
            '</span>' +
            '<a href="javascript:void(0);" onClick="windowOpener(\'400\', \'500\', \'\', \'search2.php?resdata=' + rowNum + '\');">' +
                '<img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;">' +
            '</a>' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="locations[]" id="locations' + rowNum + '" value="" style="width:100%;text-align:center;" readonly>' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="units[]" id="units' + rowNum + '" value="" style="width:100%;text-align:center;" readonly>' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="amounts[]" id="amounts' + rowNum + '" value="" style="width:100%;text-align:right;" readonly>' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="prices[]" id="prices' + rowNum + '" value="" style="width:100%;text-align:right;" readonly>' +
        '</td>' +
        '<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">' +
            '<input type="text" name="opens[]" id="opens' + rowNum + '" value="" style="width:100%;text-align:right;" onkeypress="return isNumberKey(event)">' +
        '</td>' +
    '</tr>';
    return html;
}

function getSparePartOptions() {
    return '<?php  
    $qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart WHERE `typespar` != \'2\' ORDER BY group_name ASC");
    while($row_spare = @mysqli_fetch_array($qucgspare)){
    ?><option value="<?php echo $row_spare['group_id'];?>"><?php echo $row_spare['group_name'];?></option><?php } ?>';
}

function updateRowNumbers() {
    var table = document.getElementById('dataTable');
    var tbody = table.getElementsByTagName('tbody')[0];
    if (tbody) {
        for (var i = 0; i < tbody.rows.length; i++) {
            var firstCell = tbody.rows[i].cells[0];
            firstCell.innerHTML = i + 1;
        }
    }
}

// Initialize row count on page load
document.addEventListener('DOMContentLoaded', function() {
    var table = document.getElementById('dataTable');
    var tbody = table.getElementsByTagName('tbody')[0];
    if (tbody) {
        rowCount = tbody.rows.length;
    }
});
</script>

</BODY>
</HTML>
