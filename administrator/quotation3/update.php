<?php
	include_once ("../../include/config.php");
	include_once ("../../include/connect.php");
	include_once ("../../include/function.php");
	include_once ("config.php");
  
  $vowels = array(",");

	if ($_POST['mode'] <> "") {
		$param = "";
		$a_not_exists = array();
    $param = get_param($a_param,$a_not_exists);
    
    $_POST['cd_name'] = addslashes($_POST['cd_name']);
    $_POST['cd_address'] = addslashes($_POST['cd_address']);
    $_POST['c_contact'] = addslashes($_POST['c_contact']);
		
		$a_sdate=explode("/",$_POST['pay_apv']);
		$_POST['pay_apv']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$date_forder = $_POST['date_forder'];
		$a_sdate=explode("/",$_POST['date_forder']);
		$date_forder = $a_sdate[0]."-".$a_sdate[1]."-".($a_sdate[2]+543);
		$_POST['date_forder']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		

		$a_sdate=explode("/",$_POST['cs_ship']);
		$_POST['cs_ship']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['cs_setting']);
    $_POST['cs_setting']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_sell']);
    $_POST['date_sell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_hsell']);
    $_POST['date_hsell']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
    
    $a_sdate=explode("/",$_POST['date_account']);
		$_POST['date_account']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_quf']);
		$_POST['date_quf']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$a_sdate=explode("/",$_POST['date_qut']);
		$_POST['date_qut']=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

		$_POST['ccomment'] = nl2br($_POST['ccomment']);
		$_POST['qucomment'] = nl2br($_POST['qucomment']);
		$_POST['remark'] = nl2br(addslashes($_POST['remark']));

		$_POST['separate'] = 0;

		$_POST["cprice1"] = str_replace($vowels,"",$_POST["cprice1"]);
		$_POST["cprice2"] = str_replace($vowels,"",$_POST["cprice2"]);
		$_POST["cprice3"] = str_replace($vowels,"",$_POST["cprice3"]);
		$_POST["cprice4"] = str_replace($vowels,"",$_POST["cprice4"]);
		$_POST["cprice5"] = str_replace($vowels,"",$_POST["cprice5"]);
		$_POST["cprice6"] = str_replace($vowels,"",$_POST["cprice6"]);
		$_POST["cprice7"] = str_replace($vowels,"",$_POST["cprice7"]);
		
    $_POST["paym"] = str_replace($vowels,"",$_POST["paym"]);
    $_POST["paym2"] = str_replace($vowels,"",$_POST["paym2"]);
    $_POST["paym3"] = str_replace($vowels,"",$_POST["paym3"]);
		$_POST["pays"] = str_replace($vowels,"",$_POST["pays"]);
		$_POST["paysa"] = str_replace($vowels,"",$_POST["paysa"]);
    $_POST["paysad"] = str_replace($vowels,"",$_POST["paysad"]);
    
$sumTotal = 0;

if($_POST['cpro1'] != ""){
  if($_POST['pro_sn1'] == ""){
    $_POST['pro_sn1'] = 1;
  }
  $totalSub1 = $_POST['pro_sn1'] * $_POST['camount1'];
  if($_POST['cprice1'] != ""){$totalSub1 = $totalSub1 - $_POST['cprice1'];
  }else{$_POST['cprice1'] = "";}
  $sumTotal = $sumTotal+$totalSub1;
  if($totalSub1 != "" || $totalSub1 != 0){
    $totalSub1s = number_format($totalSub1,2);
  }
}

if($_POST['cpro2'] != ""){
  if($_POST['pro_sn2'] == ""){
    $_POST['pro_sn2'] = 1;
  }
  $totalSub2 = $_POST['pro_sn2'] * $_POST['camount2'];
  if($_POST['cprice2'] != ""){$totalSub2 = $totalSub2 - $_POST['cprice2'];
  }else{$_POST['cprice2'] = "";}
  $sumTotal = $sumTotal+$totalSub2;
  if($totalSub2 != "" || $totalSub2 != 0){
    $totalSub2s = number_format($totalSub2,2);
  }
}

if($_POST['cpro3'] != ""){
  if($_POST['pro_sn3'] == ""){
    $_POST['pro_sn3'] = 1;
  }
  $totalSub3 = $_POST['pro_sn3'] * $_POST['camount3'];
  if($_POST['cprice3'] != ""){$totalSub3 = $totalSub3 - $_POST['cprice3'];
  }else{$_POST['cprice3'] = "";}
  $sumTotal = $sumTotal+$totalSub3;
  if($totalSub3 != "" || $totalSub3 != 0){
    $totalSub3s = number_format($totalSub3,2);
  }
}

if($_POST['cpro4'] != ""){
  if($_POST['pro_sn4'] == ""){
    $_POST['pro_sn4'] = 1;
  }
  $totalSub4 = $_POST['pro_sn4'] * $_POST['camount4'];
  if($_POST['cprice4'] != ""){$totalSub4 = $totalSub4 - $_POST['cprice4'];
  }else{$_POST['cprice4'] = "";}
  $sumTotal = $sumTotal+$totalSub4;
  if($totalSub4 != "" || $totalSub4 != 0){
    $totalSub4s = number_format($totalSub4,2);
  }
}

if($_POST['cpro5'] != ""){
  if($_POST['pro_sn5'] == ""){
    $_POST['pro_sn5'] = 1;
  }
  $totalSub5 = $_POST['pro_sn5'] * $_POST['camount5'];
  if($_POST['cprice5'] != ""){$totalSub5 = $totalSub5 - $_POST['cprice5'];
  }else{$_POST['cprice5'] = "";}
  $sumTotal = $sumTotal+$totalSub5;
  if($totalSub5 != "" || $totalSub5 != 0){
    $totalSub5s = number_format($totalSub5,2);
  }
}

if($_POST['cpro6'] != ""){
  if($_POST['pro_sn6'] == ""){
    $_POST['pro_sn6'] = 1;
  }
  $totalSub6 = $_POST['pro_sn6'] * $_POST['camount6'];
  if($_POST['cprice6'] != ""){$totalSub6 = $totalSub6 - $_POST['cprice6'];
  }else{$_POST['cprice6'] = "";}
  $sumTotal = $sumTotal+$totalSub6;
  if($totalSub6 != "" || $totalSub6 != 0){
    $totalSub6s = number_format($totalSub6,2);
  }
}

if($_POST['cpro7'] != ""){
  if($_POST['pro_sn7'] == ""){
    $_POST['pro_sn7'] = 1;
  }
  $totalSub7 = $_POST['pro_sn7'] * $_POST['camount7'];
  if($_POST['cprice7'] != ""){$totalSub7 = $totalSub7 - $_POST['cprice7'];
  }else{$_POST['cprice7'] = "";}
  $sumTotal = $sumTotal+$totalSub7;
  if($totalSub7 != "" || $totalSub7 != 0){
    $totalSub7s = number_format($totalSub7,2);
  }
}

if($_POST['cpro8'] != ""){
  if($_POST['pro_sn8'] == ""){
    $_POST['pro_sn8'] = 1;
  }
  $totalSub8 = $_POST['pro_sn8'] * $_POST['camount8'];
  if($_POST['cprice8'] != ""){$totalSub8 = $totalSub8 - $_POST['cprice8'];
  }else{$_POST['cprice8'] = "";}
  $sumTotal = $sumTotal+$totalSub8;
  if($totalSub8 != "" || $totalSub8 != 0){
    $totalSub8s = number_format($totalSub8,2);
  }
}

if($_POST['cpro9'] != ""){
  if($_POST['pro_sn9'] == ""){
    $_POST['pro_sn9'] = 1;
  }
  $totalSub9 = $_POST['pro_sn9'] * $_POST['camount9'];
  if($_POST['cprice9'] != ""){$totalSub9 = $totalSub9 - $_POST['cprice9'];
  }else{$_POST['cprice9'] = "";}
  $sumTotal = $sumTotal+$totalSub9;
  if($totalSub9 != "" || $totalSub9 != 0){
    $totalSub9s = number_format($totalSub9,2);
  }
}

if($_POST['cpro10'] != ""){
  if($_POST['pro_sn10'] == ""){
    $_POST['pro_sn10'] = 1;
  }
  $totalSub10 = $_POST['pro_sn10'] * $_POST['camount10'];
  if($_POST['cprice10'] != ""){$totalSub10 = $totalSub10 - $_POST['cprice10'];
  }else{$_POST['cprice10'] = "";}
  $sumTotal = $sumTotal+$totalSub10;
  if($totalSub10 != "" || $totalSub10 != 0){
    $totalSub10s = number_format($totalSub10,2);
  }
}

$sumprice  = $sumTotal;
$sumpricevat = ($sumprice * 7) / 100;
$sumtotals = $sumprice + $sumpricevat;
		
		if($_POST["payc"] == "1"){
      
      $_POST['guaran3'] = "";
      $_POST['guaran4'] = "0";

      if($_POST['paym'] != ""){
        $_POST['paym2'] = $sumtotals - $_POST['paym'];
      }

      // if($_POST['guaran3'] != ""){
      //   $_POST['paym'] = ($_POST['guaran3']/100)*$sumtotals;
      //   $_POST['guaran4'] = ($_POST['guaran3']/100)*$sumtotals;
      //   $_POST['paym2'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals));
      // }else{
      //   $_POST['paym'] = "0";
      //   $_POST['paym2'] = $sumtotals;
      //   $_POST['guaran4'] = "0";
      // }

			$_POST['pays'] = "";
			$_POST['paysa'] = "0";
			$_POST['paysad'] = "";
		}else{
      
      if($_POST['pays'] != ""){
        if($_POST['guaran3'] != ""){
          //$_POST['paysa'] = ($sumtotals - (($_POST['guaran3']/100)*$sumtotals)) / $_POST['pays'];
          $_POST['paysa'] = $sumtotals / $_POST['pays'];
          $_POST['guaran4'] = ($_POST['guaran3']/100)*$sumtotals;
        }else{
          $_POST['paysa'] = $sumtotals / $_POST['pays'];
          $_POST['guaran4'] = "0";
        }
        
      }
      
      $_POST['paym'] = "0";
      $_POST['paym2'] = "0";
      $_POST['paym3'] = "0";
		}

		if ($_POST['mode'] == "add") {

				$_POST['fs_id'] = get_snfirstorders($conn,$_POST['fs_id']);
				$_POST['status_use'] = 1;
				$_POST['st_setting'] = 0;
			
				$_POST['loc_name'] = addslashes($_POST['loc_name']);

        if($_POST['type_service'] == 4 || $_POST['type_service'] === "4" ){
          $_POST['type_service_dsc'] = addslashes($_POST['type_service_dsc']);
        }else{
          $_POST['type_service_dsc'] = "";
        }

				include_once "../include/m_add.php";
				$id = mysqli_insert_id($conn);

        if ($_FILES['pro_img1s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');	
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img1s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img1s']['name']);
              //$sizes = $value;
              uploadfile($path,$filename,$_FILES['pro_img1s']['tmp_name'],$width, $quality);
          } // end foreach				
            $sql = "update $tbl_name set pro_img1  = '".$filename."' where $PK_field = '".$id."' ";
            @mysqli_query($conn,$sql);	
            $pro_img1 = $filename;
          } // end if ($_FILES[ufimages][name] != "")	

          if ($_FILES['pro_img2s']['name'] != "") { 
            $mname="";
            $mname=gen_random_num(5);
            $a_size = array('250');	
            $filename = "";
            foreach($a_size as $key => $value) {
              $path = "../../upload/quotation/";
              $quality = 80;
              if($filename == "")
                $name_data=explode(".",$_FILES['pro_img2s']['name']);
                $type=$name_data[1];
                $filename =$mname.".".$type;
                list($width, $height) = getimagesize($_FILES['pro_img2s']['name']);
                //$sizes = $value;
                uploadfile($path,$filename,$_FILES['pro_img2s']['tmp_name'],$width, $quality);
            } // end foreach				
              $sql = "update $tbl_name set pro_img2  = '".$filename."' where $PK_field = '".$id."' ";
              @mysqli_query($conn,$sql);			
              $pro_img2 = $filename;	
            } // end if ($_FILES[ufimages][name] != "")	

            if ($_FILES['pro_img3s']['name'] != "") { 
              $mname="";
              $mname=gen_random_num(5);
              $a_size = array('250');	
              $filename = "";
              foreach($a_size as $key => $value) {
                $path = "../../upload/quotation/";
                $quality = 80;
                if($filename == "")
                  $name_data=explode(".",$_FILES['pro_img3s']['name']);
                  $type=$name_data[1];
                  $filename =$mname.".".$type;
                  list($width, $height) = getimagesize($_FILES['pro_img3s']['name']);
                  //$sizes = $value;
                  uploadfile($path,$filename,$_FILES['pro_img3s']['tmp_name'],$width, $quality);
              } // end foreach				
                $sql = "update $tbl_name set pro_img3  = '".$filename."' where $PK_field = '".$id."' ";
                @mysqli_query($conn,$sql);				
                $pro_img3 = $filename;
              } // end if ($_FILES[ufimages][name] != "")	
			
				//require_once("genpdf.php");

				include_once("../mpdf54/mpdf.php");
				include_once("form_quotation.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/quotation/'.$chaf.'.pdf','F');

       // header("Location:update.php?mode=update&qu_id=".$id);
			header ("location:index.php?" . $param);
		}
		if ($_POST['mode'] == "update" ) {
				
				$_POST['loc_name'] = addslashes($_POST['loc_name']);

        if($_POST['type_service'] == 4 || $_POST['type_service'] === "4" ){
          $_POST['type_service_dsc'] = addslashes($_POST['type_service_dsc']);
        }else{
          $_POST['type_service_dsc'] = "";
        }
				
				include_once ("../include/m_update.php");
				$id = $_REQUEST[$PK_field];
			

        if ($_FILES['pro_img1s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');				
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            @unlink($path.$_POST['pro_img1']);
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img1s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img1s']['name']);
              uploadfile($path,$filename,$_FILES['pro_img1s']['tmp_name'],$width, $quality);
          } // end foreach				
          $sql = "update $tbl_name set pro_img1 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);		
          $pro_img1 = $filename;		
        } // end if ($_FILES[ufimages][name] != "")
        else{
          $pro_img1 = $_POST['pro_img1'];
        }

        if ($_FILES['pro_img2s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');				
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            @unlink($path.$_POST['pro_img2']);
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img2s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img2s']['name']);
              uploadfile($path,$filename,$_FILES['pro_img2s']['tmp_name'],$width, $quality);
          } // end foreach				
          $sql = "update $tbl_name set pro_img2 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);	
          $pro_img2 = $filename;			
        } // end if ($_FILES[ufimages][name] != "")
        else{
          $pro_img2 = $_POST['pro_img2'];
        }

        if ($_FILES['pro_img3s']['name'] != "") { 
          $mname="";
          $mname=gen_random_num(5);
          $a_size = array('250');				
          $filename = "";
          foreach($a_size as $key => $value) {
            $path = "../../upload/quotation/";
            @unlink($path.$_POST['pro_img3']);
            $quality = 80;
            if($filename == "")
              $name_data=explode(".",$_FILES['pro_img3s']['name']);
              $type=$name_data[1];
              $filename =$mname.".".$type;
              list($width, $height) = getimagesize($_FILES['pro_img3s']['name']);
              uploadfile($path,$filename,$_FILES['pro_img3s']['tmp_name'],$width, $quality);
          } // end foreach				
          $sql = "update $tbl_name set pro_img3 = '".$filename."' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img3 = $filename;	
        } // end if ($_FILES[ufimages][name] != "")
        else{
          $pro_img3 = $_POST['pro_img3'];
        }

        $paths = "../../upload/quotation/";

        if($_POST['deleteimg1'] === '1'){
          @unlink($paths.$_POST['pro_img1']);
          $sql = "update $tbl_name set pro_img1 = '' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img3 = "";
        }
        if($_POST['deleteimg2'] === '1'){
          @unlink($paths.$_POST['pro_img2']);
          $sql = "update $tbl_name set pro_img2 = '' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img2 = "";
        }
        if($_POST['deleteimg3'] === '1'){
          @unlink($paths.$_POST['pro_img3']);
          $sql = "update $tbl_name set pro_img3 = '' where $PK_field = '".$_POST[$PK_field]."' ";
          @mysqli_query($conn,$sql);			
          $pro_img3 = "";
        }
				//require_once("genpdf.php");
			
				include_once("../mpdf54/mpdf.php");
				include_once("form_quotation.php");
				$mpdf=new mPDF('UTF-8');
				$mpdf->SetAutoFont();
				$mpdf->WriteHTML($form);
				$chaf = str_replace("/","-",$_POST['fs_id']);
				$mpdf->Output('../../upload/quotation/'.$chaf.'.pdf','F');

        //header("Location:update.php?mode=update&qu_id=".$id);
			header ("location:index.php?" . $param);
		}
	}
	if ($_GET['mode'] == "add") {
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"add");
	}
	if ($_GET['mode'] == "update") {
		 Check_Permission($conn,$check_module,$_SESSION['login_id'],"update");
		$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] ."'";
		$query = @mysqli_query($conn,$sql);
		while ($rec = @mysqli_fetch_array($query)) {
			$$PK_field = $rec[$PK_field];
			foreach ($fieldlist as $key => $value) {
				$$value = $rec[$value];
			}
		}

		$a_sdate=explode("-",$pay_apv);
		$pay_apv=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
		
		$a_sdate=explode("-",$date_forder);
		$date_forder=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_ship);
		$cs_ship=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$cs_setting);
    $cs_setting=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    $a_sdate=explode("-",$date_sell);
    $date_sell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$date_hsell);
    $date_hsell=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

    $a_sdate=explode("-",$date_account);
    $date_account=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_quf);
		$date_quf=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];

		$a_sdate=explode("-",$date_qut);
    $date_qut=$a_sdate[2]."/".$a_sdate[1]."/".$a_sdate[0];
    
    $sumTotal = 0;

if($cpro1 != ""){
  if($pro_sn1 == ""){
    $pro_sn1 = 1;
  }
  $totalSub1 = $pro_sn1 * $camount1;
  if($cprice1 != ""){$totalSub1 = $totalSub1 - $cprice1;
  }else{$cprice1 = "";}
  $sumTotal = $sumTotal+$totalSub1;
  if($totalSub1 != "" || $totalSub1 != 0){
    $totalSub1s = number_format($totalSub1,2);
  }
}

if($cpro2 != ""){
  if($pro_sn2 == ""){
    $pro_sn2 = 1;
  }
  $totalSub2 = $pro_sn2 * $camount2;
  if($cprice2 != ""){$totalSub2 = $totalSub2 - $cprice2;
  }else{$cprice2 = "";}
  $sumTotal = $sumTotal+$totalSub2;
  if($totalSub2 != "" || $totalSub2 != 0){
    $totalSub2s = number_format($totalSub2,2);
  }
}

if($cpro3 != ""){
  if($pro_sn3 == ""){
    $pro_sn3 = 1;
  }
  $totalSub3 = $pro_sn3 * $camount3;
  if($cprice3 != ""){$totalSub3 = $totalSub3 - $cprice3;
  }else{$cprice3 = "";}
  $sumTotal = $sumTotal+$totalSub3;
  if($totalSub3 != "" || $totalSub3 != 0){
    $totalSub3s = number_format($totalSub3,2);
  }
}

if($cpro4 != ""){
  if($pro_sn4 == ""){
    $pro_sn4 = 1;
  }
  $totalSub4 = $pro_sn4 * $camount4;
  if($cprice4 != ""){$totalSub4 = $totalSub4 - $cprice4;
  }else{$cprice4 = "";}
  $sumTotal = $sumTotal+$totalSub4;
  if($totalSub4 != "" || $totalSub4 != 0){
    $totalSub4s = number_format($totalSub4,2);
  }
}

if($cpro5 != ""){
  if($pro_sn5 == ""){
    $pro_sn5 = 1;
  }
  $totalSub5 = $pro_sn5 * $camount5;
  if($cprice5 != ""){$totalSub5 = $totalSub5 - $cprice5;
  }else{$cprice5 = "";}
  $sumTotal = $sumTotal+$totalSub5;
  if($totalSub5 != "" || $totalSub5 != 0){
    $totalSub5s = number_format($totalSub5,2);
  }
}

if($cpro6 != ""){
  if($pro_sn6 == ""){
    $pro_sn6 = 1;
  }
  $totalSub6 = $pro_sn6 * $camount6;
  if($cprice6 != ""){$totalSub6 = $totalSub6 - $cprice6;
  }else{$cprice6 = "";}
  $sumTotal = $sumTotal+$totalSub6;
  if($totalSub6 != "" || $totalSub6 != 0){
    $totalSub6s = number_format($totalSub6,2);
  }
}

if($cpro7 != ""){
  if($pro_sn7 == ""){
    $pro_sn7 = 1;
  }
  $totalSub7 = $pro_sn7 * $camount7;
  if($cprice7 != ""){$totalSub7 = $totalSub7 - $cprice7;
  }else{$cprice7 = "";}
  $sumTotal = $sumTotal+$totalSub7;
  if($totalSub7 != "" || $totalSub7 != 0){
    $totalSub7s = number_format($totalSub7,2);
  }
}

if($cpro8 != ""){
  if($pro_sn8 == ""){
    $pro_sn8 = 1;
  }
  $totalSub8 = $pro_sn8 * $camount8;
  if($cprice8 != ""){$totalSub8 = $totalSub8 - $cprice8;
  }else{$cprice8 = "";}
  $sumTotal = $sumTotal+$totalSub8;
  if($totalSub8 != "" || $totalSub8 != 0){
    $totalSub8s = number_format($totalSub8,2);
  }
}

if($cpro9 != ""){
  if($pro_sn9 == ""){
    $pro_sn9 = 1;
  }
  $totalSub9 = $pro_sn10 * $camount9;
  if($cprice9 != ""){$totalSub9 = $totalSub9 - $cprice9;
  }else{$cprice9 = "";}
  $sumTotal = $sumTotal+$totalSub9;
  if($totalSub9 != "" || $totalSub9 != 0){
    $totalSub9s = number_format($totalSub9,2);
  }
}


if($cpro10 != ""){
  if($pro_sn10 == ""){
    $pro_sn10 = 1;
  }
  $totalSub10 = $pro_sn10 * $camount10;
  if($cprice10 != ""){$totalSub10 = $totalSub10 - $cprice10;
  }else{$cprice10 = "";}
  $sumTotal = $sumTotal+$totalSub10;
  if($totalSub10 != "" || $totalSub10 != 0){
    $totalSub10s = number_format($totalSub10,2);
  }
}

$sumprice  = $sumTotal;
$sumpricevat = ($sumprice * 7) / 100;
$sumtotals = $sumprice + $sumpricevat;

	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type=text/css href="../css/reset.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/style.css" media=screen>
<LINK rel="stylesheet" type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js"></SCRIPT>
<!--<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<SCRIPT type=text/javascript src="ajax.js"></SCRIPT>

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<META name=GENERATOR content="MSHTML 8.00.7600.16535">
<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check(frm){
		if (frm.group_name.value.length==0){
			alert ('Please enter group name !!');
			frm.group_name.focus(); return false;
		}
}

function chksign(vals){
	//alert(vals);
}

function submitForm() {
		document.getElementById("submitF").disabled = true;
		document.getElementById("resetF").disabled = true;
		document.form1.submit()
	}

</script>
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<style>
	input{
		font-size:13px !important;
	}
	select{
		font-size:13px !important;
	}
	textarea{
		font-size:13px !important;
	}
</style>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข	[<?php  echo $page_name; ?>]<?php  } ?>	</P>
<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../quotation3/"><SPAN><IMG  alt=icon src="../images/btn_back.gif"><BR>
  กลับ</SPAN></A></LI>
</UL>
<!-- End .clear -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right">

<H3 align="left"><?php  echo $check_module; ?></H3>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab">
  <form action="update.php" method="post" enctype="multipart/form-data" name="form1" id="form1"  onSubmit="return check(this)">
    <div class="formArea">
      <fieldset>
      <legend><?php  echo $page_name; ?> </legend>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td style="padding-bottom:5px;">
    <?php 
    //$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`= ".$qu_id);
    $headerIMG = '../images/form/header-qar.png';
    ?>
    <img src="<?php echo $headerIMG;?>" width="100%" /></td>
  </tr>
</table>
  
  <table width="100%" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> <input type="text" name="cd_name" value="<?php  echo $cd_name;?>" id="cd_name" class="inpfoder" style="width:70%;border: 0px;">
            <span id="rsnameid"><input type="hidden" name="cus_id" value="<?php  echo $cus_id;?>"></span><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_c.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
            </td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>เลขที่ใบเสนอราคา:</strong> 
            <input type="text" value="<?php  if($fs_id == ""){echo check_quotation3($conn);}else{echo $fs_id;};?>" class="inpfoder" readonly style="border: 0px;"> 
            <input type="hidden" name="fs_id" value="<?php  if($fs_id == ""){echo check_quotation3($conn);}else{echo $fs_id;};?>" id="fs_id" class="inpfoder" style="border: 0px;"> 
            </td>

          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong> ชื่อร้าน :</strong>
            <input type="text" name="loc_name" value="<?php  echo $loc_name;?>" id="loc_name" class="inpfoder" style="border: 0px;width: 60%;">
            </td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong> หมวดการเสนอราคา :</strong>
            <input type="radio" name="quo_titles" value="1" <?php if($quo_titles == '1' || $quo_titles == '0'){echo 'checked';}?>> ซ่อม
            &nbsp;&nbsp;<input type="radio" name="quo_titles" value="2" <?php if($quo_titles == '2'){echo 'checked';}?>> ติดตั้ง
            &nbsp;&nbsp;<input type="radio" name="quo_titles" value="3" <?php if($quo_titles == '3'){echo 'checked';}?>> ติดตั้ง-โปรเจค
            &nbsp;&nbsp;<input type="radio" name="quo_titles" value="4" <?php if($quo_titles == '4'){echo 'checked';}?>> เดินระบบน้ำ/ไฟฟ้า
            &nbsp;&nbsp;<input type="radio" name="quo_titles" value="5" <?php if($quo_titles == '5'){echo 'checked';}?>> ขนส่งสินค้า
            &nbsp;&nbsp;<input type="radio" name="quo_titles" value="6" <?php if($quo_titles == '6'){echo 'checked';}?>> อื่นๆ
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ที่อยู่ :</strong> <input type="text" name="cd_address" value="<?php  echo $cd_address;?>" id="cd_address" class="inpfoder" style="width:85%;border: 0px;"></td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong> วันที่ :</strong> <input type="text" name="date_forder" readonly value="<?php  if($date_forder==""){echo date("d/m/Y");}else{ echo $date_forder;}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_forder'});</script>
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>จังหวัด :</strong>
            <select name="cd_province" id="cd_province" class="inputselect" style="border: 0px;">
                <?php
                	$quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
					while($row_province = @mysqli_fetch_array($quprovince)){
					  ?>
					  	<option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
					  <?php
					}
				?>
            </select>
           	</td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ใบเสนอราคา :</strong> <input type="radio" name="type_service" value="1" <?php if($type_service == '1' || $type_service == '0'){echo 'checked';}?>> เครื่องล้างจาน
				&nbsp;&nbsp;<input type="radio" name="type_service" value="2" <?php if($type_service == '2'){echo 'checked';}?>> เครื่องล้างแก้ว
				&nbsp;&nbsp;<input type="radio" name="type_service" value="3" <?php if($type_service == '3'){echo 'checked';}?>> เครื่องผลิตน้ำแข็ง
        &nbsp;&nbsp;<input type="radio" name="type_service" value="4" <?php if($type_service == '4'){echo 'checked';}?>> อื่นๆ ระบุ
        &nbsp;&nbsp;<input type="text" name="type_service_dsc" value="<?php  echo $type_service_dsc;?>" id="type_service_dsc" class="inpfoder"         
      </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>โทรศัพท์ :</strong> <input type="text" name="cd_tel" value="<?php  echo $cd_tel;?>" id="cd_tel" class="inpfoder" style="border: 0px;">
            </td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อผู้ติดต่อ :</strong>
              <input type="text" name="c_contact" value="<?php  echo $c_contact;?>" id="c_contact" class="inpfoder" style="border: 0px;">
              <strong>เบอร์โทร :</strong>
              <input type="text" name="c_tel" value="<?php  echo $c_tel;?>" id="c_tel" class="inpfoder" style="border: 0px;">
            </td>
          </tr>
          <tr>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>อีเมล์ :</strong>
              <input type="test" name="cd_email" value="<?php  echo $cd_email;?>" id="cd_email" class="inpfoder" style="border: 0px;">
              <input type="hidden" name="cd_fax" value="<?php  echo $cd_fax;?>" id="cd_fax" class="inpfoder" style="border: 0px;">
            
            </td>
            <td style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;">
            	<strong>ชื่อพนักงานขาย : </strong>
              <select name="loc_contact" id="loc_contact">
                	<option value="">กรุณาเลือก</option>
                	<?php   
                  $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
                  while($row_custec = @mysqli_fetch_array($qu_custec)){
                    ?>
                    <option value="<?php   echo $row_custec['group_id'];?>" <?php   if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php   echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
                    <?php  
                  }
                ?>
              </select>
            </td>
          </tr>
</table>
<br>
<p>ทางบริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด มีความยินดีขอเสนอราคา <textarea name="c_title_detail" id="c_title_detail" style="height:25px;"><?php  echo $c_title_detail;?></textarea> <br>ให้พิจารณา ดังนี</p>
  <br>
<table width="100%" cellspacing="0" cellpadding="0" style="font-size:13pxtext-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="48%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <!-- <td width="20%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td> -->
      <td width="11%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="12%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา</strong></td>
      <td width="12%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="12%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">1</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">
      <select name="cpro1" id="cpro1" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro1 = @mysqli_fetch_array($qupro1)){
                ?>
                  <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cpro1 == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_spro_id']." | ".$row_qupro1['group_name'];?></option>
                <?php
              }
          ?>
      </select>
      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod1" id="pro_pod1" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros1 = @mysqli_fetch_array($qupros1)){
                ?>
                  <option value="<?php  echo $row_qupros1['group_name'];?>" <?php  if($pro_pod1 == $row_qupros1['group_name']){echo 'selected';}?>><?php  echo $row_qupros1['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod1');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;" >
        <input type="text" name="pro_sn1" value="<?php  echo number_format($pro_sn1, 2, '.', '');?>" id="pro_sn1" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount1" value="<?php  echo number_format($camount1, 2, '.', '');?>" id="camount1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice1" value="<?php  echo number_format($cprice1, 2, '.', '');?>" id="cprice1" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub1s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">2</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro2" id="cpro2" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro2 = @mysqli_fetch_array($qupro1)){
                ?>
                  <option value="<?php  echo $row_qupro2['group_id'];?>" <?php  if($cpro2 == $row_qupro2['group_id']){echo 'selected';}?>><?php  echo $row_qupro2['group_spro_id']." | ".$row_qupro2['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod2" id="pro_pod2" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros2 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros2 = @mysqli_fetch_array($qupros2)){
                ?>
                  <option value="<?php  echo $row_qupros2['group_name'];?>" <?php  if($pro_pod2 == $row_qupros2['group_name']){echo 'selected';}?>><?php  echo $row_qupros2['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod2');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="pro_sn2" value="<?php  echo number_format($pro_sn2, 2, '.', '');?>" id="pro_sn2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount2" value="<?php  echo number_format($camount2, 2, '.', '');?>" id="camount2" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      <input type="text" name="cprice2" value="<?php  echo number_format($cprice2, 2, '.', '');?>" id="cprice2" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub2s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">3</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro3" id="cpro3" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro3 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro3 = @mysqli_fetch_array($qupro3)){
                ?>
                  <option value="<?php  echo $row_qupro3['group_id'];?>" <?php  if($cpro3 == $row_qupro3['group_id']){echo 'selected';}?>><?php  echo $row_qupro3['group_spro_id']." | ".$row_qupro3['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod3" id="pro_pod3" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros3 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros3 = @mysqli_fetch_array($qupros3)){
                ?>
                  <option value="<?php  echo $row_qupros3['group_name'];?>" <?php  if($pro_pod3 == $row_qupros3['group_name']){echo 'selected';}?>><?php  echo $row_qupros3['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod3');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn3" value="<?php  echo number_format($pro_sn3, 2, '.', '');?>" id="pro_sn3" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount3" value="<?php  echo number_format($camount3, 2, '.', '');?>" id="camount3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice3" value="<?php  echo number_format($cprice3, 2, '.', '');?>" id="cprice3" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub3s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">4</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro4" id="cpro4" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro4 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro4 = @mysqli_fetch_array($qupro4)){
                ?>
                  <option value="<?php  echo $row_qupro4['group_id'];?>" <?php  if($cpro4 == $row_qupro4['group_id']){echo 'selected';}?>><?php  echo $row_qupro4['group_spro_id']." | ".$row_qupro4['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod4" id="pro_pod4" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros4 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros4 = @mysqli_fetch_array($qupros4)){
                ?>
                  <option value="<?php  echo $row_qupros4['group_name'];?>" <?php  if($pro_pod4 == $row_qupros4['group_name']){echo 'selected';}?>><?php  echo $row_qupros4['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod4');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn4" value="<?php  echo number_format($pro_sn4, 2, '.', '');?>" id="pro_sn4" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount4" value="<?php  echo number_format($camount4, 2, '.', '');?>" id="camount4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice4" value="<?php  echo number_format($cprice4, 2, '.', '');?>" id="cprice4" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub4s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">5</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro5" id="cpro5" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro5 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro5 = @mysqli_fetch_array($qupro5)){
                ?>
                  <option value="<?php  echo $row_qupro5['group_id'];?>" <?php  if($cpro5 == $row_qupro5['group_id']){echo 'selected';}?>><?php  echo $row_qupro5['group_spro_id']." | ".$row_qupro5['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod5" id="pro_pod5" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros5 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros5 = @mysqli_fetch_array($qupros5)){
                ?>
                  <option value="<?php  echo $row_qupros5['group_name'];?>" <?php  if($pro_pod5 == $row_qupros5['group_name']){echo 'selected';}?>><?php  echo $row_qupros5['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod5');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn5" value="<?php  echo number_format($pro_sn5, 2, '.', '');?>" id="pro_sn5" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount5" value="<?php  echo number_format($camount5, 2, '.', '');?>" id="camount5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice5" value="<?php  echo number_format($cprice5, 2, '.', '');?>" id="cprice5" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub5s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">6</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro6" id="cpro6" class="inputselect" style="width:90%;" >
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro6 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro6 = @mysqli_fetch_array($qupro6)){
                ?>
                  <option value="<?php  echo $row_qupro6['group_id'];?>" <?php  if($cpro6 == $row_qupro6['group_id']){echo 'selected';}?>><?php  echo $row_qupro6['group_spro_id']." | ".$row_qupro6['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod6" id="pro_pod6" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros6 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros6 = @mysqli_fetch_array($qupros6)){
                ?>
                  <option value="<?php  echo $row_qupros6['group_name'];?>" <?php  if($pro_pod6 == $row_qupros6['group_name']){echo 'selected';}?>><?php  echo $row_qupros6['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod6');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn6" value="<?php  echo number_format($pro_sn6, 2, '.', '');?>" id="pro_sn6" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount6" value="<?php  echo number_format($camount6, 2, '.', '');?>" id="camount6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
		<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice6" value="<?php  echo number_format($cprice6, 2, '.', '');?>" id="cprice6" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub6s;?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;text-align:center;">7</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro7" id="cpro7" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro7 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro7 = @mysqli_fetch_array($qupro7)){
                ?>
                  <option value="<?php  echo $row_qupro7['group_id'];?>" <?php  if($cpro7 == $row_qupro7['group_id']){echo 'selected';}?>><?php  echo $row_qupro7['group_spro_id']." | ".$row_qupro7['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod7" id="pro_pod7" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros7 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros7 = @mysqli_fetch_array($qupros7)){
                ?>
                  <option value="<?php  echo $row_qupros7['group_name'];?>" <?php  if($pro_pod7 == $row_qupros7['group_name']){echo 'selected';}?>><?php  echo $row_qupros7['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod7');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn7" value="<?php  echo number_format($pro_sn7, 2, '.', '');?>" id="pro_sn7" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount7" value="<?php  echo number_format($camount7, 2, '.', '');?>" id="camount7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice7" value="<?php  echo number_format($cprice7, 2, '.', '');?>" id="cprice7" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub7s;?>&nbsp;&nbsp;</td>
    </tr>

    <tr style="display:none">
      <td style="border:1px solid #000000;padding:5;text-align:center;">8</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro8" id="cpro8" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro8 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro8 = @mysqli_fetch_array($qupro8)){
                ?>
                  <option value="<?php  echo $row_qupro8['group_id'];?>" <?php  if($cpro8 == $row_qupro8['group_id']){echo 'selected';}?>><?php  echo $row_qupro8['group_spro_id']." | ".$row_qupro8['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro8');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod8" id="pro_pod8" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros8 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros8 = @mysqli_fetch_array($qupros7)){
                ?>
                  <option value="<?php  echo $row_qupros8['group_name'];?>" <?php  if($pro_pod8 == $row_qupros8['group_name']){echo 'selected';}?>><?php  echo $row_qupros8['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod8');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn8" value="<?php  echo number_format($pro_sn8, 2, '.', '');?>" id="pro_sn8" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount8" value="<?php  echo number_format($camount8, 2, '.', '');?>" id="camount8" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice8" value="<?php  echo number_format($cprice8, 2, '.', '');?>" id="cprice8" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub8s;?>&nbsp;&nbsp;</td>
    </tr>

    <tr style="display:none">
      <td style="border:1px solid #000000;padding:5;text-align:center;">9</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro9" id="cpro9" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro9 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro9 = @mysqli_fetch_array($qupro9)){
                ?>
                  <option value="<?php  echo $row_qupro9['group_id'];?>" <?php  if($cpro9 == $row_qupro9['group_id']){echo 'selected';}?>><?php  echo $row_qupro9['group_spro_id']." | ".$row_qupro9['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro9');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod9" id="pro_pod9" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros9 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros9 = @mysqli_fetch_array($qupros9)){
                ?>
                  <option value="<?php  echo $row_qupros9['group_name'];?>" <?php  if($pro_pod9 == $row_qupros9['group_name']){echo 'selected';}?>><?php  echo $row_qupros9['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod9');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn9" value="<?php  echo number_format($pro_sn9, 2, '.', '');?>" id="pro_sn9" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount9" value="<?php  echo number_format($camount9, 2, '.', '');?>" id="camount9" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice9" value="<?php  echo number_format($cprice9, 2, '.', '');?>" id="cprice9" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub9s;?>&nbsp;&nbsp;</td>
    </tr>

    <tr style="display:none">
      <td style="border:1px solid #000000;padding:5;text-align:center;">10</td>
      <td style="border:1px solid #000000;padding:5;text-align:left;">
      	<select name="cpro10" id="cpro10" class="inputselect" style="width:90%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupro10 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct2 ORDER BY group_name ASC");
              while($row_qupro10 = @mysqli_fetch_array($qupro10)){
                ?>
                  <option value="<?php  echo $row_qupro10['group_id'];?>" <?php  if($cpro10 == $row_qupro10['group_id']){echo 'selected';}?>><?php  echo $row_qupro10['group_spro_id']." | ".$row_qupro10['group_name'];?></option>
                <?php
              }
          ?>
      	</select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php?protype=cpro10');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td>
      <!-- <td style="border:1px solid #000000;padding:5;text-align:center;" >
      <select name="pro_pod10" id="pro_pod10" class="inputselect" style="width:80%;">
      		<option value="">กรุณาเลือกรายการ</option>
		  <?php
              $qupros10 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
              while($row_qupros10 = @mysqli_fetch_array($qupros10)){
                ?>
                  <option value="<?php  echo $row_qupros10['group_name'];?>" <?php  if($pro_pod10 == $row_qupros10['group_name']){echo 'selected';}?>><?php  echo $row_qupros10['group_name'];?></option>
                <?php
              }
          ?>
      </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod10');"><img src="../images/icon2/mark_f2.png" width="25" height="25" alt="" style="vertical-align:middle;padding-left:5px;"></a>
      </td> -->
      <td style="border:1px solid #000000;padding:5;text-align:center;"><input type="text" name="pro_sn10" value="<?php  echo number_format($pro_sn10, 2, '.', '');?>" id="pro_sn10" class="inpfoder" style="width:100%;text-align:center;"></td>
      <td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="camount10" value="<?php  echo number_format($camount10, 2, '.', '');?>" id="camount10" class="inpfoder" style="width:100%;text-align:center;">
      </td>
	<td style="border:1px solid #000000;padding:5;text-align:center;">
      	<input type="text" name="cprice10" value="<?php  echo number_format($cprice10, 2, '.', '');?>" id="cprice10" class="inpfoder" style="width:100%;text-align:center;">
      </td>
      <td style="border:1px solid #000000;padding:5;text-align:right;"><?php echo $totalSub10s;?>&nbsp;&nbsp;</td>
    </tr>

    <tr>
      <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumprice,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumpricevat,2);?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;border:0px solid #003399;padding:9px 5px;background-color: #ddebf7;"><strong><?php echo baht_text($sumtotals);?></strong></td>
      <td style="border:0px solid #003399;padding:9px 5px;"></td>
      <td style="border:1px solid #003399;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #003399;padding:9px 5px;text-align:right;"><?php echo number_format($sumtotals,2);?>&nbsp;&nbsp;</td>
    </tr>
    </table><br>
    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><strong>รูปภาพประกอบที่ 1 (Size 250px x 150px)</strong></td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><strong>รูปภาพประกอบที่ 2 (Size 250px x 150px)</strong></td>
        <td width="33%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;"><strong>รูปภาพประกอบที่ 3 (Size 250px x 150px)</strong></td>
    </tr>
    <tr>
        <td width="33%" style="border:1px solid #000000;text-align:center;">
        <input type="file" name="pro_img1s"> 
        <?php 
         if($pro_img1 != ""){
          ?><br><br>
           <img src="../../upload/quotation/<?php  echo $pro_img1;?>" height="150"><br>
           <input type="checkbox" id="deleteimg1" name="deleteimg1" value="1"> Delete
          <?php
         }
        ?>
        <input name="pro_img1" type="hidden" value="<?php  echo $pro_img1; ?>">
      </td>
        <td width="33%" style="border:1px solid #000000;text-align:center;">
        <input type="file" name="pro_img2s">
        <?php 
         if($pro_img2 != ""){
          ?><br><br>
           <img src="../../upload/quotation/<?php  echo $pro_img2;?>" height="150"><br>
           <input type="checkbox" id="deleteimg2" name="deleteimg2" value="1"> Delete
          <?php
         }
        ?>
         <input name="pro_img2" type="hidden" value="<?php  echo $pro_img2; ?>">
      </td>
        <td width="33%" style="border:1px solid #000000;text-align:center;">
        <input type="file" name="pro_img3s">
        <?php 
         if($pro_img3 != ""){
          ?><br><br>
           <img src="../../upload/quotation/<?php  echo $pro_img3;?>" height="150"><br>
           <input type="checkbox" id="deleteimg3" name="deleteimg3" value="1"> Delete
          <?php
         }
        ?>
        <input name="pro_img3" type="hidden" value="<?php  echo $pro_img3; ?>">
      </td>
    </tr>
  </table>
  <br/><br/>
	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="70%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <p><strong>เงื่อนไขการขาย / การชำระเงิน</strong></p> 
        <p>
        	 1. <strong><u>การชำระเงิน</u></strong> <input type="text" name="paycon1" value="<?php  echo $paycon1;?>" id="paycon1" class="inpfoder" style="width: 350px;border: 1px solid;"><br/>
           <br><strong>เงื่อนไขการขาย</strong><br>
           <br>1. ราคาดังกล่าวข้างต้น <input type="text" name="pay1" value="<?php echo $pay1;?>" style="text-align: center;width: 100px;"> ภาษีมูลค่าเพิ่ม <input type="text" name="pay2" value="<?php echo $pay2;?>" style="text-align: center;width: 50px;"> ตามที่สรรพากรกำหนดเรียบร้อยแล้ว
        	 <br>2. กำหนดยืนราคา <input type="text" name="giveprice" value="<?php echo $giveprice;?>" style="text-align: center;width: 50px;"> วัน นับตั้งแต่วันที่อนุมัติใบเสนอราคา หรือ PO สั่งซื้อบริการดีงกล่าวข้างต้น	
           <br>3. ทางบริษัทฯ ขอสงวนสิทธ์ในกรณีที่ลูกค้าเช็นอนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆเกิดขึ้นระหว่างดำเนินการ ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น
           <!-- <br><span>** รับประกันอะไหล่ <input type="text" name="guaran" value="<?php echo $guaran;?>" style="text-align: center;width: 50px;"> เดือน ** หรือ <input type="text" name="paycon2" value="<?php  echo $paycon2;?>" id="paycon2" class="inpfoder" style="width: 350px;border: 1px solid;"></span> -->
        </p>    
        </td>
        <td width="30%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <p style="text-align: center;"><strong>บัญชีธนาคาร :สำหรับโอนเงินชำระค่าสินค้า</strong></p> 
        <p style="    text-align: center;">
        <span style="color: #018022;font-weight: bold;">
    ธนาคารกสิกร : สาขา สุขาภิบาล 5<br>
    บัญชีออมทรัพย์ : บจก.โอเมก้าแมชชีนเนอรี่ (1999)<br>
    เลขที่บัญชี : 026-1-810689</span><br><br>
    <span style="color: #4b2b7e;font-weight: bold;">ธนาคารไทยพาณิชย์ : สาขา โชคชัย 4 5<br>
    บัญชีออมทรัพย์ : บจก.โอเมก้าแมชชีนเนอรี่ (1999)<br>
    เลขที่บัญชี : 127-2-27409-1
    </span>
        </p>
        </td>
      </tr>
      
    </table>
    <br>
    <table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:left;padding-top:10px;padding-bottom:10px;">
        <strong>หมายเหตุอื่นๆ :</strong>
        <br>
        <textarea name="remark" id="remark" style="height:150px;"><?php  echo strip_tags($remark);?></textarea>
        </td>
      </tr>
    </table>
    <br>
  	<table width="100%" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติสั่งซื้อสินค้าตามรายการข้างต้น</strong></td>
              </tr>
              <tr>
                <td style="font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;">
                วันที่ ________________________
                </td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	

        </td>
        <td width="33%" style="border:1px solid #000000;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>
                <select name="cs_technic" id="cs_technic">
                	<option value="">กรุณาเลือก</option>
                	<?php  
						$qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");
						while($row_custec = @mysqli_fetch_array($qu_custec)){
							// if($row_custec['group_id'] == 11 || $row_custec['group_id'] == 33 || $row_custec['group_id'] == 34){
							?>
							<option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $cs_technic){echo 'selected';}?>><?php  echo $row_custec['group_name'];?></option>
							<?php 
							// }
						}
					?>
                </select></strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานฝ่ายช่าง / ผู้เสนอ</strong></td>
              </tr>
              <tr>
              <td style="font-size:13pxfont-family:Verdana, Geneva, sans-serif;text-align:center;">
             </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
    </fieldset>
    </div><br>
    <div class="formArea">
      <div style="text-align: center;">
      <input type="button" value=" บันทึก " id="submitF" class="button bt_save" onclick="submitForm()">
      <input type="button" name="Cancel" id="resetF" value=" ยกเลิก " class="button bt_cancel" onClick="window.location='index.php'">
      </div>
      <?php
			$a_not_exists = array();
			post_param($a_param,$a_not_exists);
			?>
      <input name="mode" type="hidden" id="mode" value="<?php  echo $_GET['mode'];?>">
      <input name="status_use" type="hidden" id="status_use" value="<?php  echo $status_use;?>">
      <input name="quotation" type="hidden" id="quotation" value="<?php  echo $quotation;?>">
      <input name="st_setting" type="hidden" id="st_setting" value="<?php  echo $st_setting;?>">
      <input name="<?php  echo $PK_field;?>" type="hidden" id="<?php  echo $PK_field;?>" value="<?php  echo $_GET[$PK_field];?>">
    </div>
  </form>
</DIV>
</DIV><!-- End .content-box-content -->
</DIV><!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<?php  if($msg_user==1){?>
<script language=JavaScript>alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');</script>
<?php  }?>
</BODY>
</HTML>
