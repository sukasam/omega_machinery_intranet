// JavaScript Document
var pathLocal = "";
function GetXmlHttpObject(){
   var xmlHttp=null;
   try{
 // Firefox, Opera 8.0+, Safari
   xmlHttp=new XMLHttpRequest();
   }catch (e) {
 //Internet Explorer
      try{
         xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e){
         xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
   }
   return xmlHttp;
}

function checkfirstorder(pval,param1,param2,param3,param4,param5,param6,param7,param8,param9,param10,param11,param12,param13){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcusfirsh&pid='+pval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			if (xmlHttp.status == 200) {
				var ds = xmlHttp.responseText.split("|");
				var elements = [
					{id: param1, index: 0},
					{id: param2, index: 1},
					{id: param3, index: 2},
					{id: param4, index: 3},
					{id: param5, index: 4},
					{id: param7, index: 6},
					{id: param8, index: 7},
					{id: param9, index: 8},
					{id: param10, index: 9},
					{id: param11, index: 10},
					{id: param12, index: 11},
					{id: param13, index: 12}
				];
				
				for (var i = 0; i < elements.length; i++) {
					if (elements[i].id && ds.length > elements[i].index) {
						var elem = document.getElementById(elements[i].id);
						if (elem) {
							elem.innerHTML = ds[elements[i].index] || '';
						}
					}
				}
			} else {
				console.error('AJAX request failed with status: ' + xmlHttp.status);
			}
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_podsn(pval,param1,param2,param3,fid){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getprodetail&pid='+pval+'&fid='+fid;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
            document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];
			document.getElementById(param3).innerHTML=ds[2];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_cus(pval){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcus&pval='+pval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_sparpart(pval,resdata){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getsparpart&pval='+pval+'&resdata='+resdata;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function showspare(sval,param1,param2,param3,param4,idList,param5){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getspare&sval='+sval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
			console.log(ds[5],param5);
            document.getElementById(param1).value=ds[1];
			document.getElementById(param2).value=ds[2];
			document.getElementById(param3).value=ds[3];
			document.getElementById(param4).value=ds[4];
			document.getElementById(param5).value=ds[5];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}