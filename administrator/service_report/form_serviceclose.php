<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);
	
	$spaimfo1 = get_sparpart($conn,$_POST['cpro1']);
	$spaimfo2 = get_sparpart($conn,$_POST['cpro2']);
	$spaimfo3 = get_sparpart($conn,$_POST['cpro3']);
	$spaimfo4 = get_sparpart($conn,$_POST['cpro4']);
	$spaimfo5 = get_sparpart($conn,$_POST['cpro5']);
	
	
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	foreach($chk as $vals){
		$sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;'.get_fixname($conn,$vals).'</td>
		  </tr>
		';	
	}
	
	$chl = $_POST['ckl_list'];
	$chllist = explode(",",$chl);
	
	if(in_array(1,$chllist)){$chl_ch1 = 'aroow_ch.png';}else{$chl_ch1 = 'aroow_nch.png';}
	if(in_array(2,$chllist)){$chl_ch2 = 'aroow_ch.png';}else{$chl_ch2 = 'aroow_nch.png';}
	if(in_array(3,$chllist)){$chl_ch3 = 'aroow_ch.png';}else{$chl_ch3 = 'aroow_nch.png';}
	if(in_array(4,$chllist)){$chl_ch4 = 'aroow_ch.png';}else{$chl_ch4 = 'aroow_nch.png';}
	if(in_array(5,$chllist)){$chl_ch5 = 'aroow_ch.png';}else{$chl_ch5 = 'aroow_nch.png';}

	$chw = $_POST['ckw_list'];
	$chwlist = explode(",",$chw);
	
	if(in_array(1,$chwlist)){$chw_ch1 = 'aroow_ch.png';}else{$chw_ch1 = 'aroow_nch.png';}
	if(in_array(2,$chwlist)){$chw_ch2 = 'aroow_ch.png';}else{$chw_ch2 = 'aroow_nch.png';}
	if(in_array(3,$chwlist)){$chw_ch3 = 'aroow_ch.png';}else{$chw_ch3 = 'aroow_nch.png';}
	if(in_array(4,$chwlist)){$chw_ch4 = 'aroow_ch.png';}else{$chw_ch4 = 'aroow_nch.png';}
	if(in_array(5,$chwlist)){$chw_ch5 = 'aroow_ch.png';}else{$chw_ch5 = 'aroow_nch.png';}
	
	
	if($_POST['cprice1'] != ""){$proprice1 = number_format($_POST['cprice1']);}
	if($_POST['cprice2'] != ""){$proprice2 = number_format($_POST['cprice2']);}
	if($_POST['cprice3'] != ""){$proprice3 = number_format($_POST['cprice3']);}
	if($_POST['cprice4'] != ""){$proprice4 = number_format($_POST['cprice4']);}
	if($_POST['cprice5'] != ""){$proprice5 = number_format($_POST['cprice5']);}
	
	
	
	if(($_POST['camount1'] * $_POST['cprice1']) != 0){$suprice1 = number_format($_POST['camount1'] * $_POST['cprice1']);}else{$suprice1 = " ";}
	if(($_POST['camount2'] * $_POST['cprice2']) != 0){$suprice2 = number_format($_POST['camount2'] * $_POST['cprice2']);}else{$suprice2 = " ";}
	if(($_POST['camount3'] * $_POST['cprice3']) != 0){$suprice3 = number_format($_POST['camount3'] * $_POST['cprice3']);}else{$suprice3 = " ";}
	if(($_POST['camount4'] * $_POST['cprice4']) != 0){$suprice4 = number_format($_POST['camount4'] * $_POST['cprice4']);}else{$suprice4 = " ";}
	if(($_POST['camount5'] * $_POST['cprice5']) != 0){$suprice5 = number_format($_POST['camount5'] * $_POST['cprice5']);}else{$suprice5 = " ";}

	if($_POST['pack_size'] == '1'){
		$pack_size = '20 ลิตร / ถัง';
	}else if($_POST['pack_size'] == '2'){
		$pack_size = '10 ลิตร / แกลลอน';
	}else if($_POST['pack_size'] == '3'){
		$pack_size = '3.8 ลิตร / แกลลอน';
	}else{
		$pack_size = '-';
	}

	
	$totalprice = ($_POST['camount1'] * $_POST['cprice1']) + ($_POST['camount2'] * $_POST['cprice2']) + ($_POST['camount3'] * $_POST['cprice3']) + ($_POST['camount4'] * $_POST['cprice4']) + ($_POST['camount5'] * $_POST['cprice5']);
	
	//$serviceID = substr($_POST['sv_id'],3);
	$serviceID = $_POST['sv_id'];
	$row_service2 = @mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM s_service_report2 WHERE srid = '".trim($serviceID)."'"));
		
	$qu_sr2 = @mysqli_query($conn,"SELECT * FROM s_service_report2sub WHERE sr_id = '".$row_service2['sr_id']."' AND codes != ''");
	$brf = 1;
	
	$techniSignature = '<img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['loc_contact']).'" height="50" border="0" />';
	$hTechniSignature = '<img src="../../upload/user/signature/'.get_technician_signature($conn,9).'" height="50" border="0" />';

	$chkHCustomerAP = checkHCustomerApplove($conn,$id);
		
	$hCustomerSignature = '';

	if($chkHCustomerAP !== '' && $chkHCustomerAP != NULL){
		$hCustomerSignature = '<img src="../../upload/customer/signature/'.$chkHCustomerAP.'" height="50" border="0" />';
	}else{
		$hCustomerSignature = '<img src="../../upload/customer/signature/none.png" height="50" border="0" />';
	}

	 $srImg = getServiceImg($conn,$_POST['sr_id']);
	 $sImg = explode(',',$srImg);
	 $svImgArray = array();
	 $svImgesArray = array();
	 for($v=0;$v<count($sImg);$v++){
		 $svImgArray[] = substr($sImg[$v],0,1);
		 $svImgesArray[] = $sImg[$v];
	 }
	 
	 $chkConfirms = '';
	 if($_POST['chkConfirm'] === "1"){
		$chkConfirms = '<strong>(รอคอนเฟิร์ม)</strong>';
	 }else if($_POST['chkConfirm'] === "2"){
		$chkConfirms = '<strong>(คอนเฟิร์มติดตั้งแล้ว)</strong>';
	 }else{
		$chkConfirms ='';
	 }

	$form = '<style>
	.bgheader{
		font-size:10px;
		position:absolute;
		margin-top:100px;
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
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;	
	}
	.tb2,.tb3{
		border:1px solid #000000;	
		margin-top:5px;
	}
	.tb2 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	
	.tb3 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.ccontact{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
	}
	.ccontact tr td{
		
	}
	
	.cdetail{
		border: 1px solid #000000;
		padding:5px;
		font-size:10px;
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
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		margin-top:5px;
	}
	p.tby1{
		font-size:12px;
		font-weight:bold;
		padding-top:2px;
		padding-bottom:2px;	
	}
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_service_report.png" width="100%" border="0" />
			<div class="bgheader"><strong>'.$_POST['sv_id'].'</strong></div>
		</td>
	  </tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="57%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$finfos['cd_name'].' <br />              <strong><br />
            ที่อยู่ :</strong> '.$finfos['cd_address'].'&nbsp;'.province_name($conn,$finfos['cd_province']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$finfos['cd_tel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$finfos['cd_fax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$finfos['c_contact'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$finfos['c_tel'].'</td>
            <td width="43%"><strong>ประเภทบริการลูกค้า :</strong> '.get_servicename($conn,$_POST['sr_ctype']).'&nbsp;&nbsp;&nbsp;'.custype_name($conn,$_POST['sr_ctype2']).'<br />
              <br />
            เลขที่สัญญา  :</strong> '.$finfos['fs_id'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่  :</strong> '.format_date($_POST['job_open']).' <strong>&nbsp;&nbsp;<br /><br />';
			
			if($finfos['garun_id']){
				 $garunT = $finfos['garun_id'];
				 $form .='<strong>การรับประกัน:</strong> '.$garunT.' <strong>เดือน &nbsp;&nbsp;เริ่ม:</strong> '.format_date($finfos['date_quf']).'&nbsp;&nbsp;<strong> สิ้นสุด: </strong>'.format_date($finfos['date_qut']).'<br /><br />';
			}else{
				$garunT = '0';
			}
			
           $form .=' วันที่เข้าบริการ :</strong> '.format_date($_POST['job_close']).'&nbsp;&nbsp;'. $chkConfirms.'<br /><br /><strong>บริการครั้งก่อน : </strong>'.$_POST['job_last'].'&nbsp;&nbsp;<strong>บริการครั้งต่อไป  :</strong> '.format_date($_POST['sr_stime']).'</td>
          </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
	  <tr>
	    <td width="57%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$finfos['loc_name'].'<br />
	      <br />
	      <strong>เครื่องล้างจาน / ยี่ห้อ : </strong> '.$_POST['loc_pro'].'<br />
	      <br />
	      <strong>รุ่นเครื่อง : </strong> '.$_POST['loc_seal'].' <strong> S/N : </strong> '.$_POST['loc_sn'].'<br />
	      <br />
	      <strong>เครื่องป้อนน้ำยา : </strong> '.$_POST['loc_clean'].'<br />
	      <br />
	      <strong>ช่างบริการประจำ : </strong> '.$tecinfos['group_name'].'&nbsp;&nbsp;&nbsp;<strong> เบอร์โทร : </strong> '.$tecinfos['group_tel'].'</td>
	    <td width="43%"><strong>ปริมาณน้ำยา</strong><br />
	      <br />
	      <strong>ปริมาณน้ำยาล้าง : </strong> '.$_POST['cl_01'].' <strong> ml / rack</strong><br />
	      <br />
	      <strong>ปริมาณน้ำยาช่วยแห้ง : </strong> '.$_POST['cl_02'].' <strong>ml / rack</strong><br />
	      <br />
	      <strong>ความเข้มข้น : </strong> '.$_POST['cl_03'].' <strong>%</strong><br />
	      <br />
	      <strong>จำนวนน้ำยาที่ส่ง : </strong> '.$pack_size.' 
		  <br />
		  <br><strong> C =</strong> '.$_POST['cl_04'].' <strong> R = </strong> '.$_POST['cl_05'].' <strong> A =</strong> '.$_POST['cl_06'].' <strong> WG = </span></strong> '.$_POST['cl_07'].' <strong> RG = </strong> '.$_POST['cl_08'].' <strong></strong></td>
      </tr>
    </table>
	
	<table width="100%" border="0">
	  <tr>
		<td width="52%" style="font-size:11px;"><strong>รายการตรวจเช็ค</strong></td>
		<td width="23%" style="font-size:11px;"><strong>การบริการและการแจ้งซ่อม</strong></td>
		<td width="25%" style="font-size:11px;"><strong></strong></td>
	  </tr>
	</table>

	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
  <tr>
    <td width="52%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="51%"><strong>ระบบไฟฟ้า</strong></td>
        <td width="49%"><strong>ระบบประปา</strong></td>
      </tr>
      <tr>
        <td ><img src="../images/'.$chl_ch1.'" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คชุดควบคุม</td>
        <td ><img src="../images/'.$chw_ch1.'" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คน้ำรั่ว/ซึมภายนอก</td>
      </tr>
      <tr>
        <td ><img src="../images/'.$chl_ch2.'" width="10"  border="0" alt="" />&nbsp;ตรวจเช็ค/ขัน Terminal</td>
        <td ><img src="../images/'.$chw_ch2.'" width="10"  border="0" alt="" />&nbsp;ถอดล้างตะแกรงกรองเศษอาหาร</td>
      </tr>
      <tr>
        <td ><img src="../images/'.$chl_ch3.'" width="10"  border="0" alt="" />&nbsp;วัดแรงดันไฟฟ้า และกระแสไฟฟ้า</td>
        <td ><img src="../images/'.$chw_ch3.'" width="10"  border="0" alt="" />&nbsp;ถอดล้างสแตนเนอร์ Solinoid Value</td>
      </tr>
      <tr>
        <td ><img src="../images/'.$chl_ch4.'" width="10"  border="0" alt="" />&nbsp;ตรวจเช็ค Heater</td>
        <td ><img src="../images/'.$chw_ch4.'" width="10"  border="0" alt="" />&nbsp;ถอดล้างแขนฉีด/หัวฉีดน้ำ</td>
      </tr>
      <tr>
        <td ><img src="../images/'.$chl_ch5.'" width="10"  border="0" alt="" />&nbsp;ตรวจเช็คมอเตอร์</td>
        <td ><img src="../images/'.$chw_ch5.'" width="10"  border="0" alt="" />&nbsp;ทำความสะอาดภายใน/ภายนอก</td>
      </tr>
    </table></td>
    <td width="23%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      '.$sfix.'
    </table></td>
     <td width="25%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td style="text-align:center;"><strong>ผู้แจ้งซ่อม / เบอร์โทรศัพท์</strong></td>
       </tr>
	   <tr>
		 <td style="text-align:left;">'.$_POST['fix_name'].'</td>
	   </tr>
	   <tr>
		 <td style="text-align:left;"><strong>ตำแหน่ง:</strong> '.$_POST['fix_position'].'</td>
	   </tr>
	   <tr>
		 <td style="text-align:left;"><strong>เบอร์โทรศัพท์:</strong> '.$_POST['fix_tel'].'</td>
	   </tr>
       <tr>
         <td style="text-align:left;"><strong>รายละเอียดเพิ่มเติม:</strong> <br />'.$_POST['detail_recom3'].'</td>
       </tr>
     </table></td>
  </tr>
</table>
    <p class="tby1">รายละเอียดการให้บริการ / ข้อเสนอแนะ</p>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	<tr>
		<td>
		'.$_POST['detail_recom2'].'
		</td>
	</tr>
	</table>
    <p class="tby1">รายละเอียดการเปลี่ยนอะไหล่ / รายการใช้อุปกรณ์การติดตั้ง</p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสอะไหล่</strong></td>
      <td width="35%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / หน่วย</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคารวม (บาท)</strong></td>
    </tr>';
    
    while($rowSRV = @mysqli_fetch_array($qu_sr2)){
		$form.= '<tr>
      <td style="border:1px solid #000000;padding:5;">'.$brf.'</td>
      <td style="border:1px solid #000000;padding:5;">'.$rowSRV['codes'].'</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_sparpart_name($conn,$rowSRV['lists']).'</td>
      <td style="border:1px solid #000000;padding:5;">'.$rowSRV['opens'].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$rowSRV['prices'].'</td>
      <td style="border:1px solid #000000;padding:5;">'.($rowSRV['opens']*$rowSRV['prices']).'</td>
    </tr>
    <tr>';
	$totalprice += ($rowSRV['opens']*$rowSRV['prices']);
	$brf++;
	}
    
    $form.= '<tr>
      <td colspan="4" rowspan="1" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><br>
</td>
      <td style="border:1px solid #000000;padding:5;vertical-align:middle;"><strong>ค่าใช้จ่ายรวม<br />
(ทั้งหมด)</strong></td>
      <td style="border:1px solid #000000;padding:5;vertical-align:middle;">'.number_format($totalprice,2).'</td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
	<tr>
		<td style="text-align:center;">
		<br><br>
		<strong>สายด่วน...งานบริการ 086-319-3766, 081-910-1158</strong>	
		<br><br>
		</td>
		<td style="text-align:left;">
			<img src="0863193766.jpg" width="50">
		</td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >'.$techniSignature.'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$tecinfos['group_name'].'/ ช่างบริการ</strong>
				<br> <strong> Tel: '.$tecinfos['group_tel'].'</strong>
				</td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date_th(checkHCustomerDate($conn,$_POST['sr_id']),8).'
                </strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hCustomerSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับบริการ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date_th(checkHCustomerDate($conn,$_POST['sr_id']),8).'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hTechniSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date_th(checkHCustomerDate($conn,$_POST['sr_id']),8).'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table><br><br><br><br><br><br>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ccontact">
	  <tr>
	    <td valign="top" style="text-align:center;font-size:15px;"><center><h3><strong>ภาพก่อนบริการ</strong></h3></center></td>
      </tr>';
	
		if(in_array('1',$svImgArray)){
			$key = array_search('1', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}

		if(in_array('2',$svImgArray)){
			$key = array_search('2', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}

		if(in_array('3',$svImgArray)){
			$key = array_search('3', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}

	  $form .='<tr>
	    <td valign="top" style="text-align:center;font-size:15px;"><center><h3><strong>ภาพหลังบริการ</strong></h3></center><br></td>
      </tr>';
	  
	  if(in_array('4',$svImgArray)){
			$key = array_search('4', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}

		if(in_array('5',$svImgArray)){
			$key = array_search('5', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}

		if(in_array('6',$svImgArray)){
			$key = array_search('6', $svImgArray);
			$form.='<tr>
			<td valign="top" style="text-align:center;"><img src="../../upload/service_images/'.$svImgesArray[$key].'" width="400"><br><br></td>
		  </tr>';
		}
	  
    $form.='</table>';

?>



	
