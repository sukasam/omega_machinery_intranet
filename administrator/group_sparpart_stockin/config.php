
<?php    
	$PK_field = "sub_id";
	//$FR_field = "";
	$check_module = "รายการอะไหล่";
	$page_name = "รายการรับเข้าสต็อคอะไหล่";;
	$tbl_name = "s_group_sparpart_bill";
	$field_confirm_showname= "sub_name";
	$fieldlist = array('sub_name','sub_address','sub_tel','sub_billnum','sub_billdate','sub_comment','sub_option','sub_vat','stock_date','st_setting','approve','stock_admin','stock_approve','stock_approve_date');
	$search_key = array('sub_name','sub_address','sub_tel','sub_billnum','sub_billdate','stock_date');
	$pagesize = 50;
	$pages="รายการรับเข้าสต็อคอะไหล่";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />