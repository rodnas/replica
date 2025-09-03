<?php
$which_backw = @$_GET["which_back"];
$onlyview = @$_GET["onlyview"];
$partner_id = @$_GET["partner_id"];
if (!empty($which_backw))
	{
	$which_back = "list&modul_select=".$which_backw;
	if (!empty($partner_id))
		{
		$which_back .= "&partner_id=".$partner_id;
		}
	$which_back .= "&cmd=resetall";
	}
else
	{
	$which_back = "list";
	}
sharefieldinit();
if (($ewCurSec & ewAllowview) <> ewAllowview) jumptopage("index.php?modul_action=" . $which_back);
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}

// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	//display with input box
	}
switch ($a)
	{
	case "I": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	
		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_name = @$row["name"];
		$x_country = @$row["country"];
		$x_zipcode = @$row["zipcode"];
		$x_city = @$row["city"];
		$x_address = @$row["address"];
		$x_phone = @$row["phone"];
		$x_email = @$row["email"];
		$x_taxnumber = @$row["taxnumber"];
		if (!is_null(@$row["pictURL"])) 
			$x_pictURL = $modul_image_path . @$row["pictURL"]; 
		else 
			$x_pictURL="";
		$x_directorname = @$row["directorname"];
		$x_contactname = @$row["contactname"];
		$x_factor = @$row["factor"];
		sharefromtable();
		mysqli_free_result($rs);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
include ("partner_view.php");
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
$html_page .= footer("view");
?>
