<?php
// Module properties
sharefieldinit();
//$noview = true;
$nocopy = true;

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

// field "email"
$x_email = @$_GET["x_email"];
$z_email = @$_GET["z_email"];
$z_email = (get_magic_quotes_gpc()) ? stripslashes($z_email) : $z_email;
$arrfieldopr = explode(",", $z_email);
if ($x_email <> "" && count($arrfieldopr) >= 3)
	{
	$x_email = (!get_magic_quotes_gpc()) ? addslashes($x_email) : $x_email;
	$a_search = $a_search . "`email` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_email . $arrfieldopr[2] . " AND ";
	}

// field "website"
$x_website = @$_GET["x_website"];
$z_website = @$_GET["z_website"];
$z_website = (get_magic_quotes_gpc()) ? stripslashes($z_website) : $z_website;
$arrfieldopr = explode(",", $z_website);
if ($x_website <> "" && count($arrfieldopr) >= 3)
	{
	$x_website = (!get_magic_quotes_gpc()) ? addslashes($x_website) : $x_website;
	$a_search = $a_search . "`website` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_website . $arrfieldopr[2] . " AND ";
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

// field "moderated"
$x_moderated = @$_GET["x_moderated"];
$z_moderated = @$_GET["z_moderated"];
$z_moderated = (get_magic_quotes_gpc()) ? stripslashes($z_moderated) : $z_moderated;
$arrfieldopr = explode(",", $z_moderated);
if ($x_moderated <> "" && count($arrfieldopr) >= 3)
	{
	$x_moderated = (!get_magic_quotes_gpc()) ? addslashes($x_moderated) : $x_moderated;
	$a_search = $a_search . "`moderated` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_moderated . $arrfieldopr[2] . " AND ";
	}

// field "automoderated"
$x_automoderated = @$_GET["x_automoderated"];
$z_automoderated = @$_GET["z_automoderated"];
$z_automoderated = (get_magic_quotes_gpc()) ? stripslashes($z_automoderated) : $z_automoderated;
$arrfieldopr = explode(",", $z_automoderated);
if ($x_automoderated <> "" && count($arrfieldopr) >= 3)
	{
	$x_automoderated = (!get_magic_quotes_gpc()) ? addslashes($x_automoderated) : $x_automoderated;
	$a_search = $a_search . "`automoderated` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_automoderated . $arrfieldopr[2] . " AND ";
	}

// field "author_from"
$x_author_from = @$_GET["x_author_from"];
$z_author_from = @$_GET["z_author_from"];
$z_author_from = (get_magic_quotes_gpc()) ? stripslashes($z_author_from) : $z_author_from;
$arrfieldopr = explode(",", $z_author_from);
if ($x_author_from <> "" && count($arrfieldopr) >= 3)
	{
	$x_author_from = (!get_magic_quotes_gpc()) ? addslashes($x_author_from) : $x_author_from;
	$a_search = $a_search . "`author_from` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_author_from . $arrfieldopr[2] . " AND ";
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

// field "active"
$x_active = @$_GET["x_active"];
$z_active = @$_GET["z_active"];
$z_active = (get_magic_quotes_gpc()) ? stripslashes($z_active) : $z_active;
$arrfieldopr = explode(",", $z_active);
if ($x_active <> "" && count($arrfieldopr) >= 3)
	{
	$x_active = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
	$a_search = $a_search . "`active` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_active . $arrfieldopr[2] . " AND ";
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
			$b_search .= "`name` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`email` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`website` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`description` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`author_from` LIKE '%" . trim($kw) . "%' OR ";
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
		$b_search .= "`email` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`website` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`description` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`author_from` LIKE '%" . $pSearch . "%' OR ";
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
if (@$_GET["cmd"] <> "") {
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
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
builddbwhere();

// default order
$DefaultOrder = "insert_datetime";
$DefaultOrderType = "DESC";

// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "";
	}
else
	{
	$DefaultFilter = "active=1";
	}
checkorder();
// build SQL
$strsql = "SELECT * FROM " . $modul_select;
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
$html_page .= "</td>";
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form  action='" . $modul_select . "list.php' method='post' name='listform'>";
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td align='left' width='400'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
//$html_page .= "<td></td>";
$html_page .= "<td align='left' width='110'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
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
		$x_name = @$row["name"];
		$x_email = @$row["email"];
		$x_website = @$row["website"];
		$x_moderated = @$row["moderated"];
		$x_automoderated = @$row["automoderated"];
		$x_author_from = @$row["author_from"];
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr bgcolor='".$bgcolor."'>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'><tr>";
		$html_page .= "<td align='left' valign='center'>";
		$html_page .= "<span class='phpmaker'><b>&nbsp;" . $x_name . "</b></span>";
		$html_page .= "</td>";
		$buttonsize = getimagesize(urldecode($image_button . "email.gif"));
		$html_page .= "<td width='".$buttonsize[0]."' align='right' valign='center'>";
		$html_page .= "<b><span class='phpmaker'>";
		if (!is_null($x_email))
			{
			$html_page .= "<a href='mailto:" . $x_email . "'><img src='" . $image_button . "email.gif' border='0'></a>";
			}
		$html_page .= "</td>";
		$html_page .= "<td width='4'></td>";
		$buttonsize = getimagesize(urldecode($image_button . "home.gif"));
		$html_page .= "<td width='".$buttonsize[0]."' align='right' valign='center'>";
		if (!is_null($x_website))
			{
			$html_page .= "<a href='" . $x_website . "' target='blank'><img src='" . $image_button . "home.gif' border='0'></a>";
			}
		$html_page .= "</td>";
		$html_page .= "</tr>";
		$html_page .= "</table>";
		$html_page .= "</td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;<i>" . FormatDateTime($x_insert_datetime,8) . "</i></span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td align='right'><table cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
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