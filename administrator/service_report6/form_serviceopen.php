<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php   
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);

	if($_POST['type_service'] === '2'){
		$type_service = 'เครื่องล้างแก้ว';
	}else if($_POST['type_service'] === '3'){
		$type_service = 'เครื่องผลิตน้ำแข็ง';
	}else{
		$type_service = 'เครื่องล้างจาน';
	}

	if($_POST['sr_stock'] === '1'){
		$sr_stock = 'ออฟฟิต สุขาภิบาล5';
	}else if($_POST['sr_stock'] === '2'){
		$sr_stock = 'โรงงานลาดหลุมแก้ว';
	}else{
		$sr_stock = '-';
	}

	if($_POST['status_type'] === '2'){
		$status_type = 'รอล้าง/ทำความสะอาด';
	}else if($_POST['status_type'] === '3'){
		$status_type = 'ซ่อมหนัก (รอตัดซาก)';
	}else if($_POST['status_type'] === '4'){
		$status_type = 'นำไปติดตั้งแล้ว';
	}else if($_POST['status_type'] === '5'){
		$status_type = 'พร้อมใช้ / จองแล้ว';
	}else{
		$status_type = 'พร้อมใช้';
	}
	
	foreach($chk as $vals){
		$sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;'.get_fixname($conn,$vals).'</td>
		  </tr>
		';	
	}

	$totalMoneyTec = $_POST['money1']+$_POST['money2']+$_POST['money3']+$_POST['money4']+$_POST['money5']+$_POST['money6'];

	$hTechniSignature = '<img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['loc_contact3']).'" height="50" border="0" />';

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
		border: 1px solid;
	}
	
	.tb3 tr td{
		font-size:10px;
		font-family:Verdana, Geneva, sans-serif;
		padding:5px;		
	}
	.tb3 img{
		vertical-align:bottom;
	}
	
	.tb4{
		margin-top:5px;
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
	
	</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:right;font-size:12px;">
			<img src="../images/form/header_service_report6.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="57%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$_POST['cus_name'].' <br /><br />
			<strong>ถอดมาจาก :</strong> '.$_POST['takeout'].' <br /><br />
            <strong>ที่อยู่ :</strong> '.$_POST['cus_address'].'&nbsp;'.province_name($conn,$_POST['cus_province']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$_POST['cus_tel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$_POST['cus_fax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$_POST['cus_con'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST['cus_con_tel'].'
            </td>
            <td width="43%"><strong>เลขที่ FO ที่ยกเลิก  :</strong> '.$_POST['srid'].' <strong><br>
            <br>
            ประเภทบริการ :</strong> '.$type_service.' <strong><br />
              <br />
            </strong><strong>วันที่เบิกอะไหล่  :</strong> '.format_date($_POST['job_open']).' &nbsp;&nbsp;<strong>วันที่ถอดเครื่อง :</strong> '.format_date($_POST['job_out']).'<strong><br />
            <br />
            กำหนดคืนอะไหล่ :</strong> '.format_date($_POST['job_balance']).' &nbsp;<strong>วันที่ซ่อมเสร็จ :</strong> '.format_date($_POST['sr_stime']).'<br /><br />
            <strong>อ้างอิงใบยืม :</strong> '.$_POST['srid2'].'&nbsp;&nbsp;<strong>วันที่ :</strong> '.format_date($_POST['ref_date']).'</td>
          </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="53%"><strong>สถานที่จะไปติดตั้ง : </strong>'.$_POST['cus_location'].'<br /><br />
			<strong>เลขที่ FO ติดตั้งใหม่ : </strong> '.$_POST['loc_clean'].'<br /><br />
            <strong>เครื่องล้างจาน / ยี่ห้อ : </strong> '.$_POST['loc_pro'].'<br /><br />
            <strong>รุ่นเครื่อง : </strong> '.$_POST['loc_seal'].' <strong> S/N : </strong> '.$_POST['loc_sn'].'<br /><br />
            <strong>ช่างบริการประจำ : </strong> '.$tecinfos['group_name'].'&nbsp;&nbsp;&nbsp;<strong> เบอร์โทร : </strong> '.$tecinfos['group_tel'].'<br /><br />
			<strong>สถานะเครื่อง : </strong> '.$status_type.' &nbsp;&nbsp;<strong>สต็อกเครื่อง : </strong> '.$sr_stock.' 
			</td>
        <td width="47%" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border:0px;width:50%">
					<strong>ค่าใช้จ่าย : แผนกช่าง </strong><br><br>
					<strong>ค่าแรง : </strong> '.number_format($_POST['money1'],2).'<br /><br />
					<strong>ค่าน้ำมัน : </strong> '.number_format($_POST['money2'],2).'<br /><br />
					<strong>ค่าทางด่วน : </strong> '.number_format($_POST['money3'],2).'<br /><br />
				</td>
				<td style="border:0px;width:50%">
					<br><br>
					<strong>ค่าเบี้ยเลี้ยง : </strong> '.number_format($_POST['money4'],2).'<br /><br />
					<strong>ค่าโอที : </strong> '.number_format($_POST['money5'],2).'<br /><br />
					<strong>ค่าใช้จ่ายอื่นๆ : </strong> '.number_format($_POST['money6'],2).'<br /><br />
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border:0px;font-size:12px;"><br>
				<center><strong>รวมค่าใช้จ่าย : </strong> '.number_format($totalMoneyTec,2).'</center>
				</td>
			</tr>
		</table>
		</td>
      </tr>
</table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%"><strong>ลำดับ</strong></td>
        <td width="8%"><strong>Code</strong></td>
        <td width="44%"><strong>รายการ</strong></td>
		<td width="9%"><strong>หน่วยนับ</strong></td>
		<td width="9%"><strong>คงเหลือ Stock</strong></td>
        <td width="9%"><strong>ราคา/หน่วย</strong></td>
        <td width="9%"><strong>จำนวนเบิก</strong></td>
        </tr>';
		
		$sumtotal = 0;
		$total = 0;

		foreach($codes as $a => $b){
			//if($units[$a] != 0){$bunits = $units[$a];$units[$a] = number_format($units[$a]);}
			if($prices[$a] != 0){$bprices = $prices[$a];$prices[$a] = number_format($prices[$a]);}
			if($amounts[$a] != 0){$amounts[$a] = number_format($amounts[$a]);}
			if($opens[$a] != 0){$bopens = $opens[$a];$opens[$a] = number_format($opens[$a]);}
			if($remains[$a] != 0){$remains[$a] = number_format($remains[$a]);}
			if($codes[$a] != "" || $lists[$a] != ""){$sumlist = $sumlist+1;}
			
			$sumtotal = $bopens * $bprices;
			
		 $form .='<tr >
			<td><center>'.($a+1).'</center></td>
			<td>'.$codes[$a].'</td>
			<td>'.get_sparpart_name($conn,$lists[$a]).'</td>
			<td align="center">'.$units[$a].'</td>
			<td align="right">'.getStockSpar($conn,$lists[$a]).'</td>
			<td align="right">'.$prices[$a].'</td>			
			<td align="right">'.$opens[$a].'</td>
			</tr>';
			
			if($codes[$a] != "" || $lists[$a] != ""){$total += $sumtotal;}
		}
        $form .= '<tr >
		    <td colspan="3" rowspan="4"><strong>หมายเหตุ : รายละเอียดการเปลี่ยนอะไหล่</strong><br>
			'.$_POST['detail_recom'].'</td>
			<td colspan="2"><center><strong>รวมรายการอะไหล่</strong></center></td>
			<td colspan="2" align="right"><strong>'.$sumlist.'&nbsp;&nbsp;รายการ</strong></td>
		</tr>
		
        <tr>
          <td colspan="2"><center><strong>รวมยอดค่าอะไหล่</strong></center></td>
          <td colspan="2" align="right"><strong>'.number_format($total,2).'&nbsp;&nbsp;บาท</strong></td>
          </tr>
		  
		  <tr>
          <td colspan="2"><center><strong>รวมยอด คชจ.ช่าง</strong></center></td>
          <td colspan="2" align="right"><strong>'.number_format($totalMoneyTec,2).'&nbsp;&nbsp;บาท</strong></td>
          </tr>
		  
		  <tr>
          <td colspan="2"><center><strong>ค่าใช้จ่ายรวมทั้งสิ้น</strong></center></td>
          <td colspan="2" align="right"><strong>'.number_format($total+$totalMoneyTec,2).'&nbsp;&nbsp;บาท</strong></td>
          </tr>
    </table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>
        
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.get_technician_name($conn,$_POST['loc_contact2']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างเบิก</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date2']).'</td>
              </tr>
            </table>
        </td>	
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.get_technician_name($conn,$_POST['cs_sell']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จ่ายอะไหล่</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['sell_date']).'</td>
              </tr>
            </table>
        </td>
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hTechniSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date3']).'</td>
              </tr>
            </table>
        </td>

      </tr>
    </table>';
?>


	

	