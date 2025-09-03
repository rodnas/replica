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

// get fields from form
$x_id = @$_POST["x_id"];
$x_total_amount = 0;
$x_total_price = 0;
$x_type_id = @$_POST["x_type_id"];
$x_term_date = @$_POST["x_term_date"];
$x_comment = @$_POST["x_comment"];
$x_status_id = @$_POST["x_status_id"];
$x_is_read = @$_POST["x_is_read"];
$x_is_read_datetime = @$_POST["x_is_read_datetime"];
$x_is_read_user_id = @$_POST["x_is_read_user_id"];
sharefrompost();
switch ($a)
	{
	case "I": // get a record to display
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
	case "U": // update
//		if ($x_errortext == 'NULL' || $x_errortext == "")		
//			{
			$tkey = "" . $key . "";

			// get the form values
			$x_id = @$_POST["x_id"];
			$x_total_amount = @$_POST["x_total_amount"];
			$x_total_price = @$_POST["x_total_price"];
			$x_type_id = @$_POST["x_type_id"];
			$x_term_date = @$_POST["x_term_date"];
			$x_comment = @$_POST["x_comment"];
			$x_status_id = @$_POST["x_status_id"];
			$x_is_read = @$_POST["x_is_read"];
			$x_is_read_datetime = @$_POST["x_is_read_datetime"];
			$x_is_read_user_id = @$_POST["x_is_read_user_id"];
			sharefrompost();
			// add the values into an array

			// status_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_status_id) : $x_status_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`status_id`"] = $theValue;

			sharefieldconv();			

			if ($x_is_read != 1)
				{
				$fieldList["`is_read`"] = 1;

				$fieldList["`is_read_datetime`"] = $w_actual_datetime;

				$fieldList["`is_read_user_id`"] = @$_SESSION[$which_system . "status_UserID"];
				}

			// update
			$updateSQL = "UPDATE `" . $modul_select . "` SET ";
			foreach ($fieldList as $key=>$temp)
				{
				$updateSQL .= "$key = $temp, ";			
				}
			if (substr($updateSQL, -2) == ", ")
				{
				$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
				}
			$updateSQL .= " WHERE `id`=".$tkey;
	  		$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
			jumptopage("index.php?modul_action=" . $which_back);
//		}		
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form enctype=\"multipart/form-data\" method='post' name='editform'>";
$html_page .= "<input type='hidden' name='a' value='U'>";
$html_page .= "<input type='hidden' name='key' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<input type='hidden' name='x_id' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<input type='hidden' name='x_is_read' value='" . htmlspecialchars(@$x_is_read) . "'>";
$html_page .= "<input type='hidden' name='x_description' value='" . htmlspecialchars(@$x_description) . "'>";
$html_page .= "<input type='hidden' name='x_active' value='" . htmlspecialchars(@$x_active) . "'>";
$html_page .= "<table border='0'  width='100%' cellspacing='1' cellpadding='2'>";
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
$html_page .= "<td align='center' bgcolor='#F3f2eb'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
$x_status_idList = "<select name=\"x_status_id\">";
$cbo_x_status_id_js = ""; // initialise
$sqlwrk = "SELECT `id`, `name` FROM `" . $modul_select . "_status`";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_status_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_status_id)
			{
			$x_status_idList .= " selected";
			}
		$x_status_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_status_idList .= "</select>";
$html_page .= $x_status_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=".$modul_select . "_status"."&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' title='".viewModulParam($modul_select,"status_idTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
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
$html_page .= "<tr valign='top' align='center'>";
$html_page .= "<td colspan='9' bgcolor='" . $color6 . "'><span class='phpmaker'>" . @$x_description . "</span>&nbsp;</td>";
$html_page .= "</tr>";
footer("edit");
?>
