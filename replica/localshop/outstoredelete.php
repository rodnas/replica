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
$sqlKey = "store.id=" . "" . $key . "";
if (!is_null($key))
	{
	$sqlwrk = "SELECT * FROM store";
	$sqlwrk .= " WHERE " . $sqlKey;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_topic_id = $rowwrk["topic_id"];
		$x_product_id = $rowwrk["product_id"];
		}
	@mysqli_free_result($rswrk);
	}
$x_key_m = @$_SESSION[$which_system.viewModul($modul_select,"name") . "_masterkey"]; // restore master key from session
if ($x_key_m <> "")
	{
	$strsql = "DELETE FROM " . viewModul($modul_select,"name");
	$strsql .= " WHERE topic_id=".$x_key_m;
	$strsql .= " AND product_id=".$x_product_id;
	$rs =	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
	}
jumptopage("index.php?modul_action=list");
?>