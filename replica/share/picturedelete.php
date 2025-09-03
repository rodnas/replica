<?php
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}
$sqlKey = "id=" . "" . $key . "";

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
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_topic_id = @$row["topic_id"];
		$x_item_id = @$row["item_id"];
		$x_name = @$row["name"];
		if ($modul_select == "gallery_picture")
			{
			$x_sender = @$row["sender"];
			$x_maker = @$row["maker"];
			}
		$x_pictURL = $modul_image_path . "/" . str_replace("_small.","_normal.",@$row["pictURL"]);
		sharefromtable();
		mysqli_free_result($rs);
		break;
	case "D": // delete
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	

		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_pictURL = @$row["pictURL"];
		if (!empty($x_pictURL))
			{
			unlink($modul_image_path . "/" . str_replace("_small.","_large.",$x_pictURL));
			unlink($modul_image_path . "/" . str_replace("_small.","_normal.",$x_pictURL));
			unlink($modul_image_path . "/" . $x_pictURL);
			}
		$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<input type='hidden' name='x_which_master' value='".$which_master."'>";
$html_page .= "<input type='hidden' name='x_modul_header' value='".$modul_header."'>";
$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td valign='top' align='left'>";
$html_page .= whichpictureview($x_pictURL,"");
$html_page .= "</td>";
$html_page .= "<td valign='top' align='right'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$strmassql = "SELECT ".str_replace("_picture","_item",$modul_select).".*,".str_replace("_picture","_topic",$modul_select).".name AS topicname FROM " . str_replace("_picture","_item",$modul_select);
$strmassql .= " LEFT JOIN ".str_replace("_picture","_topic",$modul_select)." ON " . str_replace("_picture","_topic",$modul_select).".id=".str_replace("_picture","_item",$modul_select).".topic_id";
$strmassql .= " WHERE ";	
$strmassql .= "(".str_replace("_picture","_item",$modul_select).".id = " . $x_item_id  . ")";	
$rsMas = mysqli_query($GLOBALS["conn"],$strmassql);
if (mysqli_num_rows($rsMas) > 0)
	{
	$row = mysqli_fetch_array($rsMas);
	$x_topicname = @$row["topicname"];
	$x_itemname = $row["name"];
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $row["topicname"] . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
	$html_page .= "<td width='400' bgcolor='" . $color6 . "'><span class='phpmaker'>".$x_itemname."</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
$html_page .= "</tr>";
if ($modul_select == "gallery_picture")
	{
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"makerTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_maker . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "</tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"senderTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_sender . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"pictURLTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_pictURL . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "</table></td></tr>";
$html_page .= "</table></td></tr>";
$html_page .= itemstatus();
footer("delete");
?>
