<?php
// Module properties
sharefieldinit();
$nocopy = true;

// get search criteria for advanced search
// field "id"

$x_id = @$HTTP_GET_VARS["x_id"];
$z_id = @$HTTP_GET_VARS["z_id"];
$z_id = (get_magic_quotes_gpc()) ? stripslashes($z_id) : $z_id;
$arrfieldopr = explode(",", $z_id);
if ($x_id <> "" && count($arrfieldopr) >= 3) {
	$x_id = (!get_magic_quotes_gpc()) ? addslashes($x_id) : $x_id;
	$a_search = $a_search . "`id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_id . $arrfieldopr[2] . " AND ";
}

// field "topic_id"
$x_topic_id = @$HTTP_GET_VARS["x_topic_id"];
$z_topic_id = @$HTTP_GET_VARS["z_topic_id"];
$z_topic_id = (get_magic_quotes_gpc()) ? stripslashes($z_topic_id) : $z_topic_id;
$arrfieldopr = explode(",", $z_topic_id);
if ($x_topic_id <> "" && count($arrfieldopr) >= 3) {
	$x_topic_id = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
	$a_search = $a_search . "`topic_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_topic_id . $arrfieldopr[2] . " AND ";
}

// field "active"
$x_active = @$HTTP_GET_VARS["x_active"];
$z_active = @$HTTP_GET_VARS["z_active"];
$z_active = (get_magic_quotes_gpc()) ? stripslashes($z_active) : $z_active;
$arrfieldopr = explode(",", $z_active);
if ($x_active <> "" && count($arrfieldopr) >= 3) {
	$x_active = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
	$a_search = $a_search . "`active` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_active . $arrfieldopr[2] . " AND ";
}

// field "description"
$x_description = @$HTTP_GET_VARS["x_description"];
$z_description = @$HTTP_GET_VARS["z_description"];
$z_description = (get_magic_quotes_gpc()) ? stripslashes($z_description) : $z_description;
$arrfieldopr = explode(",", $z_description);
if ($x_description <> "" && count($arrfieldopr) >= 3) {
	$x_description = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
	$a_search = $a_search . "`description` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_description . $arrfieldopr[2] . " AND ";
}

// field "moderated"
$x_moderated = @$HTTP_GET_VARS["x_moderated"];
$z_moderated = @$HTTP_GET_VARS["z_moderated"];
$z_moderated = (get_magic_quotes_gpc()) ? stripslashes($z_moderated) : $z_moderated;
$arrfieldopr = explode(",", $z_moderated);
if ($x_moderated <> "" && count($arrfieldopr) >= 3) {
	$x_moderated = (!get_magic_quotes_gpc()) ? addslashes($x_moderated) : $x_moderated;
	$a_search = $a_search . "`moderated` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_moderated . $arrfieldopr[2] . " AND ";
}

// field "automoderated"
$x_automoderated = @$HTTP_GET_VARS["x_automoderated"];
$z_automoderated = @$HTTP_GET_VARS["z_automoderated"];
$z_automoderated = (get_magic_quotes_gpc()) ? stripslashes($z_automoderated) : $z_automoderated;
$arrfieldopr = explode(",", $z_automoderated);
if ($x_automoderated <> "" && count($arrfieldopr) >= 3) {
	$x_automoderated = (!get_magic_quotes_gpc()) ? addslashes($x_automoderated) : $x_automoderated;
	$a_search = $a_search . "`automoderated` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_automoderated . $arrfieldopr[2] . " AND ";
}

// field "lang_id"
$x_lang_id = @$HTTP_GET_VARS["x_lang_id"];
$z_lang_id = @$HTTP_GET_VARS["z_lang_id"];
$z_lang_id = (get_magic_quotes_gpc()) ? stripslashes($z_lang_id) : $z_lang_id;
$arrfieldopr = explode(",", $z_lang_id);
if ($x_lang_id <> "" && count($arrfieldopr) >= 3) {
	$x_lang_id = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
	$a_search = $a_search . "`lang_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lang_id . $arrfieldopr[2] . " AND ";
}

// field "insert_user_id"
$x_insert_user_id = @$HTTP_GET_VARS["x_insert_user_id"];
$z_insert_user_id = @$HTTP_GET_VARS["z_insert_user_id"];
$z_insert_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_insert_user_id) : $z_insert_user_id;
$arrfieldopr = explode(",", $z_insert_user_id);
if ($x_insert_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_insert_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
	$a_search = $a_search . "`insert_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_user_id . $arrfieldopr[2] . " AND ";
}

// field "answer_user_id"
$x_answer_user_id = @$HTTP_GET_VARS["x_answer_user_id"];
$z_answer_user_id = @$HTTP_GET_VARS["z_answer_user_id"];
$z_answer_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_answer_user_id) : $z_answer_user_id;
$arrfieldopr = explode(",", $z_answer_user_id);
if ($x_answer_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_answer_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_answer_user_id) : $x_answer_user_id;
	$a_search = $a_search . "`answer_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_answer_user_id . $arrfieldopr[2] . " AND ";
}

// field "insert_datetime"
$x_insert_datetime = @$HTTP_GET_VARS["x_insert_datetime"];
$z_insert_datetime = @$HTTP_GET_VARS["z_insert_datetime"];
$z_insert_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_insert_datetime) : $z_insert_datetime;
$arrfieldopr = explode(",", $z_insert_datetime);
if ($x_insert_datetime <> "" && count($arrfieldopr) >= 3) {
	$x_insert_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
	$a_search = $a_search . "`insert_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_datetime . $arrfieldopr[2] . " AND ";
}

// field "modify_user_id"
$x_modify_user_id = @$HTTP_GET_VARS["x_modify_user_id"];
$z_modify_user_id = @$HTTP_GET_VARS["z_modify_user_id"];
$z_modify_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_modify_user_id) : $z_modify_user_id;
$arrfieldopr = explode(",", $z_modify_user_id);
if ($x_modify_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_modify_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$a_search = $a_search . "`modify_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_user_id . $arrfieldopr[2] . " AND ";
}

// field "modify_datetime"
$x_modify_datetime = @$HTTP_GET_VARS["x_modify_datetime"];
$z_modify_datetime = @$HTTP_GET_VARS["z_modify_datetime"];
$z_modify_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_modify_datetime) : $z_modify_datetime;
$arrfieldopr = explode(",", $z_modify_datetime);
if ($x_modify_datetime <> "" && count($arrfieldopr) >= 3) {
	$x_modify_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
	$a_search = $a_search . "`modify_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_datetime . $arrfieldopr[2] . " AND ";
}

// field "visitcounter"
$x_visitcounter = @$HTTP_GET_VARS["x_visitcounter"];
$z_visitcounter = @$HTTP_GET_VARS["z_visitcounter"];
$z_visitcounter = (get_magic_quotes_gpc()) ? stripslashes($z_visitcounter) : $z_visitcounter;
$arrfieldopr = explode(",", $z_visitcounter);
if ($x_visitcounter <> "" && count($arrfieldopr) >= 3) {
	$x_visitcounter = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
	$a_search = $a_search . "`visitcounter` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_visitcounter . $arrfieldopr[2] . " AND ";
}

// field "lastvisit"
$x_lastvisit = @$HTTP_GET_VARS["x_lastvisit"];
$z_lastvisit = @$HTTP_GET_VARS["z_lastvisit"];
$z_lastvisit = (get_magic_quotes_gpc()) ? stripslashes($z_lastvisit) : $z_lastvisit;
$arrfieldopr = explode(",", $z_lastvisit);
if ($x_lastvisit <> "" && count($arrfieldopr) >= 3) {
	$x_lastvisit = (!get_magic_quotes_gpc()) ? addslashes($x_lastvisit) : $x_lastvisit;
	$a_search = $a_search . "`lastvisit` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lastvisit . $arrfieldopr[2] . " AND ";
}
if (strlen($a_search) > 4) {
	$a_search = substr($a_search, 0, strlen($a_search)-4);
}

// get search criteria for basic search
$pSearch = @$_POST["psearch"];
$pSearchOriginal = $pSearch;
$pSearchType = @$_POST["psearchtype"];
if ($pSearch <> "")
	{
	psearchtypeset(); // 2005.10.15. New version
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = $pSearchOriginal;
	if ($pSearchType <> "")
		{
		while (strpos($pSearch, "  ") > 0)
			{
			$pSearch = str_Replace("  ", " ",$pSearch);
			}
		$arpSearch = explode(" ", trim($pSearch));
		foreach ($arpSearch as $kw)
			{
			$b_search .= "(";
			$b_search .= "`description` LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "`description` LIKE '%" . $pSearch . "%' OR ";
		}
	}
if (substr($b_search, -4) == " OR ")
	{
	$b_search = substr($b_search, 0, strlen($b_search)-4);
	}
if (substr($b_search, -5) == " AND ")
	{
	$b_search = substr($b_search, 0, strlen($b_search)-5);
	}

buildsearch();
savesearch();

// get clear search cmd
if (@$_GET["cmd"] <> "")
	{
	$cmd = $_GET["cmd"];
	if (strtoupper($cmd) == "RESET")
		{
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$key_m = "";
		$_SESSION[$which_system.$modul_select . "_masterkey"] = $key_m; // clear master key
		$masterdetailwhere = "";
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}

builddbwhere();

// default order
$DefaultOrder = "insert_datetime";
$DefaultOrderType = "DESC";

// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2)
	{
	$DefaultFilter = " insert_user_id=".$_SESSION[$which_system . "status_UserID"];
	$DefaultFilter .= " OR target_user_id=".$_SESSION[$which_system . "status_UserID"]."";
	}
else
	{
	$DefaultFilter = "active=1 ";
	$DefaultFilter .= " AND (insert_user_id=".$_SESSION[$which_system . "status_UserID"];
	$DefaultFilter .= " OR target_user_id=".$_SESSION[$which_system . "status_UserID"].")";

	}
checkorder();
// build SQL
$strsql = "SELECT * FROM ".$modul_select;
buildsql();
$rs = mysqli_query($GLOBALS["conn"],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));
checkstart();
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= searchbottom();
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form action='index.php?action=" . $which_php . "list.php' method='post' name='listform'>";
notLoggedTextView();
$html_page .= "<tr align='center'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"insert_user_idOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"target_user_idOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"subjectOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"is_read_datetimeOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td></td>";
$html_page .= "</tr>";
$html_page .= "<tr height=2><td></td></tr>";

// avoid starting record > total records
if ($startRec > $totalRecs)
	{
	$startRec = $totalRecs;
	}
// set the last record to display
$stopRec = $startRec + $displayRecs - 1;
$recCount = $startRec - 1;

sharefieldinit();
// move to the first record
@mysqli_data_seek($rs, $recCount);
$recActual = 0;
while (($row = @mysqli_fetch_array($rs)) && ($recCount < $stopRec))
	{
	$recCount++;	
	if ($recCount >= $startRec)
		{
		$recActual++;	
		$bgcolor = $color4; // row color
		if (($recCount % 2) <> 0)
			{ // display alternate color for rows
			$bgcolor = $color5;
			}

		// load key for record
		$key = @$row["id"];
		$x_target_user_id = @$row["target_user_id"];
		$x_subject = @$row["subject"];
		$x_is_read = @$row["is_read"];
		$x_is_read_datetime = @$row["is_read_datetime"];
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr bgcolor='".$bgcolor."'>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<span class='phpmaker'>&nbsp;";
		if (!is_null($x_insert_user_id)) 
			{
			$sqlwrk = "SELECT * FROM users";
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
				$x_email = $rowwrk["email"];
				$x_website = $rowwrk["website"];
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= "<b>".$x_insert_user_id."</b>";
		$html_page .= "</span></td>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<span class='phpmaker'>&nbsp;";
		if (!is_null($x_target_user_id)) 
			{
			$sqlwrk = "SELECT * FROM users ";
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
		$html_page .= "<b>".$x_target_user_id."</b>";
		$html_page .= "</span></td>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<span class='phpmaker'>&nbsp;";
		$html_page .= $x_subject;
		$html_page .= "</span></td>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<span class='phpmaker'>&nbsp;";
		$html_page .= "&nbsp;<i>" . FormatDateTime($x_insert_datetime,8) . "</i>";
		$html_page .= "</span></td>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<table border=0 cellspacing='0' cellpadding='0'>";
		$html_page .= "<tr>";
		$html_page .= activeTd($x_is_read,$enable["yes"],$enable["no"]);
		$html_page .= "<td>";
		$html_page .= "<span class='phpmaker'>&nbsp;";
		$html_page .= "&nbsp;<i>" . FormatDateTime($x_is_read_datetime,8) . "</i>";
		$html_page .= "</span></td>";
		$html_page .= "</tr>";
		$html_page .= "</table>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td align='right'><table cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td>";
		$html_page .= "</tr>";
		if (!empty($x_description))
			{
			$html_page .= "<tr><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "<td><span class='phpmaker'>" . textwrapper(substr(@$x_description,0,200)) . "...</span></td>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "</tr></table></td>";
			$html_page .= "</tr>";
			}

		}
	}
$html_page .= "</form>";
$html_page .= "</table></td></tr>";
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");
?>
