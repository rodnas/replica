<?php
$description_title = $modul[$modul_select]["description"];
$html_page .= "<tr valign='top'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"descriptionTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='". $color6 . "'><span class='phpmaker'><textarea name='x_description' cols='85' rows='10'>" . @$x_description . "</textarea><script language=\"JavaScript1.2\">editor_generate('x_description');</script></span>&nbsp;</td>";
$html_page .= "</tr>";
$comment_title = viewModulParam($modul_select,"commentTitle");
if (isset($comment_title))
	{
	$html_page .= "<tr valign='top'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"commentTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='". $color6 . "'><span class='phpmaker'><textarea name='x_comment' cols='85' rows='10'>" . @$x_comment . "</textarea><script language=\"JavaScript1.2\">editor_generate('x_comment');</script></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
if (@$_SESSION[$which_system . "status_UserLevel"] == 2) 
	{ // system admin 
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"itemlang")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (empty($x_lang_id))
		{
		$x_lang_id = 0;
		} // set default value
	$x_lang_idList = "<select name=\"x_lang_id\">";
	$cbo_x_lang_id_js = ""; // initialise
	$sqlwrk = "SELECT id, name FROM language";
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($rswrk))
			{
			$x_lang_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
			if ($datawrk["id"] == @$x_lang_id)
				{
				$x_lang_idList .= " selected";
				}
			$x_lang_idList .= ">" . $datawrk["name"] . "</option>";
			$rowcntwrk++;
			}
		}
	@mysqli_free_result($rswrk);
	$x_lang_idList .= "</select>";
	$html_page .= $x_lang_idList;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
else
	{
	$html_page .= "<input type='hidden' name='x_lang_id' value='" . @$_SESSION[$which_system . "status_UserLangID"] . "'>";
	}

if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	if (!empty($x_bgcolor))
		$w_bgcolor=$x_bgcolor;
	else
		$w_bgcolor=$color6;
	$html_page .= "<tr valign='top'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"bgcolor")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='".$w_bgcolor."'><span class='phpmaker'>";
	include ($share_path."colorpalette.php");
	$x_color_idList = "<select name=\"x_bgcolor\" size='5'><option value=\"\">".viewModulParam($modul_select,"itemselect")."</option>";
	$cbo_x_color_id_js = ""; // initialise
	foreach ($enableColor as $actualColor) 
		{	
		$x_color_idList .= "<option value=\"" . htmlspecialchars($actualColor) . "\"";
		if ($x_bgcolor == @$actualColor)
			{
			$x_color_idList .= " selected";
			}
		$x_color_idList .= " style='border:none;background-color:".$actualColor.";'>" . $actualColor . "</option>";
		}
	$x_color_idList .= "</select>";
	$html_page .= $x_color_idList;
	$html_page .= "</td>";
	$html_page .= "</tr>";
	}
else
	{
	$html_page .= "<input type='hidden' name='x_active' value='" . $x_active . "'>";
	}

if ($modul_action == "add")
	{
	$fieldList["active"] = 1;
	}
else if ($modul_action == "edit")
	{
	$html_page .= activateTr("x_active","active");
	}
?>
