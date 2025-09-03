<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowadd) <> ewAllowadd) jumptopage("index.php?modul_action=" . $which_back);
// get action
$a = @$_POST["a"];
$x_errortext = @$_POST["errortext"];
$x_fieldfocus = @$_POST["fieldfocus"];
if (empty($a))
	{
	$key = @$_GET["key"];
	if ($key <> "")
		{
		$a = "C"; // copy record
		}
	else
		{
		$a = "I"; // display blank record
		}
	}
switch ($a)
	{
	case "C": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql);
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		else
			{
			$row = mysqli_fetch_array($rs);

			// get the field contents
			$x_target_user_id = @$row["target_user_id"];
			$x_subject = @$row["subject"];
			$x_is_read = @$row["is_read"];
			$x_is_read_datetime = @$row["is_read_datetime"];
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

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

			// insert into database
			$strsql = "INSERT INTO " . $modul_select . " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
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
function  EW_checkMyForm(EW_this)
	{
	if (EW_this.x_target_user_id && !EW_hasValue(EW_this.x_target_user_id, "TEXT" )) {
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"target_user_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_target_user_id";
                return true; 
	        }
	if (EW_this.x_subject && !EW_hasValue(EW_this.x_subject, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"subjectErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_subject";
                return true; 
	        }
	if (EW_this.x_description && !EW_hasValue(EW_this.x_description, "TEXTAREA" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"descriptionErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_description";
                return true; 
	        }
	document.addform.errortext.value = "";
	document.addform.fieldfocus.value = "";
	return true;
	}
// end JavaScript -->
</script>
<?php
$html_page .= "<form onSubmit=\"return EW_checkMyForm(this);\" method='post' name='addform'>";
$html_page .= "<input type='hidden' name='errortext' value='" . $x_errortext . "'>";
$html_page .= "<input type='hidden' name='fieldfocus' value='" . $x_fieldfocus . "'>";
$html_page .= "<input type='hidden' name='a' value='A'>";
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
$sqlwrk = "SELECT id, shortname FROM users WHERE id != ".$_SESSION[$which_system . "status_UserID"];
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
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_target_user_id" : document.addform.x_target_user_id.focus();
		break;
	case "x_subject" : document.addform.x_subject.focus();
		break;
	case "x_description" : document.addform.x_description.focus();
		break;
	default : document.addform.x_name.focus();
		break;
	}
-->
</script>
