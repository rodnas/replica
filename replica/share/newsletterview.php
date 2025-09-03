<?php
// Module properties
$which_back = "list";
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
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_id = @$row["id"];
		$x_name = @$row["name"];
		if (!empty($x_pictURL))
			{
			$x_pictURL = $modul_image_path . "/" . str_replace("_small.","_normal.",@$row["pictURL"]);
			}
		sharefromtable();
		mysqli_free_result($rs);
		is_reading();
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td valign='top' align='center'>";
$html_page .= "<table width='90%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr height='20'>";
$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
footer("view");
?>
