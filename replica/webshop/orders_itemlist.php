<?php
// Module properties
$which_back = "list&modul_select=orders&cmd=resetall";
$noview = true;
$noadd = true;
$nocopy = true;
$nodelete = true;

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
	$masterdetailwhere = "orders_id = " . $key_m  . "";
	}

// get search criteria for basic search
$pSearch = @$_GET["psearch"];
$pSearchOriginal = $pSearch;
$pSearchType = @$_GET["psearchtype"];
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
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
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
		$_SESSION[$which_system . "orders_item_searchwhere"] = $searchwhere;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system . "orders_item_searchwhere"] = $searchwhere;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system . "orders_item_REC"] = $startRec;
	}

builddbwhere();
// default order
$DefaultOrder = "product_id";
$DefaultOrderType = "";

// default filter
$DefaultFilter = "";
//$DefaultFilter = "orders_id=" . @$_GET["key"];

checkorder();
$OrderBy = "product_id";
// build SQL
$strsql = "SELECT * FROM " . $modul_select;
buildsql();
$rs = mysqli_query($GLOBALS["conn"],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));
$displayRecs = $totalRecs;

if ($totalRecs < 1) jumptopage("index.php?modul_action=" . $which_back);

checkstart();
include ($share_path . "header1.php");
$html_page = header2();
$html_page = "<form method='post' name='listform'>";
$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='#CCCCCC'>";
$html_page .= "<td align='center' style='border-style:groove;border-color:".$color2.";border-width:thin;'>";
$html_page .= "<span class='header'><b>";
$html_page .= viewModulParam($modul_select,"header");
$html_page .= "</b></span>&nbsp;</td>";
$html_page .= "</tr>";

if ($key_m <> "")
	{
	$strmassql = "SELECT * FROM orders WHERE ";	
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
		$x_active = @$row["active"];
		$x_lang_id = @$row["lang_id"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$html_page .= "<tr align='center' bgcolor='".$bgcolor."'><td>";
		$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
		$html_page .= "<tr bgcolor='#CCCCCC'>";
		$html_page .= "<td><span class='header'>&nbsp;";
		$x_orders_name = "";
		if (!is_null($x_insert_user_id)) 
			{
			$sqlwrk = "SELECT * FROM users ";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_insert_user_id;
			if ($sqlwrk_where <> "" ) 
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
				{
				$x_orders_name = "<b>".$rowwrk["shortname"]."</b>";
				$x_orders_name .= " (".$rowwrk["bill_surname"]." ".$rowwrk["bill_forename"].")";
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= $x_orders_name;
		$html_page .= "</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'><i>" . FormatDateTime($x_insert_datetime,8) . "</i>&nbsp;</span></td>";
		$html_page .= "</tr>";
		$html_page .= "</table></td>";
		$html_page .= "</tr>";  
		}
	}

$html_page .= "<tr valign='top'><td>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr height='25' bgcolor='" . $actcolor . "' valign='center'>";
$html_page .= "<td width='70'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"productidTitle")."&nbsp;</span></td>";
$html_page .= "<td width='100'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"maker_idTitle")."</span></td>";
$html_page .= "<td width='100'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"productnameTitle")."</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"amountTitle")."</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"itempriceTitle")."</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"totalpriceTitle")."</span></td>";
$html_page .= "<td width='80' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"insert_datetimeTitle")."</span></td>";
$html_page .= "<td width='80' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"status_idTitle")."</span></td>";
$html_page .= "<td width='50' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"activeTitle")."</span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height=5><td></td></tr>";

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
echo $html_page;
$html_page = "";
$totalCount = 0;
$totalSum = 0;
$recCount = 0;
while (($row = @mysqli_fetch_array($rs)) && ($recCount < $stopRec))
	{
	$recCount++;	
	if ($recCount >= $startRec)
		{
		$recActual++;	
		$bgcolor = $color4; // set row color
		if (($recCount % 2) <> 0)
			{ // display alternate color for rows
			$bgcolor = $color5;
			}

		// load key for record
		$key = @$row["id"];
		$x_id = @$row["id"];
		$x_product_id = @$row["product_id"];
		$x_status_id = @$row["status_id"];
		$x_amount = @$row["amount"];
		$x_price = @$row["price"];
		$x_active = @$row["active"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$totalCount += $x_amount;
		$totalSum += $x_amount * $x_price;
		$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "'>";
		if (!is_null($x_product_id))
			{
			$sqlwrk = "SELECT * FROM product_item";
			$sqlwrk .= " WHERE id = " . $x_product_id;
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_productid = $rowwrk["productid"];
				$x_maker_id = $rowwrk["maker_id"];
				$x_name = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= "<input type='hidden' name='" . $x_id . "' value='" . htmlspecialchars(@$x_id) . "'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_productid . "&nbsp;</span></td>";
		$x_make_name = "";
		if (!is_null($x_maker_id))
			{
			$sqlwrk = "SELECT * FROM product_maker";
			$sqlwrk .= " WHERE id = " . $x_maker_id;
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_maker_name = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}

		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_maker_name . "&nbsp;</span></td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_name . "</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_amount . "</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_price . "</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_price*$x_amount . "</span></td>";
		$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;" . FormatDateTime($x_insert_datetime,9) . "&nbsp;</span></td>";
		if (!is_null($x_status_id))
			{
			$sqlwrk = "SELECT id, name FROM " . $modul_select . "_status";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_status_id;
			if ($sqlwrk_where <> "" )
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_status_id = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}
		$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;" . $x_status_id . "&nbsp;</span></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		$html_page .= "<td width='5'></td>";
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>";
		}
	$html_page .= "</td>";
	}
$html_page .= "</td></tr>";
$html_page .= "<tr><td colspan='10'align='center'>";
$html_page .= "<hr size='4' width='100%' style='border-style:groove;groove;border-color:" . $actcolor . ";border-width:thin';>";
$html_page .= "</td></tr>";
$html_page .= "<tr>";
$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"totalcountTitle").":</span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td align='right'><span class='phpmaker'><b>". $totalCount . "&nbsp;</b></span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td align='right'><span class='phpmaker'><b>" . $totalSum . "&nbsp;</b></span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";
$html_page .= navigation();
$html_page .= "</form>";
$html_page .= "</table>";
footer("");
?>
<script language="JavaScript">
/*
function is_order(is_order)
	{
	return document.listform.x_status_id.value;	
	}
*/
</script>
