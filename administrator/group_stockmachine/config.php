
<?php    
	$PK_field = "group_id";
	//$FR_field = "";
	$check_module = "รายการสต็อกสินค้า";
	$page_name = "รายการสต็อกสินค้า (Product list)";
	$tbl_name = "group_stockmachine";
	$field_confirm_showname= "group_name";
	$fieldlist = array('group_spar_id','group_name','group_location','group_type','group_status');
	$search_key = array('group_spar_id','group_location','group_name','group_type');
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />