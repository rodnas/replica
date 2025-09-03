<?php
// Modul properties
sharefieldinit();
//$noview = true;
$nocopy = true;

$x_savekey = @$_GET["savekey"];
if (!empty($x_savekey))
	{
	$w_actual_datetime = db_actual_datetime();
	$strsql = "SELECT " . viewModul($modul_select,"name") . ".*, partner.name AS partnername, store_topic.name AS storename";
	$strsql .= " FROM " . viewModul($modul_select,"name");
//	$strsql .= " LEFT JOIN ".viewModul($modul_select,"itemtable") . "_type ON " . viewModul($modul_select,"name").".type_id=".viewModul($modul_select,"itemtable")."_type.id";
	$strsql .= " LEFT JOIN partner ON " . viewModul($modul_select,"name").".partner_id=partner.id";
	$strsql .= " LEFT JOIN store_topic  ON " . viewModul($modul_select,"name").".store_id=store_topic.id";
	$strsql .= " WHERE ".viewModul($modul_select,"name").".id=" . $x_savekey;
	$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
	$row = mysqli_fetch_array($rs);
	$x_store_id = @$row["store_id"]; 
	$selectSQL = "SELECT * FROM " .viewModul($modul_select,"itemtable");
	$selectSQL .= " LEFT JOIN ".viewModul($modul_select,"name")." ON ".viewModul($modul_select,"name").".id=".viewModul($modul_select,"itemtable").".topic_id";
	$selectSQL .= " LEFT JOIN store_topic ON store_topic.id=".viewModul($modul_select,"name").".store_id";
	$selectSQL .= " WHERE topic_id= ".$x_savekey;
	$selectrs = mysqli_query($GLOBALS['conn'],$selectSQL) or die(mysqli_error());
	while ($selectrow = @mysqli_fetch_array($selectrs))
		{
		$x_id = @$selectrow["id"];
		$x_product_id = @$selectrow["product_id"];
		$x_amount = @$selectrow["amount"];
		$x_price = @$selectrow["price"];
		$x_store_id = @$selectrow["store_id"];
		$select_storeSQL = "SELECT * FROM store WHERE product_id=".$x_product_id." AND topic_id= ".$x_store_id;
		$select_storers = mysqli_query($GLOBALS['conn'],$select_storeSQL);
		$select_storers_is = intval(@mysqli_num_rows($select_storers));
		if ($modul_select == "instore_topic")
			{
			$operation_type = "+";
			}
		else if ($modul_select == "outstore_topic")
			{
			$operation_type = "-";
			}
		else if ($modul_select == "selling_topic")
			{
			$operation_type = "-";
			}
		if ($select_storers_is != 0)
			{
			$update_storeSQL = "UPDATE store SET ";
			$update_storeSQL .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
			$update_storeSQL .= "modify_datetime = ".$w_actual_datetime.",";			
			$update_storeSQL .= "amount = amount".$operation_type.$x_amount;			
			$update_storeSQL .= " WHERE product_id= ".$x_product_id." AND topic_id=".$x_store_id;
			$update_storers = mysqli_query($GLOBALS['conn'],$update_storeSQL) or die(mysqli_error());
			}
		else
			{
			$x_lang_id = @$_SESSION[$which_system . "status_UserLangID"];

			// topic_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_store_id) : $x_store_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`topic_id`"] = $theValue;

			// product_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_product_id) : $x_product_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`product_id`"] = $theValue;

			// amount
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_amount) : $x_amount;
			$theValue = ($theValue != "") ? " '" . $operation_type.$theValue . "'" : "NULL";
			$fieldList["`amount`"] = $theValue;

			if ($operation_type == "+")
				{
				// inprice
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_inprice) : $x_inprice;
				$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
				$fieldList["`inprice`"] = $theValue;
				}

			// outprice
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_outprice) : $x_outprice;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`outprice`"] = $theValue;

			$w_actual_datetime = db_actual_datetime();

			// insert_user_id
			$fieldList["insert_user_id"] = @$_SESSION[$which_system . "status_UserID"];

			// insert_datetime
			$fieldList["insert_datetime"] = $w_actual_datetime;

			sharefieldconv();			

			// insert into database
			$insert_storeSQL = "INSERT INTO store (";
			$insert_storeSQL .= implode(",", array_keys($fieldList));
			$insert_storeSQL .= ") VALUES (";
			$insert_storeSQL .= implode(",", array_values($fieldList));
			$insert_storeSQL .= ")";
			mysqli_query($GLOBALS['conn'],$insert_storeSQL) or die(mysqli_error());
			}
		}

	$update_move_topicSQL = "UPDATE " . viewModul($modul_select,"name") . " SET ";
	$update_move_topicSQL .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
	$update_move_topicSQL .= "modify_datetime = ".$w_actual_datetime.",";			
	$update_move_topicSQL .= "active = 0";			
	$update_move_topicSQL .= " WHERE id= '".$x_savekey."'";
	$update_move_topicrs = mysqli_query($GLOBALS['conn'],$update_move_topicSQL) or die(mysqli_error());
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
	$_SESSION[$which_system.viewModul($modul_select,"name") . "pSearchOriginal"] = $pSearchOriginal;
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
			$b_search .= viewModul($modul_select,"name").".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= viewModul($modul_select,"itemtable").".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "partner.name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= viewModul($modul_select,"name").".delivery_letter LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "store_topic.name LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= viewModul($modul_select,"name").".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= viewModul($modul_select,"itemtable").".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "partner.name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= viewModul($modul_select,"name").".delivery_letter LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "store_topic.name LIKE '%" . $pSearch . "%' OR ";
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
		$_SESSION[$which_system.viewModul($modul_select,"name")."_searchwhere"] = $searchwhere;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.viewModul($modul_select,"name")."_searchwhere"] = $searchwhere;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.viewModul($modul_select,"name")."_REC"] = $startRec;
	}

builddbwhere();
// default order
$DefaultOrder = "modify_datetime";
$DefaultOrderType = "DESC";

// default filter
$DefaultFilter = "";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	if ($modul_select == "selling_topic")
		{
		$DefaultFilter .= "type_id=1";
		}
	}
else
	{
	$DefaultFilter .= "active=1";
	if ($modul_select == "selling_topic")
		{
		$DefaultFilter .= " AND type_id=1";
		}
	}

checkorder();
// build SQL
$strsql = "SELECT " . viewModul($modul_select,"name") . ".*, partner.name AS partnername, store_topic.name AS storename";
$strsql .= " FROM " . viewModul($modul_select,"name");
$strsql .= " LEFT JOIN partner ON " . viewModul($modul_select,"name").".partner_id=partner.id";
$strsql .= " LEFT JOIN store_topic  ON " . viewModul($modul_select,"name").".store_id=store_topic.id";
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
$html_page .= orderchange($modul_select,"storenameOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='180' align='left'>";
$html_page .= orderchange($modul_select,"partnernameOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='180' align='left'>";
$html_page .= orderchange($modul_select,"delivery_letterOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='170' align='center'>";
$html_page .= orderchange($modul_select,"insert_datetimeOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='80' align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"topic_sumTitle")."</span></td>";
if ($modul_select == "instore_topic")
	{
	$html_page .= "<td width='90' align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"topic_shoppriceTitle")."</span></td>";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td colspan=3>&nbsp;</td>";
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
		$x_store_id = @$row["store_id"]; 
		$x_storename = @$row["storename"]; 
		$x_partner_id = @$row["partner_id"]; 
		$x_partnername = @$row["partnername"]; 
		$x_delivery_letter = @$row["delivery_letter"]; 
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr height='25' bgcolor='" . $bgcolor. "' align='center'>";
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>&nbsp;".htmlspecialchars($x_storename)."&nbsp;</span>";
		$html_page .= "</td>";
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>&nbsp;".htmlspecialchars($x_partnername)."&nbsp;</span>";
		$html_page .= "</td>";
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>&nbsp;".htmlspecialchars($x_delivery_letter)."&nbsp;</span>";
		$html_page .= "</td>";
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
		$x_topic_count = 0;
		$sqlwrk = "SELECT SUM(amount) AS topic_sum, SUM(amount*shopprice) AS topic_shopprice FROM ".viewModul($modul_select,"itemtable");
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
		$x_topic_shopprice = $rowwrk["topic_shopprice"];
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_sum = $rowwrk["topic_sum"];
			$x_topic_shopprice = $rowwrk["topic_shopprice"];
			}
		@mysqli_free_result($rswrk);
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_sum . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_shopprice . "&nbsp;</span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		$html_page .= "<td valign='center' align='right'><table border='0' cellspacing='0' cellpadding='0'><tr valign='center'>";
		$html_page .= "</table></td>";
		$html_page .= "<td width='5'>&nbsp;</td>";
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>";
		if (!empty($x_description))
			{
			$html_page .= "<tr><td colspan='10'>";
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