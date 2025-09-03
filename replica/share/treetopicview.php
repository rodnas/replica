<?php
// Module properties
$which_back="list";
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
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_tree_id = @$row["tree_id"];
		$x_name = @$row["name"];
		sharefromtable();
		mysqli_free_result($rs);
		is_reading();
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='viewform'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table width='90%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= itemstatus();
footer("view");
?>
