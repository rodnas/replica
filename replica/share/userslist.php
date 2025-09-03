<?php 
// Module properties
sharefieldinit();
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

// field "shortname"
$x_shortname = @$_GET["x_shortname"];
$z_shortname = @$_GET["z_shortname"];
$z_shortname = (get_magic_quotes_gpc()) ? stripslashes($z_shortname) : $z_shortname;
$arrfieldopr = explode(",", $z_shortname);
if ($x_shortname <> "" && count($arrfieldopr) >= 3)
	{
	$x_shortname = (!get_magic_quotes_gpc()) ? addslashes($x_shortname) : $x_shortname;
	$a_search = $a_search . "`shortname` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_shortname . $arrfieldopr[2] . " AND ";
	}

// field "password"
$x_password = @$_GET["x_password"];
$z_password = @$_GET["z_password"];
$z_password = (get_magic_quotes_gpc()) ? stripslashes($z_password) : $z_password;
$arrfieldopr = explode(",", $z_password);
if ($x_password <> "" && count($arrfieldopr) >= 3)
	{
	$x_password = (!get_magic_quotes_gpc()) ? addslashes($x_password) : $x_password;
	$a_search = $a_search . "`password` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_password . $arrfieldopr[2] . " AND ";
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

// field "group_id"
$x_group_id = @$_GET["x_group_id"];
$z_group_id = @$_GET["z_group_id"];
$z_group_id = (get_magic_quotes_gpc()) ? stripslashes($z_group_id) : $z_group_id;
$arrfieldopr = explode(",", $z_group_id);
if ($x_group_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_group_id = (!get_magic_quotes_gpc()) ? addslashes($x_group_id) : $x_group_id;
	$a_search = $a_search . "`group_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_group_id . $arrfieldopr[2] . " AND ";
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
			$b_search .= "`shortname` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`password` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`email` LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "`shortname` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`password` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`email` LIKE '%" . $pSearch . "%' OR ";
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
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}

builddbwhere();
// default order
$DefaultOrder = "";
$DefaultOrderType = "";

// default filter
//$DefaultFilter = "(id = " . @$_SESSION[$which_system . "status_UserID"] . " OR group_id > " . @$_SESSION[$which_system . "status_UserLevel"] . ")";
$DefaultFilter = "";
// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2)
	{
	$DefaultFilter = "";
	}
else if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "group_id=1 OR group_id > 2";
	}
else
	{
	$DefaultFilter = "active=1 AND (group_id=1 OR group_id > 2)";
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
$html_page .= "<form method='post' name='listform'>";
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 ."'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr align='center' bgcolor='" . $color6 . "'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"shortnameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"emailOrderHead");
$html_page .= "</td>";
if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
	@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
	{
	$html_page .= "<td align='left'>";
	$html_page .= orderchange($modul_select,"group_idOrderHead");
	$html_page .= "</td>";
	}
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"lang_idOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height=2><td></td></tr>";

// avoid starting record > total records
if ($startRec > $totalRecs)
	{
	$startRec = $totalRecs;
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 1 OR
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] > 3)
	{
	$noadd = true;
	$nodelete = true;
	$noedit = true;
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
		$x_shortname = @$row["shortname"];
		$x_password = @$row["password"];
		$x_email = @$row["email"];
		$x_group_id = @$row["group_id"];
		$x_lang_id = @$row["lang_id"];
		$x_visitcounter = @$row["visitcounter"];
		$x_lastvisit = @$row["lastvisit"];
		$x_active = @$row["active"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
		if (isset($is_newitemcount) &&
			(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
			@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3))
			{
			$GLOBALS["x_is_read"] = @$GLOBALS["row"]["is_read"]; 
			}
		$html_page .= "<tr align='left' bgcolor='" . $bgcolor. "'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_shortname . "</span></td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_email . "</span></td>";
		if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
			@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3)
			{
			$html_page .= "<td><span class='phpmaker'>&nbsp;";
			if ($x_group_id != NULL)
				{
				$sqlwrk = "SELECT id, name FROM groups";
				$sqlwrk_where = "";
				$sqlwrk_where .= "id = " . $x_group_id;
				if ($sqlwrk_where <> "" )
					{
					$sqlwrk .= " WHERE " . $sqlwrk_where;
					}
				$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
				if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
					{
					$x_group_id = $rowwrk["name"];
					}
				@mysqli_free_result($rswrk);
				}
			$html_page .= $x_group_id;
			$html_page .= "</span></td>";
			}
		$html_page .= "<td><span class='phpmaker'>&nbsp;";
		if (!is_null($x_lang_id)) 
			{
			$sqlwrk = "SELECT `id`, `name`, `pictURL`  FROM `language`";
			$sqlwrk_where = "";
			$sqlwrk_where .= "`id` = " . $x_lang_id;
			if ($sqlwrk_where <> "" ) 
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				$x_lang_id = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}
		if (!is_null($rowwrk["pictURL"])) 
			{ 
			$html_page .= "<img src='" . $rowwrk["pictURL"] . "' border='0'>";
			} 
		else 
			{
			$html_page .= $rowwrk["name"];
			}
		$html_page .= "</span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
			{
			if ((actual_permission("users_permissions") & ewAllowview) == ewAllowview)
				{ 
				$html_page .= "<td valign='center' align='right' ><table  border='0' cellspacing='1' cellpadding='2'><tr valign='center'>";
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
			}
		$html_page .= "<td width='5'>&nbsp;</td>";
//		$html_page .= "</td><td><table>";
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>"; 
		$html_page .= "</table></td></tr>";
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