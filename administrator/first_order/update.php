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

		

		$a_sdate=explode("/",$_POST['date_forder']);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_ship']);
		$_POST['cs_ship']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_setting']);
		$_POST['cs_setting']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_quf']);
		$_POST['date_quf']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
		$a_sdate=explode("/",$_POST['date_qut']);
    $_POST['date_qut']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

    $a_sdate=explode("/",$_POST['date_qut_old']);
    $_POST['date_qut_old']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['sign_date1']);
    $_POST['sign_date1']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['sign_date2']);
    $_POST['sign_date2']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['sign_date3']);
    $_POST['sign_date3']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	

		$_POST['ccomment'] = nl2br($_POST['ccomment']);

		$_POST['qucomment'] = nl2br($_POST['qucomment']);

		$_POST['remark'] = nl2br($_POST['remark']);

		

    $_POST['separate'] = 0;		

		$_POST["cprice1"] = str_replace($vowels,"",$_POST["cprice1"]);

		$_POST["cprice2"] = str_replace($vowels,"",$_POST["cprice2"]);

		$_POST["cprice3"] = str_replace($vowels,"",$_POST["cprice3"]);

		$_POST["cprice4"] = str_replace($vowels,"",$_POST["cprice4"]);

		$_POST["cprice5"] = str_replace($vowels,"",$_POST["cprice5"]);

		$_POST["cprice6"] = str_replace($vowels,"",$_POST["cprice6"]);

		$_POST["cprice7"] = str_replace($vowels,"",$_POST["cprice7"]);

	
		$_POST["money_garuntree"] = str_replace($vowels,"",$_POST["money_garuntree"]);
		$_POST["money_setup"] = str_replace($vowels,"",$_POST["money_setup"]);



		if ($_POST["mode"] == "add") { 

        $_POST['st_setting'] = 0;
        $_POST['approve'] = 0;
        $_POST['approve2'] = 0;
				$_POST['fs_id'] = get_snfirstorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;


				include "../include/m_add.php";

				$id = mysqli_insert_id($conn);

				include_once("../mpdf54/mpdf.php");
				include_once("form_firstorder.php");
				$mpdf=new mPDF('UTF-8'); 

				$mpdf->SetAutoFont();

				$mpdf->WriteHTML($form);

				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 

				$mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');

				

			header ("location:index.php?" . $param); 

		}

		if ($_POST["mode"] == "update" ) { 

      // if($_POST['date_qut_old'] !== ''){
      //   // echo "date_qut_old !== '' && date_qut_old = ".$_POST['date_qut_old']."<br>";
      //   if($_POST['date_qut_old'] !== $_POST['date_qut']){
      //     $_POST['approve'] = 0;
      //     $_POST['approve2'] = 0;
      //     // echo "date_qut_old !== date_qut";
      //   }else{
      //     // echo "date_qut_old === date_qut";
      //   }
      // }else{
      //   // echo "date_qut_old === ''";
      // }

      if($_POST['kongw'] == ''){
        $_POST['kongw_type'] = '';
        $_POST['kongw_type2'] = '';
      }
      if($_POST['stockm'] == ''){
        $_POST['stockm_type'] = '';
        $_POST['stockm_type2'] = '';
      }

				include ("../include/m_update.php");

				$id = $_REQUEST[$PK_field];			

			
				include_once("../mpdf54/mpdf.php");

				include_once("form_firstorder.php");

				$mpdf=new mPDF('UTF-8'); 

				$mpdf->SetAutoFont();

				$mpdf->WriteHTML($form);

				$chaf = preg_replace("/\//","-",$_POST['fs_id']); 

				$mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');

			

			header ("location:index.php?" . $param); 

		}

	}

	if ($_GET['mode'] == "add") { 

		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"add");

	}

	if ($_GET['mode'] == "update") { 

		 Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");

		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";

		$query = @mysqli_query($conn,$sql);

		while ($rec = @mysqli_fetch_array ($query)) { 

			$$PK_field = $rec[$PK_field];

			foreach ($fieldlist as $key => $value) { 

				$$value = $rec[$value];

			}

		}


		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_ship);
		$cs_ship=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_setting);
		$cs_setting=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_quf);
		$date_quf=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_qut);
    $date_qut=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    $a_sdate=explode("-",$sign_date1);
    $sign_date1=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$sign_date2);
    $sign_date2=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$sign_date3);
    $sign_date3=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML xmlns="http://www.w3.org/1999/xhtml">

<HEAD>

<TITLE><?php  echo $s_title;?></TITLE>

<META content="text/html; charset=utf-8" http-equiv=Content-Type>

<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>

<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>

<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>

<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>

<!--
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>

<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>

<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
-->

<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>

<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>



<script language="JavaScript" src="../Carlender/calendar_us.js"></script>

<link rel="stylesheet" href="../Carlender/calendar.css">



<META name=GENERATOR content="MSHTML 8.00.7600.16535">

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



function chksign(vals){

	//alert(vals);	

}
	
function changePod(s1,s2,id,foid){
	
	var x = document.getElementById(s1).value;
	 //console.log(x,s2);
	
	$.ajax({
		type: "GET",
		url: "call_return.php?action=changeSN&pod="+x+"&id="+id+"&fo_id="+foid,
		success: function(data){
			var ds = data.split('|');
			//console.log(ds[1]);
			document.getElementById(s2).innerHTML = ds[1];
			document.getElementById('search_sn'+id).innerHTML = ds[2];
			
		}
	});
}




$(function(){



 $("#cd_province").change(function(){

	var cd_province = $("#cd_province").val();

	$.ajax({

		type: "GET",

		url: 'call_return.php?action=amphur&cd_province='+cd_province,

		success: function(data){

			//console.log(data);

			$("#cd_amphur").html(data);

		}

	});

  });



});

function submitForm() {
	document.getElementById("submitF").disabled = true;
	document.getElementById("resetF").disabled = true;
	document.form1.submit()
}

</script>

</HEAD>

<?php  include ("../../include/function_script.php"); ?>

<BODY>

<DIV id=body-wrapper>

<?php  include("../left.php");?>

<DIV id=main-content>

<NOSCRIPT>

</NOSCRIPT>

<?php  include('../top.php');?>

<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>

<UL class=shortcut-buttons-set>

  <LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>

  กลับ</SPAN></A></LI>

</UL>

<!-- End .clear -->

<DIV class=clear></DIV><!-- End .clear -->

<DIV class=content-box><!-- Start Content Box -->

<DIV class=content-box-header align="right">



<H3 align="left"><?php  echo $check_module; ?></H3>

<DIV class=clear>

  

</DIV></DIV><!-- End .content-box-header -->

<DIV class=content-box-content>

<DIV id=tab1 class="tab-content default-tab">

  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">

    <div class="formArea">

      <fieldset>

      <legend><?php  echo $page_name; ?> </legend>

        <table width="100%" cellspacing="0" cellpadding="0" border="0">

  <tr>

    <td style="padding-bottom:5px;"><img src="../images/form/header-first-order.png" width="100%" border="0" /></td>

  </tr>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">

            <input name="fastwork" type="radio" id="radio21" value="" <?php  if(empty($fastwork)){echo 'checked';}?>>

            <strong>งานปกติ</strong>

            <input name="fastwork" type="radio" id="radio21" value="1" <?php  if($fastwork == 1){echo 'checked';}?>>

            <strong>งานด่วนพิเศษ</strong>

            <input name="fastwork" type="radio" id="radio21" value="2" <?php  if($fastwork == 2){echo 'checked';}?>>

            <strong>งานด่วน</strong> &nbsp; | &nbsp;

            <strong>กลุ่มลูกค้า :</strong> 

            <select name="cg_type" id="cg_type" class="inputselect">

                <?php 

                	$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");

					while($row_cgtype = @mysqli_fetch_array($qucgtype)){

					  ?>

					  	<option value="<?php  echo $row_cgtype['group_id'];?>" <?php  if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php  echo $row_cgtype['group_name'];?></option>

					  <?php 	

					}

				?>

            </select>

              </td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            
            <strong>ประเภทลูกค้า :</strong> 

             <select name="ctype" id="ctype" class="inputselect" onChange="chksign(this.value);">

                <?php 

                	$quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");

					while($row_cgcus = @mysqli_fetch_array($quccustommer)){

						if(substr($row_cgcus['group_name'],0,2) != "SR" && substr($row_cgcus['group_name'],0,2) != "IT"){

					  ?>

					  	<option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>

					  <?php 	

						}

					}

				?>

            </select>

            &nbsp;&nbsp;<strong>ประเภทสินค้า :</strong> 	

            <select name="pro_type" id="pro_type" class="inputselect">

                <?php 

                	$quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");

					while($row_protype = @mysqli_fetch_array($quprotype)){

					  ?>

					  	<option value="<?php  echo $row_protype['group_id'];?>" <?php  if($pro_type == $row_protype['group_id']){echo 'selected';}?>><?php  echo $row_protype['group_name'];?></option>

					  <?php 	

					}

				?>

            </select>

            </td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong> 

            <select name="cd_province" id="cd_province" class="inputselect">

                <?php 
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
                  while($row_province = @mysqli_fetch_array($quprovince)){
                    ?>
                      <option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
                    <?php 	
                  }
				        ?>

            </select>

           &nbsp;&nbsp;

           <strong>อำเภอ :</strong> 

           <select name="cd_amphur" id="cd_amphur" class="inputselect">

                <?php 

                	$quamphur = @mysqli_query($conn,"SELECT * FROM s_amphur WHERE province_id ='".$cd_province."' ORDER BY amphur_name ASC");

					while($row_amphur = @mysqli_fetch_array($quamphur)){

					  ?>

					  	<option value="<?php  echo $row_amphur['amphur_id'];?>" <?php  if($cd_amphur == $row_amphur['amphur_id']){echo 'selected';}?>><?php  echo $row_amphur['amphur_name'];?></option>

					  <?php 	

					}

				?>

            </select>

           	</td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ใบเสนอราคา / PO.NO. :</strong> <input type="text" name="po_id" value="<?php  echo $po_id;?>" id="po_id" class="inpfoder"></td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder">

              <strong>แฟกซ์ :</strong>

              <input type="text" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เลขที่ First order :</strong> <!--<input type="text" name="fs_id" value="<?php  echo $fs_id;?>">--><input type="text" name="fs_id" value="<?php  if($fs_id == ""){echo check_firstorder($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" > <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script></td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ :</strong>

              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder">

              <strong>เบอร์โทร :</strong>

              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>ปีลูกค้า<strong> : </strong><input type="text" name="cusyear"value="<?php  echo $cusyear;?>" id="cusyear" class="inpfoder">
            <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"></span>
            <strong>รหัสลูกค้า<strong> :</strong>
            <span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"></span>
              <input type="text" name="cusid" value="<?php  echo $cusid;?>" id="cusid" class="inpfoder">
              
			  <span style="padding-left: 20px;"><strong>แผนที่ลูกค้า<strong>
              <strong>latitude : </strong><input name="latitude" type="taxt" id="latitude" value="<?php  echo $latitude;?>">
      		  <strong>longitude : </strong><input name="longitude" type="taxt" id="longitude" value="<?php  echo $longitude;?>"></span>

            </span></strong></td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>อีเมล :</strong>
              <input type="text" name="cd_email" value="<?php echo $cd_email;?>" id="cd_email" class="inpfoder"></td>
            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong></strong>
          </tr>

</table>

  <br>

  <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #000000;" class="tb2">

  <tr>

    <td style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> <input type="text" name="loc_name" value="<?php  echo $loc_name;?>" id="loc_name" class="inpfoder" style="width:60%;"></td>

    </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="loc_address" value="<?php  echo $loc_address;?>" id="loc_address" class="inpfoder" style="width:80%;"> </td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ : </strong> <input type="text" name="loc_tel" value="<?php  echo $loc_tel;?>" id="loc_tel" class="inpfoder" style="width:30%;">&nbsp;&nbsp;<strong>แฟกซ์ : </strong> <input type="text" name="loc_fax" value="<?php  echo $loc_fax;?>" id="loc_fax" class="inpfoder" style="width:30%;"></td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อผู้ติดต่อ : </strong> <input type="text" name="loc_cname" value="<?php  echo $loc_cname;?>" id="loc_cname" class="inpfoder" style="width:30%;">&nbsp;&nbsp;<strong>เบอร์โทร : </strong> <input type="text" name="loc_ctel" value="<?php  echo $loc_ctel;?>" id="loc_ctel" class="inpfoder" style="width:30%;"></td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ขนส่งโดย :</strong> <input type="text" name="loc_shopping" value="<?php  echo $loc_shopping;?>" id="loc_shopping" class="inpfoder" style="width:80%;"></td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">&nbsp;</td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เงินค่าประกัน :

                <input type="text" name="money_garuntree" value="<?php  echo $money_garuntree;?>" id="money_garuntree" class="inpfoder" >

            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>

            <input name="notvat1" type="radio" id="radio" value="1" <?php  if($notvat1 == 1){echo 'checked';}?>>

            Not vat

            <input type="radio" name="notvat1" id="radio2" value="2" <?php  if($notvat1 == 2){echo 'checked';}?>>

            Vat 7%</strong></td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ค่าขนส่งและติดตั้ง :

                <input type="text" name="money_setup" value="<?php  echo $money_setup;?>" id="money_setup" class="inpfoder" >

            <small style="color:#F00;">ไม่ต้องใส่ (,)</small>

            <input name="notvat2" type="radio" id="radio3" value="1" <?php  if($notvat2 == 1){echo 'checked';}?>>

Not vat

<input type="radio" name="notvat2" id="radio4" value="2" <?php  if($notvat2 == 2){echo 'checked';}?>>

Vat 7%</strong></td>

          </tr>

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เครื่องป้อนน้ำยา : 

                <br>

                <input name="feeder" type="radio" id="radio5" value="1" <?php  if($feeder == 1){echo 'checked';}?>>

              เครื่องป้อนเกาหลี

              <input type="text" name="feeder_type" value="<?php  echo $feeder_type;?>" id="feeder_type1" class="inpfoder" >

              <br>

              <input name="feeder" type="radio" id="radio6" value="2" <?php  if($feeder == 2){echo 'checked';}?>>

              เครื่องป้อน DC906

              <input type="text" name="feeder_type2" value="<?php  echo $feeder_type2;?>" id="feeder_type2" class="inpfoder" >

            </strong></td>
          </tr>

          <tr>
          <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;white-space: nowrap;"><strong>เครื่องกรองน้ำ : <input name="kongw" type="radio" id="radio12" value="" <?php  if(empty($kongw)){echo 'checked';}?>> 
          <br>

          <input name="kongw" type="radio" id="radio12" value="1" <?php  if($kongw == 1){echo 'checked';}?>>

          3 ขั้นตอน   &nbsp;&nbsp;&nbsp;   

          <input name="kongw_type" type="radio" id="radio14" value="1" <?php  if($kongw_type == 1){echo 'checked';}?>>

          10 นิ้ว    &nbsp;&nbsp;&nbsp;

          <input name="kongw_type" type="radio" id="radio15" value="2" <?php  if($kongw_type == 2){echo 'checked';}?>>

          20 นิ้ว    &nbsp;&nbsp;&nbsp;

          <br>

          <input name="kongw" type="radio" id="radio13" value="2" <?php  if($kongw == 2){echo 'checked';}?>>

          2 ขั้นตอน  &nbsp;&nbsp;&nbsp;   

          <input name="kongw_type2" type="radio" id="radio16" value="1" <?php  if($kongw_type2 == 1){echo 'checked';}?>>

          10 นิ้ว    &nbsp;&nbsp;&nbsp;

          <input name="kongw_type2" type="radio" id="radio17" value="2" <?php  if($kongw_type2 == 2){echo 'checked';}?>>

          20 นิ้ว    &nbsp;&nbsp;&nbsp;

          </strong></td>

          </tr>

          <tr>
          <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;white-space: nowrap;"><strong>สต็อกเครื่อง : <input name="stockm" type="radio" id="radio10" value="" <?php  if(empty($stockm)){echo 'checked';}?>> 

          <br>

          <input name="stockm" type="radio" id="radio10" value="1" <?php  if($stockm == 1){echo 'checked';}?>>

          สต็อกเครื่องใหม่ :

          <input type="text" name="stockm_type" value="<?php  echo $stockm_type;?>" id="stockm_type1" class="inpfoder" >

          <br>

          <input name="stockm" type="radio" id="radio11" value="2" <?php  if($stockm == 2){echo 'checked';}?>>

          สต็อกเครื่องเก่า :

          <input type="text" name="stockm_type2" value="<?php  echo $stockm_type2;?>" id="stockm_type2" class="inpfoder" >

          </strong></td>
          </tr>

    </table></td>

    <td style="vertical-align:top;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">

          <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>OMG C :</strong>

              <input type="text" name="warter01" value="<?php  echo $warter01;?>" id="warter01" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>OMG R :</strong>

              <input type="text" name="warter02" value="<?php  echo $warter02;?>" id="warter02" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>OMG A :</strong>

              <input type="text" name="warter03" value="<?php  echo $warter03;?>" id="warter03" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Wash Glass :</strong>

              <input type="text" name="warter04" value="<?php  echo $warter04;?>" id="warter04" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Rinse Glass :</strong>

              <input type="text" name="warter05" value="<?php  echo $warter05;?>" id="warter05" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Omega Wash :</strong>

              <input type="text" name="warter06" value="<?php  echo $warter06;?>" id="warter06" class="inpfoder"></td>

    </tr><tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Omega Dry :</strong>

              <input type="text" name="warter07" value="<?php  echo $warter07;?>" id="warter07" class="inpfoder"></td>

    </tr>
    <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Omega Sulution EX :</strong>

              <input type="text" name="warter08" value="<?php  echo $warter08;?>" id="warter08" class="inpfoder"></td>

    </tr>
    <tr>

            <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>Omega Sulution EX Dry :</strong>

              <input type="text" name="warter09" value="<?php  echo $warter09;?>" id="warter09" class="inpfoder"></td>

    </tr>

</table>

    </td>

  </tr>

</table>





    		

  <br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">

    <tr>

      <td width="3%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="40%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="21%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="11%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>

    </tr>

    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">1</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">
      <select name="cpro1" id="cpro1" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro1 = @mysqli_fetch_array($qupro1)){
                ?>
                  <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cpro1 == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name']." ".$row_qupro1['group_detail'];?></option>
                <?php
              }
          ?>
      </select>
      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod1" id="pro_pod1" class="inputselect" style="width:80%;" onchange="changePod('pro_pod1','pro_sn1','1','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros1 = @mysqli_fetch_array($qupros1)){
                ?>
                  <option value="<?php  echo $row_qupros1['group_name'];?>" <?php  if($pro_pod1 == $row_qupros1['group_name']){echo 'selected';}?>><?php  echo $row_qupros1['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod1&protype2=pro_sn1&protype3=1&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod1" value="<?php  echo $pro_pod1;?>" id="pro_pod1" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;white-space: nowrap;" >
<!--      <input type="text" name="pro_sn1" value="<?php  echo $pro_sn1;?>" id="pro_sn1" class="inpfoder" style="width:100%;text-align:center;">-->
   
     <select name="pro_sn1" id="pro_sn1" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn1 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod1)."' ORDER BY group_name ASC");
              while($row_qusn1 = @mysqli_fetch_array($qusn1)){
				  if(chkSeries($conn,$row_qusn1['group_name'],$_GET['fo_id']) == 0){
					  ?>
					  <option value="<?php  echo $row_qusn1['group_name'];?>" <?php  if($pro_sn1 == $row_qusn1['group_name']){echo 'selected';}?>><?php  echo $row_qusn1['group_name'];?></option>
					<?php 
				  } 
              }
          ?>
      </select><span id="search_sn1">
      	<a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn1&pod=<?php echo getpod_id($conn,$pro_pod1);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </span>
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount1" value="<?php  echo $camount1;?>" id="camount1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice1" value="<?php  echo $cprice1;?>" id="cprice1" class="inpfoder" style="width:100%;text-align:center;">
      </td>


    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">2</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro2" id="cpro2" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro2 = @mysqli_fetch_array($qupro1)){
                ?>
                  <option value="<?php  echo $row_qupro2['group_id'];?>" <?php  if($cpro2 == $row_qupro2['group_id']){echo 'selected';}?>><?php  echo $row_qupro2['group_name']." ".$row_qupro2['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" id="cs2">
      <select name="pro_pod2" id="pro_pod2" class="inputselect" style="width:80%;" onchange="changePod('pro_pod2','pro_sn2','2','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros2 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros2 = @mysqli_fetch_array($qupros2)){
                ?>
                  <option value="<?php  echo $row_qupros2['group_name'];?>" <?php  if($pro_pod2 == $row_qupros2['group_name']){echo 'selected';}?>><?php  echo $row_qupros2['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod2&protype2=pro_sn2&protype3=2&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod2" value="<?php  echo $pro_pod2;?>" id="pro_pod2" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" id="csn2">
<!--      <input type="text" name="pro_sn2" value="<?php  echo $pro_sn2;?>" id="pro_sn2" class="inpfoder" style="width:100%;text-align:center;">-->
     
      <select name="pro_sn2" id="pro_sn2" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn2 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod2)."' ORDER BY group_name ASC");
              while($row_qusn2 = @mysqli_fetch_array($qusn2)){
				  if(chkSeries($conn,$row_qusn2['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn2['group_name'];?>" <?php  if($pro_sn2 == $row_qusn2['group_name']){echo 'selected';}?>><?php  echo $row_qusn2['group_name'];?></option>
                <?php
				  }
                
              }
          ?>
      </select><span id="search_sn2"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn2&pod=<?php echo getpod_id($conn,$pro_pod2);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount2" value="<?php  echo $camount2;?>" id="camount2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice2" value="<?php  echo $cprice2;?>" id="cprice2" class="inpfoder" style="width:100%;text-align:center;">
      </td>

    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">3</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro3" id="cpro3" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro3 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro3 = @mysqli_fetch_array($qupro3)){
                ?>
                  <option value="<?php  echo $row_qupro3['group_id'];?>" <?php  if($cpro3 == $row_qupro3['group_id']){echo 'selected';}?>><?php  echo $row_qupro3['group_name']." ".$row_qupro3['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <select name="pro_pod3" id="pro_pod3" class="inputselect" style="width:80%;" onchange="changePod('pro_pod3','pro_sn3','3','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros3 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros3 = @mysqli_fetch_array($qupros3)){
                ?>
                  <option value="<?php  echo $row_qupros3['group_name'];?>" <?php  if($pro_pod3 == $row_qupros3['group_name']){echo 'selected';}?>><?php  echo $row_qupros3['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod3&protype2=pro_sn3&protype3=3&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod3" value="<?php  echo $pro_pod3;?>" id="pro_pod3" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
<!--      <input type="text" name="pro_sn3" value="<?php  echo $pro_sn3;?>" id="pro_sn3" class="inpfoder" style="width:100%;text-align:center;">-->
     
     <select name="pro_sn3" id="pro_sn3" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn3 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod3)."' ORDER BY group_name ASC");
              while($row_qusn3 = @mysqli_fetch_array($qusn3)){
				  if(chkSeries($conn,$row_qusn3['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn3['group_name'];?>" <?php  if($pro_sn3 == $row_qusn3['group_name']){echo 'selected';}?>><?php  echo $row_qusn3['group_name'];?></option>
                <?php
				  }
                
              }
          ?>
      </select><span id="search_sn3"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn3&pod=<?php echo getpod_id($conn,$pro_pod3);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount3" value="<?php  echo $camount3;?>" id="camount3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice3" value="<?php  echo $cprice3;?>" id="cprice3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">4</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro4" id="cpro4" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro4 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro4 = @mysqli_fetch_array($qupro4)){
                ?>
                  <option value="<?php  echo $row_qupro4['group_id'];?>" <?php  if($cpro4 == $row_qupro4['group_id']){echo 'selected';}?>><?php  echo $row_qupro4['group_name']." ".$row_qupro4['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <select name="pro_pod4" id="pro_pod4" class="inputselect" style="width:80%;" onchange="changePod('pro_pod4','pro_sn4','4','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros4 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros4 = @mysqli_fetch_array($qupros4)){
                ?>
                  <option value="<?php  echo $row_qupros4['group_name'];?>" <?php  if($pro_pod4 == $row_qupros4['group_name']){echo 'selected';}?>><?php  echo $row_qupros4['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod4&protype2=pro_sn4&protype3=4&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod4" value="<?php  echo $pro_pod4;?>" id="pro_pod4" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
<!--      <input type="text" name="pro_sn4" value="<?php  echo $pro_sn4;?>" id="pro_sn4" class="inpfoder" style="width:100%;text-align:center;">-->
     
     <select name="pro_sn4" id="pro_sn4" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn4 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod4)."' ORDER BY group_name ASC");
              while($row_qusn4 = @mysqli_fetch_array($qusn4)){
				  if(chkSeries($conn,$row_qusn4['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn4['group_name'];?>" <?php  if($pro_sn4 == $row_qusn4['group_name']){echo 'selected';}?>><?php  echo $row_qusn4['group_name'];?></option>
                <?php
				  }
                
              }
          ?>
      </select><span id="search_sn4"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn4&pod=<?php echo getpod_id($conn,$pro_pod4);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount4" value="<?php  echo $camount4;?>" id="camount4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice4" value="<?php  echo $cprice4;?>" id="cprice4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">5</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro5" id="cpro5" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro5 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro5 = @mysqli_fetch_array($qupro5)){
                ?>
                  <option value="<?php  echo $row_qupro5['group_id'];?>" <?php  if($cpro5 == $row_qupro5['group_id']){echo 'selected';}?>><?php  echo $row_qupro5['group_name']." ".$row_qupro5['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <select name="pro_pod5" id="pro_pod5" class="inputselect" style="width:80%;" onchange="changePod('pro_pod5','pro_sn5','5','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros5 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros5 = @mysqli_fetch_array($qupros5)){
                ?>
                  <option value="<?php  echo $row_qupros5['group_name'];?>" <?php  if($pro_pod5 == $row_qupros5['group_name']){echo 'selected';}?>><?php  echo $row_qupros5['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod5&protype2=pro_sn5&protype3=5&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod5" value="<?php  echo $pro_pod5;?>" id="pro_pod5" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
<!--      <input type="text" name="pro_sn5" value="<?php  echo $pro_sn5;?>" id="pro_sn5" class="inpfoder" style="width:100%;text-align:center;">-->
     
     <select name="pro_sn5" id="pro_sn5" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn5 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod5)."' ORDER BY group_name ASC");
              while($row_qusn5 = @mysqli_fetch_array($qusn5)){
				 if(chkSeries($conn,$row_qusn5['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn5['group_name'];?>" <?php  if($pro_sn5 == $row_qusn5['group_name']){echo 'selected';}?>><?php  echo $row_qusn5['group_name'];?></option>
                <?php
				 }
              }
          ?>
      </select><span id="search_sn5"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn5&pod=<?php echo getpod_id($conn,$pro_pod5);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount5" value="<?php  echo $camount5;?>" id="camount5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice5" value="<?php  echo $cprice5;?>" id="cprice5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">6</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro6" id="cpro6" class="inputselect" style="width:90%;" >
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro6 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro6 = @mysqli_fetch_array($qupro6)){
                ?>
                  <option value="<?php  echo $row_qupro6['group_id'];?>" <?php  if($cpro6 == $row_qupro6['group_id']){echo 'selected';}?>><?php  echo $row_qupro6['group_name']." ".$row_qupro6['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <select name="pro_pod6" id="pro_pod6" class="inputselect" style="width:80%;" onchange="changePod('pro_pod6','pro_sn6','6','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros6 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros6 = @mysqli_fetch_array($qupros6)){
                ?>
                  <option value="<?php  echo $row_qupros6['group_name'];?>" <?php  if($pro_pod6 == $row_qupros6['group_name']){echo 'selected';}?>><?php  echo $row_qupros6['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod6&protype2=pro_sn6&protype3=6&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod6" value="<?php  echo $pro_pod6;?>" id="pro_pod6" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
<!--      <input type="text" name="pro_sn6" value="<?php  echo $pro_sn6;?>" id="pro_sn6" class="inpfoder" style="width:100%;text-align:center;">-->
     
     <select name="pro_sn6" id="pro_sn6" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn6 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod6)."' ORDER BY group_name ASC");
              while($row_qusn6 = @mysqli_fetch_array($qusn6)){
				  if(chkSeries($conn,$row_qusn6['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn6['group_name'];?>" <?php  if($pro_sn6 == $row_qusn6['group_name']){echo 'selected';}?>><?php  echo $row_qusn6['group_name'];?></option>
                <?php
				  }
                
              }
          ?>
      </select><span id="search_sn6"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn6&pod=<?php echo getpod_id($conn,$pro_pod6);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount6" value="<?php  echo $camount6;?>" id="camount6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice6" value="<?php  echo $cprice6;?>" id="cprice6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">7</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro7" id="cpro7" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro7 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro7 = @mysqli_fetch_array($qupro7)){
                ?>
                  <option value="<?php  echo $row_qupro7['group_id'];?>" <?php  if($cpro7 == $row_qupro7['group_id']){echo 'selected';}?>><?php  echo $row_qupro7['group_name']." ".$row_qupro7['group_detail'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <select name="pro_pod7" id="pro_pod7" class="inputselect" style="width:80%;" onchange="changePod('pro_pod7','pro_sn7','7','<?php echo $_GET['fo_id']?>');">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros7 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros7 = @mysqli_fetch_array($qupros7)){
                ?>
                  <option value="<?php  echo $row_qupros7['group_name'];?>" <?php  if($pro_pod7 == $row_qupros7['group_name']){echo 'selected';}?>><?php  echo $row_qupros7['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod7&protype2=pro_sn7&protype3=7&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      <!--<input type="text" name="pro_pod7" value="<?php  echo $pro_pod7;?>" id="pro_pod7" class="inpfoder" style="width:100%;text-align:center;">--></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
<!--      <input type="text" name="pro_sn7" value="<?php  echo $pro_sn7;?>" id="pro_sn7" class="inpfoder" style="width:100%;text-align:center;">-->
     
     <select name="pro_sn7" id="pro_sn7" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qusn7 = @mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".getpod_id($conn,$pro_pod7)."' ORDER BY group_name ASC");
              while($row_qusn7 = @mysqli_fetch_array($qusn7)){
				  if(chkSeries($conn,$row_qusn7['group_name'],$_GET['fo_id']) == 0){
					  ?>
                  <option value="<?php  echo $row_qusn7['group_name'];?>" <?php  if($pro_sn7 == $row_qusn7['group_name']){echo 'selected';}?>><?php  echo $row_qusn7['group_name'];?></option>
                <?php
				  }
                
              }
          ?>
      </select><span id="search_sn7"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_sn.php?protype=pro_sn7&pod=<?php echo getpod_id($conn,$pro_pod7);?>&fo_id=<?php echo $_GET['fo_id'];?>');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></span>
      
      
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount7" value="<?php  echo $camount7;?>" id="camount7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice7" value="<?php  echo $cprice7;?>" id="cprice7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
    </tr>

    <tr>

      <td colspan="7" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;"><strong>หมายเหตุ :</strong><br><textarea name="ccomment" id="ccomment" ><?php  echo strip_tags($ccomment);?></textarea><br></td>

    </tr>

    </table><br>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td style="border:0;padding:0;width:60%;vertical-align:top;">

            	<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                  <th width="10%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>

                  <th width="75%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>

                  <th width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>

              </tr>

              <tr>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro1" value="<?php  echo $cs_pro1;?>" id="cs_pro1" class="inpfoder" style="width:90%;height:27px;"></td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount1" value="<?php  echo $cs_amount1;?>" id="cs_amount1" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>

              </tr>

              <tr>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro2" value="<?php  echo $cs_pro2;?>" id="cs_pro2" class="inpfoder" style="width:90%;height:27px;"></td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount2" value="<?php  echo $cs_amount2;?>" id="cs_amount2" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>

              </tr>

              <tr>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro3" value="<?php  echo $cs_pro3;?>" id="cs_pro3" class="inpfoder" style="width:90%;height:27px;"></td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount3" value="<?php  echo $cs_amount3;?>" id="cs_amount3" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>

              </tr>

              <tr>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro4" value="<?php  echo $cs_pro4;?>" id="cs_pro4" class="inpfoder" style="width:90%;height:27px;"></td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount4" value="<?php  echo $cs_amount4;?>" id="cs_amount4" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>

              </tr>

              <tr>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="cs_pro5" value="<?php  echo $cs_pro5;?>" id="cs_pro5" class="inpfoder" style="width:90%;height:27px;"></td>

                <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><input type="text" name="cs_amount5" value="<?php  echo $cs_amount5;?>" id="cs_amount5" class="inpfoder" style="width:90%;text-align:center;height:27px;"></td>

              </tr>

            </table></td>

            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:12px;border:1px solid #000000;padding-top:10px;"><p><strong>

             เลขที่สัญญา : <input type="text" name="r_id" value="<?php  echo $r_id;?>" id="r_id" class="inpfoder" >&nbsp;&nbsp;อายุสัญญาเช่า : <input type="text" name="r_idrent" value="<?php  echo $r_idrent;?>" id="r_idrent" class="inpfoder" style="text-align:center;width:15%;"> เดือน<br><br>

              การรับประกันเครื่อง/อะใหล่ : <input type="text" name="garun_id" value="<?php  echo $garun_id;?>" id="garun_id" class="inpfoder" style="width: 40px;text-align: center;"> เดือน

              <br><br>

              วันเริ่ม : </strong>

              <input type="text" name="date_quf" readonly value="<?php  if($date_quf==""){echo date("d/m/Y");}else{ echo $date_quf;}?>" class="inpfoder" style="width: 70px;"/>

              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_quf'});</script> 

              <strong>&nbsp;สิ้นสุด : </strong>

              <input type="text" name="date_qut" readonly value="<?php  if($date_qut==""){echo date("d/m/Y");}else{ echo $date_qut;}?>" class="inpfoder" style="width: 70px;"/>

              <script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_qut'});</script><br>

              <div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา</strong>

              <input type="text" name="cs_sign" value="<?php  echo $cs_sign;?>" id="cs_sign" class="inpfoder" style="width:50%;">

              <br><br></div>

              <br><strong>เงื่อนไขการชำระเงิน :<br>

              <textarea name="qucomment" id="qucomment" style="height:50px;"><?php  echo strip_tags($qucomment);?></textarea>

              </strong><!--<br>

                <br>

                <strong>กำหนดวางบิล : </strong>ตั้งแต่วันที่ 12-15 ของเดือน-->

              </p></td>

          </tr>

        </table>

  <br>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr>

      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>บุคคลติดต่อทางด้านการเงิน : <input type="text" name="cs_contact" value="<?php  echo $cs_contact;?>" id="cs_contact" class="inpfoder" style="width:50%;"></strong></td>

      <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"> <strong>โทรศัพท์ : </strong><input type="text" name="cs_tel" value="<?php  echo $cs_tel;?>" id="cs_tel" class="inpfoder" style="width:50%;"></td>

    </tr>

    <tr>

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ส่งสินค้า : </strong> <?php echo getShipSetupPro($conn,$fo_id,1);?>
      <!-- <input type="text" name="cs_ship" readonly value="<?php  /*if($cs_ship==""){echo date("d/m/Y");}else{ echo $cs_ship;}*/?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_ship'});</script></td> -->

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>วันที่ติดตั้งเครื่อง : </strong> <?php echo getShipSetupPro($conn,$fo_id,2);?>
      <!-- <input type="text" name="cs_setting" readonly value="<?php  /*if($cs_setting==""){echo date("d/m/Y");}else{ echo $cs_setting;}*/?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'cs_setting'});</script></td> -->

    </tr>

    <tr>

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>การบริการ : </strong><strong>

        <select name="service_type" id="service_type" class="inputselect" style="width:50%;">

         	<option value="">กรุณาเลือกการบริการ</option>

          <?php 

                	$quservicetype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");

					while($row_servicetype = @mysqli_fetch_array($quservicetype)){

            if($row_servicetype['group_id'] == 8 || $row_servicetype['group_id'] == 37 || $row_servicetype['group_id'] == 38 || $row_servicetype['group_id'] == 39 || $row_servicetype['group_id'] == 97 || $row_servicetype['group_id'] == 100 || $row_servicetype['group_id'] == 101 || $row_servicetype['group_id'] == 102){

					  ?>

              <option value="<?php  echo $row_servicetype['group_id'];?>" <?php  if($service_type == $row_servicetype['group_id']){echo 'selected';}?>><?php  echo $row_servicetype['group_name'];?></option>

          <?php 	

            }

					}

				?>

        </select>

      </strong></td>

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">

      	<strong>กำหนดเดือนเข้าบริการ</strong>

      	<select name="service_month" id="service_month" class="inputselect" style="width:50%;">
         	<option value="0">กรุณาเลือกเดือน</option>
         	<?php
				$serviceMonth = array ('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤศจิกายน','ธันวาคม');
			
				for($i=1;$i<=count($serviceMonth);$i++){
					?>
					<option value="<?php echo $i;?>" <?php if($service_month == $i){echo 'selected';}?>><?php echo $serviceMonth[$i-1]?></option>
					<?php
				}
			?>

         
        </select>  

      </td>

    </tr>
    
    <tr>

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;"><strong>ชื่อช่างเข้าบริการ :</strong><strong>
      
      <select name="technic_service" id="technic_service" class="inputselect" style="width:50%;">

                    <option value="">กรุณาเลือกช่าง</option>

                    <?php 

                	$qutechtype = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");

					while($row_techtype = @mysqli_fetch_array($qutechtype)){

					  ?>

                    <option value="<?php  echo $row_techtype['group_id'];?>" <?php  if($technic_service == $row_techtype['group_id']){echo 'selected';}?>><?php  echo $row_techtype['group_name'];?></option>

                    <?php 	

					}

				?>

                  </select>
      
      </strong></td>

      <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:10px;">

		<strong>โซน/ภาค </strong>

      	<select name="service_zone" id="service_zone" class="inputselect" style="width:50%;">

         	<option value="">กรุณาเลือกโซน/ภาค</option>

          <?php 

                	$quservicezone = @mysqli_query($conn,"SELECT * FROM s_group_zone ORDER BY group_name ASC");

					while($row_servicezone = @mysqli_fetch_array($quservicezone)){

					  ?>

          <option value="<?php  echo $row_servicezone['group_id'];?>" <?php  if($service_zone == $row_servicezone['group_id']){echo 'selected';}?>><?php  echo $row_servicezone['group_name'];?></option>

          <?php 	

					}

				?>

        </select>      	

      </td>

    </tr>

  </table>

  <br>

  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">

      <tr>

        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >

<!--
                  <select name="cs_company" id="cs_company" class="inputselect" style="width:50%;">

                    <option value="">กรุณาเลือกช่างบริการ</option>

                    <?php 

                	$qutechtype = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");

					while($row_techtype = @mysqli_fetch_array($qutechtype)){

					  ?>

                    <option value="<?php  echo $row_techtype['group_id'];?>" <?php  if($cs_company == $row_techtype['group_id']){echo 'selected';}?>><?php  echo $row_techtype['group_name'];?></option>

                    <?php 	

					}

				?>

                  </select>
-->
                
                <select name="cs_company" id="cs_company" class="inputselect" style="width:50%;">

                <?php 

                	$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");

					while($row_saletype = @mysqli_fetch_array($qusaletype)){

					  ?>

					  	<option value="<?php  echo $row_saletype['group_id'];?>" <?php  if($cs_company == $row_saletype['group_id']){echo 'selected';}?>><?php  echo $row_saletype['group_name'];?></option>

					  <?php 	

					}

				?>

            </select>

                </strong></td>

              </tr>

              <tr>

                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>

              </tr>

              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date1" value="<?php if($sign_date1 == ""){echo date("d/m/Y");}else{ echo $sign_date1;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date1'});</script></strong>
                </td>
              </tr>

            </table>



        </td>

        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                <?php 
                    if($cs_sell != 0){
                    ?>
                    <?php echo getsalename($conn,$cs_sell);?>
                    <?php
                    }else{
                      echo "<br>";
                    }
                    ?>
                    <input type="hidden" name="cs_sell" value="<?php echo $cs_sell;?>">
                <!-- <input type="text" name="cs_sell" value="<?php  echo $cs_sell;?>" id="cs_sell" class="inpfoder" style="width:50%;text-align:center;"> -->

              </strong></td>

              </tr>

              <tr>

                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>Sale Manager / ตรวจสอบการขาย</strong></td>

              </tr>

              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date2" value="<?php if($sign_date2 == ""){echo date("d/m/Y");}else{ echo $sign_date2;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date2'});</script></strong>
                </td>
              </tr>

            </table>

        </td>

        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">

        	<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                <?php 
                    if($cs_aceep != 0){
                    ?>
                    <?php echo getsalename($conn,$cs_aceep);?>
                    <?php
                    }else{
                      echo "<br>";
                    }
                    ?>
                    <input type="hidden" name="cs_aceep" value="<?php echo $cs_aceep;?>">  
                <!-- <input type="text" name="cs_aceep" value="<?php  echo $cs_aceep;?>" id="cs_aceep" class="inpfoder" style="width:50%;text-align:center;"> -->
              </strong></td>

              </tr>

              <tr>

                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>GM / ผู้อนุมัติการขาย</strong></td>

              </tr>

              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>วันที่: <input type="text" name="sign_date3" value="<?php if($sign_date3 == ""){echo date("d/m/Y");}else{ echo $sign_date3;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'sign_date3'});</script></strong>
                </td>
              </tr>

            </table>

        </td>

      </tr>

    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">

      <tr>

        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">

        <strong>หมายเหตุอื่นๆ :</strong>

        <br>

        <textarea name="remark" id="remark" style="height:150px;"><?php  echo strip_tags($remark);?></textarea>

        </td>

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

      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php  echo $status_use;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">
      <input name="approve" type="hidden" id="approve" value="<?php  echo $approve;?>">
      <input name="approve2" type="hidden" id="approve2" value="<?php  echo $approve2;?>">
      <!-- <input name="date_qut_old" type="hidden" id="date_qut_old" value="<?php  echo $date_qut;?>"> -->
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">

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

