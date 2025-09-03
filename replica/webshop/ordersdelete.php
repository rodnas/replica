<?php
// Module properties
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
$sqlKey = "`id`=" . "" . $key . "";

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
		$strsql = "SELECT * FROM `" . $modul_select . "` WHERE `id`=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$key = @$row["id"];
		$x_total_amount = 0;
		$x_total_price = 0;
		$x_type_id = @$row["type_id"];
		$x_term_date = @$row["term_date"];
		$x_comment = @$row["comment"];
		$x_status_id = @$row["status_id"];
		$x_is_read = @$row["is_read"];
		$x_is_read_datetime = @$row["is_read_datetime"];
		$x_is_read_user_id = @$row["is_read_user_id"];
		sharefromtable();
		mysqli_free_result($rs);
		include ("ordersupdate.php");
		break;
	case "D": // delete
		$tkey = "" . $key . "";
		$strsql = "DELETE FROM " . $modul_select . " WHERE id=" . $key;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		$strsql = "DELETE FROM " . $modul_select . "_item WHERE orders_id=" . $key;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key ."'>";
$html_page .= "<table border='0'  width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<td valign='top'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#CCCCCC'>";
$html_page .= "<tr height='30' bgcolor='" . $actcolor . "' valign='center'>";
$html_page .= "<td width='70'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"idTitle")."</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"amountTitle")."</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"totalpriceTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"type_idTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"term_dateTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"status_idTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"insert_datetimeTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"usernameTitle")."</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr height='30' bgcolor='" . $color6 . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_id . "</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_total_amount . "</span>&nbsp;</td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_total_price . "</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>";
$x_type_name = "";
if (!is_null($x_type_id))
	{
	$sqlwrk = "SELECT `id`, `name` FROM `" . $modul_select . "_type`";
	$sqlwrk_where = "";
	$sqlwrk_where .= "`id` = " . $x_type_id;
	if ($sqlwrk_where <> "" )
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_type_name = $rowwrk["name"];
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_type_name;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;" . FormatDateTime($x_term_date,9) . "&nbsp;</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>";
$x_status_name = "";
if (!is_null($x_status_id))
	{
	$sqlwrk = "SELECT `id`, `name` FROM `" . $modul_select . "_status`";
	$sqlwrk_where = "";
	$sqlwrk_where .= "`id` = " . $x_status_id;
	if ($sqlwrk_where <> "" )
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_status_name = $rowwrk["name"];
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_status_name;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;" . FormatDateTime($x_insert_datetime,9) . "&nbsp;</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>";
$x_user_name = "";
if (!is_null($x_insert_user_id))
	{
	$sqlwrk = "SELECT `id`, `shortname`, `surname`, `forename` FROM `users`";
	$sqlwrk_where = "";
	$sqlwrk_where .= "`id` = " . $x_insert_user_id;
	if ($sqlwrk_where <> "" )
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_user_name = $rowwrk["shortname"];
		$x_user_name .= " (" . $rowwrk["surname"];
		$x_user_name .= " " . $rowwrk["forename"] . ")";
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_user_name;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "</tr>";
if (!empty($x_comment))
	{
	$html_page .= "<tr height='30' valign='center' align='center'>";
	$html_page .= "<td colspan='9' bgcolor='" . $actcolor . "'><span class='header'>".viewModulParam($modul_select,"commentTitle")."</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr height='30' valign='top' align='center'>";
	$html_page .= "<td colspan='9' bgcolor='" . $color6 . "'><span class='phpmaker'>" . @$x_comment . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr height='30' valign='center' align='center'>";
$html_page .= "<td colspan='9' bgcolor='" . $actcolor . "'><span class='header'>".viewModulParam($modul_select,"descriptionTitle")."</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
footer("delete");
?>
