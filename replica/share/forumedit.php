<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowedit) <> ewAllowedit) jumptopage("index.php?modul_action=" . $which_back);
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
$x_errortext = @$_POST["errortext"];
$x_fieldfocus = @$_POST["fieldfocus"];
if (empty($a))
	{
	$a = "I";	//display with input box
	}
// get fields from form
$x_topic_id = @$_POST["x_topic_id"];
$x_moderated = @$_POST["x_moderated"];
$x_automoderated = @$_POST["x_automoderated"];
sharefrompost();
switch ($a)
	{
	case "I": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (!($row = mysqli_fetch_array($rs)))
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}

		// get the field contents
		$x_topic_id = @$row["topic_id"];
		$x_quote = @$row["quote"];
		$x_moderated = @$row["moderated"];
		$x_automoderated = @$row["automoderated"];
		$x_answer_user_id = @$row["answer_user_id"];
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		$tkey = "" . $key . "";

		// get the form values
		$x_topic_id = @$_POST["x_topic_id"];
		$x_quote = @$_POST["x_quote"];
		$x_moderated = @$_POST["x_moderated"];
		$x_automoderated = @$_POST["x_automoderated"];
		$x_answer_user_id = @$_POST["x_answer_user_id"];
		$x_base_id = @$_POST["x_id"];
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array
			$w_actual_datetime = db_actual_datetime();

			// moderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_moderated) : $x_moderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["moderated"] = $theValue;

			// automoderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_automoderated) : $x_automoderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["automoderated"] = $theValue;

			// base_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_base_id) : $x_base_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["base_id"] = $theValue;

			sharefieldconv();			

			// update
			$updateSQL = "UPDATE " . $modul_select . " SET ";
			foreach ($fieldList as $key=>$temp)
				{
				$updateSQL .= "$key = $temp, ";			
				}
			if (substr($updateSQL, -2) == ", ")
				{
				$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
				}
			$updateSQL .= " WHERE id=".$tkey;
		  	$rs = mysqli_query($GLOBALS['conn'],$updateSQL) or die(mysqli_error());
			jumptopage("index.php?modul_action=" . $which_back);
			}
	}		
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<script language=\"JavaScript\" src=\"" . $share_path . "js/ew.js\"></script>";
?>
<script language="JavaScript">
<!-- start Javascript
_editor_url = "<?php echo $share_path ?>/js/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5)
	{
	document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js" language="JavaScript"></scr' + 'ipt>');
	}
else
	{
	document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>');
	}

// end JavaScript -->
</script>
<script language="JavaScript">
<!-- start Javascript
function  EW_checkMyForm(EW_this)
	{
	if (EW_this.x_topic_id && !EW_hasValue(EW_this.x_topic_id, "SELECT" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"topic_idErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_topic_id";
                return true; 
	        }
	if (EW_this.x_description && !EW_hasValue(EW_this.x_description, "TEXTAREA" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"descriptionErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_description";
                return true; 
	        }
	document.editform.errortext.value = "";
	document.editform.fieldfocus.value = "";
	return true;
	}

// end JavaScript -->
</script>
<?php
$html_page .= "<form onSubmit=\"return EW_checkMyForm(this);\" method='post' name='editform'>";
$html_page .= "<input type='hidden' name='errortext' value='" . $x_errortext . "'>";
$html_page .= "<input type='hidden' name='fieldfocus' value='" . $x_fieldfocus . "'>";
$html_page .= "<input type='hidden' name='a' value='U'>";
$html_page .= "<input type='hidden' name='key' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<input type='hidden' name='x_id' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<input type='hidden' name='x_topic_id' value='" . $x_topic_id . "'>";
$html_page .= "<input type='hidden' name='x_quote' value='" . $x_quote . "'>";
$html_page .= "<input type='hidden' name='x_answer_user_id' value='" . $x_answer_user_id . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr align='center'>";
$html_page .= "<td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
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
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span>&nbsp;</td>";
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
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"quoteTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='".$color6."'>";
	$html_page .= "<table border=0 width='100%' cellspacing='1' cellpadding='2'>";
	$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
	$html_page .= "<td width='10'></td>";
	$html_page .= "<td align='left' style='border-style:groove;border-color:#000000;border-width:thin'>";
	$html_page .= "<span class='phpmaker'><i>".viewModulParam($modul_select,"quoteTitle").":</i><b>&nbsp;".$x_answer_user_id."</b><br><br>" . htmlspecialchars(@$x_quote) . "</span></td>";
	$html_page .= "<td width='10'></td>";
	$html_page .= "</tr></table></td>";
	$html_page .= "</tr>";
	}
include ($share_path."sharefieldinput.php");
footer("edit");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch(document.editform.fieldfocus.value)
	{
	case "x_description" : document.editform.x_description.focus();
		break;
	default : document.editform.x_topic_id.focus();
		break;
	}
-->
</script>
