<?php
$which_back="list";
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
		$strsql = "SELECT * FROM " . viewModul($modul_select,"name") . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS['conn'],$strsql);
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		else
			{
			$row = mysqli_fetch_array($rs);
			// get the field contents
			$x_name = @$row["name"]; 
			$x_type_id = @$row["type_id"]; 
			$x_store_id = @$row["store_id"]; 
			$x_delivery_letter = @$row["delivery_letter"]; 
			$x_partner_id = @$row["partner_id"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_name = @$_POST["x_name"];
		$x_type_id = @$_POST["x_type_id"];
		$x_store_id = @$_POST["x_store_id"];
		$x_delivery_letter = @$_POST["x_delivery_letter"]; 
		$x_partner_id = @$_POST["x_partner_id"];
		sharefrompost();
		if (!empty($x_delivery_letter))
			{
			// Duplicate controll
			$strsql = "SELECT * FROM " . viewModul($modul_select,"name");
			$strsql .= " WHERE delivery_letter='" . $x_delivery_letter . "'";
			$strsql .= " AND partner_id='" . $x_partner_id . "'";
			$rs = mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
			if (mysqli_num_rows($rs) != 0) 
				{	
				$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
				$x_fieldfocus = "x_partner_id";
				}
			}
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["name"] = $theValue;

			// type_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_type_id) : $x_type_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`type_id`"] = $theValue;

			// store_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_store_id) : $x_store_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`store_id`"] = $theValue;

			// delivery_letter
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_delivery_letter) : $x_delivery_letter;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`delivery_letter`"] = $theValue;

			// partner_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_partner_id) : $x_partner_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`partner_id`"] = $theValue;

			sharefieldconv();			

			// insert into database
			$strsql = "INSERT INTO " . viewModul($modul_select,"name"). " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
			if ($modul_select != "selling_topic")
				{
				jumptopage("index.php?modul_action=" . $which_back);
				}
			else
				{
				$strsql = "SELECT * FROM " . viewModul($modul_select,"name");
				$strsql .= " WHERE insert_user_id=" . @$_SESSION[$which_system . "status_UserID"];
				$strsql .= " AND insert_datetime=" . $w_actual_datetime;
				$rs = mysqli_query($GLOBALS['conn'],$strsql);
				if (!($row = mysqli_fetch_array($rs)))
					{
					jumptopage("index.php?modul_action=" . $which_back);
					}

				// get the field contents
				$x_id = @$row["id"];
				jumptopage("index.php?modul_select=".viewModul($modul_select,"nextmodul")."&modul_action=list&key_m=" . $x_id);
				}
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
	if (EW_this.x_type_id && !EW_hasValue(EW_this.x_type_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"type_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_type_id";
                return true; 
	        }
	if (EW_this.x_partner_id && !EW_hasValue(EW_this.x_partner_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"partner_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_partner_id";
                return true; 
	        }
	if (EW_this.x_store_id && !EW_hasValue(EW_this.x_store_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"store_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_store_id";
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
if ($modul_select == "selling_topic")
	{
	$x_name = "Vásárlás vevõ által";
	$x_type_id = 1;
	$x_partner_id = 1;
	$x_store_id = 1;
	}
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"name")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"delivery_letter")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_delivery_letter' size='70' maxlength='100' value='" . htmlspecialchars(@$x_delivery_letter) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"type_id")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_type_id))
	{
	$x_type_id = 0;
	} // set default value
$x_type_idList = "<select name=\"x_type_id\"><option value=\"\">----------</option>";
$cbo_x_type_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM " . viewModul($modul_select,"itemtable") . "_type";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_type_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_type_id)
			{
			$x_type_idList .= " selected";
			}
		$x_type_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_type_idList .= "</select>";
$html_page .= $x_type_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=".viewModul($modul_select,"itemtable"). "_type"."&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' title='".viewTitle($modul_select,"type_id")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"partner_id")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_partner_id))
	{
	$x_partner_id = 0;
	} // set default value
$x_partner_idList = "<select name=\"x_partner_id\"><option value=\"\">----------</option>";
$cbo_x_partner_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM partner";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_partner_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_partner_id)
			{
			$x_partner_idList .= " selected";
			}
		$x_partner_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_partner_idList .= "</select>";
$html_page .= $x_partner_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=partner&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' title='".viewTitle($modul_select,"partner_id")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewTitle($modul_select,"store_id")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_store_id))
	{
	$x_store = 0;
	} // set default value
$x_store_idList = "<select name=\"x_store_id\"><option value=\"\">----------</option>";
$cbo_x_sore_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM store_topic";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_store_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_store_id)
			{
			$x_store_idList .= " selected";
			}
		$x_store_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_store_idList .= "</select>";
$html_page .= $x_store_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "</td></tr></table></td>";
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
	case "x_type_id" : document.addform.x_type_id.focus();
		break;
	case "x_partner_id" : document.addform.x_partner_id.focus();
		break;
	case "x_store_id" : document.addform.x_store_id.focus();
		break;
	default : document.addform.x_name.focus();
		break;
	}
-->
</script>
