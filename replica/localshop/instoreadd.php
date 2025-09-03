<?php
// Module properties
$key = @$_GET["key"];
if (($ewCurSec & ewAllowadd) <> ewAllowadd) 
	jumptopage("index.php?modul_action=list&key=" . $key);
$x_topic_id = @$_GET["topic_id"];
$x_amount = @$_GET["amount"];
$x_inprice = @$_GET["inprice"];
$x_outprice = @$_GET["outprice"];
$x_product_id = $key;
$x_lang_id = @$_SESSION[$which_system . "status_UserLangID"];
$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
$x_insert_datetime = date('Y.m.d H:i:s<br>',time());
// add the values into an array

// topic_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`topic_id`"] = $theValue;

// product_id
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_product_id) : $x_product_id;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`product_id`"] = $theValue;

// amount
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_amount) : $x_amount;
$theValue = ($theValue != "") ? intval($theValue) : "NULL";
$fieldList["`amount`"] = $theValue;

// inprice
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_inprice) : $x_inprice;
$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
$fieldList["`inprice`"] = $theValue;

// outprice
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_outprice) : $x_outprice;
$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
$fieldList["`outprice`"] = $theValue;

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

$sqlwrk2 = "SELECT * FROM ".$modul_select;
$sqlwrk2 .= " WHERE product_id = " . $x_product_id;
$sqlwrk2 .= " AND topic_id=" . $x_topic_id;
$rswrkrs = mysqli_query($GLOBALS['conn'],$sqlwrk2);
$rswrk_is = intval(@mysqli_num_rows($rswrkrs));
if (intval($x_amount) == 0)
	{
	$strsql = "DELETE FROM ".$modul_select;
	$strsql .= " WHERE product_id = " . $x_product_id;
	$strsql .= " AND topic_id=" . $x_topic_id; 
	$rs =	mysqli_query($GLOBALS['conn'].$strsql) or die(mysqli_error());
	}
else if ($rswrk_is == 0)
	{
	// insert into database
	$strsql = "INSERT INTO ".$modul_select." (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
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

	$updateSQL = "UPDATE ".$modul_select." SET ";
	foreach ($fieldList as $key=>$temp)
		{
		$updateSQL .= "$key = $temp, ";			
		}
	if (substr($updateSQL, -2) == ", ")
		{
		$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
		}
	$updateSQL .= " WHERE product_id = " . $x_product_id;
	$updateSQL .= " AND topic_id=" . $x_topic_id; 
	$rs = mysqli_query($GLOBALS['conn'],$updateSQL, $GLOBALS['conn']) or die(mysqli_error());
	}
jumptopage("index.php?modul_action=list&key=" . $key);
?>