<?php  
	//$conn = mysql_connect("localhost","root","") or die("connection to db fail");
//	mysql_select_db("omega_machinery_intranet");
	

	$conn = mysqli_connect("localhost", "root", "", "omega_machinery_intranet");
	@mysqli_query($conn,"SET NAMES UTF8");
	
	/*$conn = mysql_connect("localhost","sukasamc_sptools","sptools") or die("connection to db fail");
	mysql_select_db("sukasamc_sptools");
	@mysqli_query($conn,"SET NAMES UTF8")*/
?>