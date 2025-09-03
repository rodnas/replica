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
			$x_name = @$row["name"]; 
			$x_email = @$row["email"]; 
			$x_website = @$row["website"]; 
			$x_moderated = @$row["moderated"]; 
			$x_automoderated = @$row["automoderated"]; 
			$x_author_from = @$row["author_from"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_id = @$_POST["x_id"];
		$x_name = @$_POST["x_name"];
		$x_email = @$_POST["x_email"];
		$x_website = @$_POST["x_website"];
		$x_moderated = @$_POST["x_moderated"];
		$x_automoderated = @$_POST["x_automoderated"];
		$x_author_from = @$_POST["x_author_from"];
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array
			$w_actual_datetime = db_actual_datetime();

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["name"] = $theValue;

			// email
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_email) : $x_email;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["email"] = $theValue;

			// website
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_website) : $x_website;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["website"] = $theValue;

			// moderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_moderated) : $x_moderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["moderated"] = $theValue;

			// automoderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_automoderated) : $x_automoderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["automoderated"] = $theValue;

			// author_from
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_author_from) : $x_author_from;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["author_from"] = $theValue;

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
	if (EW_this.x_name && !EW_hasValue(EW_this.x_name, "TEXT" )) {
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"nameErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_name";
                return true; 
	        }
	if (EW_this.x_email && !EW_hasValue(EW_this.x_email, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"emailErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_email";
                return true; 
	        }
	if (EW_this.x_email && !EW_checkemail(EW_this.x_email.value))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"emailErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_email";
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
$html_page .= "<tr height='25'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='62' maxlength='60' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='25'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"emailTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_email' size='52' maxlength='50' value='" . htmlspecialchars(@$x_email) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='25'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"websiteTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_website' size='52' maxlength='50' value='" . htmlspecialchars(@$x_website) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_name" : document.addform.x_name.focus();
		break;
	case "x_email" : document.addform.x_email.focus();
		break;
	case "x_description" : document.addform.x_description.focus();
		break;
	default : document.addform.x_name.focus();
		break;
	}
-->
</script>
