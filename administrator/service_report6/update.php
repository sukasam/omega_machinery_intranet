<?php   
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	$vowels = array(",");

	if ($_POST["mode"] <> "") { 
		$param = "";
		$a_not_exists = array();
		$param = get_param($a_param,$a_not_exists);
		
		$a_sdate=explode("/",$_POST['sr_stime']);
		$_POST['sr_stime']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_open']);
		$_POST['job_open']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['job_out']);
		$_POST['job_out']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_close']);
		$_POST['job_close']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['job_balance']);
		$_POST['job_balance']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date2']);
		$_POST['loc_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['loc_date3']);
		$_POST['loc_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['sell_date']);
		$_POST['sell_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		$a_sdate=explode("/",$_POST['ref_date']);
		$_POST['ref_date']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST["money1"] = str_replace($vowels,"",$_POST["money1"]);
		$_POST["money2"] = str_replace($vowels,"",$_POST["money2"]);
		$_POST["money3"] = str_replace($vowels,"",$_POST["money3"]);
		$_POST["money4"] = str_replace($vowels,"",$_POST["money4"]);
		$_POST["money5"] = str_replace($vowels,"",$_POST["money5"]);
		$_POST["money6"] = str_replace($vowels,"",$_POST["money6"]);
		
		
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
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];

			$_POST['sr_stime'] = date ("Y-m-d", strtotime("+7 day", strtotime($_POST['sr_stime'])));  
			
			
			$_POST['job_last'] = get_lastservice_s($conn,$_POST['cus_id'],"");
			

			include "../include/m_add.php";
			
			$id = mysqli_insert_id($conn);
			
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report6sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '".$prices[$a]."', '".$amounts[$a]."', '".$opens[$a]."', '".($amounts[$a]-$opens[$a])."');");
					@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
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
			
			$_POST['job_last'] = get_lastservice_f($conn,$_POST['cus_id'],$_POST['sv_id']);
			
			$codes = $_POST['codes'];
			$lists = $_POST['lists'];
			$units = $_POST['units'];
			$prices = $_POST['prices'];
			$amounts = $_POST['amounts'];
			$opens = $_POST['opens'];
			$remains = $_POST['remains'];
			$rid = $_POST['r_id'];
			
			
			$sql2 = "select * from s_service_report6sub where sr_id = '".$_REQUEST[$PK_field]."'";
			$quPro = @mysqli_query($conn,$sql2);
			while($rowPro = mysqli_fetch_array($quPro)){
				@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock`+'".$rowPro['opens']."' WHERE `group_id` = '".$rowPro['lists']."';");
			}
			
			@mysqli_query($conn,"DELETE FROM `s_service_report6sub` WHERE `sr_id` = '".$_REQUEST[$PK_field]."'");
			 
			include ("../include/m_update.php");
			
			$id = $_REQUEST[$PK_field];		
			
			
			foreach($codes as $a => $b){
				
				if($lists[$a] != ""){
					if($opens[$a] == ""){
						$opens[$a] = 0;
					}
					@mysqli_query($conn,"INSERT INTO `s_service_report6sub` (`r_id`, `sr_id`, `codes`, `lists`, `units`, `prices`, `amounts`, `opens`, `remains`) VALUES (NULL, '".$id."', '".$codes[$a]."', '".$lists[$a]."', '".$units[$a]."', '".$prices[$a]."', '".$amounts[$a]."', '".$opens[$a]."', '".($amounts[$a]-$opens[$a])."');");
					@mysqli_query($conn,"UPDATE `s_group_sparpart` SET `group_stock` = `group_stock` - '".$opens[$a]."' WHERE `group_id` = '".$lists[$a]."';");
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
		
		if(empty($job_out)){
			$job_out=date('d')."/".date('m')."/".date('Y');
		}else{
			$a_sdate=explode("-",$job_out);
			$job_out=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		}
		
		
		$a_sdate=explode("-",$job_close);
		$job_close=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$job_balance);
		$job_balance=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date2);
		$loc_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$loc_date3);
		$loc_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$sell_date);
		$sell_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$ref_date);
		$ref_date=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$finfo = get_firstorder($conn,$cus_id);
		
		$ckf_list = explode(',',$ckf_list);
		
		$totalMoneyTec = $money1+$money2+$money3+$money4+$money5+$money6;

		if(!empty($cus_id)){
			$cus_name = $finfo['cd_name'];
			$cus_location = $finfo['loc_name'];
		}
		
		
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php    echo $s_title;?></TITLE>
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
<script type="text/javascript" src="scriptform.js"></script> 
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

	function submitForm() {
	document.getElementById("submitF").disabled = true;
	document.getElementById("resetF").disabled = true;
	document.form1.submit()
}
	
</script>
<SCRIPT language=Javascript>
      function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</SCRIPT>
</HEAD>
<?php    include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php    include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php    include('../top.php');?>
<P id=page-intro><?php    if ($mode == "add") { ?>Enter new information<?php    } else { ?>แก้ไข	[<?php    echo $page_name; ?>]<?php    } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php    echo $check_module; ?></H3>
<DIV class=clear>
  
</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php    echo $page_name; ?> </legend>
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
            	<img src="../images/form/header_service_report6.png" width="100%" border="0" style="max-width:1182px;"/>
            </div>
		</td>
	  </tr>
	</table>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="width:40%;"><strong>ชื่อลูกค้า :</strong> 
            	<!--<select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php    
						$qu_cusf = @mysqli_query($conn,"SELECT * FROM s_first_order ORDER BY cd_name ASC");
						while($row_cusf = @mysqli_fetch_array($qu_cusf)){
							?>
							<option value="<?php    echo $row_cusf['fo_id'];?>" <?php    if($row_cusf['fo_id'] == $cus_id){echo 'selected';}?>><?php    echo $row_cusf['cd_name']." (".$row_cusf['loc_name'].")";?></option>
							<?php   
						}
					?>
                </select>-->
                <input name="cus_name" type="text" id="cus_name"  value="<?php echo $cus_name;?>" style="width:80%;"><br><br>
				<strong>ถอดมาจาก : <input name="takeout" type="text" id="takeout"  value="<?php echo $takeout;?>" style="width:80%;"></strong> 
                <!-- <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php   echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a> -->
            </td>
            <td>

				<strong>ประเภทบริการ :</strong> <input type="radio" name="type_service" value="1" <?php if($type_service == '1' || $type_service == '0'){echo 'checked';}?>> เครื่องล้างจาน
				&nbsp;&nbsp;<input type="radio" name="type_service" value="2" <?php if($type_service == '2'){echo 'checked';}?>> เครื่องล้างแก้ว
				&nbsp;&nbsp;<input type="radio" name="type_service" value="3" <?php if($type_service == '3'){echo 'checked';}?>> เครื่องผลิตน้ำแข็ง
				<br><br><strong>สถานะเครื่อง :</strong> 
            	<select name="status_type" id="status_type">
                	<!-- <option value="">กรุณาเลือก</option> -->
					<option value="1" <?php   if($status_type === '1'){echo 'selected';}?>><?php   echo 'พร้อมใช้';?></option>
					<option value="5" <?php   if($status_type === '5'){echo 'selected';}?>><?php   echo 'พร้อมใช้ / จองแล้ว';?></option>
					<option value="2" <?php   if($status_type === '2'){echo 'selected';}?>><?php   echo 'รอล้าง/ทำความสะอาด';?></option>
					<option value="3" <?php   if($status_type === '3'){echo 'selected';}?>><?php   echo 'ซ่อมหนัก (รอตัดซาก)';?></option>
					<option value="4" <?php   if($status_type === '4'){echo 'selected';}?>><?php   echo 'นำไปติดตั้งแล้ว';?></option>
                </select>
				&nbsp;&nbsp;<strong>สต็อกเครื่อง :</strong> 
            	<select name="sr_stock" id="sr_stock">
                	<option value="">กรุณาเลือก</option>
                	<option value="1" <?php   if($sr_stock === '1'){echo 'selected';}?>><?php   echo 'ออฟฟิต สุขาภิบาล5';?></option>
					<option value="2" <?php   if($sr_stock === '2'){echo 'selected';}?>><?php   echo 'โรงงานลาดหลุมแก้ว';?></option>
                </select>
				<!--<strong>ประเภทลูกค้า :</strong>
            	<select name="sr_ctype2" id="sr_ctype2">
            	  <option value="">กรุณาเลือก</option>
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
          	  </select> -->
            	</td>
          </tr>
          <tr>
            <td><strong>ที่อยู่ :</strong> <input name="cus_address" type="text" id="cus_address"  value="<?php echo $cus_address;?>" style="width:80%;"></td>
            <td><strong>เลขที่บริการ</strong> :
<input type="text" name="sv_id" value="<?php   if($sv_id == ""){echo check_servicerepair($conn);}else{echo $sv_id;};?>" id="sv_id" class="inpfoder" style="border:0;">
&nbsp;&nbsp;<strong>เลขที่ FO ที่ยกเลิก</strong> : 
<input type="text" name="srid" value="<?php   echo $srid;?>" id="srid" class="inpfoder">
</td>
          </tr>
          <tr>
            <td><strong>จังหวัด :</strong> 
			<select name="cus_province" id="cus_province" class="inputselect">

				<?php 
					$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
				while($row_province = @mysqli_fetch_array($quprovince)){
					?>
					<option value="<?php  echo $row_province['province_id'];?>" <?php  if($cus_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
					<?php 	
				}
						?>

				</select>
		    </td>
            <td><strong>วันที่เบิกอะไหล่  :</strong> <span id="datef"></span>
              <input type="text" name="job_open" readonly value="<?php  if($job_open==""){echo date("d/m/Y");}else{ echo $job_open;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_open'});</script>
			  &nbsp;&nbsp;<strong>วันที่ถอดเครื่อง  :</strong> <span id="dateout"></span>
              <input type="text" name="job_out" readonly value="<?php  if(empty($job_out)){echo date("d/m/Y");}else{ echo $job_out;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_out'});</script>
			</td>
          </tr>
          <tr>
            <td><strong>โทรศัพท์ :</strong> <input name="cus_tel" type="text" id="cus_tel"  value="<?php echo $cus_tel;?>" style="width:30%;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <input name="cus_fax" type="text" id="cus_fax"  value="<?php echo $cus_fax;?>" style="width:30%;"></td>
            <td><!--<strong>บริการครั้งล่าสุด : </strong> <span id="sevlast"><?php   echo get_lastservice_f($conn,$cus_id,$sv_id);?></span> &nbsp;&nbsp;&nbsp;&nbsp;--><strong>กำหนดคืนอะไหล่ :</strong> <span id="datet"></span>
              <input type="text" name="job_balance" readonly value="<?php  if($job_balance==""){echo date("d/m/Y");}else{ echo $job_balance;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'job_balance'});</script>
              <input type="hidden" name="job_close" value="<?php  if($job_close==""){echo date("d/m/Y");}else{ echo $job_close;}?>" class="inpfoder"/>&nbsp;&nbsp;<strong>วันที่ซ่อมเสร็จ  :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="sr_stime" readonly value="<?php  if($sr_stime==""){echo date("d/m/Y");}else{ echo $sr_stime;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sr_stime'});</script>
            </span></td>
          </tr>
          <tr>
            <td><strong>ชื่อผู้ติดต่อ :</strong> <input name="cus_con" type="text" id="cus_con"  value="<?php echo $cus_con;?>" style="width:30%;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong > <input name="cus_con_tel" type="text" id="cus_con_tel"  value="<?php echo $cus_con_tel;?>" style="width:30%;"></td>
            <td><strong>อ้างอิงใบยืม </strong>: <strong>
              <input type="text" name="srid2" value="<?php   echo $srid2;?>" id="srid2" class="inpfoder">
            </strong>&nbsp;&nbsp;<strong>วันที่ :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
              <input type="text" name="ref_date" readonly value="<?php  if($ref_date==""){echo date("d/m/Y");}else{ echo $ref_date;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'ref_date'});</script>
            </span></td>
          </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
      <tr>
        <td width="50%"><strong>สถานที่จะไปติดตั้ง: </strong><input name="cus_location" type="text" id="cus_location"  value="<?php echo $cus_location;?>" style="width:60%;"><br />
          <br>
		  <strong>เลขที่ FO ติดตั้งใหม่ : </strong><input type="text" name="loc_clean" value="<?php   echo $loc_clean;?>" id="loc_clean" class="inpfoder" style="width:50%;"><br /><br>
          <strong>เลือกสินค้า :</strong>
          <!-- <span id="prolist">
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
          <br />-->
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
            <input type="text" name="loc_pro" value="<?php   echo $loc_pro;?>" id="loc_pro" class="inpfoder" style="width:50%;">
            </span><br>
            <br />
            <strong>รุ่นเครื่อง : </strong><span id="lpa2"><input type="text" name="loc_seal" value="<?php   echo $loc_seal;?>" id="loc_seal" class="inpfoder" style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><input type="text" name="loc_sn" value="<?php   echo $loc_sn;?>" id="loc_sn" class="inpfoder" style="width:20%;"></span><br /><br />
            <strong>ช่างบริการประจำ :</strong>
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
                </select></td>
                
        <td width="50%">
            <strong>สรุปค่าใช้จ่าย : แผนกช่าง</strong><br><br>
        	<strong>ค่าแรง</strong> : 
<input type="text" name="money1" value="<?php   echo $money1;?>" id="money1" style="width:20%;" class="inpfoder">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>ค่าเบี้ยเลี้ยง</strong> : 
<input type="text" name="money4" value="<?php   echo $money4;?>" id="money4" style="width:20%;"  class="inpfoder">
 <br><br>
<strong>ค่าน้ำมัน</strong> : 
<input type="text" name="money2" value="<?php   echo $money2;?>" id="money2" style="width:20%;"  class="inpfoder">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>ค่าโอที</strong> : 
<input type="text" name="money5" value="<?php   echo $money5;?>" id="money5" style="width:20%;"  class="inpfoder">
<br><br>
<strong>ค่าทางด่วน</strong> : 
<input type="text" name="money3" value="<?php   echo $money3;?>" id="money3" style="width:20%;"  class="inpfoder">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>ค่าใช้จ่ายอื่นๆ</strong> : 
<input type="text" name="money6" value="<?php   echo $money6;?>" id="money6" style="width:20%;"  class="inpfoder"><br><br><br>
<center style="font-size: 20px;">
	<strong >รวมค่าใช้จ่าย</strong> : <?php echo number_format($totalMoneyTec,2);?>
</center>
        </td>
      </tr>
    </table>
    
    <center>
      <br>
      <span style="font-size:18px;font-weight:bold;">รายละเอียดการเปลี่ยนอะไหล่</span></center><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="4%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ลำดับ</strong></td>
        <td width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>Code</strong></td>
        <td width="30%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><strong>รายการ</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>หน่วยนับ</strong></td>
		<td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>คงเหลือ Stock</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ราคา/หน่วย</strong></td>
        <td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนเบิก</strong></td>
        <!--<td width="9%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>จำนวนคงเหลือ</strong></td>-->
        </tr>
        <?php   
		if($_GET['mode'] == "update"){
		 $qu = @mysqli_query($conn,"SELECT * FROM s_service_report6sub WHERE sr_id = '".$sr_id."' ORDER BY r_id ASC");
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
		}
		$sumlist = 0;
		$sumlistTotal = 0;
		 for($i=1;$i<=10;$i++){
		?>
        
		<tr >
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><?php   echo $i;?></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="codes[]" id="codes<?php   echo $i;?>" value="<?php   echo $bcodes[$i-1];?>" style="width:100%" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;">
        <span id="listss<?php echo $i;?>"><select name="lists[]" id="lists<?php   echo $i;?>" class="inputselect" style="width:92%" onchange="showspare(this.value,'<?php   echo "codes".$i;?>','<?php   echo "units".$i;?>','<?php   echo "prices".$i;?>','<?php   echo "amounts".$i;?>','<?php echo $i;?>')">
        <option value="">กรุณาเลือกรายการอะไหล่</option>
                <?php  
                	$qucgspare = @mysqli_query($conn,"SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
					while($row_spare = @mysqli_fetch_array($qucgspare)){
					  ?>
					  	<option value="<?php   echo $row_spare['group_id'];?>" <?php   if($blists[$i-1] == $row_spare['group_id']){echo 'selected';}?>><?php   echo $row_spare['group_name'];?></option>
					  <?php  	
					}
				?>
            </select></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?resdata=<?php   echo $i;?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
        </td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="hidden" name="r_id[]" value="<?php   echo $brid[$i-1]?>"><input type="text" name="units[]" id="units<?php   echo $i;?>" value="<?php   echo $bunits[$i-1];?>" style="width:100%;text-align:center;" readonly></td>
		<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="amounts[]" id="amounts<?php   echo $i;?>" value="<?php   
		echo getStockSpar($conn,$blists[$i-1]);
		?>" style="width:100%;text-align:right;" readonly></td>
		<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="prices[]" id="prices<?php   echo $i;?>" value="<?php   if($bprices[$i-1] != 0){echo $bprices[$i-1];}?>" style="width:100%;text-align:right;" readonly></td>
        <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="opens[]" id="opens<?php   echo $i;?>" value="<?php   if($bopens[$i-1] != 0){echo $bopens[$i-1];}?>" style="width:100%;text-align:right;" onkeypress="return isNumberKey(event)"></td>
        <!--<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;"><input type="text" name="remains[]" id="remains<?php   echo $i;?>" value="<?php   if($bremains[$i-1] != 0){echo $bremains[$i-1];}?>" style="width:100%;text-align:right;"></td>
        </tr>-->
				<?php  	
			 
			 if($blists[$i-1] != ""){
				 $sumlist = $sumlist+1;
				 $sumlistTotal += $bopens[$i-1] * $bprices[$i-1];
			 }
			 
			}
		?>
        <tr >
          <td colspan="3" rowspan="4" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;">
          	<center><strong>รายละเอียดการเปลี่ยนอะไหล่</strong></center><br><br>
        <textarea name="detail_recom" class="inpfoder" id="detail_recom" style="width:50%;height:100px;background:#FFFFFF;"><?php   echo strip_tags($detail_recom);?></textarea>          	
          </td>
		  <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รวมรายการอะไหล่</strong></td>
		  <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo $sumlist;?> รายการ</strong></td>
		</tr>
        <tr>
          <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รวมยอดค่าอะไหล่</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($sumlistTotal,2);?> บาท</strong></td>
          </tr>
          <tr>
          <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>รวมยอด คชจ.ช่าง</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($totalMoneyTec,2);?> บาท</strong></td>
          </tr>
          <tr>
          <td colspan="2" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:center;"><strong>ค่าใช้จ่ายรวมทั้งสิ้น</strong></td>
          <td colspan="3" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;text-align:right;"><strong><?php echo number_format($sumlistTotal+$totalMoneyTec,2);?> บาท</strong></td>
          </tr>
    </table>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
	  <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
				  <!-- <select name="loc_contact3" id="loc_contact3" style="width:50%;">
                    <?php   
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician WHERE 1 AND (group_id = 28 OR group_id = 9) ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							// if($loc_contact3 != ""){$loc_contact3 = $loc_contact3;}
							// else{$loc_contact3 = 9;}
							?>
                    <option value="<?php   echo $row_custec['group_id'];?>" <?php   if($row_custec['group_id'] == $loc_contact3){echo 'selected';}?>><?php   echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                    <?php  
						}
					?>
                  </select> -->
                </strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ :</strong>
                  <input type="text" name="loc_date3" readonly value="<?php  if($loc_date3==""){echo date("d/m/Y");}else{ echo $loc_date3;}?>" class="inpfoder"/>
              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'loc_date3'});</script></td>


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
</BODY>
</HTML>
