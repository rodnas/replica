<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowedit) <> ewAllowedit) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2) 
	jumptopage($base_modul);
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
$x_id = @$_POST["x_id"];
$x_name = @$_POST["x_name"];
$x_allowview = BooleanToInt(@$_POST["x_allowview"]);
$x_allowadd = BooleanToInt(@$_POST["x_allowadd"]);
$x_allowedit = BooleanToInt(@$_POST["x_allowedit"]);
$x_allowdelete = BooleanToInt(@$_POST["x_allowdelete"]);
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
		$x_modul = @$row["modul"];
		$x_name = @$row["name"];
		$x_allowview = IntToBoolean(@$row["allowview"]);
		$x_allowadd = IntToBoolean(@$row["allowadd"]);
		$x_allowedit = IntToBoolean(@$row["allowedit"]);
		$x_allowdelete = IntToBoolean(@$row["allowdelete"]);
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		$tkey = "" . $key . "";
		// get the form values
		$x_modul = @$_POST["x_modul"];
		$x_name = @$_POST["x_name"];
		$x_allowview = BooleanToInt(@$_POST["x_allowview"]);
		$x_allowadd = BooleanToInt(@$_POST["x_allowadd"]);
		$x_allowedit = BooleanToInt(@$_POST["x_allowedit"]);
		$x_allowdelete = BooleanToInt(@$_POST["x_allowdelete"]);
		$x_ewcursec = 0;
		$x_allowadmin = 0;
		if ($x_allowadd == 1) $x_ewcursec += 1;
		if ($x_allowdelete == 1) $x_ewcursec += 2;
		if ($x_allowedit == 1) $x_ewcursec += 4;
		if ($x_allowview == 1) $x_ewcursec += 8;
		if ($x_allowadmin == 1) $x_ewcursec += 16;
		sharefrompost();
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id!=".$x_id." AND modul='" . $x_modul . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
//		$rs = mysqli_query($GLOBALS["conn"],$strsql, $GLOBALS['conn']) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_modul";
			}
		mysqli_free_result($rs);
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array
			// modul
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_modul) : $x_modul;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`modul`"] = $theValue;

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`name`"] = $theValue;

			// allowview
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowview) : $x_allowview;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowview"] = $theValue;

			// allowadd
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowadd) : $x_allowadd;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowadd"] = $theValue;

			// allowedit
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowedit) : $x_allowedit;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowedit"] = $theValue;

			// allowdelete
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowdelete) : $x_allowdelete;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowdelete"] = $theValue;

			// allowadmin
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowadmin) : $x_allowadmin;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowadmin"] = $theValue;

			// ewcursec
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ewcursec) : $x_ewcursec;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["ewcursec"] = $theValue;

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
function  EW_checkMyForm(EW_this)
	{
	if (EW_this.x_modul && !EW_hasValue(EW_this.x_modul, "TEXT" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"modulErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_modul";
                return true; 
	        }
	if (EW_this.x_name && !EW_hasValue(EW_this.x_name, "TEXT" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"nameErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_name";
                return true; 
	        }
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
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"modulTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_modul' size='90' maxlength='100' value='" . htmlspecialchars(@$x_modul) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='90' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr align='center'><td colspan='2'><table border=0 width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='" . $actcolor . "'>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"viewTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"addTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"editTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"deleteTitle")."</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr align='center' bgcolor='".$color6."'>";
$html_page .= activateTd("x_allowview");
$html_page .= activateTd("x_allowadd");
$html_page .= activateTd("x_allowedit");
$html_page .= activateTd("x_allowdelete");
$html_page .= "</tr></table></td></tr>";
include ($share_path."sharefieldinput.php");
footer("edit");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.editform.fieldfocus.value)
	{
	case "x_modul" : document.editform.x_modul.focus();
		break;
	case "x_name" : document.editform.x_name.focus();
		break;
	default : document.editform.x_modul.focus();
		break;
	}
-->
</script>
