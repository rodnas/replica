<?php
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
$x_name = @$_POST["x_name"];
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
		$x_name = @$row["name"];
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		$tkey = "" . $key . "";

		// get the form values
		$x_name = @$_POST["x_name"];
		sharefrompost();
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id!=".$x_id." AND name='" . $x_name . "'";
		$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_name";
			}
		mysqli_free_result($rs);
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`name`"] = $theValue;

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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"name")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
include ($share_path."sharefieldinput.php");
footer("edit");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.editform.fieldfocus.value)
	{
	case "x_name" : document.editform.x_name.focus();
		break;
	default : document.editform.x_name.focus();
		break;
	}
-->
</script>
