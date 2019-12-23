<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php   
	
	
	$finfos = get_firstorder($conn,$_POST['cus_id']);
	
	$chk = get_fixlist($_POST['ckf_list']);
	
	$tecinfos = get_technician($conn,$_POST['loc_contact']);
	
	foreach($chk as $vals){
		$sfix .= '
		  <tr>
			<td ><img src="../images/aroow_ch.png" width="10" height="10" border="0" alt="" />&nbsp;'.get_fixname($conn,$vals).'</td>
		  </tr>
		';	
	}

	$listShipping = '';
	if($_POST['bill_shipping'] == '1'){
		$listShipping = 'ฝ่ายขนส่งสินค้า-บริษัท ('.$_POST['shipping_dt1'].')';
	}else if($_POST['bill_shipping'] == '2'){
		$listShipping = 'จ้างขนส่งสินค้าภายนอก ('.$_POST['shipping_dt2'].')';
	}else if($_POST['bill_shipping'] == '3'){
		$listShipping = 'ฝ่ายช่าง Omega รับสินค้าเอง (ชื่อช่าง/เบอร์โทร) ('.$_POST['shipping_dt3'].')';
	}else if($_POST['bill_shipping'] == '4'){
		$listShipping = 'อื่นๆ โปรดระบุ ('.$_POST['shipping_dt4'].')';
	}else{
		$listShipping = '';
	}

	$dataApprove = '';

	if($_POST['loc_contact3'] != '0' && $_POST['loc_contact3'] != ''){
		if($_POST['loc_date3'] != '0000-00-00' && $_POST['loc_date3'] != ''){
			$dataApprove = format_date($_POST['loc_date3']);
		}else{
			$dataApprove = '';
		}
	}else{
		$dataApprove = '';
	}

	$hSaleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['loc_contact3']).'" height="50" border="0" />';

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
			<img src="../images/form/header_shipping_slip.png" width="100%" border="0" />
			<div class="bgheader">'.$_POST['sv_id'].'</div>
		</td>
	  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td width="50%" valign="top"><strong>ชื่อลูกค้า :</strong> '.$_POST['cd_names'].' <br />              <strong><br />
            ที่อยู่ :</strong> '.$_POST['cusadd'].'&nbsp;'.province_name($conn,$_POST['cusprovince']).'<strong><br />
            <br />
            โทรศัพท์ :</strong> '.$_POST['custel'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>แฟกซ์ :</strong> '.$_POST['cusfax'].'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$_POST['cscont'].' <strong>&nbsp;&nbsp;&nbsp;&nbsp;<br>
            <br>
            เบอร์โทร :</strong> '.$_POST['cstel'].'</td>
			<td width="50%">
			<strong>อ้างอิงใบเบิก : </strong> '.$_POST['srid2'].'&nbsp;&nbsp;<strong>วันที่เบิกสินค้า  :</strong> '.format_date($_POST['job_open']).'&nbsp;&nbsp;<br><br>
			<strong>อ้างอิงเลขที่ FO/PJ  :</strong> '.$_POST['srid'].' &nbsp;&nbsp;
			<strong>วันที่ต้องการสินค้า :</strong> '.format_date($_POST['job_balance']).'<br /><br />
            <strong>ประเภทลูกค้า :</strong> '.custype_name($conn,$_POST['sr_ctype2']).'<br /><br />
			<strong>ประเภทสินค้า :</strong> '.get_productname($conn,$_POST['sr_ctype']).' <strong><br><br>
            <strong>ช่องทางการขนส่งสินค้า :</strong> '.$listShipping.' 
            </td>
          </tr>
    </table>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="53%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong>'.$_POST['sloc_name'].'<br /><br />
            <strong>ที่อยู่ : </strong> '.$_POST['sloc_add'].'<br /><br />
            <strong>โทรศัพท์ : </strong> '.$_POST['loc_tel'].' <strong> แฟกซ์ : </strong> '.$_POST['loc_fax'].'<br /><br />
			<strong>ชื่อผู้ติดต่อ : </strong> '.$_POST['loc_cname'].' <strong> เบอร์โทร :</strong> '.$_POST['loc_ctel'].'<br /><br />
		</td>
        <td width="47%" valign="top"><strong>รายละเอียดเพิ่มเติมการเบิกสินค้า/ใบจัดสินค้า</strong><br><br>'.$_POST['detail_recom'].'</td>
      </tr>
</table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
      <tr>
        <td width="4%"><center><strong>ลำดับ</strong></center></td>
        <td width="8%"><center><strong>Code</strong></center></td>
		<td width="25%"><center><strong>รายการ</strong></center></td>
		<td width="9%"><center><strong>สถานที่จัดเก็บ</strong></center></td>
		<td width="9%"><center><strong>คงเหลือ Stock</strong></center></td>
		<td width="9%"><center><strong>จำนวนเบิก</strong></center></td>
		<td width="9%"><center><strong>จำนวนที่จัด</strong></center></td>
		<td width="9%"><center><strong>S/N</strong></center></td>
        </tr>';
		
		$sumtotal = 0;
		$total = 0;

		foreach($lists as $a => $b){
			
			if($amounts[$a] != 0){$amounts[$a] = number_format($amounts[$a]);}
			if($opens[$a] != 0){$bopens = $opens[$a];$opens[$a] = number_format($opens[$a]);}
			if($remains[$a] != 0){$remains[$a] = number_format($remains[$a]);}
			if($codes[$a] != "" || $lists[$a] != ""){$sumlist = $sumlist+1;}
			if($ships[$a] != 0){$bships = $ships[$a];$ships[$a] = number_format($ships[$a]);}
			
			$sumtotal = $bopens * $bprices;
			
		 $form .='<tr >
			<td><center>'.($a+1).'</center></td>
			<td><center>'.$codes[$a].'</center></td>
			<td>'.get_stockmachine_name($conn,$lists[$a]).'</td>
			<td><center>'.get_nameStockmachine($conn,$lists[$a]).'</center></td>
			<td align="right">'.getStockMachine($conn,$lists[$a]).'</td>	
			<td align="right">'.$opens[$a].'</td>
			<td align="right">'.$ships[$a].'</td>
			<td align="center">'.$sns[$a].'</td>
			</tr>';
			
			if($codes[$a] != "" || $lists[$a] != ""){$total += $sumtotal;}
		}

		/*for($i=8;$i<=10;$i++){
			
			if($_POST['pkey_open'.($i-7)] == 0){
				$_POST['pkey_open'.($i-7)] = '';
			}
			
		 $form .='<tr >
			<td><center>'.($i).'</center></td>
			<td><center>'.$_POST['pkey_code'.($i-7)].'</center></td>
			<td>'.$_POST['pkey_list'.($i-7)].'</td>
			<td align="right">'.$_POST['pkey_amount'.($i-7)].'</td>	
			<td align="right">'.$_POST['pkey_open'.($i-7)].'</td>
			<td align="right">'.$_POST['pkey_ship'.($i-7)].'</td>
			<td align="center">'.$_POST['pkey_sn'.($i-7)].'</td>
			</tr>';

			if($_POST['pkey_list'.($i-7)]){
				$sumlist++;
			}
		}*/

        $form .= '<tr >
			<td colspan="4"><center><strong>รวมจำนวนที่เบิก</strong></center></td>
			<td colspan="4" align="right"><strong>'.$sumlist.'&nbsp;&nbsp;รายการ</strong></td>
		</tr>

    </table>

	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;"  class="tb4">
      <tr>
        
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:23px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.getsalename($conn,$_POST['loc_contact2']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้เบิกสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['loc_date2']).'</td>
              </tr>
            </table>
        </td>	
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.getsalename($conn,$_POST['cs_sell']).'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้จัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.format_date($_POST['sell_date']).'</td>
              </tr>
            </table>
        </td>
		
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hSaleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้อนุมัติ / การจัดสินค้า</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ : </strong>'.$dataApprove.'</td>
              </tr>
            </table>
        </td>

      </tr>
    </table>';
?>


	

	