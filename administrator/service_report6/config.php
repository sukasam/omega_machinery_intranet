
<?php    
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "Service Report (รายการซ่อมเครื่องเก่า)";
	$page_name = "Service Report (รายการซ่อมเครื่องเก่า)";
	$tbl_name = "s_service_report6";
	$field_confirm_showname= "cus_name";
	$fieldlist = array('cus_id','cus_name','takeout','cus_address','cus_province','cus_tel','cus_fax','cus_con','cus_con_tel','cus_location','sv_id','srid','srid2','sr_ctype','sr_ctype2','job_open','job_out','job_close','job_balance','type_service','status_type','sr_stock','sr_stime','loc_pro','loc_seal','loc_sn','loc_clean','loc_contact','loc_contact2','loc_contact3','cs_sell','loc_tels','cl_01','cl_02','cl_03','cl_04','cl_05','cl_06','cl_07','cl_08','detail_recom','detail_recom2','ckl_list','ckw_list','ckf_list','detail_calpr','approve','supply','st_setting','loc_date2','sell_date','loc_date3','ref_date','money1','money2','money3','money4','money5','money6');
	$search_key = array("sv_id","cus_name","cus_location","loc_sn");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />