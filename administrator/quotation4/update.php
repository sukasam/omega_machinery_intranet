<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
	include_once ("config.php");
  
  $vowels = array(",");

	if ($_POST['mode'] <> "") {
		$param = "";
		$a_not_exists = array();
    $param = get_param($a_param,$a_not_exists);
    
    $_POST['cd_name'] = addslashes($_POST['cd_name']);
    $_POST['cd_address'] = addslashes($_POST['cd_address']);
    $_POST['c_contact'] = addslashes($_POST['c_contact']);
		
		
		$a_sdate=explode("/",$_POST['pay_apv']);
		$_POST['pay_apv']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$date_forder = $_POST['date_forder'];
		$a_sdate=explode("/",$_POST['date_forder']);
		$date_forder = $a_sdate[0]."-".$a_sdate[1]."-".($a_sdate[2]+543);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		

		$a_sdate=explode("/",$_POST['cs_ship']);
		$_POST['cs_ship']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_setting']);
    $_POST['cs_setting']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_sell']);
    $_POST['date_sell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_hsell']);
    $_POST['date_hsell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_account']);
		$_POST['date_account']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_quf']);
		$_POST['date_quf']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_qut']);
		$_POST['date_qut']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST['ccomment'] = nl2br($_POST['ccomment']);
		$_POST['qucomment'] = nl2br($_POST['qucomment']);
		
		$_POST['cpro1'] = nl2br($_POST['cpro1']);
		$_POST['cpro2'] = nl2br($_POST['cpro2']);
		$_POST['remark'] = nl2br(addslashes($_POST['remark']));

		$_POST['separate'] = 0;

		$_POST["cprice1"] = str_replace($vowels,"",$_POST["cprice1"]);
		$_POST["cprice2"] = str_replace($vowels,"",$_POST["cprice2"]);
		$_POST["cprice3"] = str_replace($vowels,"",$_POST["cprice3"]);
		$_POST["cprice4"] = str_replace($vowels,"",$_POST["cprice4"]);
		$_POST["cprice5"] = str_replace($vowels,"",$_POST["cprice5"]);
		$_POST["cprice6"] = str_replace($vowels,"",$_POST["cprice6"]);
		$_POST["cprice7"] = str_replace($vowels,"",$_POST["cprice7"]);
		
    $_POST["paym"] = str_replace($vowels,"",$_POST["paym"]);
    $_POST["paym2"] = str_replace($vowels,"",$_POST["paym2"]);
    $_POST["paym3"] = str_replace($vowels,"",$_POST["paym3"]);
		$_POST["pays"] = str_replace($vowels,"",$_POST["pays"]);
		$_POST["paysa"] = str_replace($vowels,"",$_POST["paysa"]);
    $_POST["paysad"] = str_replace($vowels,"",$_POST["paysad"]);
    
$sumTotal = 0;

if($_POST['cpro1'] != ""){
  if($_POST['pro_sn1'] == ""){
    $_POST['pro_sn1'] = 1;
  }
  $totalSub1 = $_POST['pro_sn1'] * $_POST['camount1'];
  if($_POST['cprice1'] != ""){$totalSub1 = $totalSub1 - $_POST['cprice1'];
  }else{$_POST['cprice1'] = "";}
  $sumTotal = $sumTotal+$totalSub1;
  if($totalSub1 != "" || $totalSub1 != 0){
    $totalSub1s = number_format($totalSub1);
  }
}

if($_POST['cpro2'] != ""){
  if($_POST['pro_sn2'] == ""){
    $_POST['pro_sn2'] = 1;
  }
  $totalSub2 = $_POST['pro_sn2'] * $_POST['camount2'];
  if($_POST['cprice2'] != ""){$totalSub2 = $totalSub2 - $_POST['cprice2'];
  }else{$_POST['cprice2'] = "";}
  $sumTotal = $sumTotal+$totalSub2;
  if($totalSub2 != "" || $totalSub2 != 0){
    $totalSub2s = number_format($totalSub2);
  }
}
		
		if($_POST["payc"] == "1"){
      
      $_POST['guaran3'] = "";
      $_POST['guaran4'] = "0";

      if($_POST['paym'] != ""){
        $_POST['paym2'] = $sumtotals - $_POST['paym'];
      }

      // if($_POST['guaran3'] != ""){
      //   $_POST['paym'] = ($_POST['guaran3']/100)*$sumtotals;
      //   $_POST['guaran4'] = ($_POST['guaran3']/100)*$sumtotals;
      //   $_POST['paym2'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals));
      // }else{
      //   $_POST['paym'] = "0";
      //   $_POST['paym2'] = $sumtotals;
      //   $_POST['guaran4'] = "0";
      // }

			$_POST['pays'] = "";
			$_POST['paysa'] = "0";
			$_POST['paysad'] = "";
		}else{
      
      if($_POST['pays'] != ""){
        if($_POST['guaran3'] != ""){
          //$_POST['paysa'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals)) / $_POST['pays'];
          $_POST['paysa'] = $sumtotals / $_POST['pays'];
          $_POST['guaran4'] = ($_POST['guaran3']/100)*$sumtotals;
        }else{
          $_POST['paysa'] = $sumtotals / $_POST['pays'];
          $_POST['guaran4'] = "0";
        }
        
      }
      
      $_POST['paym'] = "0";
      $_POST['paym2'] = "0";
      $_POST['paym3'] = "0";
		}

		if ($_POST['mode'] == "add") {

				$_POST['fs_id'] = get_snfirstorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;
				$_POST['st_setting'] = 0;
			
				$_POST['loc_name'] = addslashes($_POST['loc_name']);

        if($_POST['type_service'] == 4 || $_POST['type_service'] === "4" ){
          $_POST['type_service_dsc'] = addslashes($_POST['type_service_dsc']);
        }else{
          $_POST['type_service_dsc'] = "";
        }

				include_once "../include/m_add.php";
				$id = mysqli_insert_id($conn);

        if ($_FILES['pro_img1s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');	
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img1s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img1s']['name']);
              //$sizes = $value;
              uploadfile($path,$filename,$_FILES['pro_img1s']['tmp_name'],$width, $quality);
          } // end foreach				
            $sql = "update $tbl_name set pro_img1  = '".$filename."' where $PK_field = '".$id."' ";
            @mysqli_query($conn,$sql);	
            $pro_img1 = $filename;
          } // end if ($_FILES[ufimages][name] != "")	

          if ($_FILES['pro_img2s']['name'] != "") { 
            $mname="";
            $mname=gen_random_num(5);
            $a_size = array('250');	
            $filename = "";
            foreach($a_size as $key => $value) {
              $path = "../../upload/quotation/";
              $quality = 80;
              if($filename == "")
                $name_data=explode(".",$_FILES['pro_img2s']['name']);
                $type=$name_data[1];
                $filename =$mname.".".$type;
                list($width, $height) = getimagesize($_FILES['pro_img2s']['name']);
                //$sizes = $value;
                uploadfile($path,$filename,$_FILES['pro_img2s']['tmp_name'],$width, $quality);
            } // end foreach				
              $sql = "update $tbl_name set pro_img2  = '".$filename."' where $PK_field = '".$id."' ";
              @mysqli_query($conn,$sql);			
              $pro_img2 = $filename;	
            } // end if ($_FILES[ufimages][name] != "")	
			
				//require_once("genpdf.php");

				include_once("../mpdf54/mpdf.php");
				include_once("form_quotation.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/quotation/'.$chaf.'.pdf','F');

       // header("Location:update.php?mode=update&qu_id=".$id);
			header ("location:index.php?" . $param);
		}
		if ($_POST['mode'] == "update" ) {
				
				$_POST['loc_name'] = addslashes($_POST['loc_name']);

        if($_POST['type_service'] == 4 || $_POST['type_service'] === "4" ){
          $_POST['type_service_dsc'] = addslashes($_POST['type_service_dsc']);
        }else{
          $_POST['type_service_dsc'] = "";
        }
				
				include_once ("../include/m_update.php");
				$id = $_REQUEST[$PK_field];


        if ($_FILES['pro_img1s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');				
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            @unlink($path.$_POST['pro_img1']);
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img1s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img1s']['name']);
              uploadfile($path,$filename,$_FILES['pro_img1s']['tmp_name'],$width, $quality);
          } // end foreach				
          $sql = "update $tbl_name set pro_img1 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);		
          $pro_img1 = $filename;		
        } // end if ($_FILES[ufimages][name] != "")
        else{
          $pro_img1 = $_POST['pro_img1'];
        }

        if ($_FILES['pro_img2s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');				
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            @unlink($path.$_POST['pro_img2']);
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img2s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img2s']['name']);
              uploadfile($path,$filename,$_FILES['pro_img2s']['tmp_name'],$width, $quality);
          } // end foreach				
          $sql = "update $tbl_name set pro_img2 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);	
          $pro_img2 = $filename;			
        } // end if ($_FILES[ufimages][name] != "")
        else{
          $pro_img2 = $_POST['pro_img2'];
        }

        $paths = "../../upload/quotation/";

        if($_POST['deleteimg1'] === '1'){
          @unlink($paths.$_POST['pro_img1']);
          $sql = "update $tbl_name set pro_img1 = '' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img3 = "";
        }
        if($_POST['deleteimg2'] === '1'){
          @unlink($paths.$_POST['pro_img2']);
          $sql = "update $tbl_name set pro_img2 = '' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img2 = "";
        }
			
				//require_once("genpdf.php");
			
				include_once("../mpdf54/mpdf.php");
				include_once("form_quotation.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/quotation/'.$chaf.'.pdf','F');

        //header("Location:update.php?mode=update&qu_id=".$id);
			header ("location:index.php?" . $param);
		}
	}
	if ($_GET['mode'] == "add") {
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
		 $cpro1 = '- เข้าบริการตรวจเช็คเครื่องล้างจาน  2เดือน / ครั้ง<br>
- กรณีเครื่องเสีย  บริการซ่อม, เปลี่ยนอะไหล่ให้  ฟรีทันที โดยไม่ต้องเสนอราคา';
		 $cpro2 = '- เข้าบริการตรวจเช็คเครื่องล้างจาน  2เดือน / ครั้ง<br>
- กรณีเครื่องเสีย ค่าบริการซ่อมฟรี และเสนอราคาขออนุมัติซ่อม ลดราคาอะไหล่ 10%';
	}
	if ($_GET['mode'] == "update") {
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) {
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) {
				$$value = $rec[$value];
			}
		}

		$a_sdate=explode("-",$pay_apv);
		$pay_apv=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_ship);
		$cs_ship=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_setting);
    $cs_setting=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    $a_sdate=explode("-",$date_sell);
    $date_sell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$date_hsell);
    $date_hsell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$date_account);
    $date_account=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_quf);
		$date_quf=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_qut);
    $date_qut=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    $sumTotal = 0;

if($cpro1 != ""){
//  if($pro_sn1 == ""){
//    $pro_sn1 = 1;
//  }
//  $totalSub1 = $pro_sn1 * $camount1;
//  if($cprice1 != ""){$totalSub1 = $totalSub1 - $cprice1;
//  }else{$cprice1 = "";}
//  $sumTotal = $sumTotal+$totalSub1;
//  if($totalSub1 != "" || $totalSub1 != 0){
//    $totalSub1s = number_format($totalSub1);
//  }
}else{
	$cpro1 = '- เข้าบริการตรวจเช็คเครื่องล้างจาน  2เดือน / ครั้ง<br>
- กรณีเครื่องเสีย  บริการซ่อม, เปลี่ยนอะไหล่ให้  ฟรีทันที โดยไม่ต้องเสนอราคา';
}

if($cpro2 != ""){
//  if($pro_sn2 == ""){
//    $pro_sn2 = 1;
//  }
//  $totalSub2 = $pro_sn2 * $camount2;
//  if($cprice2 != ""){$totalSub2 = $totalSub2 - $cprice2;
//  }else{$cprice2 = "";}
//  $sumTotal = $sumTotal+$totalSub2;
//  if($totalSub2 != "" || $totalSub2 != 0){
//    $totalSub2s = number_format($totalSub2);
//  }
}else{
	$cpro2 = '- เข้าบริการตรวจเช็คเครื่องล้างจาน  2เดือน / ครั้ง<br>
- กรณีเครื่องเสีย ค่าบริการซ่อมฟรี และเสนอราคาขออนุมัติซ่อม ลดราคาอะไหล่ 10%';
}

$sumprice = $camount1 + $camount2;
$sumpricevat = $sumprice * 0.07;
$sumtotals = $sumprice + $sumpricevat;



	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
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
	
function handleClick(myRadio) {
	
	var cpro1 =  document.getElementById('cpro1').value;
	var cpro2 =  document.getElementById('cpro2').value;
	var remark =  document.getElementById('remark').value;
	var type_service_dsc =  document.getElementById('type_service_dsc').value;

  document.querySelectorAll('input[name="chk_mac_size1"]').forEach(radio => radio.checked = false);
  document.querySelectorAll('input[name="chk_mac_size2"]').forEach(radio => radio.checked = false);

	if(myRadio.value == 2){
		//alert("M2"+myRadio.value);
		document.getElementById('repType1').innerHTML = 'เครื่องล้างแก้ว';
		document.getElementById('repType2').innerHTML = 'เครื่องล้างแก้ว';
		document.getElementById('repType3').innerHTML = 'เครื่องล้างแก้ว';
		document.getElementById('repType4').innerHTML = 'เครื่องล้างแก้ว';
    document.getElementById('repTypeChk1').innerHTML = 'ขนาดเล็ก Under Counter';
    document.getElementById('repTypeChk2').innerHTML = 'ขนาดกลาง Hoodtype';
    document.getElementById('repTypeChk3').innerHTML = 'ขนาดใหญ่ Conveyer';

	}else if(myRadio.value == 3){
		//alert("M3"+myRadio.value);
		document.getElementById('repType1').innerHTML = 'เครื่องผลิตน้ำแข็ง';
		document.getElementById('repType2').innerHTML = 'เครื่องผลิตน้ำแข็ง';
		document.getElementById('repType3').innerHTML = 'เครื่องผลิตน้ำแข็ง';
		document.getElementById('repType4').innerHTML = 'เครื่องผลิตน้ำแข็ง';
    document.getElementById('repTypeChk1').innerHTML = 'ขนาดเล็ก Small Size';
    document.getElementById('repTypeChk2').innerHTML = 'ขนาดกลาง Medium Size';
    document.getElementById('repTypeChk3').innerHTML = 'ขนาดใหญ่ Large Size';
		
	}else if(myRadio.value == 4){
		//alert("M3"+myRadio.value);
		document.getElementById('repType1').innerHTML = 'อื่นๆ';
		document.getElementById('repType2').innerHTML = 'อื่นๆ';
		document.getElementById('repType3').innerHTML = 'อื่นๆ';
		document.getElementById('repType4').innerHTML = 'อื่นๆ';
    document.getElementById('repTypeChk1').innerHTML = 'ขนาดเล็ก';
    document.getElementById('repTypeChk2').innerHTML = 'ขนาดกลาง';
    document.getElementById('repTypeChk3').innerHTML = 'ขนาดใหญ่';
    
		
	}else{
		//alert("M1"+myRadio.value);
		document.getElementById('repType1').innerHTML = 'เครื่องล้างจาน';
		document.getElementById('repType2').innerHTML = 'เครื่องล้างจาน';
		document.getElementById('repType3').innerHTML = 'เครื่องล้างจาน';
		document.getElementById('repType4').innerHTML = 'เครื่องล้างจาน';
    document.getElementById('repTypeChk1').innerHTML = 'ขนาดเล็ก Under Counter';
    document.getElementById('repTypeChk2').innerHTML = 'ขนาดกลาง Hoodtype';
    document.getElementById('repTypeChk3').innerHTML = 'ขนาดใหญ่ Conveyer';
		
	}
	
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'call_api.php?action=replaceSrt&id='+myRadio.value+'&cpro1='+cpro1+'&cpro2='+cpro2+'&remark='+remark+'&type_service_dsc='+type_service_dsc;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split('|');
			//console.log(JSON.stringify(ds));
			
			document.getElementById('cpro1').innerHTML = ds[1];
			document.getElementById('cpro2').innerHTML = ds[2];
			document.getElementById('remark').innerHTML = ds[3];
				
			
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
	
}

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}


</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY style="font-size:13px">
<style>
	input{
		font-size:13px !important;
	}
	select{
		font-size:13px !important;
	}
	textarea{
		font-size:13px !important;
	}
</style>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../quotation4/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
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
    <td style="padding-bottom:5px;">
    <?php 
    //$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`= ".$qu_id);
    $headerIMG = "../images/form/header-qarc.png";
    ?>
    <img src="<?php echo $headerIMG;?>" width="100%" /></td>
  </tr>
</table>
  
  <table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;border: 0px;">
            <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_c.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>เลขที่ใบเสนอราคาสัญญาบริการ:</strong> 
            <input type="text" value="<?php  if($fs_id == ""){echo check_quotation4($conn);}else{echo $fs_id;};?>" class="inpfoder" readonly style="border: 0px;"> 
            <input type="hidden" name="fs_id" value="<?php  if($fs_id == ""){echo check_quotation4($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" style="border: 0px;"> 
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อร้าน :</strong> <input type="text" name="loc_name" value="<?php  echo $loc_name;?>" id="loc_name" class="inpfoder" style="border: 0px;width: 60%;"></td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>วันที่ :</strong> <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script></td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>ใบเสนอราคาสัญญาบริการ :</strong> <input type="radio" name="type_service" value="1" <?php if($type_service == '1' || $type_service == '0' || $type_service == ''){echo 'checked';}?> onclick="handleClick(this);"> เครื่องล้างจาน
				&nbsp;&nbsp;<input type="radio" name="type_service" value="2" <?php if($type_service == '2'){echo 'checked';}?> onclick="handleClick(this);"> เครื่องล้างแก้ว
				&nbsp;&nbsp;<input type="radio" name="type_service" value="3" <?php if($type_service == '3'){echo 'checked';}?> onclick="handleClick(this);"> เครื่องผลิตน้ำแข็ง            
        &nbsp;&nbsp;<input type="radio" name="type_service" value="4" <?php if($type_service == '4'){echo 'checked';}?> onclick="handleClick(this);"> อื่นๆ ระบุ  
        &nbsp;&nbsp;<input type="text" name="type_service_dsc" value="<?php  echo $type_service_dsc;?>" id="type_service_dsc" class="inpfoder"         
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <select name="cd_province" id="cd_province" class="inputselect" style="border: 0px;">
                <?php
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
					while($row_province = @mysqli_fetch_array($quprovince)){
					  ?>
					  	<option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
					  <?php
					}
				?>
            </select>
           	</td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
              <strong>ชื่อพนักงานขาย : </strong>
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
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder" style="border: 0px;">
              <strong>อีเมล :</strong>
              <input type="text" name="cd_email" value="<?php  echo $cd_email;?>" id="cd_email" class="inpfoder" style="border: 0px;">
              <input type="hidden" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder" style="border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder" style="border: 0px;">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder" style="border: 0px;">
            </td>
          </tr>
</table>

  <br>
<table width="100%" cellspacing="0" cellpadding="0" style="font-size:13pxtext-align:center;">
    <tr>
      <td width="3%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="40%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการสินค้า</strong></td>
      <td width="20%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="7%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา</strong></td>
<!--
      <td width="10%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
-->
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">1<br><input type="checkbox" name="chkserv1" value="1" <?php if($chkserv1 == '1'){echo 'checked';}?>></td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">
        <p>
        <strong>สัญญาบริการรายปี สำหรับ<span id="repType1"><?php echo getTypeService($type_service);?></span> <u>แบบรวมอะไหล่</u></strong><br>
        <strong>1.1 <span id="repType2"><?php echo getTypeService($type_service);?></span></strong>
        <input type="radio" name="chk_mac_size1" value="1" <?php if($chk_mac_size1 == '1'){echo 'checked';}?>> <span id="repTypeChk1"><?php echo getTypeMCSize(1,$type_service);?></span>  
        <input type="radio" name="chk_mac_size1" value="2" <?php if($chk_mac_size1 == '2'){echo 'checked';}?>> <span id="repTypeChk2"><?php echo getTypeMCSize(2,$type_service);?></span> 
        <input type="radio" name="chk_mac_size1" value="3" <?php if($chk_mac_size1 == '3'){echo 'checked';}?>> <span id="repTypeChk3"><?php echo getTypeMCSize(3,$type_service);?></span>
        </p>
      	<textarea name="cpro1" id="cpro1" style="height:50px;"><?php echo strip_tags(getTypeServiceDesc($type_service,$cpro1));?></textarea>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod1" id="pro_pod1" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros1 = @mysqli_fetch_array($qupros1)){
                ?>
                  <option value="<?php  echo $row_qupros1['group_name'];?>" <?php  if($pro_pod1 == $row_qupros1['group_name']){echo 'selected';}?>><?php  echo $row_qupros1['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
        <input type="text" name="pro_sn1" value="<?php  echo number_format($pro_sn1, 2, '.', '');?>" id="pro_sn1" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount1" value="<?php  echo number_format($camount1, 2, '.', '');?>" id="camount1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
<!--
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice1" value="<?php  echo $cprice1;?>" id="cprice1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
-->
<!--      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub1s;?>&nbsp;&nbsp;</td>-->
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">2<br><input type="checkbox" name="chkserv2" value="1" <?php if($chkserv2 == '1'){echo 'checked';}?>></td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
        <p><strong>สัญญาบริการรายปี สำหรับ<span id="repType3"><?php echo getTypeService($type_service);?></span> <u>แบบไม่รวมอะไหล่</u></strong></p>
        <p><strong>2.1 <span id="repType4"><?php echo getTypeService($type_service);?></span></strong>
        <input type="radio" name="chk_mac_size2" value="1" <?php if($chk_mac_size2 == '1'){echo 'checked';}?>> <span id="repTypeChk1"><?php echo getTypeMCSize(1,$type_service);?></span>  
        <input type="radio" name="chk_mac_size2" value="2" <?php if($chk_mac_size2 == '2'){echo 'checked';}?>> <span id="repTypeChk2"><?php echo getTypeMCSize(2,$type_service);?></span> 
        <input type="radio" name="chk_mac_size2" value="3" <?php if($chk_mac_size2 == '3'){echo 'checked';}?>> <span id="repTypeChk3"><?php echo getTypeMCSize(3,$type_service);?></span>
        </p>
      	<textarea name="cpro2" id="cpro2" style="height:50px;"><?php echo strip_tags(getTypeServiceDesc($type_service,$cpro2));?></textarea></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod2" id="pro_pod2" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros2 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros2 = @mysqli_fetch_array($qupros2)){
                ?>
                  <option value="<?php  echo $row_qupros2['group_name'];?>" <?php  if($pro_pod2 == $row_qupros2['group_name']){echo 'selected';}?>><?php  echo $row_qupros2['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="pro_sn2" value="<?php  echo number_format($pro_sn2, 2, '.', '');?>" id="pro_sn2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount2" value="<?php  echo number_format($camount2, 2, '.', '');?>" id="camount2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
<!--
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <input type="text" name="cprice2" value="<?php  echo $cprice2;?>" id="cprice2" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub2s;?>&nbsp;&nbsp;</td>
-->
    </tr>
<!--
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">3</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro3" id="cpro3" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro3 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro3 = @mysqli_fetch_array($qupro3)){
                ?>
                  <option value="<?php  echo $row_qupro3['group_id'];?>" <?php  if($cpro3 == $row_qupro3['group_id']){echo 'selected';}?>><?php  echo $row_qupro3['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod3" id="pro_pod3" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros3 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros3 = @mysqli_fetch_array($qupros3)){
                ?>
                  <option value="<?php  echo $row_qupros3['group_name'];?>" <?php  if($pro_pod3 == $row_qupros3['group_name']){echo 'selected';}?>><?php  echo $row_qupros3['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn3" value="<?php  echo $pro_sn3;?>" id="pro_sn3" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount3" value="<?php  echo $camount3;?>" id="camount3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice3" value="<?php  echo $cprice3;?>" id="cprice3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub3s;?>&nbsp;&nbsp;</td>
    </tr>
-->
<!--
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">4</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro4" id="cpro4" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro4 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro4 = @mysqli_fetch_array($qupro4)){
                ?>
                  <option value="<?php  echo $row_qupro4['group_id'];?>" <?php  if($cpro4 == $row_qupro4['group_id']){echo 'selected';}?>><?php  echo $row_qupro4['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod4" id="pro_pod4" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros4 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros4 = @mysqli_fetch_array($qupros4)){
                ?>
                  <option value="<?php  echo $row_qupros4['group_name'];?>" <?php  if($pro_pod4 == $row_qupros4['group_name']){echo 'selected';}?>><?php  echo $row_qupros4['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn4" value="<?php  echo $pro_sn4;?>" id="pro_sn4" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount4" value="<?php  echo $camount4;?>" id="camount4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice4" value="<?php  echo $cprice4;?>" id="cprice4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub4s;?>&nbsp;&nbsp;</td>
    </tr>
-->
<!--
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">5</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro5" id="cpro5" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro5 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro5 = @mysqli_fetch_array($qupro5)){
                ?>
                  <option value="<?php  echo $row_qupro5['group_id'];?>" <?php  if($cpro5 == $row_qupro5['group_id']){echo 'selected';}?>><?php  echo $row_qupro5['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod5" id="pro_pod5" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros5 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros5 = @mysqli_fetch_array($qupros5)){
                ?>
                  <option value="<?php  echo $row_qupros5['group_name'];?>" <?php  if($pro_pod5 == $row_qupros5['group_name']){echo 'selected';}?>><?php  echo $row_qupros5['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn5" value="<?php  echo $pro_sn5;?>" id="pro_sn5" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount5" value="<?php  echo $camount5;?>" id="camount5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice5" value="<?php  echo $cprice5;?>" id="cprice5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub5s;?>&nbsp;&nbsp;</td>
    </tr>
-->
<!--
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">6</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro6" id="cpro6" class="inputselect" style="width:90%;" >
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro6 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro6 = @mysqli_fetch_array($qupro6)){
                ?>
                  <option value="<?php  echo $row_qupro6['group_id'];?>" <?php  if($cpro6 == $row_qupro6['group_id']){echo 'selected';}?>><?php  echo $row_qupro6['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod6" id="pro_pod6" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros6 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros6 = @mysqli_fetch_array($qupros6)){
                ?>
                  <option value="<?php  echo $row_qupros6['group_name'];?>" <?php  if($pro_pod6 == $row_qupros6['group_name']){echo 'selected';}?>><?php  echo $row_qupros6['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn6" value="<?php  echo $pro_sn6;?>" id="pro_sn6" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount6" value="<?php  echo $camount6;?>" id="camount6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice6" value="<?php  echo $cprice6;?>" id="cprice6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub6s;?>&nbsp;&nbsp;</td>
    </tr>
-->
<!--
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">7</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro7" id="cpro7" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro7 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
              while($row_qupro7 = @mysqli_fetch_array($qupro7)){
                ?>
                  <option value="<?php  echo $row_qupro7['group_id'];?>" <?php  if($cpro7 == $row_qupro7['group_id']){echo 'selected';}?>><?php  echo $row_qupro7['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod7" id="pro_pod7" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros7 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros7 = @mysqli_fetch_array($qupros7)){
                ?>
                  <option value="<?php  echo $row_qupros7['group_name'];?>" <?php  if($pro_pod7 == $row_qupros7['group_name']){echo 'selected';}?>><?php  echo $row_qupros7['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn7" value="<?php  echo $pro_sn7;?>" id="pro_sn7" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount7" value="<?php  echo $camount7;?>" id="camount7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice7" value="<?php  echo $cprice7;?>" id="cprice7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub7s;?>&nbsp;&nbsp;</td>
    </tr>
-->
<!--
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumprice,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumpricevat,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong><?php echo baht_text($sumtotals);?></strong></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumtotals,2);?>&nbsp;&nbsp;</td>
    </tr>
-->
  <tr>
      <td colspan="2" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumprice, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumpricevat, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong><?php echo baht_text($sumtotals); ?></strong></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumtotals, 2); ?>&nbsp;&nbsp;</td>
    </tr>
    </table><br>

    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><strong>รูปภาพประกอบที่ 1 (Size 250px x 150px)</strong></td>
        <td width="50%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><strong>รูปภาพประกอบที่ 2 (Size 250px x 150px)</strong></td>
    </tr>
    <tr>
        <td width="50%" style="border:1px solid #000000;text-align:center;">
        <input type="file" name="pro_img1s"> 
        <?php 
         if($pro_img1 != ""){
          ?><br><br>
           <img src="../../upload/quotation/<?php  echo $pro_img1;?>" height="150"><br>
           <input type="checkbox" id="deleteimg1" name="deleteimg1" value="1"> Delete
          <?php
         }
        ?>
        <input name="pro_img1" type="hidden" value="<?php  echo $pro_img1; ?>">
      </td>
        <td width="50%" style="border:1px solid #000000;text-align:center;">
        <input type="file" name="pro_img2s">
        <?php 
         if($pro_img2 != ""){
          ?><br><br>
           <img src="../../upload/quotation/<?php  echo $pro_img2;?>" height="150"><br>
           <input type="checkbox" id="deleteimg2" name="deleteimg2" value="1"> Delete
          <?php
         }
        ?>
         <input name="pro_img2" type="hidden" value="<?php  echo $pro_img2; ?>">
      </td>
    </tr>
  </table>
  <br/><br/>
	
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <p><strong>เงื่อนไขการชำระเงิน</strong></p> 
        <p>
        	 1. <input type="text" name="pay1" value="<?php echo $pay1;?>" style="text-align: left;width: 500px;"><br>
        	 2. บัญชีสำหรับโอนเงิน ชำระสินค้า</br>
           <span style="padding-left: 14px;color: green;">ธนาคารกสิกรไทย : สาขาสุขาภิบาล 5</span></br>
           <span style="padding-left: 14px;color: green;">บัญชีออมทรัพย์ : บจก.โอเมก้า แมชชีนเนอรี่ (1999) จำกัด</span><br>
           <span style="padding-left: 14px;color: green;">หมายเลขบัญชี : 026-1-810689</span>
        </p>  
        <p><strong>เงื่อนไขการขาย</strong></p>
        <p>
        	 1. ราคาดังกล่าวข้างต้น <input type="text" name="pay2" value="<?php echo $pay2;?>" style="text-align: center;width: 100px;">
           ภาษีมูลค่าเพิ่ม <input type="text" name="pay3" value="<?php echo $pay3;?>" style="text-align: center;width: 50px;">
           ตามที่สรรพากรกำหนดเรียบร้อยแล้ว<br>
        	 2. กำหนดส่งสัญญาภายใน <input type="text" name="giveprice" value="<?php echo $giveprice;?>" style="text-align: center;width: 50px;"> วัน นับตั้งแต่วันอนุมัติทำสัญญา<br>	
        	 3. ภายใต้เงื่อนไขการทำสัญญาบริการ ทางบริษัทโอเมก้าฯ ขอสงวนลิขสิทธิ์ให้ลูกค้าใช้น้ำยาของทางบริษัทโอเมก้าฯเท่านั้น<br/>
           4. กำหนดยี่นราคา <input type="text" name="pay4" value="<?php echo $pay4;?>" style="text-align: center;width: 50px;"> วัน<br/>
           5. ทางบริษัทฯ ขอสงวนสิทธิ์ในกรณีที่ลูกค้าเซ็นอนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆเกิดขึ้นระหว่างดำเนินการ 
           ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น<br/>
          </p>    
        </td>
      </tr>
    </table>
    <br>
    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php  echo getTypeServiceDesc($type_service,strip_tags($remark));?></textarea>
        </td>
      </tr>
    </table>
    <br>
  	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติสั่งซื้อสินค้าตามรายการข้างต้น</strong></td>
              </tr>
              <tr>
                <td style="font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;">
                วันที่ ________________________
                </td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                <select name="cs_technic" id="cs_technic">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							// if($row_custec['group_id'] == 11 || $row_custec['group_id'] == 33 || $row_custec['group_id'] == 34){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $cs_technic){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
							// }
						}
					?>
                </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานฝ่ายช่าง / ผู้เสนอ</strong></td>
              </tr>
              <tr>
              <td style="font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;">
             </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
    </fieldset>
    </div><br>
    <div class="formArea">
      <div style="text-align: center;">
      <input type="button" value=" บันทึก " id="submitF" class="button bt_save" onclick="submitForm()">
      <input type="button" name="Cancel" id="resetF" value=" ยกเลิก " class="button bt_cancel" onClick="window.location='index.php'">
      </div>
      <?php
			$a_not_exists = array();
			post_param($a_param,$a_not_exists);
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php  echo $status_use;?>">
      <input name="quotation" type="hidden" id="quotation" value="<?php  echo $quotation;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">
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
