<?php
// Module properties
sharefieldinit();
$noview = true;
$nocopy = true;
$whose_permissions = str_replace("_permissions","",$modul_select);
$which_back = "list&modul_select=".$whose_permissions."&cmd=reset";
$whose_id = str_replace("s_permissions","",$modul_select)."_id";
$empty_table = "Nincsenek külön jogai a felhasználónak!";
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
	jumptopage($base_modul);

// get the keys for master table
if (@$_GET["key_m"] <> "")
	{
	$key_m = $_GET["key_m"]; // load from query string
	$_SESSION[$which_system.$modul_select . "_masterkey"] = $key_m; // save master key to session

	//reset start record counter (new master key)
	$startRec = 1;
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
else
	{
	$key_m = @$_SESSION[$which_system.$modul_select . "_masterkey"]; // restore master key from session
	}
if ($key_m <> "")
	{
	$masterdetailwhere = $whose_id ." = " . $key_m  . "";
	}

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

/*
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
*/
// field "name"
$x_permission_id = @$_GET["x_permission_id"];
$z_permission_id= @$_GET["z_permission_id"];
$z_permission_id = (get_magic_quotes_gpc()) ? stripslashes($z_permission_id) : $z_permission_id;
$arrfieldopr = explode(",", $z_permission_id);
if ($x_permission_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_permission_id = (!get_magic_quotes_gpc()) ? addslashes($x_permission_id) : $x_permission_id;
	$a_search = $a_search . "`permission_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_permission_id . $arrfieldopr[2] . " AND ";
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
$DefaultOrder = "";
$DefaultOrderType = "";

// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = $modul_select.".permission_id=permissions.id ";
	}
else
	{
	$DefaultFilter = $modul_select .".active=1 AND ".$modul_select.".permission_id=permissions.id ";
	}
$x_whose_id = @$_POST["x_".$whose_id];
checkorder();
// build SQL
$strsql = "SELECT ".$modul_select.".*,permissions.name FROM " . $modul_select . ",permissions ";
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
$html_page .= "<form method='post' name='listform'>";
if ($key_m <> "")
	{
	$strmassql = "SELECT * FROM ".$whose_permissions." WHERE ";	
	$strmassql .= "(id = " . $key_m  . ")";	
	$rsMas = mysqli_query($GLOBALS["conn"],$strmassql);
	}
if ($key_m <> "")
	{
	if (mysqli_num_rows($rsMas) > 0)
		{
		$row = mysqli_fetch_array($rsMas);
		$key = @$row["id"];
		$x_id = @$row["id"];
		if ($whose_permissions == "groups")
			{
			$x_name = @$row["name"];
			}
		else
			{
			$x_name = @$row["shortname"];
			}
		$x_description = @$row["description"];
		$x_active = @$row["active"];
		$x_lang_id = @$row["lang_id"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$html_page .= "<tr align='center' bgcolor='".$color1."'><td>";
		$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
		$html_page .= "<tr height='25' bgcolor='#CCCCCC'>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;<b>" . $x_name . "</b>&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'><i>" . FormatDateTime($x_insert_datetime,8) . "</i>&nbsp;</span></td>";
		$html_page .= "</tr>";
		$html_page .= "</table></td>";
		$html_page .= "</tr>";  
		if (!empty($x_description))
			{
			$html_page .= "<tr bgcolor='#CCCCCC'><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "<td><span class='phpmaker'>" . str_replace(chr(10), "<br>", @$x_description . "") . "</span></td>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "</tr></table></td>";
			$html_page .= "</tr>";
			}
		}
	}
$html_page .= "<tr align='center'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td width='300' align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"viewTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"addTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"editTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"deleteTitle")."</span></td>";
$html_page .= "<td width='10'></td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td width='60' align='center'></td>";
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
		$x_whose_id = @$row[$whose_id];
		$x_permission_id = @$row["permission_id"];
		$x_allowview = @$row["allowview"];
		$x_allowadd = @$row["allowadd"];
		$x_allowedit = @$row["allowedit"];
		$x_allowdelete = @$row["allowdelete"];
		sharefromtable();
		$html_page .= "<tr  bgcolor='" . $bgcolor . "'>";
		if (!is_null($x_permission_id)) 
			{
			$sqlwrk = "SELECT * FROM permissions ";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_permission_id;
			if ($sqlwrk_where <> "" ) 
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				$x_permission_id = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;" . $x_permission_id . "</span></td>";
		$html_page .= activeTd($x_allowview,$enable["yes"],$enable["no"]);
		$html_page .= activeTd($x_allowadd,$enable["yes"],$enable["no"]);
		$html_page .= activeTd($x_allowedit,$enable["yes"],$enable["no"]);
		$html_page .= activeTd($x_allowdelete,$enable["yes"],$enable["no"]);
		$html_page .= "<td></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td align='right'><table cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td>";
		$html_page .= "</tr>";
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