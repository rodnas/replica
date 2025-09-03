<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowview) <> ewAllowview) jumptopage("index.php?modul_action=" . $which_back);
$key = @$_GET["key"];
if (empty($key))
	{
	 $key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}

// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	//display with input box
	}

switch ($a)
	{
	case "I": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT " . $modul_select . ".*, " . str_replace("_item","_maker",$modul_select) . ".name AS makername, " . str_replace("_item","_topic",$modul_select) . ".name AS topicname, " . str_replace("_item","_topic",$modul_select). ".tree_id AS tree_id, " . str_replace("_item","_size",$modul_select) . ".name AS sizename";
		$strsql .= " FROM " . $modul_select; 
		$strsql .= " LEFT JOIN ".str_replace("_item","_maker",$modul_select) . " ON " . $modul_select.".maker_id=".str_replace("_item","_maker",$modul_select).".id";
		$strsql .= " LEFT JOIN ".str_replace("_item","_topic",$modul_select) . " ON " . $modul_select.".topic_id=".str_replace("_item","_topic",$modul_select).".id";
		$strsql .= " LEFT JOIN ".str_replace("_item","_size",$modul_select) . "  ON " . $modul_select.".size_id=".str_replace("_item","_size",$modul_select).".id";
		$strsql .= " WHERE ".$modul_select . ".id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_productid = @$row["productid"];
		$x_barcode = @$row["barcode"];
		$x_maker_id = @$row["maker_id"];
		$x_makername = @$row["makername"];
		$x_size_id = @$row["size_id"];
		$x_sizename = @$row["sizename"];
		$x_name = @$row["name"];
		$x_topic_id = @$row["topic_id"];
		$x_topicname = @$row["topicname"];
		$x_priceHUF = @$row["priceHUF"];
		if (!is_null(@$row["pictURL"])) 
			$x_pictURL = $modul_image_path . "/" . @$row["pictURL"]; 
		else 
			$x_pictURL="";
		$x_novelty = @$row["novelty"];
		$x_sold = @$row["sold"];
		$x_sale = @$row["sale"];
		sharefromtable();
		mysqli_free_result($rs);
		is_reading();
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td valign='top' align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td align='left' valign='middle'>";
$html_page .=  whichpictureview($x_pictURL,"");
$html_page .= "</td>";
$html_page .= "<td valign='top' align='right'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'<span class='phpmaker'>".viewModulParam($modul_select,"productidTitle")."&nbsp;</span></td>";
$html_page .= "<td width='400' bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_productid . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"barcodeTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_barcode . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"maker_idTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>".$x_makername . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"size_idTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_sizename . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_topicname . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='20'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"priceHUFTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<font class='phpmaker'>" . $x_priceHUF . "&nbsp;HUF&nbsp;</font>";
$html_page .= "</td>";
$html_page .= "</tr>";
if ($_SESSION[$which_system."status_UserLevel"] == 2 || $_SESSION[$which_system."status_UserLevel"] == 3) 
	{
	$html_page .= activeTr($x_novelty,"novelty",$enable["yes"],$enable["no"]);
	$html_page .= activeTr($x_sale,"sale",$enable["yes"],$enable["no"]);
	$html_page .= "<tr height='20' valign='top'><td align='left' bgcolor='" . $actcolor. "'><span class='phpmaker'>".viewModulParam($modul_select,"soldTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='".$color6."'><span class='phpmaker'><b>" . $row["sold"] ." <b></span></td></tr>";
	}
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= itemstatus();
footer("view");
?>
