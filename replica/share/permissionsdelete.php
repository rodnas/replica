<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2) 
	jumptopage($base_modul);

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
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "D": // delete
		$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		$strsql = "DELETE FROM groups_permissions WHERE permission_id=" . "".$key."";
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		$strsql = "DELETE FROM users_permissions WHERE permission_id=" . "".$key."";
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
//	$bgcolor = $color4; // row color
	if ($recCount % 2 <> 0 )
		{
//		$bgcolor=$color5; // alternate row color
		}
	$x_modul = @$row["modul"];
	$x_name = @$row["name"];
	$x_allowview = @$row["allowview"];
	$x_allowadd = @$row["allowadd"];
	$x_allowedit = @$row["allowedit"];
	$x_allowdelete = @$row["allowdelete"];
	sharefromtable();
	$html_page .= "<tr align='center'><td valign='top'>";
	$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"modulTitle")."</span>&nbsp;</td>";
	$html_page .= "<td width='650' bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_modul . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
	$html_page .= "<td width='650' bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'><td colspan='2'><table border=0 width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='" . $actcolor . "'>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"viewTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"addTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"editTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"deleteTitle")."</span></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center' bgcolor='".$color6."'>";
	$html_page .= activeTd($x_allowview,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowadd,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowedit,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowdelete,$enable["yes"],$enable["no"]);
	$html_page .= "</tr></table></td></tr>";
	$html_page .= "</table>";
	$html_page .= "</td>";
	$html_page .= "</tr>";
	$html_page .= "</table>";
	$html_page .= itemstatus();
	}
footer("delete");
?>
