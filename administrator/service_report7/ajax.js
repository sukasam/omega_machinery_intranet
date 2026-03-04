// JavaScript Document
var pathLocal = "";

function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function checkfirstorder(pval, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10, param11, param12, param13) {
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getcusfirsh&pid=' + pval;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            var ds = xmlHttp.responseText.split("|");
            var elem;
            if (param1 && (elem = document.getElementById(param1))) elem.innerHTML = ds[0];
            if (param2 && (elem = document.getElementById(param2))) elem.innerHTML = ds[1];
            if (param3 && (elem = document.getElementById(param3))) elem.innerHTML = ds[2];
            if (param4 && (elem = document.getElementById(param4))) elem.innerHTML = ds[3];
            if (param5 && (elem = document.getElementById(param5))) elem.innerHTML = ds[4];
            //document.getElementById(param6).innerHTML=ds[5];
            if (param7 && (elem = document.getElementById(param7))) elem.innerHTML = ds[6];
            if (param8 && (elem = document.getElementById(param8))) elem.innerHTML = ds[7];
            if (param9 && (elem = document.getElementById(param9))) elem.innerHTML = ds[8];
            if (param10 && (elem = document.getElementById(param10))) elem.innerHTML = ds[9];
            if (param11 && (elem = document.getElementById(param11))) elem.innerHTML = ds[10];
            if (param12 && (elem = document.getElementById(param12))) elem.innerHTML = ds[11];
            if (param13 && (elem = document.getElementById(param13))) elem.innerHTML = ds[12];
        } else {
            //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}

function get_podsn(pval, param1, param2, param3, fid) {
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getprodetail&pid=' + pval + '&fid=' + fid;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            var ds = xmlHttp.responseText.split("|");
            var elem;
            if (param1 && (elem = document.getElementById(param1))) elem.innerHTML = ds[0];
            if (param2 && (elem = document.getElementById(param2))) elem.innerHTML = ds[1];
            if (param3 && (elem = document.getElementById(param3))) elem.innerHTML = ds[2];
        } else {
            //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}

function get_cus(pval) {
    /*alert(pval);*/
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getcus&pval=' + pval;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            var elem = document.getElementById('rscus');
            if (elem) elem.innerHTML = xmlHttp.responseText;
        } else {
            //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}

function get_cus2(pval) {
    /*alert(pval);*/
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getcus2&pval=' + pval;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        var elem = document.getElementById('rscus');
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            if (elem) elem.innerHTML = xmlHttp.responseText;
        } else {
            if (elem) elem.innerHTML = "<div class='loading'> Loading..</div>";
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}

function get_sparpart(pval, resdata) {
    /*alert(pval);*/
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getsparpart&pval=' + pval + '&resdata=' + resdata;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            var elem = document.getElementById('rscus');
            if (elem) elem.innerHTML = xmlHttp.responseText;
        } else {
            //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}

function showspare(sval, param1, param2, param3, param4, idList, param5) {
    var xmlHttp;
    xmlHttp = GetXmlHttpObject(); //Check Support Brownser
    URL = pathLocal + 'ajax_return.php?action=getspare&sval=' + sval;
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            var ds = xmlHttp.responseText.split("|");
            //console.log(JSON.stringify(ds));
            var elem;
            if (ds[4] <= 0) {
                alert(ds[1] + ' : อะไหล่สินค้าตัวนี้ไม่เพียงพอสำหรับการเบิกอะไหล่');
                if ((elem = document.getElementById('lists' + idList))) elem.value = '';
                if (param1 && (elem = document.getElementById(param1))) elem.value = '';
                if (param2 && (elem = document.getElementById(param2))) elem.value = '';
                if (param3 && (elem = document.getElementById(param3))) elem.value = '';
                if (param4 && (elem = document.getElementById(param4))) elem.value = '';
                if (param5 && (elem = document.getElementById(param5))) elem.value = '';
                if ((elem = document.getElementById('opens' + idList))) elem.value = '';
            } else {
                if (param1 && (elem = document.getElementById(param1))) elem.value = ds[1];
                if (param2 && (elem = document.getElementById(param2))) elem.value = ds[2];
                if (param3 && (elem = document.getElementById(param3))) elem.value = ds[3];
                if (param4 && (elem = document.getElementById(param4))) elem.value = ds[4];
                if (param5 && (elem = document.getElementById(param5))) elem.value = ds[5];
            }
        } else {
            //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
    };
    xmlHttp.open("GET", URL, true);
    xmlHttp.send(null);
}