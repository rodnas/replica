<?php
// Module properties
$w_prevmodul = viewModul($modul_select,"prevmodul");
if (isset($w_prevmodul))
	{
	$which_back = "list&modul_select=".w_prevmodul;
	}
sharefieldinit();
$noview=viewModulParam($modul_select,"noview");
$nocopy=viewModulParam($modul_select,"nocopy");
$noedit=viewModulParam($modul_select,"noedit");
$noadd=viewModulParam($modul_select,"noadd");
$startrec=1;

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

// field "topic_id"
$x_type_id = @$_GET["x_type_id"];
$z_type_id = @$_GET["z_type_id"];
$z_type_id = (get_magic_quotes_gpc()) ? stripslashes($z_type_id) : $z_type_id;
$arrfieldopr = explode(",", $z_type_id);
if ($x_type_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_type_id = (!get_magic_quotes_gpc()) ? addslashes($x_type_id) : $x_type_id;
	$a_search = $a_search . "`type_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_type_id . $arrfieldopr[2] . " AND ";
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
			$b_search .= $modul_select.".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= str_replace("_item","_topic",$modul_select).".name LIKE '%" . trim($kw) . "%' OR ";
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
		$b_search .= str_replace("_item","_topic",$modul_select).".name LIKE '%" . $pSearch . "%' OR ";
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
	$treeSQL = "SELECT * FROM ".str_replace("_item","_topic",$modul_select)." WHERE id=".$x_Page;
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
		$searchwhere .= str_replace("_item","_topic",$modul_select).".tree_id LIKE '".$x_tree_id."%'";
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
	$DefaultFilter = str_replace("_item","_topic",$modul_select).".tree_id LIKE '%'";
	}
else
	{
	$DefaultFilter = $modul_select.".active=1 AND ".str_replace("_item","_topic",$modul_select).".tree_id LIKE '%'";
	}
checkorder();
// build SQL
$strsql = "SELECT " . $modul_select . ".*, ".str_replace("_item","_topic",$modul_select).".name AS topicname, ".str_replace("_item","_topic",$modul_select).".tree_id AS tree_id";
$strsql .= " FROM " . $modul_select;
$strsql .= " LEFT JOIN ".str_replace("_item","_topic",$modul_select)." ON " . $modul_select.".topic_id=".str_replace("_item","_topic",$modul_select).".id";
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
$html_page .= "<input type='hidden' name='x_category' value='". htmlspecialchars($x_category) . "'>";

$html_page .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr align='left'><td>";
$treecountSQL = "SELECT COUNT(*) AS treecounter";
$treecountSQL .= " FROM " .$modul_select;
$treecountSQL .= " LEFT JOIN ".str_replace("_item","_topic",$modul_select)." ON " . $modul_select.".topic_id=".str_replace("_item","_topic",$modul_select).".id";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$treecountSQL .= " WHERE ".str_replace("_item","_topic",$modul_select).".tree_id LIKE " ;
	}
else
	{
	$treecountSQL .= " WHERE " . $modul_select . ".active=1 AND ".str_replace("_item","_topic",$modul_select).".tree_id LIKE ";
	}
$Page = $x_tree_page;
$treeAdmin = false;
$treeTable = str_replace("_item","_topic",$modul_select);
$html_page .= MakeTree($Page,$name,$treeTable,$treecountSQL,$treeAdmin);
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";

$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";

notLoggedTextView();
$list_type = viewModulParam($modul_select,"list_type");
switch ($list_type)
	{
	case "gallery":
		$html_page .= listgallerytype();
		break;
	default:
		$html_page .= listnormaltype();
		break;
	}
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");

function listnormaltype()
	{
	global $bgcolor;
	global $x_id;
	global $row;
	global $x_active;
	global $x_insert_user_id;
	global $x_insert_datetime;
	global $x_is_read;

	$list_html_page .= "<tr valign='center' height='15'><td>";
	$list_html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='".$GLOBALS["color2"]."'>";
	$list_html_page .= "<td align='left'>";
	$list_html_page .= orderchange($GLOBALS["modul_select"],"nameOrderHead");
	$list_html_page .= "</td>";
	$list_html_page .= "<td align='left'>";
	$list_html_page .= orderchange($GLOBALS["modul_select"],"topicnameOrderHead");
	$list_html_page .= "</td>";
	$time_sort = viewModul($GLOBALS["modul_select"],"insert_datetimeOrderHead");
	if (!empty($time_sort))
		{
		$list_html_page .= "<td align='center'>";
		$list_html_page .= orderchange($GLOBALS["modul_select"],"insert_datetimeOrderHead");
		$list_html_page .= "</td>";
		}
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$list_html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($GLOBALS["modul_select"],"active")."</span></td>";
		}
	$is_picture = viewModul($GLOBALS["modul_select"],"pictURLTitle");
	$nextModul = viewModul($GLOBALS["modul_select"],"nextmodul");
	if (!empty($nextModul))
		{ 
		$list_html_page .= "<td align='right'><span class='phpmaker'>&nbsp;";
		$list_html_page .= viewModulParam($GLOBALS["modul_select"],"pictURLTitle");
		$list_html_page .= "</span></td>";
		}
	$list_html_page .= "<td>&nbsp;</td>";
	$list_html_page .= "</tr>";
	$list_html_page .= "<tr height=2><td></td></tr>";
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
			$x_makername = @$row["makername"];
			$x_name = @$row["name"];
			$x_topic_id = @$row["topic_id"];
			$x_comment = @$row["comment"];
			sharefromtable();
			if (!empty($x_bgcolor))
				$GLOBALS["bgcolor"]=$x_bgcolor;
			$list_html_page .= "<tr valign='center' bgcolor='" . $GLOBALS["bgcolor"]. "'>";
			$list_html_page .= "<td align='left'><table>";
			$list_html_page .= "<tr align='center'>";
			$list_html_page .= "<td align='left'>";
			$list_html_page .= "<span class='phpmaker'>" . $x_name . "&nbsp;</span>";
			$list_html_page .= "</td></tr></table></td>";
			$list_html_page .= "<td align='left'><span class='phpmaker'>&nbsp;&nbsp;" . $row["topicname"] ."&nbsp;</span></td>";
			$list_html_page .= "</td>";
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
				$list_html_page .= "<td align='center'>";
				$list_html_page .= "<table>";
				$list_html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;<b>".htmlspecialchars($x_insert_user_id)."</b>&nbsp;</span></td></tr>";
				$list_html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;".FormatDateTime($x_insert_datetime,8) . "&nbsp;</span></td></tr>";
				$list_html_page .= "</table>";
				$list_html_page .= "</td>";
				}
			$list_html_page .= activeTd($x_active,$GLOBALS["enable"]["yes"],$GLOBALS["enable"]["no"]);
			if (!empty($nextModul))
				{ 
				$x_picture_count = 0;
				$sqlwrk = "SELECT COUNT(*) AS picture_count FROM ".str_replace("_item","_picture",$GLOBALS["modul_select"]);
				if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] > 1)
					{
					$sqlwrk_where = "";
					}
				else
					{
					$sqlwrk_where = " active=1 AND ";
					}
				$sqlwrk_where .= "item_id = " . $x_id;
				if ($sqlwrk_where <> "" )
					{
					$sqlwrk .= " WHERE " . $sqlwrk_where;
					}
				$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
				if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
					{
					$x_picture_count = $rowwrk["picture_count"];
					}
				@mysqli_free_result($rswrk);
				$list_html_page .= "<td align='right'><span class='phpmaker'>";
				if ($x_picture_count <> 0)
					{
					$list_html_page .= $x_picture_count;
					}
				$list_html_page .= "</span></td>";
				}
			$list_html_page .= "<td align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
			if (!empty($nextModul) && ($x_picture_count > 0 ||
				$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
				$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3))
				{ 

				$list_html_page .= "<td width='5'></td>";
				$list_html_page .= "<td align='right'>";
				if ((@$row["id"] != NULL))
					{
					$list_html_page .= "<a href='index.php?modul_action=list&modul_select=".str_replace("_item","_picture",$GLOBALS["modul_select"])."&key_m=" . urlencode($x_id) . "&cmd=reset'>";
					}
				else
					{
					$list_html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
					}
				$list_html_page .= "<img src='" . $GLOBALS["image_button"] . "camera.gif' border='0' name='view' title='".viewModulParam($modul_select,"pictURLTitle")."'></a></td>";
				$list_html_page .= "<td width='5'></td>";
				}
			if ($_SESSION[$which_system . "status_UserLevel"] > 1)
				{
				$list_html_page .= "<td align='right'>";
				}
			else
				{
				$list_html_page .= "<td align='right' colspan=2>";
				}
			$list_html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr><td>";
			$list_html_page .= submenu();
			$list_html_page .= "</td></tr></table></td></tr>";
			$list_html_page .= "</table></td></tr>"; 
			}
		}
	$list_html_page .= "</form>";
	$list_html_page .= "</table></td></tr>";
	return $list_html_page;
	}

function listgallerytype()
	{
	global $bgcolor;
	global $x_id;
	global $row;
	global $x_active;
	global $x_insert_user_id;
	global $x_insert_datetime;
	global $x_is_read;
	global $x_pictURL;

	$list_html_page .= "<tr align='center' height='15'><td bgcolor='" . $GLOBALS["color1"] . "'>";
	$list_html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
	$list_html_page .= "<tr bgcolor='" . $GLOBALS["color6"] . "' align='center'>";
	$list_html_page .= "<td align='left'>";
	$list_html_page .= orderchange($GLOBALS["modul_select"],"nameOrderHead");
	$list_html_page .= "</td>";
	$list_html_page .= "<td align='right'>";
	$list_html_page .= orderchange($GLOBALS["modul_select"],"insert_datetimeOrderHead");
	$list_html_page .= "</td>";
	$list_html_page .= "<td></td>";
	$list_html_page .= "</tr>";
	$list_html_page .= "<tr height=2><td></td></tr>";
	$list_html_page .= "<tr><td colspan='3'>";

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
	$colCount = 0;
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
			$x_topic_id = @$row["topic_id"];
			$x_name = @$row["name"];
			$x_maker = @$row["maker"];
			$x_sender = @$row["sender"];
			$x_code = @$row["code"];
			$x_size = @$row["size"];
			$x_price = @$row["price"];
			$x_pictURL = $GLOBALS["modul_image_path"] . "/" . @$row["pictURL"];
			sharefromtable();
			if ($colCount == 0)
				{
				$list_html_page .= "<table border=0 height='100%' width='100%' cellspacing='0' cellpadding='0'>";
				$list_html_page .= "<tr align='center' valign='top'>";
				}
			$colCount++;
			$list_html_page .= "<td align='center'>";
			$list_html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr align='center'><td align='center'><span class='phpmaker'>";
			$list_html_page .= $x_name;
			$list_html_page .= "</span></td></tr>";
			$list_html_page .= "<tr align='center'><td><table>";
			$list_html_page .= "<tr align='center'>";
			$list_html_page .= "<td width='".viewModulParam($GLOBALS["modul_select"],"pictsmallwidth")."' height='".viewModulParam($GLOBALS["modul_select"],"pictsmallheight")."' align='center'>";
			if ((@$row["id"] != NULL))
				{
				$list_html_page .= "<a href='index.php?modul_action=viewfull&key=" . urlencode($x_id) . "'>";
				}
			else
				{
				$list_html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$list_html_page .= whichpictureview($x_pictURL,viewModulParam($GLOBALS["modul_select"],"viewfullTitle"));
			$list_html_page .= "</td></tr>";
			$list_html_page .= "</table></td></tr>";
			$list_html_page .= "<tr height='10'><td></td></tr>";
			$list_html_page .= "<tr align='center'><td><table>";
			$list_html_page .= "<tr>";
			$list_html_page .= "<td  bgcolor='" . $GLOBALS["actcolor"] . "'><span class='phpmaker'>".viewModul($GLOBALS["modul_select"],"sizeTitle")."</span>&nbsp;</td>";
			$list_html_page .= "<td bgcolor='" . $bgcolor . "'><span class='phpmaker'>".$x_size."</span>&nbsp;</td>";
			$list_html_page .= "</tr>";
			$list_html_page .= "<tr>";
			$list_html_page .= "<td  bgcolor='" . $GLOBALS["actcolor"] . "'><span class='phpmaker'>".viewModul($GLOBALS["modul_select"],"priceTitle")."</span>&nbsp;</td>";
			$list_html_page .= "<td bgcolor='" . $bgcolor . "'><span class='phpmaker'>".$x_price."</span>&nbsp;</td>";
			$list_html_page .= "</tr>";
			$list_html_page .= "</table></td></tr>";
			$list_html_page .= "<tr align='center'><td><table>";
			$list_html_page .= activeTr($x_active,"active",$GLOBALS["enable"]["yes"],$GLOBALS["enable"]["no"]);
			$list_html_page .= "</table></td></tr>";
			$list_html_page .= "<tr><td align='center' valign='bottom'><table valign='bottom' cellspacing='0' cellpadding='0'>";
			$list_html_page .= submenu();
			$list_html_page .= "</table></td></tr>";
			$list_html_page .= "</table></td>";
			if (($colCount > 5))
				{
				$list_html_page .= "</tr>";
				$list_html_page .= "</table>";
				$colCount = 0;
				}
			}
		}
	if ($recCount <> -1)
		{
		$list_html_page .= "</td></tr></table></td></tr>";
		}
	$list_html_page .= "</form>";
	$list_html_page .= "</table></td></tr>";
	return $list_html_page;
	}
?>
