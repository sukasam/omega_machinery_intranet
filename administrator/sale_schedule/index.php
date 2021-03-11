<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET["action"] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '".$_GET[$PK_field]."'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php");
		} 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET["b"] <> "" and $_GET["s"] <> "") { 
		if ($_GET["s"] == 0) $status = 1;
		if ($_GET["s"] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql_status = "update $tbl_name set st_setting = '$status' where $PK_field = '".$_GET["b"]."'";
		@mysqli_query($conn,$sql_status);
		if($_GET["page"] != ""){$conpage = "page=".$_GET["page"];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET['bb'] <> "" and $_GET['ss'] <> "") { 
		if ($_GET['ss'] == 0) $status = 1;
		if ($_GET['ss'] == 1) $status = 0;
		Check_Permission($conn,$check_module,$_SESSION["login_id"],"update");
		$sql_status = "update $tbl_name set status = '$status' where $PK_field = '".$_GET['bb']."'";
		@mysqli_query($conn,$sql_status);
		$sql_svstatus = "update s_service_report set st_setting = '$status' where cus_id = '".$_GET["foid"]."'";
		@mysqli_query($conn,$sql_svstatus);
		if($_GET["page"] != ""){$conpage = "page=".$_GET["page"];}
		header ("location:?".$conpage); 
	}
	
	//-------------------------------------------------------------------------------------
	 if ($_GET["ff"] != "" && $_GET["gg"] != "") { 
		if ($_GET["gg"] == 0) $status_use = 0;
		if ($_GET["gg"] == 1) $status_use = 1;
		if ($_GET["gg"] == 2) $status_use = 2;
		if ($_GET["gg"] == 3) $status_use = 3;
    $code = Check_Permission($conn,'กำหนดดาว FO',$_SESSION["login_id"],"update");
    if ($code == "1") {
      $sql_status = "update $tbl_name set status_use = '$status_use' where $PK_field = '".$_GET["ff"]."'";
      @mysqli_query($conn,$sql_status);
      
      if($_GET["page"] != ""){$conpage = "page=".$_GET["page"];}
      header ("location:?".$conpage); 
    }

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
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check_select(frm){
		if (frm.choose_action.value==""){
			alert ('Choose an action');
			frm.choose_action.focus(); return false;
		}
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
<P id=page-intro><?php  echo $page_name; ?></P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="update.php?mode=add<?php  if ($param <> "") echo "&".$param; ?>"><SPAN><IMG  alt=icon src="../images/pencil_48.png"><BR>
    เพิ่มตาราง<br>งานฝ่ายขาย</SPAN></A></LI>
	<LI><A class=shortcut-button href="../schedule_sale/index.php"><SPAN><IMG  alt=icon src="../images/icon2/categories.png"><BR>
  ปฏิทิน<br>งานฝ่ายขาย</SPAN></A></LI>
    <?php  
	if ($FR_module <> "") { 
	$param2 = get_return_param();
	?>
  <LI><A class=shortcut-button href="../<?php  echo $FR_module; ?>/?<?php  if($param2 <> "") echo $param2;?>"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
  <?php  }?>

</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $check_module; ?></H3>
<br><form name="form1" method="get" action="index.php">
    <input name="keyword" type="text" id="keyword" value="<?php  echo $keyword;?>">
    <input name="Action" type="submit" id="Action" value="ค้นหา">
    <?php 
			$a_not_exists = array('keyword');
			$param2 = get_param($a_param,$a_not_exists);
			  ?>
    <a href="index.php?<?php  echo $param2;?>">แสดงทั้งหมด</a>
    <?php  
			/*$a_not_exists = array();
			post_param($a_param,$a_not_exists);*/
			?>
  </form>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <form name="form2" method="post" action="confirm.php" onSubmit="return check_select(this)">
    <TABLE>
      <THEAD>
        <TR>
          <TH width="5%" <?php  Show_Sort_bg ("user_id", $orderby) ?>> <?php 
		$a_not_exists = array('orderby','sortby');
		$param2 = get_param($a_param,$a_not_exists);
	?>
            <?php   Show_Sort_new ("user_id", "ลำดับ.", $orderby, $sortby,$page,$param2);?>
            &nbsp;</TH>
          <TH width="35%">ชื่อลูกค้า</TH>
          <TH width="10%">เบอร์โทร</TH>
          <TH width="10%">อีเมล์</TH>
          <!-- <TH width="18%"><strong></strong></TH> -->
          <!-- <TH width="5%" ><div align="center"><img src="../icons/favorites_use.png" width="15" height="15"> ใช้งาน <br><img src="../icons/favorites_stranby.png" width="15" height="15"> Standby <br> <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก  <br><img src="../icons/favorites_service.png" width="15" height="15"> Service</div></TH>
          <TH width="5%" nowrap ><div align="center"><a> Open / </a><a> Close</a></div></TH>
          <TH width="5%" nowrap ><div align="center"><a>Setting</a></div></TH> -->
          <!-- <TH width="5%"><div align="center"><a>Download</a></div></TH> -->
          <!-- <TH width="10%"><div align="center"><a>สถานนะ</a></div></TH> -->
          <TH width="10%"><div align="center"><a>ตารางงาน</a></div></TH>
          
          <!-- <TH width="5%"><div align="center"><a>เอกสาร</a></div></TH>
          <TH width="5%"><div align="center"><a>Map</a></div></TH> -->
          <TH width="5%"><a>แก้ไข</a></TH>
          <TH width="5%"><a>ลบ</a></TH>
        </TR>
      </THEAD>
      <TFOOT>
        </TFOOT>
      <TBODY>
        <?php  
					if($orderby=="") $orderby = $tbl_name.".".$PK_field;
					if ($sortby =="") $sortby ="DESC";
					
				   	$sql = " select *,$tbl_name.create_date as c_date from $tbl_name  where 1 ";
					if ($_GET[$PK_field] <> "") $sql .= " and ($PK_field  = '" . $_GET[$PK_field] . " ' ) ";					
					if ($_GET[$FR_field] <> "") $sql .= " and ($FR_field  = '" . $_GET[$FR_field] . " ' ) ";					
 					if ($_GET["keyword"] <> "") { 
						$sql .= "and ( " .  $PK_field  . " like '%".$_GET["keyword"]."%' ";
						if (count ($search_key) > 0) { 
							$search_text = " and ( " ;
							foreach ($search_key as $key=>$value) { 
									$subtext .= "or " . $value  . " like '%" . $_GET["keyword"] . "%'";
							}	
						}
						$sql .=  $subtext . " ) ";
					} 
					if ($orderby <> "") $sql .= " order by " . $orderby;
					if ($sortby <> "") $sql .= " " . $sortby;
					include ("../include/page_init.php");
					// echo $sql;
					$query = @mysqli_query($conn,$sql);
					if($_GET["page"] == "") $_GET["page"] = 1;
					$counter = ($_GET["page"]-1)*$pagesize;
					
					while ($rec = @mysqli_fetch_array ($query)) { 
          $counter++;

          $GMApprove = '';
          if($rec['approve2'] == '1' || $rec['approve2'] == 1){
            if($rec["status_use"] != 2){
              $GMApprove = 'color: #0018ff;';
            }else{
              $GMApprove = 'color: #f00;';
            }
          }else{
            $GMApprove = '';
          }
				   ?>
        <TR>
          <TD style="vertical-align: middle;"><span class="text" style="<?php echo $GMApprove;?>"><?php  echo sprintf("%04d",$counter); ?></span></TD>
          <TD style="vertical-align: middle;<?php echo $GMApprove;?>">          
            <span class="text"><?php  echo $rec["cd_name"] ; ?></span><br>
            <!-- .' '.amphur_name($conn, $rec['cd_amphur']).' '.province_name($conn, $rec['cd_province']) -->
            <?php  echo "<strong style=\"".$GMApprove."\">ที่อยู่:</strong> ".$rec["cd_address"]; ?></span>
          </TD>
          <TD style="vertical-align: middle;<?php echo $GMApprove;?>">          
            <span class="text"><?php  echo $rec["cd_tel"] ; ?></span><br>
          </TD>
          <TD style="vertical-align: middle;<?php echo $GMApprove;?>">          
            <span class="text"><?php  echo $rec["c_contact"] ; ?></span><br>
          </TD>
          <!-- <TD style="vertical-align: middle;">          
            ฟหกฟหก
          </TD> -->
          <!-- <TD style="vertical-align: middle;"><span class="text"><?php  echo $rec["loc_name"] ; ?></span></TD> -->
          <!-- <TD nowrap style="vertical-align:middle"><div align="center">
            <?php  if($rec["status_use"]==0) {?>
            <img src="../icons/favorites_use.png" width="15" height="15">
            <?php  } elseif($rec["status_use"]==2) {?>
            <img src="../icons/favorites_close.png" width="15" height="15">
            <?php  } elseif($rec["status_use"]==3) {?>
            <img src="../icons/favorites_service.png" width="15" height="15">
            <?php  } else{?>
            <img src="../icons/favorites_stranby.png" width="15" height="15">
            <?php  }?>
            <div align="center" style="padding-top:5px;">
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=0&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_use.png" width="15" height="15"> | </a>
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=1&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_stranby.png" width="15" height="15"> | </a>
            <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=2&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_close.png" width="15" height="15"> | </a>
             <a href="../first_order/?ff=<?php  echo $rec[$PK_field]; ?>&gg=3&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/favorites_service.png" width="15" height="15"></a>
            </div>
          </div></TD> -->
          <TD nowrap style="vertical-align:middle;display:none;"><!--<div align="center">
            <?php  if($rec["status"]==0) {?>
            <a href="../first_order/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["fo_id"]; ?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../first_order/?bb=<?php  echo $rec[$PK_field]; ?>&ss=<?php  echo $rec["status"]; ?>&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>&foid=<?php  echo $rec["fo_id"]; ?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <div align="center"><a href="../../upload/service_report_close/<?php  echo get_srreport($conn,$rec["fs_id"]);?>.pdf" target="_blank"><p style="background:#999;color:#FFFFFF;padding:2px;"><?php  echo get_srreport($conn,$rec["fo_id"]);?></p></a></div>
            <?php  }?>
          </div>-->
          <div align="center"><A href="service_close.php?fo_id=<?php  echo $rec["fo_id"];?>"><IMG  alt=icon src="../images/icons/icon-48-install.png"></A></div>
          </TD>
          <TD nowrap style="vertical-align:middle;display:none;"><div align="center">
            <?php  if($rec["st_setting"]==0) {?>
            <a href="../first_order/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_on.gif" width="10" height="10"></a>
            <?php  } else{?>
            <a href="../first_order/?b=<?php  echo $rec[$PK_field]; ?>&s=<?php  echo $rec["st_setting"]; ?>&page=<?php  echo $_GET["page"]; ?>&<?php  echo $FK_field; ?>=<?php  echo $_REQUEST["$FK_field"];?>"><img src="../icons/status_off.gif" width="10" height="10"></a>
            <?php  }?>
          </div></TD>
           <!-- <TD style="vertical-align: middle;"><div align="center"><a href="../../upload/first_order/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icon2/download_f2.png" width="20" height="20" border="0" alt=""></a></div></TD> -->
          
          <TD style="vertical-align: middle;"><div align="center"><a href="../job_tracking?tab=sale_schedule&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"];?>"><img src="../images/tracking.png" width="30" border="0" alt=""></a></div></TD>
          <!-- <TD style="vertical-align: middle;"><div align="center"><a href="../document/?fo_id=<?php  echo $rec[$PK_field]; ?>"><img src="../images/document.png" width="30" height="30" border="0" alt=""></a></div></TD> -->
          
          <!-- <TD style="vertical-align: middle;">
          <div align="center">
            <?php if($rec["latitude"] != "" && $rec["longitude"] != ""){
					  ?>
					  <a href="https://www.google.co.th/maps/search/<?php echo $rec["latitude"];?>+<?php echo $rec["longitude"];?>" target="_blank"><img src="../images/google_map.png" width="25"></a>
					  <?php 
				   }else{
					   echo "-";
				   }?>
          	
          </div></TD> -->
          
          <TD style="vertical-align: middle;"><!-- Icons -->
            <A title=Edit href="update.php?mode=update&<?php  echo $PK_field; ?>=<?php  echo $rec["$PK_field"]; if($param <> "") {?>&<?php  echo $param; }?>"><IMG alt=Edit src="../images/pencil.png"></A> <A title=Delete  href="#"></A></TD>
          <TD style="vertical-align: middle;"><A title=Delete  href="#"><IMG alt=Delete src="../images/cross.png" onClick="confirmDelete('?action=delete&<?php  echo $PK_field; ?>=<?php  echo $rec[$PK_field];?>','Group  <?php  echo $rec[$PK_field];?> : <?php  echo $rec["group_name"];?>')"></A></TD>
        </TR>  
		<?php  }?>
      </TBODY>
    </TABLE>
    <br><br>
    <DIV class="bulk-actions align-left">
            <!-- <SELECT name="choose_action" id="choose_action">
              <OPTION selected value="">กรุณาเลือก...</OPTION>
              <OPTION value="del">ลบ</OPTION>
            </SELECT>            
            <?php 
				$a_not_exists = array();
				post_param($a_param,$a_not_exists); 
			?>
            <input class=button name="Action2" type="submit" id="Action2" value="ตกลง"> -->
          </DIV> <DIV class=pagination> <?php  include("../include/page_show.php");?> </DIV>
  </form>  
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
</BODY>
</HTML>
