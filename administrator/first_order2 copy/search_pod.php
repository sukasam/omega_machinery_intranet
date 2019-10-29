<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ค้าหาชื่อสินค้า</title>
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
	
</style>

<!--<script type="text/javascript">
	function get_customer(cid,cname){
		var sCustomerName = self.opener.document.getElementById("<?php  echo $_GET['pro']?>");
		sCustomerName.value = cname;
		window.close();
	}
</script>-->
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<script type="text/javascript" src="ajax.js"></script> 
<script type="text/javascript">
   function get_pod(group_id,group_name,protype,protype2,protype3){
	//alert(group_id);
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getpod&group_id='+group_id+'&group_name='+group_name+'&protype='+protype;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){  

			$.ajax({
				type: "GET",
				url: "call_return.php?action=changeSN&pod="+group_name+'&id='+protype3,
				success: function(data){
					var ds = data.split('|');
					//console.log(ds[1]);
					
					self.opener.document.getElementById(protype).innerHTML = xmlHttp.responseText;
					self.opener.document.getElementById(protype2).innerHTML = ds[1];
					self.opener.document.getElementById('search_sn'+protype3).innerHTML = ds[2];
					window.close();
					
				}
			});
			
            
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}
</script> 
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
  <tr>
    <td colspan="2"><strong>ค้นหา&nbsp;&nbsp;:&nbsp;&nbsp;</strong>
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_podkey(this.value,'<?php  echo $_GET['protype']?>','<?php  echo $_GET['protype2']?>','<?php  echo $_GET['protype3']?>');"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
<tr>
    <th width="50%">รายการรุ่นสินค้า</th>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php  
  	$qu_cus = mysqli_query($conn,"SELECT * FROM s_group_pod  WHERE 1 GROUP BY group_name ORDER BY group_name ASC");
	while($row_cus = @mysqli_fetch_array($qu_cus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_pod('<?php  echo $row_cus['group_id'];?>','<?php  echo $row_cus['group_name'];?>','<?php  echo $_GET['protype']?>','<?php  echo $_GET['protype2']?>','<?php  echo $_GET['protype3']?>');"><?php  echo $row_cus['group_name'];?></A></td>
          </tr>
		<?php 	
	}
  ?>
</table>

</body>
</html>