<?php
// Module properties
$view_data = true;
$noadd = true;
$nocopy = true;

// get search criteria for advanced search
// field "id"

$x_id = @$_GET["x_id"];
$z_id = @$_GET["z_id"];
$z_id = (get_magic_quotes_gpc()) ? stripslashes($z_id) : $z_id;
$arrfieldopr = explode(",", $z_id);
if ($x_id <> "" && count($arrfieldopr) >= 3) {
	$x_id = (!get_magic_quotes_gpc()) ? addslashes($x_id) : $x_id;
	$a_search = $a_search . "`id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_id . $arrfieldopr[2] . " AND ";
}

// field "description"
$x_description = @$_GET["x_description"];
$z_description = @$_GET["z_description"];
$z_description = (get_magic_quotes_gpc()) ? stripslashes($z_description) : $z_description;
$arrfieldopr = explode(",", $z_description);
if ($x_description <> "" && count($arrfieldopr) >= 3) {
	$x_description = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
	$a_search = $a_search . "`description` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_description . $arrfieldopr[2] . " AND ";
}

// field "keep"
$x_keep = @$_GET["x_keep"];
$z_keep = @$_GET["z_keep"];
$z_keep = (get_magic_quotes_gpc()) ? stripslashes($z_keep) : $z_keep;
$arrfieldopr = explode(",", $z_keep);
if ($x_keep <> "" && count($arrfieldopr) >= 3) {
	$x_keep = (!get_magic_quotes_gpc()) ? addslashes($x_keep) : $x_keep;
	$a_search = $a_search . "`keep` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_keep . $arrfieldopr[2] . " AND ";
}

// field "total_price"
$x_total_price = @$_GET["x_total_price"];
$z_total_price = @$_GET["z_total_price"];
$z_total_price = (get_magic_quotes_gpc()) ? stripslashes($z_total_price) : $z_total_price;
$arrfieldopr = explode(",", $z_total_price);
if ($x_total_price <> "" && count($arrfieldopr) >= 3) {
	$x_total_price = (!get_magic_quotes_gpc()) ? addslashes($x_total_price) : $x_total_price;
	$a_search = $a_search . "`total_price` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_total_price . $arrfieldopr[2] . " AND ";
}

// field "lang_id"
$x_lang_id = @$_GET["x_lang_id"];
$z_lang_id = @$_GET["z_lang_id"];
$z_lang_id = (get_magic_quotes_gpc()) ? stripslashes($z_lang_id) : $z_lang_id;
$arrfieldopr = explode(",", $z_lang_id);
if ($x_lang_id <> "" && count($arrfieldopr) >= 3) {
	$x_lang_id = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
	$a_search = $a_search . "`lang_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lang_id . $arrfieldopr[2] . " AND ";
}

// field "user_id"
$x_user_id = @$_GET["x_user_id"];
$z_user_id = @$_GET["z_user_id"];
$z_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_user_id) : $z_user_id;
$arrfieldopr = explode(",", $z_user_id);
if ($x_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_user_id) : $x_user_id;
	$a_search = $a_search . "`user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_user_id . $arrfieldopr[2] . " AND ";
}

// field "record"
$x_record = @$_GET["x_record"];
$z_record = @$_GET["z_record"];
$z_record = (get_magic_quotes_gpc()) ? stripslashes($z_record) : $z_record;
$arrfieldopr = explode(",", $z_record);
if ($x_record <> "" && count($arrfieldopr) >= 3) {
	$x_record = (!get_magic_quotes_gpc()) ? addslashes($x_record) : $x_record;
	$a_search = $a_search . "`record` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_record . $arrfieldopr[2] . " AND ";
}

// field "visitcounter"
$x_visitcounter = @$_GET["x_visitcounter"];
$z_visitcounter = @$_GET["z_visitcounter"];
$z_visitcounter = (get_magic_quotes_gpc()) ? stripslashes($z_visitcounter) : $z_visitcounter;
$arrfieldopr = explode(",", $z_visitcounter);
if ($x_visitcounter <> "" && count($arrfieldopr) >= 3) {
	$x_visitcounter = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
	$a_search = $a_search . "`visitcounter` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_visitcounter . $arrfieldopr[2] . " AND ";
}

// field "lastvisit"
$x_lastvisit = @$_GET["x_lastvisit"];
$z_lastvisit = @$_GET["z_lastvisit"];
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
	$_SESSION[$which_system.$modul_select . "x_category"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
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
			$b_search .= $modul_select.".description LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select.".comment LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= $modul_select.".description LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select.".comment LIKE '%" . $pSearch . "%' OR ";
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

$x_category = @$_GET["x_category"];
if (!empty($x_category))
	{
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
	$_SESSION[$which_system.$modul_select . "x_category"] = $x_category;
	}
$x_Page = @$_GET["Page"];
if (isset($x_Page))
	{
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
	$_SESSION[$which_system.$modul_select . "x_category"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = $x_Page;
	$treeSQL = "SELECT * FROM ".$modul_select."_status WHERE id=".$x_Page;
	$treers = mysqli_query($GLOBALS["conn"],$treeSQL);
	if ($treers && $treerow = mysqli_fetch_array($treers))
		{
		$x_tree_id = $treerow["tree_id"];
		}
	else
		{
		$x_tree_id = "";
		}
	@mysqli_free_result($treers);
	$searchwhere = ""; //reset search criteria
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	if (!empty($x_tree_id))
		{
		$searchwhere .= $modul_select."_status.tree_id LIKE '".$x_tree_id."%'";
		}
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
// get clear search cmd
if (@$_GET["cmd"] <> "")
	{
	$cmd = $_GET["cmd"];
	if (strtoupper($cmd) == "RESET")
		{
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}

$pSearchOriginal = $_SESSION[$which_system.$modul_select . "pSearchOriginal"];
$x_category = @$_SESSION[$which_system.$modul_select . "x_category"];
$x_tree_page = @$_SESSION[$which_system.$modul_select . "x_tree_page"];
builddbwhere();

// default order
$DefaultOrder = "id";
$DefaultOrderType = "DESC";

// default filter
$DefaultFilter = "";
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3 &&
	@$_SESSION[$which_system . "status_UserLevel"] != 4) 
	{
	$DefaultFilter = $modul_select.".insert_user_id=" . @$_SESSION[$which_system . "status_UserID"] ." AND ";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter .= $modul_select."_status.tree_id LIKE '%'";
	}
else
	{
	$DefaultFilter .= $modul_select.".active=1 AND ".$modul_select."_status.tree_id LIKE '%'";
	}

checkorder();
// build SQL
$strsql = "SELECT * FROM `" . $modul_select . "`";
$strsql = "SELECT " . $modul_select . ".*, ".$modul_select."_status.name AS statusname, ".$modul_select."_status.tree_id AS tree_id";
$strsql .= " FROM " . $modul_select;
$strsql .= " LEFT JOIN ".$modul_select."_status ON " . $modul_select.".status_id=".$modul_select."_status.id";

buildsql();
$rs = mysqli_query($GLOBALS["conn"],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));

checkstart();
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= "<input type='hidden' name='x_category' value='". htmlspecialchars($x_category) . "'>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
	$html_page .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
	$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
	$html_page .= "<tr align='left'><td>";
	$treecountSQL = "SELECT COUNT(*) AS treecounter";
	$treecountSQL .= " FROM " .$modul_select;
	$treecountSQL .= " LEFT JOIN ".$modul_select."_status ON " . $modul_select.".status_id=".$modul_select."_status.id";
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$treecountSQL .= " WHERE ".$modul_select."_status.tree_id LIKE " ;
		}
	else
		{
		$treecountSQL .= " WHERE " . $modul_select . ".active=1 AND ".$modul_select."_status.tree_id LIKE ";
		}
	$Page = $x_tree_page;
	$treeAdmin = false;
	$treeTable = $modul_select."_status";
	$html_page .= MakeTree($Page,$name,$treeTable,$treecountSQL,$treeAdmin);
	}
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr height='25' bgcolor='" . $actcolor . "' valign='center'>";
$html_page .= "<td width='60' align='left'><span class='phpmaker'>&nbsp;&nbsp;".viewModulParam($modul_select,"idTitle")."</span></td>";
$html_page .= "<td width='60' align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"amountTitle")."</span></td>";
$html_page .= "<td width='70' align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"totalpriceTitle")."</span></td>";
$html_page .= "<td width='100' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"type_idTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"term_dateTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"status_idTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"insert_datetimeTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"usernameTitle")."</span></td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='center'><span class='phpmaker'>".viewModulParam($modul_select,"emailTitle")."</span></td>";
	}
$html_page .= "<td>&nbsp;</td>";

// avoid starting record > total records
if ($startRec > $totalRecs)
	{
	$startRec = $totalRecs;
	}

// set the last record to display
$stopRec = $startRec + $displayRecs - 1;
$recCount = $startRec - 1;

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
		$x_id = @$row["id"];
		$x_total_amount = @$row["total_amount"];
		$x_total_price = @$row["total_price"];
		$x_status_id = @$row["status_id"];
		$x_type_id = @$row["type_id"];
		$x_term_date = @$row["term_date"];
		$x_comment = @$row["comment"];
		$x_description = @$row["description"];
		$x_lang_id = @$row["lang_id"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;&nbsp;" . $x_id . "</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_total_amount . "</span>&nbsp;</td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_total_price . "</span></td>";
		$html_page .= "<td align='center'><span class='phpmaker'>";
		$x_type_name = "";
		if (!is_null($x_type_id))
			{
			$sqlwrk = "SELECT id, name FROM " . $modul_select . "_type";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_type_id;
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
			$sqlwrk = "SELECT id, name FROM " . $modul_select . "_status";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_status_id;
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
		$x_email = null;
		if (!is_null($x_insert_user_id))
			{
			$sqlwrk = "SELECT `id`, `shortname`, `surname`, `forename`, `email` FROM `users`";
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
				$x_email = $rowwrk["email"];
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= $x_user_name;
		$html_page .= "</span>&nbsp;</td>";
		if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 4)
			{
			$html_page .= "<td align='center' valign='center'>";
			if (!is_null($x_email))
				{
				$html_page .= "<a href='mailto:" . $x_email . "'><img src='" . $image_button . "email.gif' border='0'></a>";
				}
			else	
				{
				$html_page .= "&nbsp;";
				}
			$html_page .= "</td>";
			}
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if ((actual_permission("orders_item") & ewAllowview) == ewAllowview)
			{ 
			$html_page .= "<td width='60' valign='center' align='right' ><table  border='0' cellspacing='1' cellpadding='2'><tr valign='center'>";
			$subbuttonsize = getimagesize(urldecode($image_button . 'dictionary.gif'));
			$subwidthsize = $subbuttonsize[0]+2;
			$html_page .= "<td width=" . $subwidthsize . ">";
			if ((@$row["id"] != NULL))
				{
				$html_page .= "<a href='index.php?modul_select=".$modul_select."_item&modul_action=list&key_m=" . urlencode($x_id) . "&cmd=resetall'>";
				}
			else
				{
				$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $image_button . "dictionary.gif' border='0' name='view' title='".viewModulParam($modul_select,"orders_itemTitle")."'></a></td>";
			$html_page .= "</tr></table></td>";
			}
		$html_page .= "<td width='5'>&nbsp;</td>";
		$html_page .= "<td align='center'><table>";
		$html_page .= submenu();
		$html_page .= "</table></td></tr>"; 
		$html_page .= "</table></td></tr>";
		}
	}
$html_page .= "</form>";
$html_page .= "</table></td></tr>";
$html_page .= "</table>";
$html_page .= "</td>";
advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");
?>
