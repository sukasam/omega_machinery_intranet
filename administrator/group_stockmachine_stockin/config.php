
<?php    
	$PK_field = "sub_id";
	//$FR_field = "";
	$check_module = "รายการรับเข้าสต็อค";
	$page_name = "รายการรับเข้าสต็อค";;
	$tbl_name = "group_stockmachine_bill";
	$field_confirm_showname= "sub_name";
	$fieldlist = array('sub_name','sub_address','sub_tel','sub_billnum','sub_billdate','sub_comment','sub_vat','stock_date','checkin','comment_other');
	$search_key = array('sup_name','sub_address','sup_tel','sub_billnum','sub_billdate','stock_date');
	$pagesize = 50;
	$pages="รายการรับเข้าสต็อค";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />