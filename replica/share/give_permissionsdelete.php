<?php
// Module properties
$which_back = "list";
sharefieldinit();
$whose_permissions = str_replace("_permissions","",$modul_select);
$whose_id = str_replace("s_permissions","",$modul_select)."_id";
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
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
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center'><td valign='center'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
//	$bgcolor = $color4; // row color
	if ($recCount % 2 <> 0 )
		{
//		$bgcolor=$color5; // alternate row color
		}
	$x_whose_id = @$row[$whose_id];
	$x_permission_id = @$row["permission_id"];
	$x_allowview = @$row["allowview"];
	$x_allowadd = @$row["allowadd"];
	$x_allowedit = @$row["allowedit"];
	$x_allowdelete = @$row["allowdelete"];
	sharefromtable();
	$html_page .= "<tr align='left' valign='top'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"whose_idTitle")."</span>&nbsp;</td>";
	$html_page .= "<td width='600' bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (!is_null($x_whose_id))
		{
		$sqlwrk = "SELECT id, name FROM ".$whose_permissions;
		$sqlwrk_where = "";
		$sqlwrk_where .= "id = " . $x_whose_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			if ($modul_select == "users_permissions")
				{
				$x_whose_name = $rowwrk["shortname"];
				}
			else if ($modul_select == "groups_permissions")
				{
				$x_whose_name = $rowwrk["name"];
				}
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= $x_whose_name;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"permission_idTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (!is_null($x_permission_id))
		{
		$sqlwrk = "SELECT id, name FROM permissions";
		$sqlwrk_where = "";
		$sqlwrk_where .= "id = " . $x_permission_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			if ($modul_select == "users_permissions")
				{
				$x_permission_name = $rowwrk["shortname"];
				}
			else if ($modul_select == "groups_permissions")
				{
				$x_permission_name = $rowwrk["name"];
				}
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= $x_permission_name;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'><td colspan='2'><table border=0 width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='" . $actcolor . "'>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"viewTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"addTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"editTitle")."</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"deleteTitle")."</span></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center' bgcolor='" . $color6 . "'>";
	$html_page .= activeTd($x_allowview,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowadd,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowedit,$enable["yes"],$enable["no"]);
	$html_page .= activeTd($x_allowdelete,$enable["yes"],$enable["no"]);
	$html_page .= "</tr></table></td></tr>";
	$html_page .= "</table></td></tr>";
	$html_page .= itemstatus();
	}
footer("delete");
?>
