<?php
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
		$strsql = "SELECT " . viewModul($modul_select,"name") . ".*, " . viewModul($modul_select,"itemtable"). "_type.name AS typename, partner.name AS partnername, store_topic.name AS storename";
		$strsql .= " FROM " . viewModul($modul_select,"name");
		$strsql .= " LEFT JOIN ".viewModul($modul_select,"itemtable") . "_type ON " . viewModul($modul_select,"name").".type_id=".viewModul($modul_select,"itemtable")."_type.id";
		$strsql .= " LEFT JOIN partner ON " . viewModul($modul_select,"name").".partner_id=partner.id";
		$strsql .= " LEFT JOIN store_topic  ON " . viewModul($modul_select,"name").".store_id=store_topic.id";
		$strsql .= " WHERE ".viewModul($modul_select,"name").".id=" . $tkey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_name = @$row["name"];
		$x_delivery_letter = @$row["delivery_letter"]; 
		$x_type_id = @$row["type_id"]; 
		$x_typename = @$row["typename"]; 
		$x_store_id = @$row["store_id"]; 
		$x_storename = @$row["storename"]; 
		$x_partner_id = @$row["partner_id"]; 
		$x_partnername = @$row["partnername"]; 
		sharefromtable();
		mysqli_free_result($rs);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr><td valign='top' align='center'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"name")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;" . $x_name . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"delivery_letter")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;" . $x_delivery_letter . "</span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"type_id")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;".$x_typename."&nbsp;</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"partner_id")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;".$x_partnername."&nbsp;</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"store_id")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;".$x_storename."&nbsp;</span></td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
footer("view");
?>
