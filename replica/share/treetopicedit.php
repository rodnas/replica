<?php
$which_back="list";
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
$x_parent_id = @$_POST["x_parent_id"];
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
		$x_name = @$row["name"];
		$x_parent_id = @$row["parent_id"];
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		$tkey = "" . $key . "";
		// get the form values
		$x_name = @$_POST["x_name"];
		$x_parent_id = @$_POST["x_parent_id"];
		sharefrompost();
		if (!empty($x_parent_id))
			{
			$x_tree_id = "";
			$parentSQL = "SELECT * FROM " . $modul_select . " WHERE id=".$x_parent_id;
			$parentrs = mysqli_query($GLOBALS["conn"],$parentSQL);
			if ($parentrs && $parentrow = mysqli_fetch_array($parentrs))
				{
				$x_tree_id .= $parentrow["tree_id"];
				}
			$x_tree_id .= $x_id."#";
			}
		else
			{
			$x_tree_id = $x_id."#";
			}
		@mysqli_free_result($parentrs);
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select;
		$strsql .= " WHERE name='" . $x_name . "'";
		$strsql .= " AND parent_id='" . $x_parent_id . "'";
		$strsql .= " AND id!='" . $x_id . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_name";
			}
		mysqli_free_result($rs);
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// tree_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tree_id) : $x_tree_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`tree_id`"] = $theValue;

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`name`"] = $theValue;

			// parent_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_parent_id) : $x_parent_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "0";
			$fieldList["`parent_id`"] = $theValue;

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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"parent_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_parent_id))
	{
	$x_parent_id = 0;
	} // set default value
$x_parent_idList = "<select name=\"x_parent_id\"><option value=\"\">----------</option>";
$cbo_x_parent_id_js = ""; // initialise
$sqlwrk = "SELECT * FROM " . $modul_select . " WHERE id!=".$x_id;
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_parent_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_parent_id)
			{
			$x_parent_idList .= " selected";
			}
		$x_parent_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_parent_idList .= "</select>";
$html_page .= $x_parent_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "</td></tr></table></td>";
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
