<?php
// Module properties
sharefieldinit();
$noview = true;
$nocopy = true;
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
	jumptopage($base_modul);

// get search criteria for advanced search
// field "id"

$x_id = @$HTTP_GET_VARS["x_id"];
$z_id = @$HTTP_GET_VARS["z_id"];
$z_id = (get_magic_quotes_gpc()) ? stripslashes($z_id) : $z_id;
$arrfieldopr = explode(",", $z_id);
if ($x_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_id = (!get_magic_quotes_gpc()) ? addslashes($x_id) : $x_id;
	$a_search = $a_search . "`id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_id . $arrfieldopr[2] . " AND ";
	}

// field "name"
$x_name = @$HTTP_GET_VARS["x_name"];
$z_name = @$HTTP_GET_VARS["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3)
	{
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
	}

// field "description"
$x_description = @$HTTP_GET_VARS["x_description"];
$z_description = @$HTTP_GET_VARS["z_description"];
$z_description = (get_magic_quotes_gpc()) ? stripslashes($z_description) : $z_description;
$arrfieldopr = explode(",", $z_description);
if ($x_description <> "" && count($arrfieldopr) >= 3)
	{
	$x_description = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
	$a_search = $a_search . "`description` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_description . $arrfieldopr[2] . " AND ";
	}

// field "active"
$x_active = @$HTTP_GET_VARS["x_active"];
$z_active = @$HTTP_GET_VARS["z_active"];
$z_active = (get_magic_quotes_gpc()) ? stripslashes($z_active) : $z_active;
$arrfieldopr = explode(",", $z_active);
if ($x_active <> "" && count($arrfieldopr) >= 3)
	{
	$x_active = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
	$a_search = $a_search . "`active` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_active . $arrfieldopr[2] . " AND ";
	}

// field "lang_id"
$x_lang_id = @$HTTP_GET_VARS["x_lang_id"];
$z_lang_id = @$HTTP_GET_VARS["z_lang_id"];
$z_lang_id = (get_magic_quotes_gpc()) ? stripslashes($z_lang_id) : $z_lang_id;
$arrfieldopr = explode(",", $z_lang_id);
if ($x_lang_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_lang_id = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
	$a_search = $a_search . "`lang_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lang_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_user_id"
$x_insert_user_id = @$HTTP_GET_VARS["x_insert_user_id"];
$z_insert_user_id = @$HTTP_GET_VARS["z_insert_user_id"];
$z_insert_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_insert_user_id) : $z_insert_user_id;
$arrfieldopr = explode(",", $z_insert_user_id);
if ($x_insert_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
	$a_search = $a_search . "`insert_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_user_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_datetime"
$x_insert_datetime = @$HTTP_GET_VARS["x_insert_datetime"];
$z_insert_datetime = @$HTTP_GET_VARS["z_insert_datetime"];
$z_insert_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_insert_datetime) : $z_insert_datetime;
$arrfieldopr = explode(",", $z_insert_datetime);
if ($x_insert_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
	$a_search = $a_search . "`insert_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_datetime . $arrfieldopr[2] . " AND ";
	}

// field "modify_user_id"
$x_modify_user_id = @$HTTP_GET_VARS["x_modify_user_id"];
$z_modify_user_id = @$HTTP_GET_VARS["z_modify_user_id"];
$z_modify_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_modify_user_id) : $z_modify_user_id;
$arrfieldopr = explode(",", $z_modify_user_id);
if ($x_modify_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$a_search = $a_search . "`modify_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_user_id . $arrfieldopr[2] . " AND ";
	}

// field "modify_datetime"
$x_modify_datetime = @$HTTP_GET_VARS["x_modify_datetime"];
$z_modify_datetime = @$HTTP_GET_VARS["z_modify_datetime"];
$z_modify_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_modify_datetime) : $z_modify_datetime;
$arrfieldopr = explode(",", $z_modify_datetime);
if ($x_modify_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
	$a_search = $a_search . "`modify_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_datetime . $arrfieldopr[2] . " AND ";
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
			$b_search .= "`name` LIKE '%" . trim($kw) . "%' OR ";
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
		$b_search .= "`name` LIKE '%" . $pSearch . "%' OR ";
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
		$_SESSION[$which_system.$modul_select."_searchwhere"] = $searchwhere;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select."_searchwhere"] = $searchwhere;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select."_REC"] = $startRec;
	}

builddbwhere();

// default order
$DefaultOrder = "modify_datetime";
$DefaultOrderType = "DESC";

// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2)
	{
	$DefaultFilter = "";
	}
else if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "id=1 OR id > 2";
	}
else
	{
	$DefaultFilter = "active=1 AND (id=1 OR id > 2)";
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
$html_page .= "<form  action='index.php?action=".$which_action."list.php' method='post' name='listform'>";
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left' width='90'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left' width='130'>";
$html_page .= orderchange($modul_select,"modify_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
$html_page .= "<td>&nbsp;</td>";
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
		$x_id = @$row["id"];
		$x_name = @$row["name"];
		sharefromtable();
		$html_page .= "<tr height='25' bgcolor='" . $bgcolor. "' align='center'>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;" . $x_name . "&nbsp;</span></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;" . FormatDateTime($x_insert_datetime,9) . "&nbsp;</span></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;" . FormatDateTime($x_modify_datetime,9) . "&nbsp;</span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if ((actual_permission("groups_permissions") & ewAllowview) == ewAllowview)
			{ 
			$html_page .= "<td valign='center' align='right' ><table  border='0' cellspacing='0' cellpadding='0'><tr valign='center'>";
			$subbuttonsize = getimagesize(urldecode($image_button . 'dictionary.gif'));
			$subwidthsize = $subbuttonsize[0]+2;
			$html_page .= "<td width=" . $subwidthsize . ">";
			if ((@$row["id"] != NULL))
				{
				$html_page .= "<a href='index.php?modul_select=".$modul_select."_permissions&modul_action=list&key_m=" . urlencode($x_id) . "&cmd=reset'>";
				}
			else
				{
				$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $image_button . "dictionary.gif' border='0' name='view' title='".viewModulParam($modul_select,"permissionsTitle")."'></a></td>";
			$html_page .= "</tr></table></td>";
			}
		$html_page .= "<td width='5'>&nbsp;</td>";
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td>";
		$html_page .= "</table></td></tr>";
		if (!empty($x_description))
			{
			$html_page .= "<tr><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "<td><span class='phpmaker'>" . textwrapper(@$x_description) . "</span></td>";
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