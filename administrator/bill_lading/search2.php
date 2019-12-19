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
<title>ค้าหาอะไหล่</title>
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
		var sCustomerName = self.opener.document.getElementById("<?php     echo $_GET['pro']?>");
		sCustomerName.value = cname;
		window.close();
	}
</script>-->
<script type="text/javascript" src="ajax.js"></script> 
<script type="text/javascript">
   function get_sparactive(spid,resdata){  
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getsparactive&spid='+spid+'&resdata='+resdata;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
			
			//window.close();
			//console.log(JSON.stringify(ds));
			
			if(ds[3] <= 0){
				if(ds[1] != ''){
					alert(ds[1]+' : สินค้าตัวนี้ไม่เพียงพอสำหรับการเบิก');
				}

				self.opener.document.getElementById('codes'+resdata).value='';
				self.opener.document.getElementById('lists'+resdata).innerHTML=ds[2];
				self.opener.document.getElementById('sns'+resdata).value='';
				self.opener.document.getElementById('amounts'+resdata).value='';
				self.opener.document.getElementById('opens'+resdata).value='';

			}else{
				//alert(resdata);
				self.opener.document.getElementById('codes'+resdata).value=ds[1];
				self.opener.document.getElementById('lists'+resdata).innerHTML=ds[2];
				self.opener.document.getElementById('sns'+resdata).value='';
				self.opener.document.getElementById('amounts'+resdata).value=ds[3];
				self.opener.document.getElementById('opens'+resdata).value='';
			}

			window.close();
			
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
        <input type="text" name="textfield" id="textfield" style="width:85%;" onkeyup="get_sparpart(this.value,'<?php echo $_GET['resdata']?>');"/>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search">
<tr>
    <th width="50%">รายการอะไหล่</th>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tv_search" id="rscus">
<?php     
  	$qu_sparcus = mysqli_query($conn,"SELECT * FROM group_stockmachine WHERE 1 ORDER BY group_spar_id ASC");
	while($row_sparcus = @mysqli_fetch_array($qu_sparcus)){
		?>
		 <tr>
            <td><A href="javascript:void(0);" onclick="get_sparactive('<?php echo $row_sparcus['group_id'];?>','<?php echo $_REQUEST['resdata']?>');"><?php     echo $row_sparcus['group_spar_id'].'&nbsp;&nbsp;'.$row_sparcus['group_name'];?></A></td>
          </tr>
		<?php    	
	}
  ?>
</table>

</body>
</html>