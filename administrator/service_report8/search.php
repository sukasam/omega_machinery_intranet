<?php   
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ค้าหาชื่อร้าน-ชื่อบริษัท</title>
<style type="text/css">
	.tv_search{
		font-size:12px;
		margin-top:10px;
	}
	.tv_search tr{
		
	}
	.tv_search tr th{ 
		font-weight:bold;
		text-align:left;
		padding-left:5px;
		padding-right:5px;
		padding-bottom:5px;
	}
	.tv_search tr td{
		padding:5px;
	}
	a{
		color:#000000;	
		outline:0;
		text-decoration:none;
	}
	a:hover{
		text-decoration:underline;
	}
	
	.filter-section {
		background-color: #f5f5f5;
		padding: 10px;
		margin-bottom: 10px;
		border: 1px solid #ddd;
		border-radius: 5px;
	}
	
	.filter-section input[type="radio"] {
		margin-right: 5px;
	}
	
	.filter-section label {
		margin-right: 15px;
		font-weight: normal;
	}
	
</style>

<script type="text/javascript">
	function get_customer(cid,cname){
		/*alert(cid);
		alert(cname);*/
		var sCustomerName = self.opener.document.getElementById("cd_names");
		sCustomerName.value = cname;
		self.opener.checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2');
		self.opener.document.getElementById("rsnameid").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\""+cid+"\">";
		window.close();
	}
	
	function changeFilter(){
		// Clear search field and reload data when filter changes
		document.getElementById("textfield").value = "";
		searchData();
	}
	
	function searchData(){
		var searchValue = document.getElementById("textfield").value;
		var filterType = document.querySelector('input[name="filter_type"]:checked').value;
		get_cus_with_filter(searchValue, filterType);
	}
	
	function get_cus_with_filter(pval, filterType) {
		var xmlHttp;
		xmlHttp = GetXmlHttpObject(); //Check Support Browser
		URL = pathLocal + 'ajax_return.php?action=getcus_filtered&pval=' + pval + '&filter_type=' + filterType;
		if (xmlHttp == null) {
			alert("Browser does not support HTTP Request");
			return;
		}
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
				document.getElementById('rscus').innerHTML = xmlHttp.responseText;
			} else {
				//document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
			}
		};
		xmlHttp.open("GET", URL, true);
		xmlHttp.send(null);
	}
</script>
<script type="text/javascript" src="ajax.js"></script> 
</head>

<body>
<div class="filter-section">
    <strong>ประเภทข้อมูล&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
    <input type="radio" name="filter_type" id="filter_first" value="first" checked onchange="changeFilter();"/>
    <label for="filter_first">First Order</label>
    <input type="radio" name="filter_type" id="filter_service" value="service" onchange="changeFilter();"/>
    <label for="filter_service">Service Order</label>
    <input type="radio" name="filter_type" id="filter_project" value="project" onchange="changeFilter();"/>
    <label for="filter_project">Project Order</label>
</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="searchData();"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
<tr>
    <th width="50%">ชื่อร้าน-ชื่อบริษัท</th>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php   
  	// Load initial data for First Order (default selection)
  	$qu_cus = mysqli_query($conn,"SELECT fo_id,cd_name,loc_name,cusid FROM s_first_order WHERE (status_use = '3' or status_use = '0') and separate = 0 ORDER BY cd_name ASC");
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_customer('<?php   echo $row_cus['fo_id'];?>','<?php   echo $row_cus['cd_name'];?>');"><?php   echo $row_cus['cd_name'];?> (<?php   echo $row_cus['loc_name']?>)</A></td>
          </tr>
		<?php  	
	}
  ?>
</table>

</body>
</html>