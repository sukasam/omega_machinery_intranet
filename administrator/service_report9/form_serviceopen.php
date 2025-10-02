<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);

	/*if($filename != "" || $filename != " "){
		$img = '<br /><br />
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td style="text-align:center;font-size:12px;"><strong>รูปภาพงานติดตั้ง</strong></td>
		  </tr>
		  <tr>
			<td style="text-align:center;font-size:12px;"><img src="../../upload/install/558970.jpg" width="600"></td>
		  </tr>
		</table>';
	}*/
	
	foreach($chk as $vals){
		$sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;'.get_fixname($conn,$vals).'</td>
		  </tr>
		';	
	}

	$sum_x = $_POST['x1']+$_POST['x2']+$_POST['x3']+$_POST['x4']+$_POST['x5']+$_POST['x6'];
	$sum_y = $_POST['y1']+$_POST['y2']+$_POST['y3']+$_POST['y4']+$_POST['y5']+$_POST['y6'];
	$sum_z = $_POST['z1']+$_POST['z2']+$_POST['z3']+$_POST['z4']+$_POST['z5']+$_POST['z6'];
	$sum_w = $_POST['w1']+$_POST['w2']+$_POST['w3']+$_POST['w4']+$_POST['w5']+$_POST['w6']+$_POST['w7']+$_POST['w8'];

	$hTechniSignature = '<img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['loc_contact3']).'" height="50" border="0" />';
	$hTechniSignature2 = '<img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['loc_contact4']).'" height="50" border="0" />';

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
			<img src="../images/form/header_service_report9.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
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
            <strong>ชื่อผู้ติดต่อ :</strong> '.$finfos['c_contact'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$finfos['c_tel'].'<br />
			<br />
			<strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$finfos['loc_name'].'<br />
			<br />
			<strong>เครื่องล้างจาน / ยี่ห้อ : </strong> '.$_POST['loc_pro'].'<br />
			<br />
			<strong>รุ่นเครื่อง : </strong> '.$_POST['loc_seal'].' <strong> S/N : </strong> '.$_POST['loc_sn'].'<br />
			<br />
			</td>
            <td width="43%"><strong>ประเภทบริการลูกค้า :</strong> '.get_servicename($conn,$_POST['sr_ctype']).' <strong><br />
              <br>
            ประเภทลูกค้า :</strong> '.custype_name($conn,$_POST['sr_ctype2']).' <strong><br /><br />
            เลขที่สัญญา  :</strong> '.$finfos['fs_id'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่  :</strong> '.format_date($_POST['job_open']).' <strong>&nbsp;&nbsp;<br />
            <br />
            วันที่ติดตั้ง :</strong> '.format_date($_POST['job_balance']).' &nbsp;&nbsp;&nbsp;&nbsp;<strong>วันที่ส่งงาน  :</strong> '.format_date($_POST['sr_stime']).'
			<br /><br>
			<strong>เลขที่ใบงาน :</strong> '.$_POST['srid'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>เสนอราคางานติดตั้ง :</strong> '.number_format($_POST['price_quo'],2).'<br />
			<br />
			<strong>เครื่องป้อนน้ำยา : </strong> '.$_POST['loc_clean'].'<br />
			<br />
			<strong>ช่างบริการประจำ : </strong> '.$tecinfos['group_name'].'&nbsp;&nbsp;&nbsp;<strong> เบอร์โทร : </strong> '.$tecinfos['group_tel'].'
			</td>
          </tr>
    </table>	
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="33%">
			<strong>สรุปค่าใช้จ่าย : ควบคุมงาน (Hardteam)</strong><br /><br />
            <strong>- ค่าน้ำมัน :</strong> '.number_format($_POST['x1'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าทางด่วน :</strong> '.number_format($_POST['x2'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าเบี้ยเลี้ยง :</strong> '.number_format($_POST['x3'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าที่พัก :</strong> '.number_format($_POST['x4'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าใช้จ่ายเบ็ดเตล็ด :</strong> '.number_format($_POST['x5'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าใช้จ่ายอื่นๆ :</strong> '.number_format($_POST['x6'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>รวมค่าใช้จ่าย (Hardteam) :</strong> '.number_format($_POST['x1']+$_POST['x2']+$_POST['x3']+$_POST['x4']+$_POST['x5']+$_POST['x6'],2).'<strong>&nbsp;บาท</strong>
            </td>
        <td width="33%">
			<strong>สรุปค่าใช้จ่าย : ส่วนงานติดตั้ง</strong><br /><br />
			<strong>- ค่าน้ำมัน :</strong> '.number_format($_POST['y1'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าทางด่วน :</strong> '.number_format($_POST['y2'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าที่พัก :</strong> '.number_format($_POST['y3'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่านำมัน :</strong> '.number_format($_POST['y4'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าแก๊ส :</strong> '.number_format($_POST['y5'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- อื่นๆ :</strong> '.number_format($_POST['y6'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>รวมค่าใช้จ่าย (งานติดตั้ง) :</strong> '.number_format($_POST['y1']+$_POST['y2']+$_POST['y3']+$_POST['y4']+$_POST['y5']+$_POST['y6'],2).'<strong>&nbsp;บาท</strong>
		</td>
		<td width="33%">
			<strong>สรุปค่าใช้จ่าย : ส่วนงานแก้ไข</strong><br /><br />
			<strong>- ค่าน้ำมัน :</strong> '.number_format($_POST['z1'],2).'<strong>&nbsp;บาท</strong><br /><br />
			<strong>- ค่าทางด่วน :</strong> '.number_format($_POST['z2'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าที่พัก :</strong> '.number_format($_POST['z3'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่านำมัน :</strong> '.number_format($_POST['z4'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- ค่าแก๊ส :</strong> '.number_format($_POST['z5'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>- อื่นๆ :</strong> '.number_format($_POST['z6'],2).'<strong>&nbsp;บาท</strong><br /><br />
            <strong>รวมค่าใช้จ่าย (งานแก้ไข) :</strong> '.number_format($_POST['z1']+$_POST['z2']+$_POST['z3']+$_POST['z4']+$_POST['z5']+$_POST['z6'],2).'<strong>&nbsp;บาท</strong>
			</td>
		</td>
		';
        
		// <strong>ปริมาณน้ำยา</strong><br /><br />
        //     <strong>ปริมาณน้ำยาล้าง : </strong> '.$_POST['cl_01'].' <strong> ml / rack</strong><br /><br />
        //     <strong>ปริมาณน้ำยาช่วยแห้ง : </strong> '.$_POST['cl_02'].' <strong>ml / rack</strong><br /><br />
        //     <strong>ความเข้มข้น : </strong> '.$_POST['cl_03'].' <strong>%</strong><br /><br />
        //     <strong>สต๊อกน้ำยา C =</strong> '.$_POST['cl_04'].' <strong>ถัง R = </strong> '.$_POST['cl_05'].' <strong>ถัง A =</strong> '.$_POST['cl_06'].' <strong>ถัง</strong><br />
        //     <strong><br />
        //     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong> '.$_POST['cl_07'].' <strong>ถัง RG = </strong> '.$_POST['cl_08'].' <strong>ถัง</strong>

		// <strong>- ค่าทางด่วน :</strong> '.number_format($_POST['mn_1'],2).'<strong>&nbsp;บาท</strong><br />
        // 	<br />
        //     <strong>- ค่าที่พัก : </strong> '.number_format($_POST['mn_2'],2).'<strong>&nbsp;บาท</strong><br />
        //     <br />
        //     <strong>- ค่านำมัน : </strong> '.number_format($_POST['mn_3'],2).'<strong>&nbsp;บาท</strong><br />
        //     <br />
		// 	<strong>- ค่าแก๊ส : </strong> '.number_format($_POST['mn_5'],2).'<strong>&nbsp;บาท</strong><br />
        //     <br />
        //     <strong>- อื่นๆ : </strong>'.number_format($_POST['mn_4'],2).'<strong>&nbsp;บาท</strong><br />
        //     <br />
        //     <strong>รวมมูลค่า : </strong>'.number_format(($_POST['mn_1']+$_POST['mn_2']+$_POST['mn_3']+$_POST['mn_4']+$_POST['mn_5']),2).'&nbsp;<strong>บาท</strong>

        $form .= '
      </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="50%">
			<strong>แยกส่วน คชจ.ติดตั้ง-โปรเจ็ค:</strong><br />
			<br />
			<strong>- ค่าอุปกรณ์ติดตั้ง-ระบบไฟฟ้า :</strong> '.number_format($_POST['w1'],2).' &nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าอุปกรณ์ติดตั้ง-ระบบประปา :</strong> '.number_format($_POST['w2'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าอุปกรณ์สิ้นเปลือง :</strong> '.number_format($_POST['w3'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าน้ำมัน+ทางด่วน :</strong> '.number_format($_POST['w4'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าขนส่งจ้างนอก :</strong> '.number_format($_POST['w5'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าที่พัก :</strong> '.number_format($_POST['w6'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าโอที/เบี้ยเลี้ยง :</strong> '.number_format($_POST['w7'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>- ค่าอื่นๆ :</strong> '.number_format($_POST['w8'],2).'<strong>&nbsp;บาท</strong>
			<br /><br />
			<strong>รวมยอด คชจ.:</strong> '.number_format($sum_w,2).'<strong>&nbsp;บาท</strong>
         </td>
        <td width="50%">
			<strong>รายละเอียดเพิ่มเติม: </strong><br />'.$_POST['detail_comment'].'
		</td>
	</tr>
	</table>
		<br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%"><strong>ลำดับ</strong></td>
        <td width="8%"><strong>Code</strong></td>
        <td width="35%"><strong>รายการ</strong></td>
		<td width="9%"><strong>สถานที่จัดเก็บ</strong></td>
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
			<td align="center">'.get_nameStock($conn,$lists[$a]).'</td>
			<td align="center">'.$units[$a].'</td>
			<td align="right">'.getStockSpar($conn,$lists[$a]).'</td>
			<td align="right">'.$prices[$a].'</td>
			<td align="right">'.$opens[$a].'</td>
			</tr>';
			
			if($codes[$a] != "" || $lists[$a] != ""){$total += $sumtotal;}
		}
        $form .= '<tr >
			<td colspan="5" align="right"><strong>รวมจำนวนที่เบิก</strong></td>
			<td colspan="3" align="right"><strong>'.$sumlist.'&nbsp;&nbsp;รายการ</strong></td>
		</tr>
		
        <tr >
          <td colspan="5" align="right"><strong>ใช้จ่ายรวม (รวมมูลค่าอะไหล่ที่เบิก)</strong></td>
          <td colspan="3" align="right"><strong>'.number_format($total,2).'&nbsp;&nbsp;บาท</strong></td>
          </tr>
        <tr >
          <td colspan="5" align="right"><strong>ใช้จ่ายรวม (ค่าอะไหล่และอื่นๆ (จากช่างค่าน้ำมัน, ค่าทางด่วน, ที่พัก))</strong></td>
          <td colspan="3" align="right"><strong>'.number_format($sum_x+$sum_y+$sum_z,2).'&nbsp;&nbsp;บาท</strong></td>
		<tr >
          <td colspan="5" align="right"><strong>รวมค่าอะไหล่ + ค่าน้ำมัน + ค่าที่พัก + ค่าทางด่วน + อื่นๆ</strong></td>
          <td colspan="3" align="right"><strong>'.number_format($sum_w,2).'&nbsp;&nbsp;บาท</strong></td>
        </tr>
		<tr >
          <td colspan="5" align="right"><strong>ใบเสนอราคาที่ได้รับ อนุมัติ	</strong></td>
          <td colspan="3" align="right"><strong>'.number_format($_POST['price_quo'],2).'&nbsp;&nbsp;บาท</strong></td>
        </tr>
		<tr >
          <td colspan="5" align="right"><strong>ส่วนต่าง คชจ.กับ ราคาค่าติดตั้ง</strong></td>
          <td colspan="3" align="right"><strong>'.number_format(($_POST['price_quo']-$sum_w)*100/$_POST['price_quo'],2).'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format($_POST['price_quo']-$sum_w,2).'&nbsp;&nbsp;บาท</strong></td>
        </tr>

    </table>
	
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>
        
		<td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
		
		<td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
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
		
		<td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hTechniSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้างานฝ่ายโปรเจ็ค</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date3']).'</td>
              </tr>
            </table>
        </td>

		<td width="25%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hTechniSignature2.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ / GM แผนกช่าง</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date4']).'</td>
              </tr>
            </table>
        </td>

      </tr>
    </table><br>';

if($_POST['filenames'] != ""){
	$form .= '<p style="text-align:center;"><strong>รูปภาพประกอบ ที่ 1</strong> <br><img src="../../upload/install/'.$_POST['filenames'].'" width="500" border="0" /></p>';
}
if($_POST['filenames2'] != ""){
	$form .= '<p style="text-align:center;"><strong>รูปภาพประกอบ ที่ 2</strong> <br><img src="../../upload/install/'.$_POST['filenames2'].'" width="500" border="0" /></p>';
}
if($_POST['filenames3'] != ""){
	$form .= '<p style="text-align:center;"><strong>รูปภาพประกอบ ที่ 3</strong> <br><img src="../../upload/install/'.$_POST['filenames3'].'" width="500" border="0" /></p>';
}

?>