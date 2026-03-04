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
	
	/* Loading overlay styles */
	.loading-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		z-index: 9999;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	
	.loading-content {
		background-color: #ffffff;
		padding: 20px 40px;
		border-radius: 8px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
		text-align: center;
	}
	
	.loading-spinner {
		border: 4px solid #f3f3f3;
		border-top: 4px solid #3498db;
		border-radius: 50%;
		width: 40px;
		height: 40px;
		animation: spin 1s linear infinite;
		margin: 0 auto 15px;
	}
	
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
	
	.loading-text {
		color: #333;
		font-size: 14px;
		font-weight: bold;
	}
	
</style>

<script type="text/javascript">
	function showLoading() {
		// Inject CSS styles into opener window if not already present
		if (!self.opener.document.getElementById("loadingStyles")) {
			var style = self.opener.document.createElement("style");
			style.id = "loadingStyles";
			style.textContent = 
				'.loading-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; justify-content: center; align-items: center; }' +
				'.loading-content { background-color: #ffffff; padding: 20px 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); text-align: center; }' +
				'.loading-spinner { border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 0 auto 15px; }' +
				'@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }' +
				'.loading-text { color: #333; font-size: 14px; font-weight: bold; }';
			self.opener.document.head.appendChild(style);
		}
		
		// Create loading overlay if it doesn't exist
		if (!self.opener.document.getElementById("loadingOverlay")) {
			var overlay = self.opener.document.createElement("div");
			overlay.id = "loadingOverlay";
			overlay.className = "loading-overlay";
			overlay.innerHTML = '<div class="loading-content"><div class="loading-spinner"></div><div class="loading-text">กำลังประมวลผล...</div></div>';
			self.opener.document.body.appendChild(overlay);
		} else {
			self.opener.document.getElementById("loadingOverlay").style.display = "flex";
		}
	}
	
	function get_customer(cid,cname,srid){
		/*alert(cid);
		alert(cname);*/
		var sCustomerName = self.opener.document.getElementById("cd_names");
		sCustomerName.value = cname;
		
		// Show loading indicator before processing
		showLoading();
		
		self.opener.checkfirstorder(cid,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist','sr_ctype2');
		self.opener.document.getElementById("rsnameid").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\""+cid+"\">";
		self.opener.document.getElementById("cus_change").innerHTML="<input type=\"hidden\" name=\"cus_id\" value=\"1\">";
		self.opener.document.getElementById("srid_get7").innerHTML="<input type=\"hidden\" name=\"srid_get7\" value=\""+srid+"\">";
		
		// Small delay to ensure loading is visible, then submit
		setTimeout(function() {
			// Auto submit the form after selecting customer
			if(self.opener.document.getElementById("form1")){
				self.opener.document.getElementById("form1").submit();
			}
		}, 100);
		
		// Close window after a short delay
		setTimeout(function() {
			window.close();
		}, 200);
	}
</script>
<script type="text/javascript" src="ajax.js"></script> 
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_cus(this.value);"/>
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
  	$qu_cus = mysqli_query($conn,"SELECT * FROM s_service_report7 WHERE approve = '1' ORDER BY sv_id DESC");
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_customer('<?php echo $row_cus['cus_id'];?>','<?php   echo get_customername($conn,$row_cus['cus_id']);?>','<?php echo $row_cus['sr_id'];?>');">
			<?php echo $row_cus['sv_id'];?> | <?php echo get_customername($conn,$row_cus['cus_id']);?> (<?php   echo get_localsettingname($conn,$row_cus['cus_id']);?>)</A></td>
          </tr>
		<?php  	
	}
  ?>
</table>

</body>
</html>