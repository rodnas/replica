<?php
// Module properties
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=list");
// single delete record
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=list");
	}
$sqlKey = "product_id=" . "" . $key . "";
$strsql = "DELETE FROM " . $modul_select;
$strsql .= " WHERE topic_id=".@$_SESSION[$which_system.$modul_select . "_masterkey"];
$strsql .= " AND ".$sqlKey;
$rs =	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
jumptopage("index.php?modul_action=list");
?>