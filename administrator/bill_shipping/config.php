
<?php    
	$PK_field = "sr_id";
	//$FR_field = "";
	$check_module = "ใบเบิกสินค้า/ใบส่งสินค้า";
	$page_name = "Shipping Slip (ใบส่งสินค้า)";
	$tbl_name = "s_bill_shipping";
	$field_confirm_showname= "cus_id";
	$fieldlist = array('cus_id','sv_id','srid','srid2','sr_ctype','sr_ctype2','job_open','job_close','job_balance','loc_contact2','loc_contact3','cs_sell','loc_tels','detail_recom','ckl_list','ckw_list','ckf_list','detail_calpr','approve','supply','st_setting','loc_date2','sell_date','loc_date3','bill_shipping','shipping_dt1','shipping_dt2','shipping_dt3','shipping_dt4','cd_names','cusadd','cusprovince','custel','cusfax','cscont','cstel','sloc_name','sloc_add','loc_tel','loc_fax','loc_cname','loc_ctel','pkey_code1','pkey_code2','pkey_code3','pkey_list1','pkey_list2','pkey_list3','pkey_location1','pkey_location2','pkey_location3','pkey_sn1','pkey_sn2','pkey_sn3','pkey_amount1','pkey_amount2','pkey_amount3','pkey_open1','pkey_open2','pkey_open3','pkey_ship1','pkey_ship2','pkey_ship3');
	$search_key = array("sv_id","cd_name","loc_name");
	$pagesize = 50;
	$pages="user";

	$a_param = array('page','orderby','sortby','keyword','pagesize','mid','smid');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />