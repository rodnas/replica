<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
// single delete record
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}
$sqlKey = $modul_select . ".id=" . "" . $key . "";

// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	// display
	}
switch ($a)
	{
	case "I": // display
		$strsql = "SELECT * FROM " . $modul_select ." WHERE " . $sqlKey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "D": // delete
		$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key ."'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
//	$bgcolor = $color4; // row color
	if ($recCount % 2 <> 0 )
		{
//		$bgcolor=$color5; // alternate row color
		}
	$x_name = @$row["name"];
	$x_topic_id = @$row["topic_id"];
	$x_comment = @$row["comment"];
	$x_pictURL = @$row["pictURL"];
	$x_code = @$row["code"];
	$x_size = @$row["size"];
	$x_price = @$row["price"];
/*
	if (!empty($x_pictURL))
		{
		$x_pictURL = $modul_image_path . "/" . str_replace("_small.","_normal.",@$row["pictURL"]);
		}
*/
	if (!empty($x_pictURL))
		{
		$x_pictURL = $modul_image_path . "/" .@$row["pictURL"];
		}
	sharefromtable();
	$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
	if (!empty($x_pictURL))
		{
		$html_page .= "<tr>";
		$html_page .= "<td valign='top' align='left'>";
		$html_page .= whichpictureview($x_pictURL,"");
		$html_page .= "</td>";
		}
	$html_page .= "<td valign='top' align='center'>";
	$html_page .= "<table width='90%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
	$html_page .= "<tr height='20'>";
	$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr height='20'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (!is_null($x_topic_id))
		{
		$sqlwrk = "SELECT id, name FROM ".str_replace("_item","_topic",$modul_select);
		$sqlwrk_where = "";
		$sqlwrk_where .= "`id` = " . $x_topic_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_id = $rowwrk["name"];
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= $x_topic_id;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr height='20'>";
	$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"codeTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_code . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr height='20'>";
	$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"sizeTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_size . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr height='20'>";
	$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"priceTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_price . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "</table></td></tr>";
	$html_page .= "</table></td></tr>";
	$html_page .= itemstatus();
	}
footer("delete");
?>
