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
$x_target_user_id = @$_POST["x_target_user_id"];
$x_subject = @$_POST["x_subject"];
$x_is_read = @$_POST["x_is_read"];;
$x_is_read_datetime = @$_POST["x_is_read_datetime"];
sharefrompost();
switch ($a)
	{
	case "I": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (!($row = mysqli_fetch_array($rs)))
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}

		// get the field contents
		$x_target_user_id = @$row["target_user_id"];
		$x_subject = @$row["subject"];
		$x_is_read = @$row["is_read"];
		$x_is_read_datetime = @$row["is_read_datetime"];
		sharefromtable();
		mysqli_free_result($rs);
		break;
	case "U": // update
		$tkey = "" . $key . "";

		// get the form values
		$x_target_user_id = @$_POST["x_target_user_id"];
		$x_subject = @$_POST["x_subject"];
		$x_is_read = 0;
		$x_is_read_datetime = @$_POST["x_is_read_datetime"];
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// x_target_user_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes(x_target_user_id) : $x_target_user_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["target_user_id"] = $theValue;

			// subject
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_subject) : $x_subject;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["subject"] = $theValue;

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
		  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
			jumptopage("index.php?modul_action=" . $which_back);
			break;
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
	if (EW_this.x_target_user_id && !EW_hasValue(EW_this.x_target_user_id, "TEXT" )) {
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"target_user_idErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_target_user_id";
                return true; 
	        }
	if (EW_this.x_subject && !EW_hasValue(EW_this.x_subject, "TEXT" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"subjectErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_subject";
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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"target_user_idTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_target_user_id))
	{
	$x_target_user_id = 0;
	} // set default value
$x_target_user_idList = "<select name=\"x_target_user_id\"><option value=\"\">----------</option>";
$cbo_x_target_user_id_js = ""; // initialise
$sqlwrk = "SELECT id, shortname FROM users";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_target_user_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_target_user_id)
			{
			$x_target_user_idList .= " selected";
			}
		$x_target_user_idList .= ">" . $datawrk["shortname"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_target_user_idList .= "</select>";
$html_page .= $x_target_user_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr height='25'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"subjectTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_subject' size='52' maxlength='50' value='" . htmlspecialchars(@$x_subject) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
include ($share_path."sharefieldinput.php");
footer("delete");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.editform.fieldfocus.value)
	{
	case "x_target_user_id" : document.editform.x_target_user_id.focus();
		break;
	case "x_subject" : document.editform.x_subject.focus();
		break;
	case "x_description" : document.editform.x_description.focus();
		break;
	default : document.editform.x_target_user_id.focus();
		break;
	}
-->
</script>
