<?php
// Modul properties
sharefieldinit();
$noview = true;
$nocopy = true;
$nodelete = true;
$displayRecs = 15;
$recRange = 10;
$dbwhere = "";
$masterdetailwhere = "";
$searchwhere = "";
$a_search = "";
$b_search = "";
$whereClause = "";

$x_savekey = @$_GET["savekey"];
if (!empty($x_savekey))
	{
	$w_actual_datetime = db_actual_datetime();
	$deleteSTORE_topic = "DELETE FROM store_topic WHERE id='".$x_savekey."'";
  	$rs = mysqli_query($GLOBALS['conn'],$deleteSTORE_topic) or die(mysqli_error());
	$deleteSTORE = "DELETE FROM store WHERE topic_id='".$x_savekey."'";
  	$rs = mysqli_query($GLOBALS['conn'],$deleteSTORE) or die(mysqli_error());
	$createSTORE_topic = "INSERT INTO store_topic  SELECT * FROM ".$modul_select." WHERE id='".$x_savekey."'";
  	$rs = mysqli_query($GLOBALS['conn'],$createSTORE_topic) or die(mysqli_error());
	$updateSQL_topic = "UPDATE " . $modul_select . " SET ";
	$updateSQL_topic .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
	$updateSQL_topic .= "modify_datetime = ".$w_actual_datetime.",";			
	$updateSQL_topic .= "active = 0";			
	$updateSQL_topic .= " WHERE id= '".$x_savekey."'";
  	$rs = mysqli_query($GLOBALS['conn'],$updateSQL_topic) or die(mysqli_error());
	$createSTORE = "INSERT INTO store SELECT * FROM ".str_replace("_topic","",$modul_select)." WHERE topic_id='".$x_savekey."'";
  	$rs = mysqli_query($GLOBALS['conn'],$createSTORE) or die(mysqli_error());
	}
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

// field "name"
$x_name = @$_GET["x_name"];
$z_name = @$_GET["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3) {
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
}

// field "endpoint"
$x_endpoint = @$_GET["x_endpoint"];
$z_endpoint = @$_GET["z_endpoint"];
$z_endpoint = (get_magic_quotes_gpc()) ? stripslashes($z_endpoint) : $z_endpoint;
$arrfieldopr = explode(",", $z_endpoint);
if ($x_endpoint <> "" && count($arrfieldopr) >= 3) {
	$x_endpoint = (!get_magic_quotes_gpc()) ? addslashes($x_endpoint) : $x_endpoint;
	$a_search = $a_search . "`endpoint` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_endpoint . $arrfieldopr[2] . " AND ";
}

// field "active"
$x_active = @$_GET["x_active"];
$z_active = @$_GET["z_active"];
$z_active = (get_magic_quotes_gpc()) ? stripslashes($z_active) : $z_active;
$arrfieldopr = explode(",", $z_active);
if ($x_active <> "" && count($arrfieldopr) >= 3) {
	$x_active = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
	$a_search = $a_search . "`active` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_active . $arrfieldopr[2] . " AND ";
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

// field "insert_user_id"
$x_insert_user_id = @$_GET["x_insert_user_id"];
$z_insert_user_id = @$_GET["z_insert_user_id"];
$z_insert_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_insert_user_id) : $z_insert_user_id;
$arrfieldopr = explode(",", $z_insert_user_id);
if ($x_insert_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_insert_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
	$a_search = $a_search . "`insert_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_user_id . $arrfieldopr[2] . " AND ";
}

// field "insert_datetime"
$x_insert_datetime = @$_GET["x_insert_datetime"];
$z_insert_datetime = @$_GET["z_insert_datetime"];
$z_insert_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_insert_datetime) : $z_insert_datetime;
$arrfieldopr = explode(",", $z_insert_datetime);
if ($x_insert_datetime <> "" && count($arrfieldopr) >= 3) {
	$x_insert_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
	$a_search = $a_search . "`insert_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_datetime . $arrfieldopr[2] . " AND ";
}

// field "modify_user_id"
$x_modify_user_id = @$_GET["x_modify_user_id"];
$z_modify_user_id = @$_GET["z_modify_user_id"];
$z_modify_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_modify_user_id) : $z_modify_user_id;
$arrfieldopr = explode(",", $z_modify_user_id);
if ($x_modify_user_id <> "" && count($arrfieldopr) >= 3) {
	$x_modify_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$a_search = $a_search . "`modify_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_user_id . $arrfieldopr[2] . " AND ";
}

// field "modify_datetime"
$x_modify_datetime = @$_GET["x_modify_datetime"];
$z_modify_datetime = @$_GET["z_modify_datetime"];
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
$strsql = "SELECT * FROM ".$modul_select;
buildsql();
$rs = mysqli_query($GLOBALS['conn'],$strsql);
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
notLoggedTextView();
$html_page .= "<tr align='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color2 . "' align='center'>";
$html_page .= "<td width='180' align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='170' align='center'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='170' align='center'>";
$html_page .= orderchange($modul_select,"modify_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='80' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"topic_sum")."</span></td>";
$html_page .= "<td width='130' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"topic_inprice")."</span></td>";
$html_page .= "<td width='120' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"topic_outprice")."</span></td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td colspan=3>&nbsp;</td>";
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
		$x_name = @$row["name"];
		$x_price = @$row["price"];
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr height='25' bgcolor='" . $bgcolor. "' align='center'>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;";
		$html_page .= $x_name;
		$html_page .= "&nbsp;</span></td>";
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
		$html_page .= "<td align='center'>";
		$html_page .= "<table>";
		$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;<b>".htmlspecialchars($x_modify_user_id)."</b>&nbsp;</span></td></tr>";
		$html_page .= "<tr><td align='center'><span class='phpmaker'>&nbsp;".FormatDateTime($x_modify_datetime,8) . "&nbsp;</span></td></tr>";
		$html_page .= "</table>";
		$html_page .= "</td>";
		$x_topic_count = 0;
		$sqlwrk = "SELECT SUM(amount) AS topic_sum, SUM(amount*inprice) AS topic_inprice, SUM(amount*outprice) AS topic_outprice FROM ".str_replace("_topic","",$modul_select);
		if (@$_SESSION[$which_system . "status_UserLevel"] < 3)
			{
			$sqlwrk_where = "";
			}
		else
			{
			$sqlwrk_where = " active=1 AND ";
			}
		$sqlwrk_where .= "topic_id = " . $x_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$x_topic_sum = $rowwrk["topic_sum"];
		$x_topic_inprice = $rowwrk["topic_inprice"];
		$x_topic_outprice = $rowwrk["topic_outprice"];
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_sum = $rowwrk["topic_sum"];
			$x_topic_inprice = $rowwrk["topic_inprice"];
			$x_topic_outprice = $rowwrk["topic_outprice"];
			}
		@mysqli_free_result($rswrk);
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_sum . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_inprice . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_outprice . "&nbsp;</span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		$html_page .= "<td valign='center' align='right' ><table  border='0' cellspacing='0' cellpadding='0'><tr valign='center'>";
		$subbuttonsize = getimagesize(urldecode($image_button . 'dictionary.gif'));
		$subwidthsize = $subbuttonsize[0]+2;
		$html_page .= "<td width=" . $subwidthsize . ">";
		if ($x_active && ($ewCurSec & ewAllowEdit) == ewAllowEdit) 
			{ 
			if ((@$row["id"] != NULL))
				{
				$html_page .= "<a href='index.php?modul_action=list&savekey=" . urlencode($x_id) . "&cmd=reset'>";
				}
			else
				{
				$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $image_button . "save.gif' border='0' name='save' title='".viewModulParam($modul_select,"save")."'></a>";
			}
		else
			{
			$html_page .= "<img src='" . $GLOBALS["image_button"] . "nobutton.gif' border='0'>";
			}
		$html_page .= "</td></table></td>";
		if (($ewCurSec & ewAllowView) == ewAllowView) 
			{ 
			$html_page .= "<td width='5'>&nbsp;</td>";
			$html_page .= "<td valign='center' align='right' ><table  border='0' cellspacing='0' cellpadding='0'><tr valign='center'>";
			$subbuttonsize = getimagesize(urldecode($image_button . 'dictionary.gif'));
			$subwidthsize = $subbuttonsize[0]+2;
			$html_page .= "<td width=" . $subwidthsize . ">";
			if ((@$row["id"] != NULL))
				{
				$html_page .= "<a href='index.php?modul_select=".str_replace("_topic","",$modul_select)."&modul_action=list&key_m=" . urlencode($x_id) . "&cmd=reset'>";
				}
			else
				{
				$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $image_button . "dictionary.gif' border='0' name='view' title='".viewModulParam($modul_select,"topic_open")."'></a></td>";
			$html_page .= "</tr></table></td>";
			}
		$html_page .= "<td width='5'>&nbsp;</td>";
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>";
		if (!empty($x_description))
			{
			$html_page .= "<tr><td colspan='9'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$x_description = str_replace(chr(10), "", @$x_description . "");
			$x_description = str_replace("<P>", "", @$x_description . "");
			$x_description = str_replace("</P>", "<br>", @$x_description . "");
			$html_page .= "<td><span class='phpmaker'>" . str_replace(chr(10), "<br>", @$x_description . "") . "</span></td>";
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
advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");
?>