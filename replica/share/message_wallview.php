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
		$x_target_user_id = @$row["target_user_id"];
		$x_subject = @$row["subject"];
		$x_is_read = @$row["is_read"];
		$x_is_read_datetime = @$row["is_read_datetime"];
		sharefromtable();
		mysqli_free_result($rs);
		if ($x_target_user_id == @$_SESSION[$which_system . "status_UserID"] &&
			($x_is_read == 0 || is_null($x_is_read)))
			{
			$updateSQL = "UPDATE " . $modul_select . " SET ";
			$updateSQL .= "is_read = 1,";			
			$updateSQL .= "is_read_datetime = ".db_actual_datetime();
			$updateSQL .= " WHERE id=" .$tkey;
		  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
			}
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table width='90%'  border='0' cellspacing='0' cellpadding='0' bgcolor='#CCCCCC'>";
$html_page .= "<tr bgcolor='" . $actcolor . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"insert_user_idTitle")."</span></td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"target_user_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"insert_datetimeTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"is_read_datetimeTitle")."</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr bgcolor='" . $color6 . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (!is_null($x_insert_user_id))
	{
	$sqlwrk = "SELECT id, shortname FROM users";
	$sqlwrk_where = "";
	$sqlwrk_where .= "id = " . $x_insert_user_id;
	if ($sqlwrk_where <> "" )
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_insert_user_id = $rowwrk["shortname"];
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_insert_user_id;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (!is_null($x_target_user_id))
	{
	$sqlwrk = "SELECT id, shortname FROM users";
	$sqlwrk_where = "";
	$sqlwrk_where .= "id = " . $x_target_user_id;
	if ($sqlwrk_where <> "" )
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_target_user_id = $rowwrk["shortname"];
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_target_user_id;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td align='left' valign='center'>";
$html_page .= "<span class='phpmaker'>&nbsp;";
$html_page .= "<i>" . FormatDateTime($x_insert_datetime,8) . "</i>";
$html_page .= "</span></td>";
$html_page .= "<td>";
$html_page .= "<span class='phpmaker'>&nbsp;";
$html_page .= "<i>" . FormatDateTime($x_is_read_datetime,8) . "</i>";
$html_page .= "</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr height='5'><td></td></tr>";
$html_page .= "<tr bgcolor='" . $actcolor . "'>";
$html_page .= "<td colspan='4'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"subjectTitle")."</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr bgcolor='" . $color6 . "'>";
$html_page .= "<td colspan='4'>";
$html_page .= "<span class='phpmaker'>&nbsp;";
$html_page .= "<b>" . $x_subject . "</b>";
$html_page .= "</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr height='5'><td></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
footer("view");
?>
