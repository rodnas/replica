<?php
// Module properties
$key_item = @$_GET["key"];
$key = @$_GET["key"];
if (($ewCurSec & ewAllowadd) <> ewAllowadd) 
	jumptopage("index.php?modul_select=product_item&modul_action=list&key=" . $key);
$x_amount = @$_GET["amount"];
if (!is_null($key))
	{
	$x_product_id = $key;
	$sqlwrk = "SELECT * FROM product_item";
	$sqlwrk .= " WHERE id = " . $x_product_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
		$x_status_id = 1;
		$x_price = $rowwrk["priceHUF"];
		$x_insert_datetime = date('Y.m.d H:i:s<br>',time());
		$x_lang_id = $_SESSION[$which_system . "status_UserLangID"];
		}
	@mysqli_free_result($rswrk);
	}

// add the values into an array

// product_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_product_id) : $x_product_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`product_id`"] = $theValue;

// status_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_status_id) : $x_status_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`status_id`"] = $theValue;

// amount
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_amount) : $x_amount;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`amount`"] = $theValue;

// price
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_price) : $x_price;
$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
$fieldList["`price`"] = $theValue;

// lang_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`lang_id`"] = $theValue;

// insert_user_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`insert_user_id`"] = $theValue;

// insert_datetime
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
$fieldList["`insert_datetime`"] = $theValue;

$sqlwrk2 = "SELECT * FROM basket";
$sqlwrk2 .= " WHERE product_id = " . $x_product_id;
$sqlwrk2 .= " AND insert_user_id=" . $x_insert_user_id; 
$sqlwrk2 .= " AND status_id=1";
$rswrkrs = mysqli_query($GLOBALS["conn"],$sqlwrk2);
$rswrk_is = intval(@mysqli_num_rows($rswrkrs));
if (intval($x_amount) == 0)
	{
	$strsql = "DELETE FROM basket";
	$strsql .= " WHERE product_id = " . $x_product_id;
	$strsql .= " AND insert_user_id=" . $x_insert_user_id; 
	$strsql .= " AND status_id=1";
	$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
	}
else if ($rswrk_is == 0)
	{
	// insert into database
	$strsql = "INSERT INTO basket (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
	}
else
	{
	$x_modify_user_id = @$_SESSION[$which_system . "status_UserID"];
	$x_modify_datetime = date('Y.m.d H:i:s<br>',time());

	// modify_user_id
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$theValue = ($theValue != "") ? intval($theValue) : "NULL";
	$fieldList["`modify_user_id`"] = $theValue;

	// modify_datetime
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
	$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
	$fieldList["`modify_datetime`"] = $theValue;

	$updateSQL = "UPDATE basket SET ";
	foreach ($fieldList as $key=>$temp)
		{
		$updateSQL .= "$key = $temp, ";			
		}
	if (substr($updateSQL, -2) == ", ")
		{
		$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
		}
	$updateSQL .= " WHERE product_id = " . $x_product_id;
	$updateSQL .= " AND insert_user_id=" . $x_insert_user_id; 
	$updateSQL .= " AND status_id=1";
	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
	}
jumptopage("index.php?modul_select=product_item&modul_action=list&key=" . $key_item);
?>