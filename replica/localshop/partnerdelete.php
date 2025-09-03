<?php
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
// single delete record
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}
$sqlKey = "id=" . "" . $key . "";
// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	// display
	}
switch ($a)
	{
	case "I": // display
		$strsql = "SELECT * FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "D": // delete
		$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs =	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr><td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount = $recCount++;	
//	$bgcolor = $color4; // set row color
	if ($recCount % 2 <> 0 )
		{
//		$bgcolor=$color5; // display alternate color for rows
		}
	$x_name = @$row["name"];
	$x_country = @$row["country"];
	$x_zipcode = @$row["zipcode"];
	$x_city = @$row["city"];
	$x_address = @$row["address"];
	$x_phone = @$row["phone"];
	$x_fax = @$row["fax"];
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
	include ("partner_view.php");
	$html_page .= "</table></td></tr>";
	$html_page .= "</table></td></tr>";
	$html_page .= itemstatus();
	}
$html_page .= footer("delete");
?>
