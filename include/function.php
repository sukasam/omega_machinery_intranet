<?php
/* *******************
Last Revised : 1 Dec, 2006
/* *******************

Check_Permission($conn,$check_module,$user_id,$action)
Cal_Age($date)
Show_Data($conn,$tbl_name, $key, $value, $fieldname)
Show_Full_Category($conn,$value)
Update_Transaction_DateTime ($sql, $mode)
date_format ($create_date)
CheckBox ($box_name, $value)
CmdDropDown($conn,$sql, $box_name, $fieldkey, $value, $fieldshow)
CmdListBox($conn,$sql, $box_name, $fieldkey, $value, $fieldshow)
CheckData ($value)
Show_Sort ($orderby, $cn,  $field_select, $sortby,$page)
Show_Sort_bg ($field)
Msg_Error ("Login or password not found")
function calculate_price($conn,$cart)
function calculate_items($cart)
function get_product_detail($conn,$product_id)
function NumToThai($value)
function gen_random ($length)
function show_check($str)
function format_date_th ($value,$type)
function format_date_en ($value,$type)
function Show_Text ($label,$value)
function Delete_Photo ($path, $value)
function Upload_Photo ($file, $path, $size, $value)
function Show_Choice ($select_name, $list_array , $value) {
function Show_Choice_month ($select_name, $list_array , $value) {
function Cal_Age($date)
function uploadfile($path,$filename,$file,$sizes,$rotate, $quality)
function make_thumb($input_file_name, $input_file_path,$width,$quality)
function Toggle ($value, $tbl_name, $field, $field_change) {
function get_product_details($product_id)
function Show_Image ($ref_id, $gallery_group, $flag) {
function Get_Point($conn,$member_id){
function resize($fromimage, $toimage, $size=500, $imagesname="jpg") {
function Show_Flash_banner($pathfiles,$width,$height){
 **********************/
function Show_Image($ref_id, $gallery_group, $flag, $size)
{
    $sql = "select * from gallery where ref_id = '$ref_id' and gallery_group = '$gallery_group'";
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {
        $filename = "upload/" . $gallery_group . "/" . $rec["gallery_id"] . "_$size.jpg";
        if (file_exists($filename)) {
            $msg = '<img src="' . $filename . '" border="0">';
        }
    }
    return $msg;
}
//------------------------------------------------------------------------------------------------------

function get_product_details($product_id)
{
    if (!$product_id || $product_id == "") {
        return false;
    }

    $query = "select * from product where product_id='$product_id'";
    $result = @mysqli_query($conn, $query);
    if (!$result) {
        return false;
    }

    $result = @mysqli_fetch_array($result);
    return $result;
}
//------------------------------------------------------------------------------------------------------

function Toggle($value, $tbl_name, $field, $field_change)
{
    $sql = "select * from " . $tbl_name . " where " . $field . " = '$value'";
    $query = @mysqli_query($conn, $sql);
    if ($rec = @mysqli_fetch_array($query)) {
        if ($rec[$field_change] == "" || $rec[$field_change] == "0") {$status = '1';} else { $status = '';}
        $sql = "update  " . $tbl_name . " set " . $field_change . "  = '$status'  where " . $field . " = '$value'";
        @mysqli_query($conn, $sql);
        //echo $sql;
    }
}
//------------------------------------------------------------------------------------------------------

function Cal_Age($birthdate)
{
    list($dob_year, $dob_month, $dob_day) = explode('-', $birthdate);
    $cur_year = date('Y');
    $cur_month = date('m');
    $cur_day = date('d');
    if ($cur_month >= $dob_month && $cur_day >= $dob_day) {
        $age = $cur_year - $dob_year;
    } else {
        $age = $cur_year - $dob_year - 1;
    }
    echo $age;
}
//------------------------------------------------------------------------------------------------------

function Show_Choice($select_name, $list_array, $prefer_location)
{
    $msg = '<select name="' . $select_name . '">';
    $msg .= '<option value="">Select One</option> ';
    foreach ($list_array as $value) {
        if (substr($value, 0, 1) == "-") {$msg .= '<option value="" ';
        } else {
            $msg .= '<option value="' . $value . '" ';
        }
        if ($prefer_location == $value) {$msg .= ' selected ';}
        $msg .= '> ' . $value . '</option>';
    }
    $msg .= '</select>';
    echo $msg;
}
//------------------------------------------------------------------------------------------------------

function Show_Choice_month($select_name, $list_array, $prefer_location)
{
    $msg = '<select name="' . $select_name . '">';
    $msg .= '<option value="">--เดือน--</option> ';
    foreach ($list_array as $value) {
        if (substr($value, 0, 1) == "-") {$msg .= '<option value="" ';
        } else {
            $msg .= '<option value="' . $value . '" ';
        }
        if ($prefer_location == $value) {$msg .= ' selected ';}
        $msg .= '> ' . $value . '</option>';
    }
    $msg .= '</select>';
    echo $msg;
}

//------------------------------------------------------------------------------------------------------

function Upload_Photo($file, $path, $size, $value)
{
    if ($file != "") {
        $path = "../../upload/" . $path . "/" . $size . "/";
        $filename = $value . ".jpg";
        copy($file, $path . $filename);
    }
}
//------------------------------------------------------------------------------------------------------

function Delete_Photo($path, $value)
{
    $delete_file = "../../upload/" . $path . "/small/" . $value . ".jpg";
    if (file_exists($delete_file)) {
        unlink($delete_file);
    }

    $delete_file = "../../upload/" . $path . "/large/" . $value . ".jpg";
    if (file_exists($delete_file)) {
        unlink($delete_file);
    }

}
//------------------------------------------------------------------------------------------------------

function Show_Text($label, $value)
{
    if (trim($value == "")) {

    } else {
        echo "<strong>$label</strong>$value";
    }
}
//------------------------------------------------------------------------------------------------------

function format_date_en($value, $type)
{
    list($s_date, $s_time) = explode(" ", $value);
    list($s_year, $s_month, $s_day) = explode("-", $s_date);
    list($s_hour, $s_minute, $s_second) = explode(":", $s_time);
    $s_month += 0;
    $s_day += 0;
    if ($s_day == "0") {
        return "";
    }

    $mktime = mktime($s_hour, $s_minute, $s_second, $s_month, $s_day, $s_year);
    switch ($type) {
        case "1": // Friday 11 November 2005
            $msg = date("l d F Y", $mktime);
            break;
        case "2": // 11 Nov 05
            $msg = date("d M y", $mktime);
            break;
        case "3": // Friday 11 November 2005 00:11
            $msg = date("l d F Y H:m", $mktime);
            break;
        case "4": // 11 Nov 05 00:11
            $msg = date("d M y  H:m", $mktime);
            break;
        case "5": // 11 Nov 05 00:11
            $msg = date("d M Y", $mktime);
            break;
        case "6": // 11/05/2010
            $year = date("Y") + 543;
            $msg = date("d/m/" . $year, $mktime);
            break;
        case "7": // 11-05-2556
            $year = date("Y") + 543;
            $msg = date("d m " . $year, $mktime);
    }
    return ($msg);
}
//------------------------------------------------------------------------------------------------------

function format_month_th($value)
{
    $month_full_th = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', ' กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
    switch ($value) {
        case "January":
            $msg = $month_full_th[1];
            break;
        case "February":
            $msg = $month_full_th[2];
            break;
        case "March":
            $msg = $month_full_th[3];
            break;
        case "April":
            $msg = $month_full_th[4];
            break;
        case "May":
            $msg = $month_full_th[5];
            break;
        case "June":
            $msg = $month_full_th[6];
            break;
        case "July":
            $msg = $month_full_th[7];
            break;
        case "August":
            $msg = $month_full_th[8];
            break;
        case "September":
            $msg = $month_full_th[9];
            break;
        case "October":
            $msg = $month_full_th[10];
            break;
        case "November":
            $msg = $month_full_th[11];
            break;
        case "December":
            $msg = $month_full_th[12];
            break;
    }
    return ($msg);

}

function format_date_th($value, $type)
{
    if (strlen($value) > 10) {
        list($s_date, $s_time) = explode(" ", $value);
        list($s_year, $s_month, $s_day) = explode("-", $s_date);
        list($s_hour, $s_minute, $s_second) = explode(":", $s_time);
    } else {
        list($s_year, $s_month, $s_day) = explode("-", $value);
    }
    $s_month += 0;
    $s_day += 0;
    if ($s_day == "0") {
        return "";
    }

    $s_year += 543;
    $month_full_th = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', ' กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
    $month_brief_th = array('', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
    $day_of_week = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
    switch ($type) {
        case "1": // วันที่ 4 มกราคม 2548
            $msg = "วันที่ " . $s_day . " " . $month_full_th[$s_month] . " " . $s_year;
            break;
        case "2": // 4 ม.ค. 2548
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . $s_year;
            break;
        case "3": // อาทิตย์ที่ 4 มกราคม 2548 เวลา 14.11 น.
            $msg = "วัน " . $s_day . " " . $month_full_th[$s_month] . " " . $s_year . " เวลา " . $s_hour . "." . $s_minute . " น.";
            break;
        case "4": // 4 ม.ค. 2548 14.11 น.
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . $s_year . "  " . $s_hour . "." . $s_minute . " น.";
            break;
        case "5": // 4 ม.ค. 2548
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . $s_year;
            break;
        case "6": // 4 ก.พ. 51
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . substr($s_year, -2);
            break;
        case "7": // 4 ก.พ. 51
            $msg = $s_day . "/" . $s_month . "/" . $s_year;
            break;
        case "8": // 4 ม.ค. 2548 <br /><br />14.11 น.
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . $s_year . "<br><br>เวลา " . $s_hour . "." . $s_minute . " น.";
            break;
        case "9": // 4 ก.พ. 51
            $msg = ($s_year - 543) . "-" . sprintf("%02d", $s_month) . "-" . sprintf("%02d", $s_day);
            break;
        case "10": // 4 ม.ค. 2548 <br /><br />14.11 น.
            $msg = $s_day . " " . $month_brief_th[$s_month] . " " . $s_year . "<br>เวลา " . $s_hour . "." . $s_minute . " น.";
            break;
    }
    return ($msg);

}
//------------------------------------------------------------------------------------------------------

function format_date_th2($value)
{
    $date = explode("-", $value);
    $month_full_th = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', ' กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
    $text = (int) $date[2] . " " . $month_full_th[$date[1]] . " " . ($date[0]);
    return ($text);
}
//------------------------------------------------------------------------------------------------------

function gen_random($length)
{
    $keychars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789";

    // RANDOM KEY GENERATOR
    $randkey = "";
    $max = strlen($keychars) - 1;
    for ($i = 0; $i <= $length; $i++) {
        $randkey .= substr($keychars, rand(0, $max), 1);
    }
    return $randkey;

}
//------------------------------------------------------------------------------------------------------

function gen_random_num($length)
{
    $keychars = "0123456789";

    // RANDOM KEY GENERATOR
    $randkey = "";
    $max = strlen($keychars) - 1;
    for ($i = 0; $i <= $length; $i++) {
        $randkey .= substr($keychars, rand(0, $max), 1);
    }
    return $randkey;

}

//------------------------------------------------------------------------------------------------------

function show_check($str)
{
    $str = trim($str);
    if ($str == "1") {
        $msg = "<img src = '../images/check1.gif'>";
    }

    if ($str == "" || $str == "0") {
        $msg = "<img src = '../images/check0.gif'>";
    }

    echo $msg;
}
function NumToThai($value)
{
    // Constant Variable
    $Unit = array("", "???", "????", "???", "?????", "???", "????");
    $No = array("?????", "????", "??", "???", "???", "???", "??", "????", "???", "????");

    // Prepare Variable
    $NumToThai = "";
    $Pos = 0;

    list($Number, $Satang) = explode("[.]", $value);
    // Process
    while ($Number > 0) {
        $LastDigit = $Number % 10;

        if ($Pos == 0 && $LastDigit == 1 && $Number > 1) {
            $NumToThai = "????";
        } elseif ($Pos == 1 && $LastDigit == 1) {
            $NumToThai = "???" . $NumToThai;
        } elseif ($Pos == 1 && $LastDigit == 2) {
            $NumToThai = "??????" . $NumToThai;
        } elseif ($LastDigit != 0) {
            $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai;
        }

        $Number = (int) ($Number / 10);
        $Pos = $Pos + 1;
    }
    $msg = $NumToThai . "???";
    if ($Satang + 0 == 0) {
        $msg .= "???";
    }

// ***************
    if ($Satang > 0) {
        $Pos = 0;
        $Number = $Satang;
        $NumToThai = "";
        while ($Number > 0) {
            $LastDigit = $Number % 10;
            if ($Pos == 0 && $LastDigit == 1 && $Number > 1) {
                $NumToThai = "????";
            } elseif ($Pos == 1 && $LastDigit == 1) {
                $NumToThai = "???" . $NumToThai;
            } elseif ($Pos == 1 && $LastDigit == 2) {
                $NumToThai = "??????" . $NumToThai;
            } elseif ($LastDigit != 0) {
                $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai;
            }

            $Number = (int) ($Number / 10);
            $Pos = $Pos + 1;
        }
        $msg .= $NumToThai . "?????";

    }

// *****************
    if ($NumToThai == "") {
        $NumToThai = "-";
    }

    return $msg;
}
//------------------------------------------------------------------------------------------------------

function convert_price($number)
{
    $num = array('?????', '????', '??', '???', '???', '???', '??', '????', '???', '????');
    $unit = array('', '???', '????', '???', '?????', '???', '????');
    $number = explode(".", $number);
    $c_num = $n = strlen($number[0]);
    for ($i = 0; $i < $c_num; $i++) {
        $n--;
        $c_digit = substr($number[0], $i, 1);
        if ($c_digit != '0' || $n == '6') {
            if ($c_digit == '2' && $n == '1') {
                $convert .= '???';
            } elseif ($c_digit == '1' && $n == '1') {
                $convert .= '';
            } else {
                $convert .= $num[$c_digit];
            }

            $convert .= $unit[$n];
        }
    }
    return $convert;
}
//------------------------------------------------------------------------------------------------------

function calculate_price($conn, $cart)
{
    $price = 0.0;
    if (is_array($cart)) {
        // $conn = connect_db("thaigoodstuff");
        foreach ($cart as $product_id => $qty) {
            $query = "select price from product where product_id ='$product_id'";
            $result = @mysqli_query($conn, $query);
            if ($result) {
                $item_price = mysql_result($result, 0, "price");
                $price += $item_price * $qty;
            }
        }
    }
    return $price;
}
//------------------------------------------------------------------------------------------------------

function calculate_items($cart)
{
    $items = 0;
    if (is_array($cart)) {
        foreach ($cart as $product_id => $qty) {
            $items += $qty;
        }
    }
    return $items;
}
//------------------------------------------------------------------------------------------------------

function get_product_detail($conn, $product_id)
{
    if (!$product_id || $product_id == "") {
        return false;
    }

    $sql = "select * from product where product_id = '$product_id'";
    $query = @mysqli_query($conn, $sql);

    if (!$query) {
        return false;
    }

    $rec = @mysqli_fetch_array($query);
    return $rec;

}
//------------------------------------------------------------------------------------------------------

function Msg_Error($msg)
{
    $ret = '<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">';
    $ret .= '  <tr>';
    $ret .= '    <td bgcolor="#FF0000"><table width="100%" border="0" cellspacing="1" cellpadding="1">';
    $ret .= '        <tr>';
    $ret .= '          <td align="center" bgcolor="#FFFFFF"><br><br>' . $msg . '<br><br><br></td>';
    $ret .= '        </tr>';
    $ret .= '      </table></td>';
    $ret .= '  </tr>';
    $ret .= '</table>';
    return $ret;
}
//------------------------------------------------------------------------------------------------------

function Check_Permission2($conn, $check_module, $user_id, $action)
{
    $sql = "select * from s_user_p where user_id = '$user_id' and s_module like '$check_module' and ";
    if ($action == "read") {
        $sql .= " read_p like '1'";
    }

    if ($action == "add") {
        $sql .= " add_p like '1'";
    }

    if ($action == "update") {
        $sql .= " update_p like '1'";
    }

    if ($action == "delete") {
        $sql .= " delete_p like '1'";
    }

    //echo $sql;
    $query = @mysqli_query($conn, $sql) or die("Can not check permission");
    $code = 0;
    if ($rec = @mysqli_fetch_array($query)) {
        switch ($action) {
            case "read":$code = $rec["read_p"];
                break;
            case "add":$code = $rec["add_p"];
                break;
            case "update":$code = $rec["update_p"];
                break;
            case "delete":$code = $rec["delete_p"];
                break;
        }
    }
//    echo $sql;
    if ($code == "0") {
        header("location:/inner/error/permission.php");
    }
}
//------------------------------------------------------------------------------------------------------

function Show_Data($conn, $tbl_name, $key, $value, $fieldname)
{
    $sql = "select * from $tbl_name where $key like '" . $value . "'";
    $query = @mysqli_query($conn, $sql);
    $fields = explode(":", $fieldname);
    $msg = "";
    if ($rec = @mysqli_fetch_array($query)) {
        foreach ($fields as $key => $value) {
            $msg .= " : " . $rec[$value];
        }
        $msg = substr($msg, 3);
    }
    return $msg;
}
//------------------------------------------------------------------------------------------------------

function Show_Full_Category($conn, $value)
{
    $stop = 0;
    $sql = "select * from category where category_id  like '" . $value . "'";
    $query = @mysqli_query($conn, $sql);
    $rec = @mysqli_fetch_array($query);
    $url = $rec["category_name"];
    $parent_category_id = $rec["parent_category_id"];
    while ($parent_category_id != '0' and !$stop) {
        //echo "65555555";
        $sql = "select * from category where category_id  like '" . $parent_category_id . "'";
        $query = @mysqli_query($conn, $sql);
        if ($rec = @mysqli_fetch_array($query)) {
            $url = $rec["category_name"] . " > " . $url;
            $parent_category_id = $rec["parent_category_id"];
        } else {
            $stop = 1;
        }
    }
//    $url = "Home" . " > " . $url;
    echo $url;
}
function Show_Full_Category_data($conn, $value)
{
    $stop = 0;
    $sql = "select * from category where category_id  like '" . $value . "'";
    $query = @mysqli_query($conn, $sql);
    $rec = @mysqli_fetch_array($query);
    $url = $rec["category_name"];
    $parent_category_id = $rec["parent_category_id"];
    while ($parent_category_id != '0' and !$stop) {
        $sql = "select * from category where category_id  like '" . $parent_category_id . "'";
        $query = @mysqli_query($conn, $sql);
        if ($rec = @mysqli_fetch_array($query)) {
            $url = $rec["category_name"] . " > " . $url;
            $parent_category_id = $rec["parent_category_id"];
        } else {
            $stop = 1;
        }
    }
//    $url = "Home" . " > " . $url;
    return $url;
}
function Show_Full_Category_nav($conn, $value)
{
    $stop = 0;
    $sql = "select * from category where category_id  like '" . $value . "'";
    $query = @mysqli_query($conn, $sql);
    $rec = @mysqli_fetch_array($query);
    $url = '<a href="list.php?category_id=' . $rec["category_id"] . '">' . $rec["category_name"] . $url . '</a>';
    $parent_category_id = $rec["parent_category_id"];
    while ($parent_category_id != '1' and !$stop) {
        $sql = "select * from category where category_id  like '" . $parent_category_id . "'";
        $query = @mysqli_query($conn, $sql);
        if ($rec = @mysqli_fetch_array($query)) {
            $url = '<a href="' . $_SERVER['PHP_SELF'] . '?category_id=' . $rec["category_id"] . '">' . $rec["category_name"] . '</a> > ' . $url;
            $parent_category_id = $rec["parent_category_id"];
        } else {
            $stop = 1;
        }
    }
    $url = '<a href="/">Home</a>' . " > " . $url;
    echo $url;
}
function Update_Transaction_DateTime($sql, $mode)
{
    if ($mode == "add") {

    }
    if ($mode == "update") {
        $sql .= ", update_date = '" . date("Y-m-d H:m:s") . "'";
        $sql .= ", update_by = '" . $_SESSION["username"] . "'";
    }
    if ($mode == "delete") {

    }
    return $sql;
}
/* function date_format ($create_date) {
list($year1, $month1, $day1, $hour1, $minute1, $second1 ) = explode('[-.]', $create_date);
return mktime(0,0,0,$month1,$day1,$year1);
}  */
function CheckBox($box_name, $value)
{
    if ($value) {
        $value = " checked ";
    }

    echo '<input name="' . $box_name . '" type="checkbox" value="1" ' . $value . '>';
}
function CmdDropDown($conn, $sql, $box_name, $fieldkey, $value, $fieldshow)
{
    if ($value == "0" or $value == "") {
        $select_none = " selected ";
    } else {
        $select_none = "";
    }

    echo '<select name="' . $box_name . '" >';
    echo '<option value="" ' . $select_none . '>Select One</option>';

    $query = @mysqli_query($conn, $sql);

    while ($rec = @mysqli_fetch_array($query)) {

        if ($rec[$fieldkey] == $value) {
            $selected = " selected ";
        } else {
            $selected = "";
        }

        echo '<option value="' . $rec[$fieldkey] . '" ' . $selected . '>' . $rec[$fieldshow] . '</option>';
    }
    echo '</select>';
}
function CmdDropDown2($conn, $sql, $box_name, $fieldkey, $value, $fieldshow, $fieldshow2)
{
    if ($value == "0" or $value == "") {
        $select_none = " selected ";
    } else {
        $select_none = "";
    }

    echo '<select name="' . $box_name . '" >';
    echo '<option value="" ' . $select_none . '>Select One</option>';
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {

        if ($rec[$fieldkey] == $value) {
            $selected = " selected ";
        } else {
            $selected = "";
        }

        echo '<option value="' . $rec[$fieldkey] . '" ' . $selected . '>' . $rec[$fieldshow] . " ( " . $rec[$fieldshow2] . ' )</option>';
    }
    echo '</select>';
}
function CmdDropDown3($conn, $sql, $box_name, $fieldkey, $value, $fieldshow)
{
    if ($value == "0" or $value == "") {
        $select_none = " selected ";
    } else {
        $select_none = "";
    }

    echo '<select name="' . $box_name . '" >';
    echo '<option value="" ' . $select_none . '>Other</option>';
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {

        if ($rec[$fieldkey] == $value) {
            $selected = " selected ";
        } else {
            $selected = "";
        }

        echo '<option value="' . $rec[$fieldkey] . '" ' . $selected . '>' . $rec[$fieldshow] . '</option>';
    }
    echo '</select>';
}
function CmdDropDown4($conn, $sql, $box_name, $fieldkey, $value, $fieldshow)
{
    if ($value == "0" or $value == "") {
        $select_none = " selected ";
    } else {
        $select_none = "";
    }

    echo '<select name="' . $box_name . '" >';
    echo '<option value="" ' . $select_none . '>Select One</option>';
    echo '<option value="" ' . $select_none . '>????</option>';
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {

        if ($rec[$fieldkey] == $value) {
            $selected = " selected ";
        } else {
            $selected = "";
        }

        echo '<option value="' . $rec[$fieldkey] . '" ' . $selected . '>' . $rec[$fieldshow] . '</option>';
    }
    echo '</select>';
}
function CmdListBox($conn, $sql, $box_name, $fieldkey, $value, $fieldshow, $total_value)
{
    echo '<select name="' . $box_name . '" size=15 multiple>';
    echo '<option value=""  >Select One</option>';
    $query = @mysqli_query($conn, $sql);
    while ($rec = @mysqli_fetch_array($query)) {
        $selected = "";
        if (in_array($rec[$fieldkey], $total_value)) {
            $selected = " selected ";
        }

        echo '                    <option value="' . $rec[$fieldkey] . '" ' . $selected . '>' . $rec[$fieldshow] . '</option>';
    }
    echo '                  </select>';
}
function CmdRadio($box_name, $a_value, $select_value)
{
    foreach ($a_value as $key => $value) {
        $check = "";
        if ($key == $select_value) {$check = " checked ";}
        echo '<input type="radio" name="' . $box_name . '" value="' . $key . '" ' . $check . '>' . $value;
    }
}
function CheckData($value)
{
    if (isset($value)) {
        echo $value;
    }

}
function Show_Sort($orderby, $cn, $field_select, $sortby, $page)
{
    global $FK_field;
    global $$FK_field;

    if ($sortby != "" and ($orderby == $field_select)) {
        $img = '<img src="../../inner/icons/' . $sortby . '.gif">';
    }

    if ($sortby == "desc" or $sortby == "") {
        $sortby = "asc";
    } else {
        $sortby = "desc";
    }

    if ($orderby != $field_select) {
        $sortby = "asc";
    }

    $param = "orderby=$orderby";
    if ($FK_field != "") {
        $param .= "&" . $FK_field . "=" . $$FK_field;
    }

    if ($sortby != "") {
        $param .= "&sortby=$sortby";
    }

    if ($keyword != "") {
        $param .= "&keyword=$keyword";
    }

    if ($page != "") {
        $param .= "&page=" . $_GET["page"];
    }

    $link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] . "?" . $param . "'>";
    $url = $link_1 . $cn . "</a>";
    if ($sortby != "") {
        $url .= $img;
    }

    echo $url;
}

function Show_Sort_new($orderby, $cn, $field_select, $sortby, $page, $param)
{
    global $FK_field;
    global $$FK_field;
    global $s_domain;

    if ($sortby != "" and ($orderby == $field_select)) {
        $img = '<img src="../../inner/icons/' . $sortby . '.gif">';
    }

    if ($sortby == "desc" or $sortby == "") {
        $sortby = "asc";
    } else {
        $sortby = "desc";
    }

    if ($orderby != $field_select) {
        $sortby = "asc";
    }

    $param .= "&orderby=" . $orderby . "&sortby=" . $sortby;
    $link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] . "?" . $param . "'>";
    $url = $link_1 . $cn . "</a>";
    if ($sortby != "") {
        $url .= $img;
    }

    echo $url;
}

function Show_Sort_bg($field, $sortby)
{
    if ($field == $sortby) {
        echo 'class="sort"';
    }

}

function cal_point($conn, $member_id, $action_type, $point)
{
    $sql = "select point from member where member_id = '$member_id'";
    $query = @mysqli_query($conn, $sql);
    $rec = @mysqli_fetch_array($query);
    $mpoint = $rec["point"];
    if ($action_type == "+") {
        //$mpoint = ???????????? query
        $total_point = $mpoint + $point;
    }
    if ($action_type == "-") {
        //$mpoint = ???????????? query
        $total_point = $mpoint - $point;
    }

    echo $total_point;
}
function make_thumb($input_file_name, $input_file_path, $width, $quality)
{
    global $config;
    $config[thumbnail_width] = $width;
    $config[thumbnail_height] = $width;
    $imagedata = GetImageSize("$input_file_path" . "$input_file_name");
    $imagewidth = $imagedata[0];
    $imageheight = $imagedata[1];
    $imagetype = $imagedata[2];
    // type definitions
    // 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP
    // 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order)
    // 9 = JPC, 10 = JP2, 11 = JPX
    $thumb_name = $input_file_name; //by default
    if ($imagetype == 2) {
        $shrinkage = 1;
        if ($imagewidth > $imageheight) {
            if ($imagewidth > $config[thumbnail_width]) {
                $shrinkage = $config[thumbnail_width] / $imagewidth;
                $dest_height = $shrinkage * $imageheight;
                $dest_width = $config[thumbnail_width];
            } else {
                $dest_height = $imageheight;
                $dest_width = $imagewidth;
            }
        } else {
            if ($imageheight > $config[thumbnail_height]) {
                $shrinkage = $config[thumbnail_height] / $imageheight;
                $dest_width = $shrinkage * $imagewidth;
                $dest_height = $config[thumbnail_height];
            } else {
                $dest_height = $imageheight;
                $dest_width = $imagewidth;
            }
        }
        $src_img = imagecreatefromjpeg("$input_file_path/$input_file_name");
        $dst_img = imagecreatetruecolor($dest_width, $dest_height);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $imagewidth, $imageheight);
        $thumb_name = "$input_file_name";
        imagejpeg($dst_img, "$input_file_path/$thumb_name", $quality);
        imagedestroy($src_img);
        imagedestroy($dst_img);
    } // end if $imagetype == 2
    return $thumb_name;
} // end function make_thumb

function uploadfile($input_file_path, $input_file_name, $file, $sizes, $quality)
{
    $version = "linux";
    if ($file != "") {
        if (!copy($file, $input_file_path . $input_file_name)) {
            echo ("failed to copy $file_name...<br>\n");
        }
        if ($version != "windows") {
            $pic = $input_file_path . $input_file_name;
            $size = GetImageSize("$pic");
            $w = $size[0];
            $h = $size[1];
            make_thumb($input_file_name, $input_file_path, $sizes, $quality);
        }
    }
}

function Get_Point($conn, $member_id)
{
    $sql = "select * from transaction where customer_id = '$member_id' order by transaction_id desc";
    $rec = @mysqli_fetch_array(@mysqli_query($conn, $sql));
    $total_point = $rec["total_point"];
    return $total_point;
}
//---------------------------------------------------------------------------------------------------------------------------------

function Check_Permission($conn, $check_module, $user_id, $action)
{
    $sql = "select * from s_user_group where user_id = '$user_id'";
    $query = @mysqli_query($conn, $sql) or die("1");
    $groups = "";

    while ($rec = @mysqli_fetch_array($query)) {
        $groups .= "or group_id = '$rec[group_id]'";
    }
    if ($groups != "") {
        $groups = substr($groups, 3);
        $groups = " and (" . $groups . ")";
    }
    $sql = "select * from s_module where module_name like '$check_module'";
    $query = @mysqli_query($conn, $sql) or die("2");
    $module_id = 0;
    while ($rec = @mysqli_fetch_array($query)) {
        $module_id = $rec["module_id"];
    }
    $sql = "select * from s_user where user_id = '$user_id'";
    $query = @mysqli_query($conn, $sql) or die("3");
    if ($rec = @mysqli_fetch_array($query)) {
        if ($rec["admin_flag"] == '1' or $_SESSION["s_group_all"] == "ALL") {

        } else {
/*
if ($action == "read") $sql .= " read_p like '1'";
if ($action == "add") $sql .= " add_p like '1'";
if ($action == "update") $sql .= " update_p like '1'";
if ($action == "delete") $sql .= " delete_p like '1'";
 */

            $sql = "select * from s_user_p where user_id = '$user_id'  and  module_id like '$module_id'";

            $query = @mysqli_query($conn, $sql) or die("4");
            if (@mysqli_num_rows($query)) {

                while ($rec = @mysqli_fetch_array($query)) {
                    switch ($action) {
                        case "read":$code = $rec["read_p"];
                            break;
                        case "add":$code = $rec["add_p"];
                            break;
                        case "update":$code = $rec["update_p"];
                            break;
                        case "delete":$code = $rec["delete_p"];
                            break;
                    }
                } // end while
                if (($code == "0") || ($code == "")) {
                    header("location:../error/permission.php");
                }

            } else {
                $code = "";
                if ($groups != "") {
                    $sql = "select sum(read_p) as s_read,sum(add_p) as s_add,sum(update_p) as s_update,sum(delete_p) as s_delete,module_id,group_id from s_user_p group by module_id,group_id having module_id like '$module_id' " . $groups;
                    //echo $sql;
                    $query = @mysqli_query($conn, $sql) or die("5");
                    if (@mysqli_num_rows($query) == 0) {
                        $code = "";
                    }

                    if ($rec = @mysqli_fetch_array($query)) {
                        switch ($action) {
                            case "read":$code = $rec["s_read"];
                                break;
                            case "add":$code = $rec["s_add"];
                                break;
                            case "update":$code = $rec["s_update"];
                                break;
                            case "delete":$code = $rec["s_delete"];
                                break;
                        } // end switch
                    }
                }
                if (trim($code) == '' or $code == '0') {
                    header("location:../error/permission.php");
                }
            }
        }
    } else {
        header("location:../error/permission.php");
    }
    return $code;
}
//---------------------------------------------------------------------------------------------------------------------------------

function Check_Permission_menu($conn, $check_module, $user_id, $action)
{
    $permission_denine = 0;
    $sql = "select * from s_user_group where user_id = '$user_id'";
    $query = @mysqli_query($conn, $sql) or die("1");
    $groups = "";

    while ($rec = @mysqli_fetch_array($query)) {
        $groups .= "or group_id = '$rec[group_id]'";
    }
    if ($groups != "") {
        $groups = substr($groups, 3);
        $groups = " and (" . $groups . ")";
    }
    $sql = "select * from s_module where module_name like '$check_module'";
    $query = @mysqli_query($conn, $sql) or die("2");
    $module_id = 0;
    while ($rec = @mysqli_fetch_array($query)) {
        $module_id = $rec["module_id"];
    }
    $sql = "select * from s_user where user_id = '$user_id'";
    $query = @mysqli_query($conn, $sql) or die("3");
    if ($rec = @mysqli_fetch_array($query)) {
        if ($rec["admin_flag"] == '1' or $_SESSION["s_group_all"] == "ALL") {

        } else {
/*
if ($action == "read") $sql .= " read_p like '1'";
if ($action == "add") $sql .= " add_p like '1'";
if ($action == "update") $sql .= " update_p like '1'";
if ($action == "delete") $sql .= " delete_p like '1'";
 */

            $sql = "select * from s_user_p where user_id = '$user_id'  and  module_id like '$module_id'";

            $query = @mysqli_query($conn, $sql) or die("4");
            if (@mysqli_num_rows($query)) {

                while ($rec = @mysqli_fetch_array($query)) {
                    switch ($action) {
                        case "read":$code = $rec["read_p"];
                            break;
                        case "add":$code = $rec["add_p"];
                            break;
                        case "update":$code = $rec["update_p"];
                            break;
                        case "delete":$code = $rec["delete_p"];
                            break;
                    }
                } // end while
                if (($code == "0") || ($code == "")) {
                    //header ("location:/inner/error/permission.php");
                    $permission_denine = 0;
                }

            } else {
                $code = "";
                if ($groups != "") {
                    $sql = "select sum(read_p) as s_read,sum(add_p) as s_add,sum(update_p) as s_update,sum(delete_p) as s_delete,module_id,group_id from s_user_p group by module_id,group_id having module_id like '$module_id' " . $groups;
                    $query = @mysqli_query($conn, $sql) or die("5");

                    if (@mysqli_num_rows($query) == 0) {
                        $code = "";
                    }

                    if ($rec = @mysqli_fetch_array($query)) {
                        switch ($action) {
                            case "read":$code = $rec["s_read"];
                                break;
                            case "add":$code = $rec["s_add"];
                                break;
                            case "update":$code = $rec["s_update"];
                                break;
                            case "delete":$code = $rec["s_delete"];
                                break;
                        } // end switch
                    }
                }
                if (trim($code) == '' or $code == '0') {
                    //header ("location:/inner/error/permission.php");
                    $permission_denine = 1;
                }
            }
        }
    } else {
//header ("location:/inner/error/permission.php");
        $permission_denine = 1;
    }
    return $permission_denine;
}

function Show_Full_Category_spec($conn, $value)
{
    $stop = 0;
    $sql = "select * from category_spec where category_spec_id  like '" . $value . "'";
    $query = @mysqli_query($conn, $sql);
    $rec = @mysqli_fetch_array($query);
    $url = $rec["cat_name"];
    $parent_category_id = $rec["parent_category_id"];
    while ($parent_category_id != '0' and !$stop) {
        //echo "65555555";
        $sql = "select * from category_spec where category_spec_id  like '" . $parent_category_id . "'";
        $query = @mysqli_query($conn, $sql);
        if ($rec = @mysqli_fetch_array($query)) {
            $url = $rec["cat_name"] . " > " . $url;
            $parent_category_id = $rec["parent_category_id"];
        } else {
            $stop = 1;
        }
    }
//    $url = "Home" . " > " . $url;
    return $url;
}

function record_member($conn, $page_name)
{
    $now_date = date("Y-m-d");
    $sql = "select * from member_log where user_id = '" . $_SESSION["login_id"] . "' and create_date like '$now_date%' ";
    $query = @mysqli_query($conn, $sql);
    if (@mysqli_num_rows($query) == 0) {
        $sql = "insert into member_log (user_id,page_log,create_date) values ('" . $_SESSION["login_id"] . "','$page_name','$now_date') ";
        @mysqli_query($conn, $sql);
    } else {
        $rec = @mysqli_fetch_array($query);
        @reset($a_page_log);
        unset($a_page_log);
        $a_page_log = @explode(",", $rec[page_log]);
        if (!@in_array($page_name, $a_page_log)) {
            $page_log = $rec[page_log] . "," . $page_name;
            $sql = "update member_log set page_log = '$page_log' where member_log_id = '$rec[member_log_id]' ";
            @mysqli_query($conn, $sql);
        }
    }
}
function check_azAZ09($text)
{
    if (preg_match("/[^0-9A-Za-z]/", $text)) {
        return false;
    } else {
        return true;
    }

}
function get_param($a_param, $a_not_exists)
{
    $param = $param2 = "";
    if (count($a_param) > 0) {
        foreach ($a_param as $key => $value) {
            if ((!@in_array($value, $a_not_exists)) && ($_REQUEST[$value] != "")) {
                $param .= "&" . $value . "=" . $_REQUEST[$value];
            }

        }
    }
    if (count($_REQUEST) > 0) {
        foreach ($_REQUEST as $key => $value) {
            if (preg_match("/pre_/", $key) && ($value != "")) {
                $param2 .= "&" . $key . "=" . $value;
            }

        }
    }
    $param = $param . $param2;
    return substr($param, 1);
}
function post_param($a_param, $a_not_exists)
{
    $param = "";
    if (count($a_param) > 0) {
        foreach ($a_param as $key => $value) {
            if ((!@in_array($value, $a_not_exists)) && ($_REQUEST[$value] != "")) {
                echo "<input type=\"hidden\" name=\"$value\" value=\"" . $_REQUEST[$value] . "\">";
            }

        } // end foreach
    }
    if (count($_REQUEST) > 0) {
        foreach ($_REQUEST as $key => $value) {
            if (preg_match("/pre_/", $key) && ($value != "")) {
                echo "<input type=\"hidden\" name=\"$key\" value=\"$value\">";
            }

        } // end foreach
    }
}
function get_pre_param($a_param)
{
    $param = "";
    if (count($a_param) > 0) {
        foreach ($a_param as $key => $value) {
            if ($_REQUEST[$value] != "") {
                $param .= "&pre_" . $value . "=" . $_REQUEST[$value];
            }

        }
        $param = substr($param, 1);
    }
    return $param;
}
function get_return_param()
{
    $param = "";
    if (count($_REQUEST) > 0) {
        foreach ($_REQUEST as $key => $value) {
            if (preg_match("/pre_/", $key) && ($value != "")) {
                $param .= "&" . str_replace("pre_", "", $key) . "=" . $value;
            }

        }
        $param = substr($param, 1);
    }
    return $param;
}
function check_username($conn, $name)
{
    $return_id = "";
    $sql = "select * from person where name_th = '$name' or name_en = '$name' ";
    $query = @mysqli_query($conn, $sql);
    if (@mysqli_num_rows($query) > 0) {
        $rec = @mysqli_fetch_array($query);
        $return_id = $rec[person_id];
    } else {
        $username = gen_random(4);
        $password = '1234';
        $stop = 0;
        while ($stop != 0) {
            $sql = "select * from s_user where username = '$username' and password = '$password' ";
            $query = @mysqli_query($conn, $sql);
            if (@mysqli_num_rows($query) == 0) {
                $stop = 1;
            } else {
                $uername = gen_random(4);
            }

        }
        $sql = "insert into s_user (username , password , create_date , create_by) values ('$username','$password','" . date("Y-m-d H:i:s") . "' , '" . $_SESSION['login_name'] . "')";
        @mysqli_query($conn, $sql);
        $user_id = mysql_insert_id();

        $sql = "insert into person (name_th , researcher , user_id , create_date , create_by) values ('$name' , '1' , '$user_id' , '" . date("Y-m-d H:i:s") . "' , '" . $_SESSION['login_name'] . "')";
        @mysqli_query($conn, $sql);
        $return_id = mysql_insert_id();
    }
    return $return_id;
}

function show_menu($menu_id, $menu_name)
{
    if (preg_match("/," . $menu_id . ",/", $_SESSION['s_menu_id'] . ",")) {
        if ($menu_id == $_SESSION['s_now_menu']) {
            echo "<font color=\"#FF0000\">$menu_name</font>";
        } else {
            echo "<font color=\"#CC6600\">$menu_name</font>";
        }

    } else {
        echo $menu_name;
    }

}

function check_file_in_path($file_type, $path, $length)
{
    $filename = gen_random($length - 1) . "." . $file_type;
    while (1) {
        if (!file_exists($path . $filename)) {
            break;
        } else {
            $filename = gen_random($length - 1) . "." . $file_type;
        }
    }
    return $filename;
}
//=====================================================================================

function resize($fromimage, $toimage, $size = 500, $imagesname = "jpg")
{

    $input = $fromimage;
    $output = $toimage;
    $size = $size;
    #$image=ImageCreateFromJpeg($input);

    $dot = strtolower(end(explode('.', $imagesname)));
    #หาค่าขนาดของรูปต้นฉบับ
    if ($dot == "jpg" || $dot == "jpeg") {
        $image = ImageCreateFromJpeg($input);
    } elseif ($dot == "gif") {
        $image = ImageCreateFromGif($input);
    } elseif ($dot == "png") {
        $image = ImageCreateFromPng($input);
    } else {
        $image = ImageCreateFromJpeg($input);
    }

    if (ImagesX($image) < $size && ImagesY($image) < $size) {
        $newwidth = ImagesX($image);
        $newheight = ImagesY($image);
    } else {
        /*if(ImagesX($image)>ImagesY($image)){
        #----------รูปแนวนอน
        $percen             =    ($size/ImagesX($image))*100;
        $newwidth         =    (ImagesX($image)*$percen)/100;
        $newheight    =    (ImagesY($image)*$percen)/100;
        }elseif(ImagesX($image)<ImagesY($image)){
        #----------รูปแนวนอน
        $percen             =    ($size/ImagesY($image))*100;
        $newwidth         =    (ImagesX($image)*$percen)/100;
        $newheight    =    (ImagesY($image)*$percen)/100;
        }elseif(ImagesX($image)==ImagesY($image)){
        $newwidth         =    $size;
        $newheight    =    $size;
        }
        }*/
        if (ImagesX($image) > 130) {
            #----------รูปแนวนอน
            $percen = ($size / ImagesX($image)) * 100;
            $newwidth = (ImagesX($image) * $percen) / 100;
            $newheight = (ImagesY($image) * $percen) / 100;
        } elseif (ImagesX($image) == ImagesY($image)) {
            $newwidth = $size;
            $newheight = $size;
        }

        if (ImagesX($image) < 130) {
            #----------รูปแนวนอน
            $percen = ($size / ImagesX($image)) * 100;
            $newwidth = (ImagesX($image) * $percen) / 100;
            $newheight = (ImagesY($image) * $percen) / 100;
        } elseif (ImagesX($image) == ImagesY($image)) {
            $newwidth = $size;
            $newheight = $size;
        }
    }

    $blank = ImageCreateTrueColor($newwidth, $newheight);
    ImageCopyResampled($blank, $image, 0, 0, 0, 0, $newwidth, $newheight, ImagesX($image), ImagesY($image));
    #ImageJPEG($blank,$output,95);

    if ($dot == "jpg" || $dot == "jpeg") {
        ImageJpeg($blank, $output, 95);
    } elseif ($dot == "gif") {
        ImageGif($blank, $output, 95);
    } elseif ($dot == "png") {
        ImagePng($blank, $output, 95);
    } else {
        ImageJpeg($blank, $output, 95);
    }

    ImageDestroy($blank);
}
//=====================================================================================
function cropImage($nw, $nh, $source, $stype, $dest)
{
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];

    switch ($stype) {
        case 'gif':
            $simg = imagecreatefromgif($source);
            break;
        case 'jpg':
            $simg = imagecreatefromjpeg($source);
            break;
        case 'png':
            $simg = imagecreatefrompng($source);
            break;
    }

    $dimg = imagecreatetruecolor($nw, $nh);

    $wm = $w / $nw;
    $hm = $h / $nh;

    $h_height = $nh / 2;
    $w_height = $nw / 2;

    if ($w > $h) {

        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;

        imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);

    } elseif (($w < $h) || ($w == $h)) {

        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;

        imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);

    } else {
        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
    }

    imagejpeg($dimg, $dest, 100);
}
//------------------------------------------------------------------------------------------------------------
function Show_Flash_banner($pathfiles, $width, $height)
{
    // have to include  <script type="text/javascript" src="/Scripts/AC_RunActiveContent.js"><script>  in use page

    $msgfiles = "<script type='text/javascript'>AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','" . $width . "','height','" . $height . "','src','" . $pathfiles . "','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','" . $pathfiles . "' ); //end AC code
          </script>
          <noscript>
          <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0' width='" . $width . "' height='" . $height . "'>
            <param name='movie' value='" . $pathfiles . ".swf' />
            <param name='quality' value='high' />
            <embed src='" . $pathfiles . ".swf' quality='high' pluginspage='http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash' type='application/x-shockwave-flash' width='" . $width . "' height='" . $height . "'></embed></object></noscript>";

    return $msgfiles;
}

//---------------------------------------------------------------------------------------------------------------

function chkBrowser($nameBroser)
{
    return preg_match("/" . $nameBroser . "/", $_SERVER['HTTP_USER_AGENT']);
}

function dateConvert($date)
{
    $list_date = explode("-", $date);
    return $list_date[2] . '-' . $list_date[1] . '-' . $list_date[0];
}

function checkencodeing()
{

    if ($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai") {
        $_SESSION['encodein'] = 'windows-874';
    } else {
        $_SESSION['encodein'] = 'windows-874';
    }
    $encodein = $_SESSION['encodein'];
    return $encodein;
}

function curPageURL()
{
    $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
    $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
    $port = ($port) ? ':' . $_SERVER["SERVER_PORT"] : '';
    $url = ($isHTTPS ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];
    return $url;
}

function language_file($lang)
{
    $list_lang = explode("/", $_SERVER['SCRIPT_FILENAME']);
    $numlamg = sizeof($list_lang);
    if ($lang != "") {
        if ($lang == "english") {
            $_SESSION['lang'] = "english";
        } else {
            $_SESSION['lang'] = "thai";
        }
    } else {
        if ($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai") {
            $_SESSION['lang'] = "thai";
        } else {
            $_SESSION['lang'] = "english";
        }
    }
    $f_lang = $_SESSION['lang'] . '/' . $list_lang[$numlamg - 1];
    return $f_lang;
}

function language()
{

    if ($_SESSION['lang'] == "" || $_SESSION['lang'] == "thai") {
        $_SESSION['langs'] = "thai/thai.php";
    } else {
        $_SESSION['langs'] = "english/english.php";
    }

    $f_langs = $_SESSION['langs'];
    return $f_langs;
}

function current_page($lang)
{
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false ? 'http' : 'https';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    //$params   = $_SERVER['QUERY_STRING'];
    //$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
    $currentUrl = $protocol . '://' . $host . $script . '?lang=' . $lang;
    echo $currentUrl;
}

function check_firstorder($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "FO " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_first_order WHERE fs_id like '%" . $concheck . "%' ORDER BY fs_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "FO " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "FO " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_projectorder($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "PJ " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_project_order WHERE fs_id like '%" . $concheck . "%' ORDER BY fs_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "PJ " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "PJ " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_serviceorder($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "SV " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_first_order WHERE fs_id like '%" . $concheck . "%' ORDER BY fs_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "SV " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "SV " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_contactfo($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    //$concheck = "R".$thdate.date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_first_order ORDER BY r_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['r_id'] == "") {
        return "R" . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['r_id'], -3) + 1;
        return "R" . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_contact($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "RV" . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_first_order WHERE r_id like '%" . $concheck . "%' ORDER BY r_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['r_id'] == "") {
        return "RV" . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['r_id'], -3) + 1;
        return "RV" . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_servicereport($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = $thdate . date("m");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_service_report ORDER BY sr_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    // if($row_forder['sv_id'] == ""){
    //     return "SR ".$thdate.date("/m/")."001";
    // }else{
    //     //$num_odersum = $num_oder+1;
    //     $num_odersum = substr($row_forder['sv_id'],-3)+1;
    //     return "SR ".$thdate.date("/m/").sprintf("%03d",$num_odersum);
    // }
    $num_odersum = $row_forder['sr_id'] + 1;
    return "SR " . $concheck . $num_odersum;
}

function check_servicereportinstall($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "IR " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_service_report4 WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "IR " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "IR " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function check_serviceman($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "SP " . $thdate . date("/m/");
    //echo "SELECT * FROM s_service_report2 WHERE sv_id like '%".$concheck."%' ORDER BY sv_id DESC";
    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_service_report2 WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "SP " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "SP " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function check_serviceman2($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "LP " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_service_report3 WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "LP " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "LP " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function format_date($value)
{
    if ($value) {
        list($s_year, $s_month, $s_day) = explode("-", $value);
        $year = $s_year + 543;
        return $s_day . '-' . $s_month . '-' . $year;
    } else {
        return '';
    }

}

function get_groupcusname($conn, $value)
{
    $row_cgroup = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_type WHERE group_id = '" . $value . "'"));
    return $row_cgroup['group_name'];
}

function province_name($conn, $value)
{
    $row_provunce = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_province WHERE province_id = '" . $value . "'"));
    return $row_provunce['province_name'];
}

function amphur_name($conn, $value)
{
    $row_amphur = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_amphur WHERE amphur_id = '" . $value . "'"));
    return $row_amphur['amphur_name'];
}

function custype_name($conn, $value)
{
    $row_cusg = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_custommer WHERE group_id = '" . $value . "'"));
    return $row_cusg['group_name'];
}

function protype_name($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_product WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function getpod_name($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_pod WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function get_proname($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function get_procode2($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct2 WHERE group_id = '" . $value . "'"));
    return $row_protype['group_spro_id'];
}

function get_proname2($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct2 WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function get_projectname($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_project WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function get_productname($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_product WHERE group_id = '" . $value . "'"));
    return $row_protype['group_name'];
}

function get_servicename($conn, $value)
{
    $row_servtype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_service WHERE group_id = '" . $value . "'"));
    return $row_servtype['group_name'];
}

function get_serial($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct WHERE group_id = '" . $value . "'"));
    return $row_protype['group_pro_pod'];
}
function get_sn($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct WHERE group_id = '" . $value . "'"));
    return $row_protype['group_pro_sn'];
}
function get_price($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct WHERE group_id = '" . $value . "'"));
    return $row_protype['group_pro_price'];
}

function get_pro_code($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_typeproduct WHERE group_id = '" . $value . "'"));
    return $row_protype['group_spro_id'];
}

function get_sprice($cprice, $camount)
{

    if (($cprice * $camount) != 0) {
        return $prspro = number_format($cprice * $camount, 2);
    } else {
        return "";
    }
}

function get_calsprice($cprice, $camount)
{
    return $prspro = $cprice * $camount;
}

function get_sumprice($conn, $value)
{

    $row_fod = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $value . "'"));

    $proprice1 = get_calsprice($row_fod['cprice1'], $row_fod['camount1']);
    $proprice2 = get_calsprice($row_fod['cprice2'], $row_fod['camount2']);
    $proprice3 = get_calsprice($row_fod['cprice3'], $row_fod['camount3']);
    $proprice4 = get_calsprice($row_fod['cprice4'], $row_fod['camount4']);
    $proprice5 = get_calsprice($row_fod['cprice5'], $row_fod['camount5']);
    $proprice6 = get_calsprice($row_fod['cprice6'], $row_fod['camount6']);
    $proprice7 = get_calsprice($row_fod['cprice7'], $row_fod['camount7']);

    $sumproprice = $proprice1 + $proprice2 + $proprice3 + $proprice4 + $proprice5 + $proprice6 + $proprice7;

    return $sumproprice;
}

function get_vatprice($value)
{
    $sumpro = get_sumprice($conn, $value);
    $getvat = ($sumpro * 7) / 100;
    return $getvat;
}

function get_totalprice($value)
{
    $sum = get_sumprice($conn, $value);
    $vat = get_vatprice($value);

    $total = $sum + $vat;

    return $total;
}

function get_firstorder($conn, $fo_id)
{
    $row_first_order = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $fo_id . "'"));
    return $row_first_order;
}

function get_servicereport($conn, $sv_id)
{
    $row_service_report = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_service_report WHERE sv_id = '" . $sv_id . "'"));
    return $row_service_report;
}

function get_customername($conn, $fo_id)
{
    $row_first_order = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $fo_id . "'"));
    return $row_first_order['cd_name'];
}

function get_localsettingname($conn, $fo_id)
{
    $row_first_order = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $fo_id . "'"));
    return $row_first_order['loc_name'];
}

function get_fixlist($ckf_list)
{
    $ckf = explode(',', $ckf_list);
    foreach ($ckf as $val) {
        $chkd[] = $val;
    }
    return $chkd;
}

function get_fixname($conn, $ckf)
{
    $row_fix = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_fix WHERE group_id = '" . $ckf . "'"));
    return $row_fix['group_name'];
}

function get_sparpart($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea;
}

function get_sparpart_name($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_name'];
}

function get_sparpart_uniprice($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_unit_price'];
}

function get_stockmachine_name($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  group_stockmachine WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_name'];
}

function get_nameStock($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_location'];
}

function get_nameStockmachine($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  group_stockmachine WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_location'];
}

function getShippingStatus($conn, $sv_id)
{

    //echo "SELECT * FROM  s_bill_shipping WHERE srid2 LIKE '%".$sv_id."%'";
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_bill_shipping WHERE srid2 LIKE '%" . $sv_id . "%'"));
    $fileDo = preg_replace("/\//", "-", $row_dea['sv_id']);
    $linkA = '<a href="../../upload/bill_shipping/' . $fileDo . '.pdf" target="_blank">' . $row_dea['sv_id'] . '</a>';

    if ($row_dea['srid2'] == $sv_id) {
        return $linkA;
    } else {
        return "-";
    }

}

function get_servreport($conn, $ymd, $loc, $ctype)
{

    $condi = "";

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    }

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_balance = '" . $ymd . "' " . $condi . " AND st_setting = 0 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    $numR = 1;
    if ($numsrv > 0) {
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            //     $res .= "&nbsp;<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\"><strong>".$scstatus."</strong></a>\n<br>\n";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            //     $res .= "&nbsp;<a href=\"../../upload/service_report_close/".$chaf.".pdf\" target=\"_blank\"><strong>".$scstatus."</strong></a>\n<br>\n";
            // }

            if ($loc != "") {
                $scstatus = "<span style=\"color:green;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . "</span>";
                $res .= "&nbsp;<a href=\"../../upload/service_report_open/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";

            } else {
                $scstatus = "<span style=\"color:green;\">" . $row_dea['sv_id'] . "</span>";
                $res .= "&nbsp;<a href=\"../../upload/service_report_open/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            }
            $numR++;
        }
    }

    return $res;
}

function get_servreport_closed($conn, $ymd, $loc, $ctype)
{

    $condi = "";

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    }

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_close = '" . $ymd . "' " . $condi . " AND st_setting = 1 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    $numR = 1;
    if ($numsrv > 0) {
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            $colorSet = "red";

            if (substr($row_dea['sv_id'], 0, 2) === "RP") {
                $colorSet = "green";
            } else if (substr($row_dea['sv_id'], 0, 2) === "IT") {
                $colorSet = "blue";
            } else {
                $colorSet = "red";
            }

            if ($loc != "") {
                $scstatus = "<span style=\"color:" . $colorSet . ";\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . "</span>";
                $res .= "&nbsp;<a href=\"../../upload/service_report_close/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            } else {
                $scstatus = "<span style=\"color:" . $colorSet . ";\">" . $row_dea['sv_id'] . "</span>";
                $res .= "&nbsp;<a href=\"../../upload/service_report_close/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            }
            $numR++;

        }
    }

    return $res;
}

function get_servreport_setup($conn, $ymd, $loc, $ctype)
{

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    } else {

        $serTypeList = array("45", "47", "36", "23", "31", "48", "89", "55", "24", "87", "88", "105", "108", "112", "113", "114", "115");

        $condi .= " AND (";

        for ($i = 0; $i < count($serTypeList); $i++) {
            $condi .= "sr_ctype = '" . $serTypeList[$i] . "' OR ";
        }

        $condi = substr($condi, 0, -3) . ")";
    }

    //echo "SELECT * FROM s_service_report WHERE job_balance = '".$ymd."' ".$condi." AND st_setting = 0 LIMIT 4";

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_balance = '" . $ymd . "' " . $condi . " AND st_setting = 0 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    if ($numsrv > 0) {
        $numR = 1;
        //blue , #f911c5, red, green
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            if ($row_dea['job_opentime'] != "") {
                $jobOpen = " เวลา " . $row_dea['job_opentime'];
            } else {
                $jobOpen = "";
            }


            

            if ($row_dea['sr_ctype'] == '31' || $row_dea['sr_ctype'] == '48') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:#f911c5;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:#f911c5;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
                
            } else if ($row_dea['sr_ctype'] == '24' || $row_dea['sr_ctype'] == '55' || $row_dea['sr_ctype'] == '89') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:red;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:red;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }  
            } else if ($row_dea['sr_ctype'] == '23' || $row_dea['sr_ctype'] == '36' || $row_dea['sr_ctype'] == '45' || $row_dea['sr_ctype'] == '47' || $row_dea['sr_ctype'] == '112' || $row_dea['sr_ctype'] == '113' || $row_dea['sr_ctype'] == '114' || $row_dea['sr_ctype'] == '115') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:blue;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:blue;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            } else {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:green;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:green;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            }

            $res .= "&nbsp;<a href=\"../../upload/service_report_open/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            $numR++;
        }

    }

    return $res;
}

function get_servreport_setupclosed($conn, $ymd, $loc, $ctype)
{

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    } else {

        $serTypeList = array("45", "47", "36", "23", "31", "48", "89", "55", "24", "87", "88", "105", "108", "112", "113", "114", "115");

        $condi .= " AND (";

        for ($i = 0; $i < count($serTypeList); $i++) {
            $condi .= "sr_ctype = '" . $serTypeList[$i] . "' OR ";
        }

        $condi = substr($condi, 0, -3) . ")";
    }

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_close = '" . $ymd . "' " . $condi . " AND st_setting = 1 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    if ($numsrv > 0) {
        $numR = 1;
        //blue , #f911c5, red, green
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            if ($row_dea['job_opentime'] != "") {
                $jobOpen = " เวลา " . $row_dea['job_closetime'];
            } else {
                $jobOpen = "";
            }

            if ($row_dea['sr_ctype'] == '31' || $row_dea['sr_ctype'] == '48') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:#f911c5;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:#f911c5;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            } else if ($row_dea['sr_ctype'] == '24' || $row_dea['sr_ctype'] == '55' || $row_dea['sr_ctype'] == '89') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:red;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:red;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            } else if ($row_dea['sr_ctype'] == '23' || $row_dea['sr_ctype'] == '36' || $row_dea['sr_ctype'] == '45' || $row_dea['sr_ctype'] == '47' || $row_dea['sr_ctype'] == '112' || $row_dea['sr_ctype'] == '113' || $row_dea['sr_ctype'] == '114' || $row_dea['sr_ctype'] == '115') {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:blue;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:blue;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            } else {
                if($row_dea['chkConfirm'] === '2'){
                    $scstatus = "<span style=\"color:green;\"><mark>" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</mark></span>";
                }else{
                    $scstatus = "<span style=\"color:green;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
                }
            }

            $res .= "&nbsp;<a href=\"../../upload/service_report_close/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            $numR++;
        }

    }

    return $res;
}

function get_sale_schedule($conn, $ymd, $loc, $ctype)
{

    if ($loc != "") {
        $condi .= " AND ss.cs_sale = '" . $loc . "'";
    }

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_group_tracking as st,s_sale_schedule as ss WHERE st.group_type = 'sale_schedule' AND st.fo_id = ss.fo_id AND st.group_date = '".$ymd."' ".$condi." LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    if ($numsrv > 0) {
        $numR = 1;
        //blue , #f911c5, red, green
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            if ($row_dea['group_time'] != "") {
                $jobOpen = " เวลา " . $row_dea['group_time'];
            } else {
                $jobOpen = "";
            }

            $scstatus = "<span style=\"color:green;\">" . $numR . "." . $row_dea['cd_name'] . $jobOpen . " (".getsalename($conn, $row_dea['cs_sale']).")</span>";

            //$res .= "&nbsp;<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\"><strong>".$scstatus."</strong></a>\n<br>\n";
            $res .= "&nbsp;<a href=\"../job_tracking/index.php?tab=sale_schedule&fo_id=".$row_dea['fo_id']."\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            $numR++;
        }

    }

    return $res;
}

function get_servreport_fix($conn, $ymd, $loc, $ctype)
{

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    } else {

        $serTypeList = array("103", "107");

        $condi .= " AND (";

        for ($i = 0; $i < count($serTypeList); $i++) {
            $condi .= "sr_ctype = '" . $serTypeList[$i] . "' OR ";
        }

        $condi = substr($condi, 0, -3) . ")";
    }

    //echo "SELECT * FROM s_service_report WHERE job_balance = '".$ymd."' ".$condi." AND st_setting = 0 LIMIT 4";

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_balance = '" . $ymd . "' " . $condi . " AND st_setting = 0 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    if ($numsrv > 0) {
        $numR = 1;
        //blue , #f911c5, red, green
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            if ($row_dea['job_opentime'] != "") {
                $jobOpen = " เวลา " . $row_dea['job_opentime'];
            } else {
                $jobOpen = "";
            }

            if ($row_dea['sr_ctype'] == '107') {
                $scstatus = "<span style=\"color:blue;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
            } else {
                $scstatus = "<span style=\"color:green;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
            }

            //$res .= "&nbsp;<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\"><strong>".$scstatus."</strong></a>\n<br>\n";
            $res .= "&nbsp;<a href=\"../../upload/service_report_close/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            $numR++;
        }

    }

    return $res;
}

function get_servreport_fixclosed($conn, $ymd, $loc, $ctype)
{

    if ($loc != "") {
        $condi .= " AND loc_contact = '" . $loc . "'";
    }

    if ($ctype != "") {
        $condi .= " AND sr_ctype = '" . $ctype . "'";
    } else {

        $serTypeList = array("103", "107");

        $condi .= " AND (";

        for ($i = 0; $i < count($serTypeList); $i++) {
            $condi .= "sr_ctype = '" . $serTypeList[$i] . "' OR ";
        }

        $condi = substr($condi, 0, -3) . ")";
    }

    $qqu_srv = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE job_close = '" . $ymd . "' " . $condi . " AND st_setting = 1 LIMIT 6");
    $numsrv = @mysqli_num_rows($qqu_srv);
    $res = "";
    if ($numsrv > 0) {
        $numR = 1;
        //blue , #f911c5, red, green
        while ($row_dea = @mysqli_fetch_array($qqu_srv)) {
            $chaf = preg_replace("/\//", "-", $row_dea["sv_id"]);
            // if($row_dea['st_setting'] == 0){
            //     $scstatus = "<span style=\"color:green;\">".$row_dea['sv_id']."</span>";
            // }else{
            //     $scstatus = "<span style=\"color:red;\">".$row_dea['sv_id']."</span>";
            // }

            if ($row_dea['job_opentime'] != "") {
                $jobOpen = " เวลา " . $row_dea['job_closetime'];
            } else {
                $jobOpen = "";
            }

            if ($row_dea['sr_ctype'] == '107') {
                $scstatus = "<span style=\"color:blue;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
            } else {
                $scstatus = "<span style=\"color:green;\">" . $numR . "." . get_localsettingname($conn, $row_dea['cus_id']) . $jobOpen . "</span>";
            }

            $res .= "&nbsp;<a href=\"../../upload/service_report_close/" . $chaf . ".pdf\" target=\"_blank\"><strong>" . $scstatus . "</strong></a>\n<br>\n";
            $numR++;
        }

    }

    return $res;
}

function get_imguser($conn, $userid)
{
    $row_fix = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_user WHERE user_id = '" . $userid . "'"));

    if ($row_fix['u_images'] == " ") {$img = "none.jpg";} else { $img = $row_fix['u_images'];}

    return $img;
}

function get_user_fullname($conn, $userid)
{
    $row_fix = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_user WHERE user_id = '" . $userid . "'"));
    return $row_fix['name'];
}

function get_numprosall($conn, $value)
{

    $row_fod = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $value . "'"));
    $numprosall = 0;

    if ($row_fod['cpro1'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro2'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro3'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro4'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro5'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro6'] != "") {$numprosall = $numprosall + 1;}
    if ($row_fod['cpro7'] != "") {$numprosall = $numprosall + 1;}

    return $numprosall;
}

function get_profirsod($conn, $value)
{

    $row_fod = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $value . "'"));

    if ($row_fod['cpro1'] != "") {$procp[] = $row_fod['cpro1'];}
    if ($row_fod['cpro2'] != "") {$procp[] = $row_fod['cpro2'];}
    if ($row_fod['cpro3'] != "") {$procp[] = $row_fod['cpro3'];}
    if ($row_fod['cpro4'] != "") {$procp[] = $row_fod['cpro4'];}
    if ($row_fod['cpro5'] != "") {$procp[] = $row_fod['cpro5'];}
    if ($row_fod['cpro6'] != "") {$procp[] = $row_fod['cpro6'];}
    if ($row_fod['cpro7'] != "") {$procp[] = $row_fod['cpro7'];}

    return $procp;
}

function get_numprofirsod($conn, $value)
{

    $row_fod = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_first_order WHERE fo_id = '" . $value . "'"));

    if ($row_fod['camount1'] != "") {$procp[] = $row_fod['camount1'];}
    if ($row_fod['camount2'] != "") {$procp[] = $row_fod['camount2'];}
    if ($row_fod['camount3'] != "") {$procp[] = $row_fod['camount3'];}
    if ($row_fod['camount4'] != "") {$procp[] = $row_fod['camount4'];}
    if ($row_fod['camount5'] != "") {$procp[] = $row_fod['camount5'];}
    if ($row_fod['camount6'] != "") {$procp[] = $row_fod['camount6'];}
    if ($row_fod['camount7'] != "") {$procp[] = $row_fod['camount7'];}

    return $procp;
}

function get_rpfprosrsn($conn, $val)
{

    if (get_proname($conn, $val) != "") {$pname = get_proname($conn, $val);} else { $pname = " - ";}
    if (get_serial($conn, $val) != "") {$psr = get_serial($conn, $val);} else { $psr = " - ";}
    if (get_sn($conn, $val) != "") {$psn = get_sn($conn, $val);} else { $psn = " - ";}

    return $pname . " / " . $psr . " / " . $psn;
}

function get_numfixs($conn, $value)
{

    $row_fspd = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_service_report WHERE sr_id = '" . $value . "'"));
    $exfix = explode(",", $row_fspd['ckf_list']);

    $numd = 0;
    foreach ($exfix as $val) {
        $numd = $numd + 1;
    }

    return $numd;
}

function get_listfixs($conn, $value)
{

    $row_fspd = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_service_report WHERE sr_id = '" . $value . "'"));
    $exfix = explode(",", $row_fspd['ckf_list']);

    return $exfix;
}

function get_numspapartsall($conn, $value)
{

    $row_fspd = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_service_report WHERE sr_id = '" . $value . "'"));
    $numspartsall = 0;

    if ($row_fspd['cpro1'] != "") {$numspartsall = $numspartsall + 1;}
    if ($row_fspd['cpro2'] != "") {$numspartsall = $numspartsall + 1;}
    if ($row_fspd['cpro3'] != "") {$numspartsall = $numspartsall + 1;}
    if ($row_fspd['cpro4'] != "") {$numspartsall = $numspartsall + 1;}
    if ($row_fspd['cpro5'] != "") {$numspartsall = $numspartsall + 1;}

    return $numspartsall;
}

function get_prospapart($conn, $value)
{

    $row_fsd = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_service_report WHERE sr_id = '" . $value . "'"));

    if ($row_fsd['cpro1'] != "") {$rso[] = $row_fsd['cpro1'];}
    if ($row_fsd['cpro2'] != "") {$rso[] = $row_fsd['cpro2'];}
    if ($row_fsd['cpro3'] != "") {$rso[] = $row_fsd['cpro3'];}
    if ($row_fsd['cpro4'] != "") {$rso[] = $row_fsd['cpro4'];}
    if ($row_fsd['cpro5'] != "") {$rso[] = $row_fsd['cpro5'];}

    return $rso;
}

function get_lastservice_f($conn, $cusid, $sevid)
{

    $qu_lastservice = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE cus_id = '" . $cusid . "' ORDER BY sv_id DESC");
    $numlastservice = mysqli_num_rows($qu_lastservice);
    while ($row_lasservice = @mysqli_fetch_array($qu_lastservice)) {
        $ser_id[] = $row_lasservice['sv_id'];
        $ser_job_balance[] = $row_lasservice['job_balance'];
    }

    $arraysearch = @array_search($sevid, $ser_id);

    if ($ser_id[$arraysearch + 1] != "") {
        return format_date($ser_job_balance[$arraysearch + 1]);
    } else {
        return " - ";
    }
}

function get_lastservice_s($conn, $cusid, $sevid)
{

    $ser_id[] = "";
    $qu_lastservice = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE cus_id = '" . $cusid . "' ORDER BY sv_id DESC");
    $numlastservice = mysqli_num_rows($qu_lastservice);
    while ($row_lasservice = @mysqli_fetch_array($qu_lastservice)) {
        $ser_id[] = $row_lasservice['sv_id'];
        $ser_job_balance[] = $row_lasservice['job_balance'];
    }

    $arraysearch = @array_search($sevid, $ser_id);

    if ($ser_id[$arraysearch] != "") {
        return format_date($ser_job_balance[$arraysearch]);
    } else {
        return " - ";
    }
}

function get_technician($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_technician WHERE group_id = '" . $val . "'"));
    return $row_dea;
}

function get_technician_name($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_technician WHERE group_id = '" . $val . "'"));
    return $row_dea['group_name'];
}

function get_technician_tel($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_technician WHERE group_id = '" . $val . "'"));
    return $row_dea['group_tel'];
}

function get_technician_id($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_technician WHERE group_id = '" . $val . "'"));
    return $row_dea['group_cus_id'];
}

function get_sale_id($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_sale WHERE group_id = '" . $val . "'"));
    return $row_dea['group_cus_id'];
}

function getsalename($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_sale WHERE group_id = '" . $val . "'"));
    return $row_dea['group_name'];
}

function getsaletel($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_sale WHERE group_id = '" . $val . "'"));
    return $row_dea['group_tel'];
}

function getsaleline($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_sale WHERE group_id = '" . $val . "'"));
    return $row_dea['line_id'];
}

function getcustom_type($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_custommer WHERE group_id = '" . $val . "'"));
    return $row_dea['group_name'];
}

function get_profirstorder($conn, $val)
{
    $row_pfirst = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_first_order WHERE fo_id = '" . $val . "'"));

    $row_pfirst['cpro1'];
    $row_pfirst['cpro2'];
    $row_pfirst['cpro3'];
    $row_pfirst['cpro4'];
    $row_pfirst['cpro5'];
    $row_pfirst['cpro6'];
    $row_pfirst['cpro7'];

    if ($row_pfirst['cpro1'] != "") {$prolist[] = $row_pfirst['cpro1'];}
    if ($row_pfirst['cpro2'] != "") {$prolist[] = $row_pfirst['cpro2'];}
    if ($row_pfirst['cpro3'] != "") {$prolist[] = $row_pfirst['cpro3'];}
    if ($row_pfirst['cpro4'] != "") {$prolist[] = $row_pfirst['cpro4'];}
    if ($row_pfirst['cpro5'] != "") {$prolist[] = $row_pfirst['cpro5'];}
    if ($row_pfirst['cpro6'] != "") {$prolist[] = $row_pfirst['cpro6'];}
    if ($row_pfirst['cpro7'] != "") {$prolist[] = $row_pfirst['cpro7'];}

    return $prolist;
}
function get_podfirstorder($conn, $val)
{
    $row_pfirst = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_first_order WHERE fo_id = '" . $val . "'"));

    $row_pfirst['pro_pod1'];
    $row_pfirst['pro_pod2'];
    $row_pfirst['pro_pod3'];
    $row_pfirst['pro_pod4'];
    $row_pfirst['pro_pod5'];
    $row_pfirst['pro_pod6'];
    $row_pfirst['pro_pod7'];

    if ($row_pfirst['pro_pod1'] != "") {$propodlist[] = $row_pfirst['pro_pod1'];}
    if ($row_pfirst['pro_pod2'] != "") {$propodlist[] = $row_pfirst['pro_pod2'];}
    if ($row_pfirst['pro_pod3'] != "") {$propodlist[] = $row_pfirst['pro_pod3'];}
    if ($row_pfirst['pro_pod4'] != "") {$propodlist[] = $row_pfirst['pro_pod4'];}
    if ($row_pfirst['pro_pod5'] != "") {$propodlist[] = $row_pfirst['pro_pod5'];}
    if ($row_pfirst['pro_pod6'] != "") {$propodlist[] = $row_pfirst['pro_pod6'];}
    if ($row_pfirst['pro_pod7'] != "") {$propodlist[] = $row_pfirst['pro_pod7'];}

    return $propodlist;
}
function get_snfirstorder($conn, $val)
{
    $row_pfirst = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_first_order WHERE fo_id = '" . $val . "'"));

    $row_pfirst['pro_sn1'];
    $row_pfirst['pro_sn2'];
    $row_pfirst['pro_sn3'];
    $row_pfirst['pro_sn4'];
    $row_pfirst['pro_sn5'];
    $row_pfirst['pro_sn6'];
    $row_pfirst['pro_sn7'];

    if ($row_pfirst['pro_sn1'] != "") {$prosnlist[] = $row_pfirst['pro_sn1'];}
    if ($row_pfirst['pro_sn2'] != "") {$prosnlist[] = $row_pfirst['pro_sn2'];}
    if ($row_pfirst['pro_sn3'] != "") {$prosnlist[] = $row_pfirst['pro_sn3'];}
    if ($row_pfirst['pro_sn4'] != "") {$prosnlist[] = $row_pfirst['pro_sn4'];}
    if ($row_pfirst['pro_sn5'] != "") {$prosnlist[] = $row_pfirst['pro_sn5'];}
    if ($row_pfirst['pro_sn6'] != "") {$prosnlist[] = $row_pfirst['pro_sn6'];}
    if ($row_pfirst['pro_sn7'] != "") {$prosnlist[] = $row_pfirst['pro_sn7'];}

    return $prosnlist;
}
function get_snfirstorders($conn, $val)
{

    $row_pfirst = @mysqli_fetch_array(@mysqli_query($conn, "SELECT fs_id FROM `s_first_order` WHERE fs_id like '%" . $val . "'"));

    if ($row_pfirst['fs_id'] != $val) {
        return $val;
    } else {
        $row_pfirsts = @mysqli_fetch_array(@mysqli_query($conn, "SELECT `fs_id` FROM `s_first_order` WHERE `fs_id` like '%" . substr($val, 0, 9) . "%' ORDER BY `fo_id` DESC"));
        $fsid = $row_pfirsts['fs_id'];
        $fsid = sprintf("%03d", (substr($fsid, -3) + 1));
        return substr($val, 0, 9) . $fsid;

    }
}

function get_snprojectorders($conn, $val)
{

    $row_pfirst = @mysqli_fetch_array(@mysqli_query($conn, "SELECT fs_id FROM `s_project_order` WHERE fs_id like '%" . $val . "'"));

    if ($row_pfirst['fs_id'] != $val) {
        return $val;
    } else {
        $row_pfirsts = @mysqli_fetch_array(@mysqli_query($conn, "SELECT `fs_id` FROM `s_project_order` WHERE `fs_id` like '%" . substr($val, 0, 9) . "%' ORDER BY `fo_id` DESC"));
        $fsid = $row_pfirsts['fs_id'];
        $fsid = sprintf("%03d", (substr($fsid, -3) + 1));
        return substr($val, 0, 9) . $fsid;

    }
}

function backup_tables($host, $user, $pass, $name, $tables = '*')
{

    $conn = mysqli_connect($host, $user, $pass, $name);
    //$link = mysql_connect($host,$user,$pass);
    //mysql_select_db($name,$link);

    //get all of the tables
    if ($tables == '*') {
        $tables = array();
        $result = @mysqli_query($conn, 'SHOW TABLES');
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
    }

    //cycle through
    foreach ($tables as $table) {
        $result = @mysqli_query($conn, 'SELECT * FROM ' . $table);
        $num_fields = mysqli_num_fields($result);

        $return .= 'DROP TABLE ' . $table . ';';
        $row2 = mysqli_fetch_row(@mysqli_query($conn, 'SHOW CREATE TABLE ' . $table));
        $return .= "\n\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_match_replace("\n", "\\n", $row[$j]);
                    if (isset($row[$j])) {$return .= '"' . $row[$j] . '"';} else { $return .= '""';}
                    if ($j < ($num_fields - 1)) {$return .= ',';}
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
    }

    //save file
    $fildatabase = 'db-backup-' . time() . '.sql';
    $handle = fopen('../../upload/database/' . $fildatabase, 'w+');
    fwrite($handle, $return);
    fclose($handle);

    return $fildatabase;
}

function get_listspart($conn, $db, $val)
{
    $qu_pfirst = @mysqli_query($conn, "SELECT * FROM " . $db . " WHERE sr_id = '" . $val . "'");
    $sdc = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
    while ($row = @mysqli_fetch_array($qu_pfirst)) {
        $sdc .= '<tr>
		  <td>' . $row['lists'] . '</td>
		  <td>' . $row['prices'] . '</td>
		  <td>' . ($row['prices'] * $row['amounts']) . '</td>
		</tr>';
    }
    $sdc .= '</table>';
    return $sdc;
}

function get_plusminus($conn, $db1, $db2, $rid, $sid)
{
    $row_open = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM " . $db2 . " WHERE r_id ='" . $rid . "'"));

    @mysqli_query($conn, "UPDATE `" . $db1 . "` SET `group_stock` = `group_stock` + '" . $row_open['opens'] . "' WHERE `group_id` = '" . $sid . "';");
    //@mysqli_query($conn,"UPDATE `".$db2."` SET `amounts` = `amounts` + '".$row_open['opens']."' WHERE `r_id` = '".$rid."';");
}

function get_plusminus2($conn, $db1, $db2, $rid, $sid)
{
    $row_open = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM " . $db2 . " WHERE r_id ='" . $rid . "'"));

    @mysqli_query($conn, "UPDATE `" . $db1 . "` SET `group_stock` = `group_stock` - '" . $row_open['remains'] . "' WHERE `group_id` = '" . $sid . "';");
    //@mysqli_query($conn,"UPDATE `".$db2."` SET `amounts` = `amounts` + '".$row_open['opens']."' WHERE `r_id` = '".$rid."';");
}

function get_srreport($conn, $fo_id)
{
    $row_close = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_service_report WHERE cus_id = '" . $fo_id . "' ORDER BY sr_id DESC"));
    return $row_close['sv_id'];
}

function get_foid($conn, $fo_id)
{
    $row_close = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_first_order WHERE fo_id = '" . $fo_id . "'"));
    return $row_close['fs_id'];
}

function get_zone($conn, $group_id)
{
    $row_zone = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_zone WHERE group_id = '" . $group_id . "'"));
    return $row_zone['group_name'];
}

function findWord($string, $findWord)
{
    $pos = strpos($string, $findWord);
    if ($pos !== false) {
        return 'yes';
    } else {
        return 'no';
    }
}

function get_sparpart_id($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_spar_id'];
}

function get_stockmachine_id($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  group_stockmachine WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_spar_id'];
}

function getStockSpar($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group_sparpart WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_stock'];
}

function getStockMachine($conn, $gid)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  group_stockmachine WHERE group_id = '" . $gid . "'"));
    return $row_dea['group_stock'];
}

function check_servicerepair($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "RO " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_service_report6 WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "RO " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "RO " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function check_work_noti($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "WO " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_work_noti WHERE fs_id like '%" . $concheck . "%' ORDER BY fs_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "WO " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "WO " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function check_billlading($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "BL " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_bill_lading WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "BL " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "BL " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function check_billshipping($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "SS " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_bill_shipping WHERE sv_id like '%" . $concheck . "%' ORDER BY sv_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['sv_id'] == "") {
        return "SS " . $thdate . date("/m/") . "001";
    } else {
        //$num_odersum = $num_oder+1;
        $num_odersum = substr($row_forder['sv_id'], -3) + 1;
        return "SS " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }
}

function get_username($conn, $user_account)
{

    $row_user = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_user WHERE username = '" . $user_account . "'"));

    return $row_user['name'];
}

function userGroup($conn, $user_id)
{
    $row_user = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_user_group WHERE user_id = '" . $user_id . "'"));
    $row_user_group = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_group WHERE group_id = '" . $row_user['group_id'] . "'"));

    return $row_user_group['group_name'];
}

function userTecGroupID($conn, $user_id)
{
    $row_user = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM  s_user_group WHERE user_id = '" . $user_id . "'"));
    $row_user_group = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_technician WHERE user_account = '" . $row_user['group_id'] . "'"));

    return $row_user_group['group_id'];
}

function userSaleGroupID($conn, $user_id)
{
    $row_user = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_user WHERE user_id = '" . $user_id . "'"));
    $row_user_group = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_sale WHERE user_account = '" . $row_user['user_id'] . "'"));

    return $row_user_group['group_id'];
}

function getpod_id($conn, $value)
{
    $row_protype = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_pod WHERE group_name = '" . $value . "'"));
    return $row_protype['group_id'];
}

function get_firstorder_qr($conn, $sn)
{

    //AND `status_use` != '2' ดาวแดง

    //echo "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '".$sn."%' OR `pro_sn2` LIKE '".$sn."%' OR `pro_sn3` LIKE '".$sn."%' OR `pro_sn4` LIKE '".$sn."%' OR `pro_sn5` LIKE '".$sn."%' OR `pro_sn6` LIKE '".$sn."%' OR `pro_sn7` LIKE '".$sn."%') AND `status_use` != '2' AND `status_use` != '1' ORDER BY `fo_id`  DESC";

    $row_first_order = @mysqli_fetch_array(@mysqli_query($conn, "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '" . $sn . "%' OR `pro_sn2` LIKE '" . $sn . "%' OR `pro_sn3` LIKE '" . $sn . "%' OR `pro_sn4` LIKE '" . $sn . "%' OR `pro_sn5` LIKE '" . $sn . "%' OR `pro_sn6` LIKE '" . $sn . "%' OR `pro_sn7` LIKE '" . $sn . "%') AND `status_use` != '2' AND `status_use` != '1' ORDER BY `fo_id`  DESC"));

    return $row_first_order;
}

function chkSeries($conn, $sn, $foid)
{

//    $sqlSN = "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '".$sn."' OR `pro_sn1` LIKE '".$sn."' OR `pro_sn2` LIKE '".$sn."' OR `pro_sn3` LIKE '".$sn."' OR `pro_sn4` LIKE '".$sn."' OR `pro_sn5` LIKE '".$sn."' OR `pro_sn6` LIKE '".$sn."' OR `pro_sn7` LIKE '".$sn."') AND `status_use` != '2' AND fo_id != '".$foid."' ORDER BY `fo_id`  DESC";
    $foInfo = get_firstorder($conn, $foid);
    $status_use = $foInfo['status_use'];

    if ($status_use != "2" || $status_use != 2) {

        $sqlSN = "SELECT *  FROM `s_first_order` WHERE 1 AND (`pro_sn1` LIKE '" . $sn . "' OR `pro_sn1` LIKE '" . $sn . "' OR `pro_sn2` LIKE '" . $sn . "' OR `pro_sn3` LIKE '" . $sn . "' OR `pro_sn4` LIKE '" . $sn . "' OR `pro_sn5` LIKE '" . $sn . "' OR `pro_sn6` LIKE '" . $sn . "' OR `pro_sn7` LIKE '" . $sn . "') AND `status_use` != '2' AND fo_id != '" . $foid . "' AND `fs_id` NOT LIKE 'SV%' ORDER BY `fo_id`  DESC";

        $qu_prosn = @mysqli_query($conn, $sqlSN);
        $row_prosn = @mysqli_num_rows($qu_prosn);
        return $row_prosn;
    } else {
        return 0;
    }
}

function checkHCustomerApplove($conn, $id)
{
    $quApprove = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE sr_id = '" . $id . "'");
    $numApprove = mysqli_fetch_array($quApprove);
    return $numApprove['signature'];
}
function checkHCustomerDate($conn, $id)
{
    $quApprove = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE sr_id = '" . $id . "'");
    $numApprove = mysqli_fetch_array($quApprove);
    return $numApprove['signature_date'];
}

function getServiceImg($conn, $id)
{
    $quImg = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE sr_id = '" . $id . "'");
    $numImg = mysqli_fetch_array($quImg);
    return $numImg['service_image'];
}

function getScheduleFile($conn, $technician, $month, $fo_id)
{
    $rowSchedule = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `service_schedule` WHERE `month` = " . $month . " AND `technician` = " . $technician . " AND `fo_id` LIKE '" . $fo_id . "' ORDER BY `sv_id`"));
    return $rowSchedule;
}

function getCheckProGen($conn, $pro, $fosv)
{

    if (substr($fosv, 0, 2) === "SV") {

        $pro_re = get_proname2($conn, $pro);
        // $pos4 = strpos($pro_re, "สัญญาบริการ");

        $mystring = $pro_re;
        $findme   = 'สัญญาบริการ';
        $pos4 = strpos($mystring, $findme);

        $pos4CH = '';

        if ($pos4 !== false) {
            //echo $pro_re."|".$pos4."<br>";
            return 1;
        } else {
            //echo "NoT".$pro_re."|".$pos4."<br>";
            return 0;
        }

        if ($pos4 !== false) {
            return 1;
        } else {
            return 0;
        }

    } else {
        $pro_re = get_proname($conn, $pro);
        $pos1 = strpos($pro_re, 'เครื่องล้างแก้ว');
        $pos2 = strpos($pro_re, 'เครื่องล้างจาน');
        $pos3 = strpos($pro_re, 'เครื่องทำน้ำแข็ง');

        $pos1CH = '';
        $pos2CH = '';
        $pos3CH = '';

        if ($pos1 !== false) {
            $pos1CH = 'yes';
        } else {
            $pos1CH = 'no';
        }

        if ($pos2 !== false) {
            $pos2CH = 'yes';
        } else {
            $pos2CH = 'no';
        }

        if ($pos3 !== false) {
            $pos3CH = 'yes';
        } else {
            $pos3CH = 'no';
        }

        if ($pos1CH == 'yes' || $pos2CH == 'yes' || $pos3CH == 'yes' || $pos4CH == 'yes') {
            return 1;
        } else {
            return 0;
        }

    }

}

function get_technician_signature($conn, $technic_id)
{

    $rowTechnic = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_group_technician` WHERE group_id = '" . $technic_id . "'"));

    $rowAccount = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_user` WHERE user_id = '" . $rowTechnic['user_account'] . "'"));

    $signature = '';

    if ($rowAccount['signature'] != '') {
        $signature = $rowAccount['signature'];
    } else {
        $signature = 'none.png';
    }

    return $signature;

}

function get_sale_signature($conn, $sale_id)
{

    $rowSale = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_group_sale` WHERE group_id = '" . $sale_id . "'"));

    $rowAccount = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_user` WHERE user_id = '" . $rowSale['user_account'] . "'"));

    $signature = '';

    if ($rowAccount['signature'] != '') {
        $signature = $rowAccount['signature'];
    } else {
        $signature = 'none.png';
    }

    return $signature;

}

function getScheduleService($svmonth, $month, $svtype)
{

    if ($svtype == 8) { //งานบริการประจำเดือนทุกเดือน
        return 1;
    }

    if ($svtype == 37) { //งานบริการประจำ เดือนเว้นเดือน

        //echo $svmonth." ".$month;
        if ($svmonth == $month) { //เดือนเดียวกัน
            return 1;
        }

        $listMonth = array();

        for ($i = 1; $i <= 6; $i++) {

            $svmonth += 2;

            if ($svmonth == 13) {$svmonth = 1;}
            if ($svmonth == 14) {$svmonth = 2;}

            array_push($listMonth, $svmonth);

        }
//        echo $month."<br>";
        //
        //        print_r($listMonth);

        if (in_array($month, $listMonth)) {
            return 1;
        }

    }

    if ($svtype == 38) { //งานบริการประจำ 2 เดือน/ครั้ง
        if ($svmonth == $month) { //เดือนเดียวกัน
            return 1;
        }

        $listMonth = array();

        for ($i = 1; $i <= 6; $i++) {

            $svmonth += 2;

            if ($svmonth == 13) {$svmonth = 1;}
            if ($svmonth == 14) {$svmonth = 2;}

            array_push($listMonth, $svmonth);

        }
//        echo $month."<br>";
        //
        //        print_r($listMonth);

        if (in_array($month, $listMonth)) {
            return 1;
        }

    }

    if ($svtype == 39) { //งานบริการประจำ 3 เดือน/ครั้ง

        if ($svmonth == $month) { //เดือนเดียวกัน
            return 1;
        }

        $listMonth = array();

        for ($i = 1; $i <= 4; $i++) {

            $svmonth += 3;

            if ($svmonth == 13) {$svmonth = 1;}
            if ($svmonth == 14) {$svmonth = 2;}
            if ($svmonth == 15) {$svmonth = 3;}

            array_push($listMonth, $svmonth);

        }
        //echo $month."<br>";

        //print_r($listMonth);

        if (in_array($month, $listMonth)) {
            return 1;
        }

    }

    if ($svtype == 97) { //งานบริการประจำ 4 เดือน/ครั้ง
        if ($svmonth == $month) { //เดือนเดียวกัน
            return 1;
        }

        $listMonth = array();

        for ($i = 1; $i <= 3; $i++) {

            $svmonth += 4;

            if ($svmonth == 13) {$svmonth = 1;}
            if ($svmonth == 14) {$svmonth = 2;}
            if ($svmonth == 15) {$svmonth = 3;}
            if ($svmonth == 16) {$svmonth = 4;}

            array_push($listMonth, $svmonth);

        }
//        echo $month."<br>";
        //
        //        print_r($listMonth);

        if (in_array($month, $listMonth)) {
            return 1;
        }
    }

    if ($svtype == 100) { //งานบริการประจำ 6 เดือน/ครั้ง
        if ($svmonth == $month) { //เดือนเดียวกัน
            return 1;
        }

        $listMonth = array();

        for ($i = 1; $i <= 2; $i++) {

            $svmonth += 6;

            if ($svmonth == 13) {$svmonth = 1;}
            if ($svmonth == 14) {$svmonth = 2;}
            if ($svmonth == 15) {$svmonth = 3;}
            if ($svmonth == 17) {$svmonth = 4;}
            if ($svmonth == 18) {$svmonth = 5;}
            if ($svmonth == 19) {$svmonth = 6;}

            array_push($listMonth, $svmonth);

        }
//        echo $month."<br>";
        //
        //        print_r($listMonth);

        if (in_array($month, $listMonth)) {
            return 1;
        }

    }
}

function chkServerFormGen($conn)
{

    $dateM = date("m");
    $dateY = date("Y");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM `service_schedule` WHERE `month` = " . $dateM . " AND `year` = '" . $dateY . "' ORDER BY `id` DESC");
    $num_oder = @mysqli_num_rows($qu_forder);

    if ($num_oder >= 1) {
        return 1;
    } else {
        return 0;
    }

}

function getShipSetupPro($conn, $fo_id, $typeSV)
{
    $quSV = @mysqli_query($conn, "SELECT * FROM s_service_report4 WHERE cus_id = '" . $fo_id . "' ORDER BY sr_id DESC");
    $rowSV = mysqli_fetch_array($quSV);
    if ($typeSV == 2) {
        return format_date_th($rowSV['job_balance'], 7);
    } else {
        return format_date_th($rowSV['sr_stime'], 7);
    }

}

function getTrackJObs($conn, $tab, $fo_id)
{

    $tableDB = '';

    if ($tab == 'FO' || $tab == 'SV') {
        $tableDB = 's_first_order';
    } else if ($tab == 'WO') {
        $tableDB = 's_work_noti';
    } else if ($tab == 'PJ') {
        $tableDB = 's_project_order';
    }else if ($tab == 'sale_schedule') {
        $tableDB = 's_sale_schedule';
    }
    $quFO = @mysqli_query($conn, "SELECT * FROM " . $tableDB . " WHERE fo_id = '" . $fo_id . "' ORDER BY fo_id DESC");
    $rowFO = mysqli_fetch_array($quFO);

    if ($tab == 'sale_schedule') {
        return $rowFO['cd_name'];
    }else{
        return $rowFO['fs_id'];
    }
    
}

function getWorkNotiInfo($conn, $val)
{
    $row_dea = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_work_noti WHERE fo_id = '" . $val . "'"));
    return $row_dea;
}

function diffDate($dateTo, $dateFm)
{
    //echo $dateTo.' '.$dateFm;
    $date1 = date_create($dateTo);
    $date2 = date_create($dateFm);
    $diff = date_diff($date1, $date2);
    return $diff->format("%a");
}

function TimeIsBetweenTwoTimes($from, $till, $input)
{
    $f = DateTime::createFromFormat('H:i:s', $from);
    $t = DateTime::createFromFormat('H:i:s', $till);
    $i = DateTime::createFromFormat('H:i:s', $input);
    if ($f > $t) {
        $t->modify('+1 day');
    }

    return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
}

function checkTotalOpenCloseService($conn, $condition, $daterriod, $openclose = 3)
{
    $condition .= " AND sv.st_setting = 1 ";
    $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $condition . " " . $daterriod . " ORDER BY fr.cd_name ASC";
    $quFO = @mysqli_query($conn, $sql);
    while ($row_fr = @mysqli_fetch_array($quFO)) {
        if ($row_fr['st_status'] == '0' || $row_fr['st_status'] == 0) {
            @mysqli_query($conn, "UPDATE `s_service_report` SET `st_status` = '1' WHERE `sr_id` = " . $row_fr['sr_id'] . ";");
        }
    }
}

function getTotalOpenCloseService($conn, $condition, $daterriod, $openclose, $custype = 0, $st_status = 0)
{

    $sums = 0;

    if ($openclose == 2) {
        $condition .= "";
    } else if ($openclose == 3) {
        $condition .= " AND sv.st_setting = 1 ";
    } else if ($openclose == 4) {
        $condition .= " AND sv.st_status = 2";
    } else if ($openclose == 5) {
        $condition .= " AND sv.sr_ctype2 = " . $custype . " AND sv.st_setting = 1";
    } else if ($openclose == 55) {
        $condition .= " AND sv.sr_ctype2 = " . $custype . " AND sv.st_setting = 0";
    } else if ($openclose == 6) {
        $condition .= " AND sr_ctype2 = " . $custype . " AND st_setting = 1 AND st_status='" . $st_status . "'";
        $sql = "SELECT * FROM s_service_report as sv WHERE 1 " . $condition . " " . $daterriod;
        $quFO = @mysqli_query($conn, $sql);
        while ($row_fr = @mysqli_fetch_array($quFO)) {
            $sums += 1;
        }
        return $sums;
    }

    if ($openclose != 6) {
        $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $condition . " " . $daterriod . " ORDER BY fr.cd_name ASC";
        $quFO = @mysqli_query($conn, $sql);
        while ($row_fr = @mysqli_fetch_array($quFO)) {
            $sums += 1;
        }
        return $sums;
    }

}

function getServiceSchedule($conn, $technician, $fo_id, $year, $month, $sn)
{
    // $rowSV = mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `service_schedule` WHERE `technician` = '".$technician."' AND `fo_id` = '".$fo_id."' AND `year` = '".$year."' AND `month` = '".$month."'  ORDER BY id ASC"));
    // $rowSVR = mysqli_fetch_array(@mysqli_query($conn,"SELECT * FROM `s_service_report` WHERE `sv_id` = '".$rowSV['sv_id']."' ORDER BY `sr_id` DESC"));
    // return format_date_th ($rowSVR['job_balance'],9);

    $quSV = @mysqli_query($conn, "SELECT * FROM `service_schedule` WHERE `technician` = '" . $technician . "' AND `fo_id` = '" . $fo_id . "' AND `year` = '" . $year . "' AND `month` = '" . $month . "'  ORDER BY id ASC");
    $numSV = mysqli_num_rows($quSV);
    if ($numSV > 1) {
        while ($rowSV = mysqli_fetch_array($quSV)) {

            $rowSVR = mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_service_report` WHERE `sv_id` = '" . $rowSV['sv_id'] . "' ORDER BY `sr_id` LIMIT 1"));

            if ($rowSVR['loc_sn'] == $sn) {
                return format_date_th($rowSVR['job_balance'], 9);
            }
        }
    } else {
        $rowSV = mysqli_fetch_array($quSV);
        $rowSVR = mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_service_report` WHERE `sv_id` = '" . $rowSV['sv_id'] . "' ORDER BY `sr_id` LIMIT 1"));
        return format_date_th($rowSVR['job_balance'], 9);
    }

}
function getServiceScheduleSV($conn, $technician, $fo_id, $year, $month, $sn)
{
    //echo "SELECT * FROM `service_schedule` WHERE `technician` = '".$technician."' AND `fo_id` = '".$fo_id."' AND `year` = '".$year."' AND `month` = '".$month."'  ORDER BY id ASC";
    $quSV = @mysqli_query($conn, "SELECT * FROM `service_schedule` WHERE `technician` = '" . $technician . "' AND `fo_id` = '" . $fo_id . "' AND `year` = '" . $year . "' AND `month` = '" . $month . "'  ORDER BY id ASC");
    $numSV = mysqli_num_rows($quSV);
    if ($numSV > 1) {
        while ($rowSV = mysqli_fetch_array($quSV)) {

            $rowSVR = mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM `s_service_report` WHERE `sv_id` = '" . $rowSV['sv_id'] . "' ORDER BY `sr_id` LIMIT 1"));

            if ($rowSVR['loc_sn'] == $sn) {
                return $rowSVR['sv_id'];
            }
        }
    } else {
        $rowSV = mysqli_fetch_array($quSV);
        return $rowSV['sv_id'];
    }

}

function check_quotation($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "QA-B " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_quotation WHERE fs_id like '%" . $concheck . "%' ORDER BY qu_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "QA-B " . $thdate . date("/m/") . "001";
    } else {
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "QA-B " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}
function check_quotation2($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "QA-H " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_quotation2 WHERE fs_id like '%" . $concheck . "%' ORDER BY qu_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "QA-H " . $thdate . date("/m/") . "001";
    } else {
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "QA-H " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}


function check_quotation3($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "QA-R " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_quotation3 WHERE fs_id like '%" . $concheck . "%' ORDER BY qu_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "QA-R " . $thdate . date("/m/") . "001";
    } else {
		$num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "QA-R " . $thdate . date("/m/") . sprintf("%03d", $num_odersum);
    }

}

function check_quotation4($conn)
{

    $thdate = substr(date("Y") + 543, 2);
    $concheck = "QA-RC " . $thdate . date("/m/");

    $qu_forder = @mysqli_query($conn, "SELECT * FROM s_quotation4 WHERE fs_id like '%" . $concheck . "%' ORDER BY qu_id DESC");
    $num_oder = @mysqli_num_rows($qu_forder);
    $row_forder = @mysqli_fetch_array($qu_forder);

    if ($row_forder['fs_id'] == "") {
        return "QA-RC " . $thdate . date("/m/") . "0001";
    } else {
        $num_odersum = substr($row_forder['fs_id'], -3) + 1;
        return "QA-RC " . $thdate . date("/m/") . sprintf("%04d", $num_odersum);
    }

}


const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
const BAHT_TEXT_TWENTY = 'ยี่';
const BAHT_TEXT_INTEGER = 'ถ้วน';
const BAHT_TEXT_BAHT = 'บาท';
const BAHT_TEXT_SATANG = 'สตางค์';
const BAHT_TEXT_POINT = 'จุด';
/**
 * Convert baht number to Thai text
 * @param double|int $number
 * @param bool $include_unit
 * @param bool $display_zero
 * @return string|null
 */
function baht_text($number, $include_unit = true, $display_zero = true)
{
    if (!is_numeric($number)) {
        return null;
    }
    $log = floor(log($number, 10));
    if ($log > 5) {
        $millions = floor($log / 6);
        $million_value = pow(1000000, $millions);
        $normalised_million = floor($number / $million_value);
        $rest = $number - ($normalised_million * $million_value);
        $millions_text = '';
        for ($i = 0; $i < $millions; $i++) {
            $millions_text .= BAHT_TEXT_UNITS[6];
        }
        return baht_text($normalised_million, false) . $millions_text . baht_text($rest, true, false);
    }
    $number_str = (string) floor($number);
    $text = '';
    $unit = 0;
    if ($display_zero && $number_str == '0') {
        $text = BAHT_TEXT_NUMBERS[0];
    } else {
        for ($i = strlen($number_str) - 1; $i > -1; $i--) {
            $current_number = (int) $number_str[$i];
            $unit_text = '';
            if ($unit == 0 && $i > 0) {
                $previous_number = isset($number_str[$i - 1]) ? (int) $number_str[$i - 1] : 0;
                if ($current_number == 1 && $previous_number > 0) {
                    $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
                } else if ($current_number > 0) {
                    $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
                }
            } else if ($unit == 1 && $current_number == 2) {
                $unit_text .= BAHT_TEXT_TWENTY;
            } else if ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
                $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
            }
            if ($current_number > 0) {
                $unit_text .= BAHT_TEXT_UNITS[$unit];
            }
            $text = $unit_text . $text;
            $unit++;
        }
    }

    if ($include_unit) {
        $text .= BAHT_TEXT_BAHT;
        $satang = explode('.', number_format($number, 2, '.', ''))[1];
        if ($satang == 0) {
            $text .= BAHT_TEXT_INTEGER;
        } else {
            $text .= baht_text($satang, false) . BAHT_TEXT_SATANG;
        }
    } else {
        $exploded = explode('.', $number);
        if (isset($exploded[1])) {
            $text .= BAHT_TEXT_POINT;
            $decimal = (string) $exploded[1];
            for ($i = 0; $i < strlen($decimal); $i++) {
                $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
            }
        }
    }
    return $text;
}

function getTypeService($id)
{

    switch ($id) {
        case "2":
            return "เครื่องล้างแก้ว";
            break;
        case "3":
            return "เครื่องผลิตน้ำแข็ง";
            break;
        default:
            return "เครื่องล้างจาน";
    }
}

function getTypeServiceDesc($id, $word)
{

    switch ($id) {
        case "2":
            $new_str = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างแก้ว', $word);
            $new_str = str_replace('เครื่องล้างจาน', 'เครื่องล้างแก้ว', $new_str);
            return $new_str;
            break;
        case "3":
            $new_str = str_replace('เครื่องล้างแก้ว', 'เครื่องผลิตน้ำแข็ง', $word);
            $new_str = str_replace('เครื่องล้างจาน', 'เครื่องผลิตน้ำแข็ง', $new_str);
            return $new_str;
            break;
        default:
            $new_str = str_replace('เครื่องล้างแก้ว', 'เครื่องล้างจาน', $word);
            $new_str = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างจาน', $new_str);
            return $new_str;
    }
}

function getNameSaleApprove($conn)
{
    $row_name = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_group_approve WHERE group_id = 1"));
    $row_user = get_username($conn, $row_name['user_account']);
    return $row_user;
}

function checkHSaleApplove($conn, $tag_db, $t_id)
{
    $quApprove = @mysqli_query($conn, "SELECT * FROM s_approve WHERE tag_db = '" . $tag_db . "' AND t_id = '" . $t_id . "' AND process_1 = '1';");
    $numApprove = mysqli_num_rows($quApprove);
    return $numApprove;
}

function checkProcess($conn, $tag_db, $PK_field, $id)
{
    $rowProcess = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM " . $tag_db . " WHERE " . $PK_field . " = '" . $id . "';"));
    return $rowProcess['process'];
}

function getDesc($value,$n) { 
	$value = str_replace('&nbsp;','' , $value);
	$value = str_replace('&hellip;','' , $value);
	$value = str_replace('&ldquo;','' , $value);
	$value = str_replace('&rdquo;','' , $value);
	$value = str_replace('&amp;',' and ' , $value);
	$value = str_replace('&quot;','' , $value);
	$value = str_replace('&ndash;','' , $value);
	$result = mb_strimwidth(trim(strip_tags($value)), 0, $n , "...", "UTF-8");
	return $result;
}

function checkBoxFO($conn,$cusID){
    $qu = @mysqli_query($conn, "SELECT sr . * , fd.cd_name FROM s_service_report4 AS sr, s_first_order AS fd WHERE sr.cus_id = fd.fo_id AND sr.cus_id ='".$cusID."' order by sr.sr_id");
    $numSV = mysqli_num_rows($result);
    $statusCheckBox = 0;
    while ($row = @mysqli_fetch_array($qu)) {
        if($row["st_setting"] != 0){
            if($row["sr_ctype"] == 23 || $row["sr_ctype"] == 36 || $row["sr_ctype"] == 45 || $row["sr_ctype"] == 47){
                $statusCheckBox = 1;
            }else if($row["sr_ctype"] == 24 || $row["sr_ctype"] == 55 || $row["sr_ctype"] == 89){
                $statusCheckBox = 2;
            }else{
                $statusCheckBox = 0;
            }
            
        }
    }

    $qu2 = @mysqli_query($conn, "SELECT * FROM s_service_report WHERE cus_id ='".$cusID."' and (sr_ctype = '24' OR sr_ctype = '55' OR sr_ctype = '89') order by sr_id DESC");
    while ($row = @mysqli_fetch_array($qu2)) {
        if($row["st_setting"] != 0){
            $statusCheckBox = 2;
        }
    }
    return $statusCheckBox;
}

function getTypeMCSize($id,$type)
{
    if($type == 3){
        switch ($id) {
            case "1":
                return "ขนาดเล็ก Small Size";
                break;
            case "2":
                return "ขนาดกลาง Medium Size";
                break;
            case "3":
                return "ขนาดใหญ่ Large Size";
                break;
            default:
                return "";
        }
    }else if($type == 4){
        switch ($id) {
            case "1":
                return "ขนาดเล็ก";
                break;
            case "2":
                return "ขนาดกลาง";
                break;
            case "3":
                return "ขนาดใหญ่";
                break;
            default:
                return "";
        }
    }else{
        switch ($id) {
            case "1":
                return "ขนาดเล็ก Under Counter";
                break;
            case "2":
                return "ขนาดกลาง Hoodtype";
                break;
            case "3":
                return "ขนาดใหญ่ Conveyer";
                break;
            default:
                return "";
        }
    }
}

function getQuotationTitle($id)
{
    switch ($id) {
        case "1":
            return "ซ่อม";  
            break;
        case "2":
            return "ติดตั้ง";
            break;
        case "3":
            return "ติดตั้ง-โปรเจค";
            break; 
        case "4":
            return "เดินระบบน้ำ/ไฟฟ้า";
            break;
        case "5":
            return "ขนส่งสินค้า";
            break;
        case "6":
            return "อื่นๆ";
            break;
        default:
            return "";
    }
}

            
            


                    