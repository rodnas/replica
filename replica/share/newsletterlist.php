<?php
// Module properties
sharefieldinit();
$nocopy = true;
//$startrec=1;

// get search criteria for advanced search
// field "id"

$x_id = @$_GET["x_id"];
$z_id = @$_GET["z_id"];
$z_id = (get_magic_quotes_gpc()) ? stripslashes($z_id) : $z_id;
$arrfieldopr = explode(",", $z_id);
if ($x_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_id = (!get_magic_quotes_gpc()) ? addslashes($x_id) : $x_id;
	$a_search = $a_search . "`id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_id . $arrfieldopr[2] . " AND ";
	}

// field "name"
$x_name = @$_GET["x_name"];
$z_name = @$_GET["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3)
	{
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
	}

// field "description"
$x_description = @$_GET["x_description"];
$z_description = @$_GET["z_description"];
$z_description = (get_magic_quotes_gpc()) ? stripslashes($z_description) : $z_description;
$arrfieldopr = explode(",", $z_description);
if ($x_description <> "" && count($arrfieldopr) >= 3)
	{
	$x_description = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
	$a_search = $a_search . "`description` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_description . $arrfieldopr[2] . " AND ";
	}

// field "lang_id"
$x_lang_id = @$_GET["x_lang_id"];
$z_lang_id = @$_GET["z_lang_id"];
$z_lang_id = (get_magic_quotes_gpc()) ? stripslashes($z_lang_id) : $z_lang_id;
$arrfieldopr = explode(",", $z_lang_id);
if ($x_lang_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_lang_id = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
	$a_search = $a_search . "`lang_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lang_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_user_id"
$x_insert_user_id = @$_GET["x_insert_user_id"];
$z_insert_user_id = @$_GET["z_insert_user_id"];
$z_insert_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_insert_user_id) : $z_insert_user_id;
$arrfieldopr = explode(",", $z_insert_user_id);
if ($x_insert_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
	$a_search = $a_search . "`insert_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_user_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_datetime"
$x_insert_datetime = @$_GET["x_insert_datetime"];
$z_insert_datetime = @$_GET["z_insert_datetime"];
$z_insert_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_insert_datetime) : $z_insert_datetime;
$arrfieldopr = explode(",", $z_insert_datetime);
if ($x_insert_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
	$a_search = $a_search . "`insert_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_datetime . $arrfieldopr[2] . " AND ";
	}

// field "modify_user_id"
$x_modify_user_id = @$_GET["x_modify_user_id"];
$z_modify_user_id = @$_GET["z_modify_user_id"];
$z_modify_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_modify_user_id) : $z_modify_user_id;
$arrfieldopr = explode(",", $z_modify_modify_id);
if ($x_modify_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$a_search = $a_search . "`modify_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_user_id . $arrfieldopr[2] . " AND ";
	}

// field "modify_datetime"
$x_modify_datetime = @$_GET["x_modify_datetime"];
$z_modify_datetime = @$_GET["z_modify_datetime"];
$z_modify_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_modify_datetime) : $z_modify_datetime;
$arrfieldopr = explode(",", $z_modify_datetime);
if ($x_modify_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
	$a_search = $a_search . "`modify_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_datetime . $arrfieldopr[2] . " AND ";
	}

// field "visitcounter"
$x_visitcounter = @$_GET["x_visitcounter"];
$z_visitcounter = @$_GET["z_visitcounter"];
$z_visitcounter = (get_magic_quotes_gpc()) ? stripslashes($z_visitcounter) : $z_visitcounter;
$arrfieldopr = explode(",", $z_visitcounter);
if ($x_visitcounter <> "" && count($arrfieldopr) >= 3)
	{
	$x_visitcounter = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
	$a_search = $a_search . "`visitcounter` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_visitcounter . $arrfieldopr[2] . " AND ";
	}

// field "lastvisit"
$x_lastvisit = @$_GET["x_lastvisit"];
$z_lastvisit = @$_GET["z_lastvisit"];
$z_lastvisit = (get_magic_quotes_gpc()) ? stripslashes($z_lastvisit) : $z_lastvisit;
$arrfieldopr = explode(",", $z_lastvisit);
if ($x_lastvisit <> "" && count($arrfieldopr) >= 3)
	{
	$x_lastvisit = (!get_magic_quotes_gpc()) ? addslashes($x_lastvisit) : $x_lastvisit;
	$a_search = $a_search . "`lastvisit` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lastvisit . $arrfieldopr[2] . " AND ";
	}
if (strlen($a_search) > 4)
	{
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
			$b_search .= $modul_select.".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select . ".description LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= $modul_select.".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select . ".description LIKE '%" . $pSearch . "%' OR ";
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
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
$pSearchOriginal = $_SESSION[$which_system.$modul_select . "pSearchOriginal"];
builddbwhere();

// default order
$DefaultOrder = "insert_datetime";
$DefaultOrderType = "DESC";

// default filter
$DefaultFilter = "";
$x_start = @$_GET["start"];
$x_pageno = @$_GET["pageno"];
$x_key = @$_GET["key"];
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
$strsql = "SELECT " . $modul_select . ".*";
$strsql .= " FROM " . $modul_select;
buildsql();
$rs = mysqli_query($GLOBALS["conn"],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));

checkstart();
$a = @$_POST["a"];
if (empty($a))
	{
	$key = @$row["id"];
	}
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";

$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";

notLoggedTextView();
$list_type = viewModulParam($modul_select,"list_type");
$html_page .= "<tr valign='center' height='15'><td>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='".$GLOBALS["color2"]."'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($GLOBALS["modul_select"],"nameOrderHead");
$html_page .= "</td>";
$time_sort = viewModul($GLOBALS["modul_select"],"insert_datetimeOrderHead");
if (!empty($time_sort))
	{
	$html_page .= "<td align='center'>";
	$html_page .= orderchange($GLOBALS["modul_select"],"insert_datetimeOrderHead");
	$html_page .= "</td>";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($GLOBALS["modul_select"],"active")."</span></td>";
	}
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height=2><td></td></tr>";
// avoid starting record > total records
if ($GLOBALS["startRec"] > $GLOBALS["totalRecs"])
	{
	$GLOBALS["startRec"] = $GLOBALS["totalRecs"];
	}

// set the last record to display
$GLOBALS["stopRec"] = $GLOBALS["startRec"] + $GLOBALS["displayRecs"] - 1;
$GLOBALS["recCount"] = $GLOBALS["startRec"] - 1;

// move to the first record
@mysqli_data_seek($GLOBALS["rs"], $GLOBALS["recCount"]);
$recActual = 0;
while (($row = @mysqli_fetch_array($GLOBALS["rs"])) && ($GLOBALS["recCount"] < $GLOBALS["stopRec"]))
	{
	$GLOBALS["recCount"]++;	
	if ($GLOBALS["recCount"] >= $GLOBALS["startRec"])
		{
		$recActual++;	
		$GLOBALS["bgcolor"] = $GLOBALS["color4"]; // row color
		if (($GLOBALS["recCount"] % 2) <> 0)
			{ // display alternate color for rows
			$GLOBALS["bgcolor"] = $GLOBALS["color5"];
			}

		// load key for record
		$key = @$row["id"];
		$x_name = @$row["name"];
		sharefromtable();
		if (!empty($GLOBALS["x_bgcolor"]))
			$GLOBALS["bgcolor"]=$x_bgcolor;
		$html_page .= "<tr valign='center' bgcolor='" . $GLOBALS["bgcolor"]. "'>";
		$html_page .= "<td align='left'><table>";
		$html_page .= "<tr align='center'>";
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>" . $x_name . "&nbsp;</span>";
		$html_page .= "</td></tr></table></td>";
		if (!empty($time_sort))
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
				$rswrk = db_query($sqlwrk,$GLOBALS["conn"]);
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
		$html_page .= activeTd($x_active,$GLOBALS["enable"]["yes"],$GLOBALS["enable"]["no"]);
		$html_page .= "<td align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if ($_SESSION[$which_system . "status_UserLevel"] > 1)
			{
			$html_page .= "<td align='right'>";
			}
		else
			{
			$html_page .= "<td align='right' colspan=2>";
			}
		$html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>"; 
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
