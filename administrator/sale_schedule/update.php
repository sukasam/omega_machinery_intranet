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

		$_POST['remark'] = nl2br($_POST['remark']);


		if ($_POST["mode"] == "add") { 



				include "../include/m_add.php";

				$id = mysqli_insert_id($conn);

				// include_once("../mpdf54/mpdf.php");
				// include_once("form_firstorder.php");
				// $mpdf=new mPDF('UTF-8'); 

				// $mpdf->SetAutoFont();

				// $mpdf->WriteHTML($form);

				// $chaf = preg_replace("/\//","-",$_POST['fs_id']); 

				// $mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');

				

			header ("location:index.php?" . $param); 

		}

		if ($_POST["mode"] == "update" ) { 

				include ("../include/m_update.php");

				$id = $_REQUEST[$PK_field];			

				

				// include_once("../mpdf54/mpdf.php");

				// include_once("form_firstorder.php");

				// $mpdf=new mPDF('UTF-8'); 

				// $mpdf->SetAutoFont();

				// $mpdf->WriteHTML($form);

				// $chaf = preg_replace("/\//","-",$_POST['fs_id']); 

				// $mpdf->Output('../../upload/first_order/'.$chaf.'.pdf','F');

			

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

  <!-- <tr>

    <td style="padding-bottom:5px;"><img src="../images/form/header-first-order.png" width="100%" border="0" /></td>

  </tr> -->

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า :</strong> 

            <select name="cg_type" id="cg_type" class="inputselect">

                <?php 

                	$qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");

					while($row_cgtype = @mysqli_fetch_array($qucgtype)){
						if(substr($row_cgtype['group_name'],0,2) != "SV"){
					  ?>

					  	<option value="<?php  echo $row_cgtype['group_id'];?>" <?php  if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php  echo $row_cgtype['group_name'];?></option>

					  <?php 	
						}
					}

				?>

            </select>

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

            </select> </td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:80%;"></td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ประเภทสินค้า :</strong> 	

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

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script></td>

          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder">

              <!-- <strong>แฟกซ์ :</strong>

              <input type="text" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder"> -->
              
              </td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"> 
			<strong>รหัสลูกค้า<strong> :</strong>
            <input type="text" name="cusid" value="<?php  echo $cusid;?>" id="cusid" class="inpfoder">
			<strong>ปีลูกค้า<strong> : </strong>
			<input type="text" name="cusyear"value="<?php  echo $cusyear;?>" id="cusyear" class="inpfoder">
			</td>
          </tr>

          <tr>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>อีเมล์ :</strong>

              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder">

              <!-- <strong>เบอร์โทร :</strong>

              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder"> -->
              </td>

            <td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>พนักงานขาย<strong> : 
			<select name="cs_sale" id="cs_sale" class="inputselect" style="width:50%;">
			<option value="">กรุณาเลือกพนักงานขาย</option>
				<?php 

					$qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");

					while($row_saletype = @mysqli_fetch_array($qusaletype)){

					?>

						<option value="<?php  echo $row_saletype['group_id'];?>" <?php  if($cs_sale == $row_saletype['group_id']){echo 'selected';}?>><?php  echo $row_saletype['group_name'];?></option>

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

