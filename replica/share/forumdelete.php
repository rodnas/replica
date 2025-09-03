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
$sqlKey = "id=" . "" . $key . "";
// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	// display
	}
$x_id = @$_POST["x_id"];;
$x_answer_user_id = @$_POST["x_answer_user_id"];
$x_answer_id = @$_POST["x_answer_id"];;
$x_base_id = @$_POST["x_base_id"];;
switch ($a)
	{
	case "I": // display
		$strsql = "SELECT * FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "D": // delete
		if ($x_id == $x_answer_id)
			{
			$strsql = "DELETE FROM " . $modul_select . "";
			$strsql .= " WHERE base_id=" . $x_id;
			$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
			}
		else
			{
			forums_deltree($modul_select,$x_id);
			$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
			$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
			}
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table width='90%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
	$bgcolor = $color4; // row color
	if ($recCount % 2 <> 0 )
		{
		$bgcolor=$color5; // alternate row color
		}
	$x_id = @$row["id"];
	$x_topic_id = @$row["topic_id"];
	$x_quote = @$row["quote"];
	$x_answer_user_id = @$row["answer_user_id"];
	$x_moderated = @$row["moderated"];
	$x_automoderated = @$row["automoderated"];
	$x_author_from = @$row["author_from"];
	$x_answer_id = @$row["answer_id"];
	$x_base_id = @$row["base_id"];
	sharefromtable();
	$html_page .= "<tr align='left' valign='top'>";
	$html_page .= "<td width='40' bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (!is_null($x_topic_id))
		{
		$sqlwrk = "SELECT id, name FROM " . $modul_select . "_topic";
		$sqlwrk_where = "";
		$sqlwrk_where .= "id = " . $x_topic_id;
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
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"insert_user_idTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	$x_shortname = "";
	$x_email = null;
	$x_website = null;
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
			$x_shortname = $rowwrk["shortname"];
			$x_email = $rowwrk["email"];
			$x_website = $rowwrk["website"];
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= $x_shortname;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "</table></td></tr>";
	$html_page .= "</table></td></tr>";
	if (!empty($x_quote))
		{
		if (!is_null($x_answer_user_id)) 
			{
			$sqlwrk = "SELECT * FROM users";
			$sqlwrk_where = "";
			$sqlwrk_where .= "id = " . $x_answer_user_id;
			if ($sqlwrk_where <> "" ) 
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = db_query($sqlwrk,$GLOBALS['conn']);
			if ($rswrk && $rowwrk = db_fetch_array($rswrk)) 
				{
				$x_answer_user_id = $rowwrk["shortname"];
				}
			db_free_result($rswrk);
			}
		$html_page .= "<tr valign='top'>";
		$html_page .= "<table border=0 width='90%' cellspacing='1' cellpadding='2'>";
		$html_page .= "<tr height='20' bgcolor='" . $actcolor . "' valign='top' align='left'>";
		$html_page .= "<td><span class='phpmaker'>".viewModulParam("forum","quoteTitle")."</span>&nbsp;</td>";
		$html_page .= "</td>";
		$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
		$html_page .= "<td align='left' style='border-style:groove;groove;border-color:#000000;border-width:thin'>";
		$html_page .= "<span class='phpmaker'><i>".viewModulParam($modul_select,"quoteTitle").":</i><b>&nbsp;".$x_answer_user_id."</b><br><br>" . htmlspecialchars(@$x_quote) . "</span></td>";
		$html_page .= "</tr></table></td>";
		$html_page .= "</tr>";
		}
	$html_page .= itemstatus();
	}
$html_page .= "<input type='hidden' name='x_id' value='" . $x_id . "'>";
$html_page .= "<input type='hidden' name='x_base_id' value='" . $x_base_id . "'>";
$html_page .= "<input type='hidden' name='x_answer_user_id' value='" . $x_answer_user_id . "'>";
$html_page .= "<input type='hidden' name='x_answer_id' value='" . $x_answer_id . "'>";
footer("delete");

function forums_deltree($which_table,$x_id)
	{
	$strsql = "SELECT * FROM " . $which_table . "";
	$strsql .= " WHERE answer_id=". $x_id;
	$rss = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
	$item_count = intval(mysqli_num_rows($rss));
	if ($item_count == 0)
		{
		ob_end_clean();
		}
	else
		{
		$count = 0;
		while (($row = mysqli_fetch_array($rss)) && ($item_count>=$count))
			{
			$x_id = @$row["id"];
			if (!empty($x_id))
				{
				forums_deltree($which_table,$x_id);
				$strsql = "DELETE FROM " . $which_table . " WHERE id=" . $x_id;
				$rsd =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
				}
			$count++;
			}
		}
	return;
	}
?>
