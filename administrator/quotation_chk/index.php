<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
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
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro>ใบเสนอราคา (ขาย / เช่า / ซ่อม / สัญญาบริการ)</P>

<UL class=shortcut-buttons-set>
    <LI><A class=shortcut-button href="../quotation/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>ขาย</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation2/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>เช่า</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation3/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคา<br>ซ่อม</SPAN></A></LI>
    <LI><A class=shortcut-button href="../quotation4/"><SPAN><IMG  alt=icon src="../images/paper_content_pencil_48.png"><BR>
    ใบเสนอราคาสัญญาบริการ</SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->


<!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</BODY>
</HTML>
