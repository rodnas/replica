<?php
// Modul properties
$w_prevmodul = viewModulParam($modul_select,"prevmodul");
if (isset($w_prevmodul))
	{
	$which_back = "list&modul_select=".$w_prevmodul;
	}
if (viewModul($modul_select,"back")!="")
	{
	$which_back = "list&modul_select=".viewModulParam($modul_select,"back");
	}
sharefieldinit();
if (viewModul($modul_select,"noview")==1)
	{
//	$noview = true;
	}
$nocopy = true;
if (viewModul($modul_select,"notreeview")!=1)
	{
	$noadd = true;
	}

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

// field "tree_id"
$x_tree_id = @$HTTP_GET_VARS["x_tree_id"];
$z_tree_id = @$HTTP_GET_VARS["z_tree_id"];
$z_tree_id = (get_magic_quotes_gpc()) ? stripslashes($z_tree_id) : $z_tree_id;
$arrfieldopr = explode(",", $z_tree_id);
if ($x_tree_id <> "" && count($arrfieldopr) >= 3) {
	$x_tree_id = (!get_magic_quotes_gpc()) ? addslashes($x_tree_id) : $x_tree_id;
	$a_search = $a_search . "`tree_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_tree_id . $arrfieldopr[2] . " AND ";
}

// field "name"
$x_name = @$HTTP_GET_VARS["x_name"];
$z_name = @$HTTP_GET_VARS["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3) {
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
}

// field "endpoint"
$x_endpoint = @$HTTP_GET_VARS["x_endpoint"];
$z_endpoint = @$HTTP_GET_VARS["z_endpoint"];
$z_endpoint = (get_magic_quotes_gpc()) ? stripslashes($z_endpoint) : $z_endpoint;
$arrfieldopr = explode(",", $z_endpoint);
if ($x_endpoint <> "" && count($arrfieldopr) >= 3) {
	$x_endpoint = (!get_magic_quotes_gpc()) ? addslashes($x_endpoint) : $x_endpoint;
	$a_search = $a_search . "`endpoint` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_endpoint . $arrfieldopr[2] . " AND ";
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
			$b_search .= "tree_id LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select.".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select.".description LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "tree_id LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select.".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select.".description LIKE '%" . $pSearch . "%' OR ";
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
	$treeSQL = "SELECT * FROM ".$modul_select." WHERE id=".$x_Page;
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
		$searchwhere .= $modul_select . ".tree_id LIKE '".$x_tree_id."%'";
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
		$_SESSION[$which_system.$modul_select."_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select."_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select."_REC"] = $startRec;
	}

$pSearchOriginal = $_SESSION[$which_system.$modul_select . "pSearchOriginal"];
$x_category = @$_SESSION[$which_system.$modul_select . "x_category"];
$x_tree_page = @$_SESSION[$which_system.$modul_select . "x_tree_page"];

builddbwhere();
// default order
$DefaultOrder = "modify_datetime";
$DefaultOrderType = "DESC";
// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "";
	}
else
	{
	$DefaultFilter = $modul_select.".active=1";
	}

checkorder();
// build SQL
$strsql = "SELECT ".$modul_select.".* FROM ".$modul_select;
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] != 2 &&
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] != 3)
	{
	$strsql .= ",".$modul[$modul_select]["itemtable"];
	$GroupBy = $modul_select.".id";
	}
buildsql();
$rs = mysqli_query($GLOBALS['conn'],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));

checkstart();
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<input type='hidden' name='a' value=''>";

if (viewModul($modul_select,"notreeview")!=1)
	{
	$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
	$html_page .= "<tr align='left'><td>";
	$treecountSQL = "SELECT COUNT(*) AS treecounter";
	$treecountSQL .= " FROM ".$modul[$modul_select]["itemtable"];
	$treecountSQL .= " LEFT JOIN ".$modul_select . " ON " . $modul[$modul_select]["itemtable"].".".$modul[$modul_select]["codefield"]."=".$modul_select.".id";
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$treecountSQL .= " WHERE ".$modul_select.".tree_id LIKE " ;
		}
	else
		{
		$treecountSQL .= " WHERE " . $modul_select . ".active=1 AND ".$modul_select.".tree_id LIKE ";
		}
	$Page = $x_tree_page;
	$treeAdmin = true;
	$treeTable = $modul_select;
	$html_page .= MakeTree($Page,$name,$treeTable,$treecountSQL,$treeAdmin);
	}

$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";
notLoggedTextView();
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$insertTimeSort = viewModul($modul_select,"insert_datetimeOrderHead");
if (!empty($insertTimeSort))
	{
	$html_page .= "<td align='center'>";
	$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
	$html_page .= "</td>";
	}
$modifyTimeSort = viewModul($modul_select,"modify_datetimeOrderHead");
if (!empty($modifyTimeSort))
	{
	$html_page .= "<td align='center'>";
	$html_page .= orderchange($modul_select,"modify_datetimeOrderHead");
	$html_page .= "</td>";
	}
if (viewModulParam($modul_select,"topic_countTitle")!=NULL)
	{
	$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"topic_countTitle")."</span></td>";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td>&nbsp;</td>";
//$html_page .= "<td>&nbsp;</td>";
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
		$x_tree_id = @$row["tree_id"];
		$x_name = @$row["name"];
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr height='25' bgcolor='" . $bgcolor. "' align='center'>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;".$x_name . "&nbsp;</span></td>";
		if (!empty($insertTimeSort))
			{
			if (!is_null($x_insert_user_id)) 
				{
				$sqlwrk = "SELECT * FROM users";
				$sqlwrk_where = "";
				$sqlwrk_where .= "id = " . $x_insert_user_id;
				if ($sqlwrk_where <> "" ) 
					{
					$sqlwrk .= " WHERE " . $sqlwrk_where;
					}
				$rswrk = db_query($sqlwrk,$GLOBALS['conn']);
				if ($rswrk && $rowwrk = db_fetch_array($rswrk)) 
					{
					$x_insert_user_id = $rowwrk["shortname"];
					}
				db_free_result($rswrk);
				}
			$html_page .= "<td align='center'>";
			$html_page .= "<table>";
			$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;<b>".htmlspecialchars($x_insert_user_id)."</b>&nbsp;</span></td></tr>";
			$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;".FormatDateTime($x_insert_datetime,8) . "&nbsp;</span></td></tr>";
			$html_page .= "</table>";
			$html_page .= "</td>";
			}
		if (!empty($modifyTimeSort))
			{
			if (!is_null($x_modify_user_id)) 
				{
				$sqlwrk = "SELECT * FROM users";
				$sqlwrk_where = "";
				$sqlwrk_where .= "id = " . $x_modify_user_id;
				if ($sqlwrk_where <> "" ) 
					{
					$sqlwrk .= " WHERE " . $sqlwrk_where;
					}
				$rswrk = db_query($sqlwrk,$GLOBALS['conn']);
				if ($rswrk && $rowwrk = db_fetch_array($rswrk)) 
					{
					$x_modify_user_id = $rowwrk["shortname"];
					}
				db_free_result($rswrk);
				}
			if ($x_modify_user_id == "0") $x_modify_user_id = "";
			$html_page .= "<td align='center'>";
			$html_page .= "<table>";
			$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;<b>".htmlspecialchars($x_modify_user_id)."</b>&nbsp;</span></td></tr>";
			$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;".FormatDateTime($x_modify_datetime,8) . "&nbsp;</span></td></tr>";
			$html_page .= "</table>";
			$html_page .= "</td>";
			}
		if (viewModulParam($modul_select,"topic_countTitle")!="")
			{
			$x_topic_count = 0;
			$sqlwrk = "SELECT COUNT(*) AS topic_count FROM ".viewModul($modul_select,"itemtable");
			if (@$_SESSION[$which_system . "status_UserLevel"] < 3)
				{
				$sqlwrk_where = "";
				}
			else
				{
				$sqlwrk_where = " active=1 AND ";
				}
			$sqlwrk_where .= $modul[$modul_select]["codefield"]." = " . $x_id;
			if ($sqlwrk_where <> "" )
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$x_topic_count = $rowwrk["topic_count"];
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_topic_count = $rowwrk["topic_count"];
				}
			@mysqli_free_result($rswrk);
			if ($x_topic_count == 0) $x_topic_count = "";
			$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_count . "&nbsp;</span></td>";
			}
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if (viewModul($modul_select,"nextmodul")!="")
			{
			if (($ewCurSec & ewAllowView) == ewAllowView) 
				{ 
				$html_page .= "<td valign='center' align='right' ><table  border='0' cellspacing='0' cellpadding='0'><tr valign='center'>";
				$subbuttonsize = getimagesize(urldecode($image_button . 'dictionary.gif'));
				$subwidthsize = $subbuttonsize[0]+2;
				$html_page .= "<td width=" . $subwidthsize . ">";
				if ((@$row["id"] != NULL))
					{
					$html_page .= "<a href='index.php?modul_select=".viewModul($modul_select,"nextmodul")."&modul_action=list&key_m=" . urlencode($x_id) . "&cmd=reset'>";
					}
				else
					{
					$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
					}
				$html_page .= "<img src='" . $image_button . "dictionary.gif' border='0' name='view' title='".viewModulParam($modul_select,"topic_open")."'></a></td>";
				$html_page .= "</tr></table></td>";
				$html_page .= "<td width='5'>&nbsp;</td>";
				}
			}
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>";
		if (!empty($x_description) && viewModul($modul_select,"noviewdescription")!=1)
			{
			$html_page .= "<tr><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "<td><span class='phpmaker'>" . textwrapper(@$x_description) . "</span></td>";
//			$html_page .= "<td><span class='phpmaker'>" . @$x_description . "</span></td>";
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