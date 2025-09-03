<?php
$which_back="list";
sharefieldinit();
if (($ewCurSec & ewAllowadd) <> ewAllowadd) jumptopage("index.php?modul_action=" . $which_back);
// get action
$a = @$_POST["a"];
$x_errortext = @$_POST["errortext"];
$x_fieldfocus = @$_POST["fieldfocus"];
$x_parent_id =  @$_GET["parent_id"];
if (empty($x_parent_id)) $x_parent_id =  @$_POST["parent_id"];
if (empty($x_parent_id)) $x_parent_id =  '0';
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
			$x_active = @$row["active"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add
		// get the form values
		$x_name = @$_POST["x_name"];
		sharefrompost();
		$x_parent_tree_id = "";
		if (!empty($x_parent_id))
			{
			$parentSQL = "SELECT * FROM " . $modul_select;
			$parentSQL .= " WHERE id=".$x_parent_id;
			$parentrs = mysqli_query($GLOBALS["conn"],$parentSQL);
			if ($parentrs && $parentrow = mysqli_fetch_array($parentrs))
				{
				$x_parent_tree_id .= $parentrow["tree_id"];
				}
			@mysqli_free_result($parentrs);
			}
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select;
		$strsql .= " WHERE name='" . $x_name . "'";
		$strsql .= " AND parent_id='" . $x_parent_id . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_tree_id";
			}
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// tree_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tree_id) : $x_tree_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["tree_id"] = $theValue;

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["name"] = $theValue;

			// parent_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_parent_id) : $x_parent_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`parent_id`"] = $theValue;

			sharefieldconv();			

			// insert into database
			$strsql = "INSERT INTO " . $modul_select . " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
			$selectSQL = "SELECT * FROM " . $modul_select;
			$selectSQL .= " WHERE name='" . $x_name."'";
			$selectSQL .= " AND parent_id=" . $x_parent_id;
			$selectSQL .= " AND insert_user_id=" . @$_SESSION[$which_system . "status_UserID"];
			$selectSQL .= " AND insert_datetime=" . $w_actual_datetime;
			$rs = mysqli_query($GLOBALS["conn"],$selectSQL) or die(mysqli_error());
			if (!($row = mysqli_fetch_array($rs)))
				{
				jumptopage("index.php?modul_action=" . $which_back);
				}
			// get the field contents
			$x_id = @$row["id"];
			$x_tree_id .= $x_parent_tree_id.$x_id."#";
			$updateSQL = "UPDATE " . $modul_select . " SET ";
			$updateSQL .= "tree_id='".$x_tree_id."'";
			$updateSQL .= " WHERE id=".$x_id;
		  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL); // or die(mysqli_error())
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
	if (EW_this.x_name && !EW_hasValue(EW_this.x_name, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"nameErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_name";
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
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<input type='hidden' name='x_parent_id' value='" . htmlspecialchars(@$x_parent_id) . "'>";
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_name" : document.addform.x_name.focus();
		break;
	default : document.addform.x_name.focus();
		break;
	}
-->
</script>
