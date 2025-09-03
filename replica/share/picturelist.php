<?php
// Module properties
$which_back = "list&modul_select=".str_replace("_picture","_item",$modul_select);
//."&cmd=reset";
sharefieldinit();
$nocopy = true;

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
	$masterdetailwhere = "`item_id` = " . $key_m  . "";
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

// field "topic_id"
$x_topic_id = @$_GET["x_topic_id"];
$z_topic_id = @$_GET["z_topic_id"];
$z_topic_id = (get_magic_quotes_gpc()) ? stripslashes($z_topic_id) : $z_topic_id;
$arrfieldopr = explode(",", $z_topic_id);
if ($x_topic_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_topic_id = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
	$a_search = $a_search . "`topic_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_topic_id . $arrfieldopr[2] . " AND ";
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

if ($modul_select == "gallery_picture")
	{
	// field "maker"
	$x_maker = @$_GET["x_maker"];
	$z_maker = @$_GET["z_maker"];
	$z_maker = (get_magic_quotes_gpc()) ? stripslashes($z_maker) : $z_maker;
	$arrfieldopr = explode(",", $z_maker);
	if ($x_maker <> "" && count($arrfieldopr) >= 3)
		{
		$x_maker = (!get_magic_quotes_gpc()) ? addslashes($x_maker) : $x_maker;
		$a_search = $a_search . "`maker` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_maker . $arrfieldopr[2] . " AND ";
		}

	// field "sender"
	$x_sender = @$_GET["x_sender"];
	$z_sender = @$_GET["z_sender"];
	$z_sender = (get_magic_quotes_gpc()) ? stripslashes($z_sender) : $z_sender;
	$arrfieldopr = explode(",", $z_sender);
	if ($x_sender <> "" && count($arrfieldopr) >= 3)
		{
		$x_sender = (!get_magic_quotes_gpc()) ? addslashes($x_sender) : $x_sender;
		$a_search = $a_search . "`sender` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_sender . $arrfieldopr[2] . " AND ";
		}
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

// field "pictURL"
$x_pictURL = @$_GET["x_pictURL"];
$z_pictURL = @$_GET["z_pictURL"];
$z_pictURL = (get_magic_quotes_gpc()) ? stripslashes($z_pictURL) : $z_pictURL;
$arrfieldopr = explode(",", $z_pictURL);
if ($x_pictURL <> "" && count($arrfieldopr) >= 3)
	{
	$x_pictURL = (!get_magic_quotes_gpc()) ? addslashes($x_pictURL) : $x_pictURL;
	$a_search = $a_search . "`pictURL` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_pictURL . $arrfieldopr[2] . " AND ";
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
			$b_search .= "`description` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`name` LIKE '%" . trim($kw) . "%' OR ";
			if ($modul_select == "gallery_picture")
				{
				$b_search .= "`maker` LIKE '%" . trim($kw) . "%' OR ";
				$b_search .= "`sender` LIKE '%" . trim($kw) . "%' OR ";
				}
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
		$b_search .= "`name` LIKE '%" . $pSearch . "%' OR ";
		if ($modul_select == "gallery_picture")
			{
			$b_search .= "`maker` LIKE '%" . $pSearch . "%' OR ";
			$b_search .= "`sender` LIKE '%" . $pSearch . "%' OR ";
			}
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
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";
notLoggedTextView();
if ($key_m <> "")
	{
	$strmassql = "SELECT ".str_replace("_picture","_item",$modul_select).".*,".str_replace("_picture","_topic",$modul_select).".name AS topicname FROM " . str_replace("_picture","_item",$modul_select);
	$strmassql .= " LEFT JOIN ".str_replace("_picture","_topic",$modul_select)." ON " . str_replace("_picture","_topic",$modul_select).".id=".str_replace("_picture","_item",$modul_select).".topic_id";
	$strmassql .= " WHERE ";	
	$strmassql .= "(".str_replace("_picture","_item",$modul_select).".id = " . $key_m  . ")";	
	$rsMas = mysqli_query($GLOBALS["conn"],$strmassql);
	if (mysqli_num_rows($rsMas) > 0)
		{
		$row = mysqli_fetch_array($rsMas);
		$key = @$row["id"];
		$x_id = @$row["id"];
		$x_topicname = @$row["topicname"];
		$x_tree_id = @$row["tree_id"];
		$x_name = @$row["name"];
		$x_active = @$row["active"];
		$x_topic_active = @$row["active"];
		if (!$x_topic_active)
			{
			$noadd = true;
			$noedit = true;
			$nodelete = true;
			}
		$x_lang_id = @$row["lang_id"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$x_description = @$row["description"];
		$html_page .= "<tr align='center'><td bgcolor='" . $color1 . "'>";
		$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
		$html_page .= "<tr height='25' bgcolor='#CCCCCC'>";
		$html_page .= "<td align='left'><span class='header'>&nbsp;<b>" . $x_topicname . "</b>&nbsp;</span></td>";
		$html_page .= "<td align='right'></td>";
		$html_page .= "</tr>";
		$html_page .= "<tr height='25' bgcolor='#CCCCCC'>";
		$html_page .= "<td align='left'><span class='header'>&nbsp;&nbsp;<b>" . $x_name . "</b>&nbsp;</span></td>";
		$html_page .= "<td align='right'></td>";
		$html_page .= "</tr>";
		$html_page .= "</table></td>";
		$html_page .= "</tr>";  
		if (!empty($x_description))
			{
			$html_page .= "<tr bgcolor='#CCCCCC'><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "<td><span class='phpmaker'>" . @$x_description . "</span></td>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "</tr></table></td>";
			$html_page .= "</tr>";
			}
		}
	}
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color6 . "' align='center'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='right'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td></td>";
$html_page .= "</tr>";
$html_page .= "<tr height=2><td></td></tr>";
$html_page .= "<tr><td colspan='3'>";

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
$colCount = 0;
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
		$x_topic_id = @$row["topic_id"];
		$x_name = @$row["name"];
		$x_maker = @$row["maker"];
		$x_sender = @$row["sender"];
		$x_pictURL = $modul_image_path . "/" . @$row["pictURL"];
		sharefromtable();
		if ($colCount == 0)
			{
			$html_page .= "<table border=0 height='100%' width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr align='center' valign='top'>";
			}
		$colCount++;
		$html_page .= "<td align='center'>";
		$html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr align='center'><td align='center'><span class='phpmaker'>";
		$html_page .= $x_name;
		$html_page .= "</td></tr>";
		$html_page .= "<tr align='center'><td><table>";
		$html_page .= "<tr align='center'>";
		$html_page .= "<td width='".viewModulParam($modul_select,"pictsmallwidth")."' height='".viewModulParam($modul_select,"pictsmallheight")."' align='center' >";
		if ((@$row["id"] != NULL))
			{
			$html_page .= "<a href='index.php?modul_action=viewfull&key=" . urlencode($x_id) . "'>";
			}
		else
			{
			$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
			}
		$html_page .= whichpictureview($x_pictURL,viewModulParam($modul_select,"viewfullTitle"));
		$html_page .= "</span></td></tr>";
		$html_page .= "</table></td></tr>";
		if ($modul_select == "gallery_picture")
			{
			$html_page .= "<tr height='10'><td></td></tr>";
			$html_page .= "<tr align='center'>";
			$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModul($modul_select,"makerTitle")."</span>&nbsp;</td>";
			$html_page .= "</tr>";
			$html_page .= "<tr align='center'>";
			$html_page .= "<td bgcolor='" . $bgcolor . "'><span class='phpmaker'>".$x_maker."</span>&nbsp;</td>";
			$html_page .= "</tr>";
			}
		$html_page .= "<tr align='center'><td><table>";
		$html_page .= activeTr($x_active,"active",$enable["yes"],$enable["no"]);
		$html_page .= "</table></td></tr>";
		$html_page .= "<tr><td align='center' valign='bottom'><table valign='bottom' cellspacing='0' cellpadding='0'>";
		$html_page .= submenu();
		$html_page .= "</table></td></tr>";
		$html_page .= "</table></td>";
		if (($colCount > 5))
			{
			$html_page .= "</tr>";
			$html_page .= "</table>";
			$colCount = 0;
			}
		}
	}
if ($recCount <> -1)
	{
	$html_page .= "</td></tr></table></td></tr>";
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
