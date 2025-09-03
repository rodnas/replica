<?php
// Module properties
$which_back = "list";
sharefieldinit();
$whose_permissions = str_replace("_permissions","",$modul_select);
$whose_id = str_replace("s_permissions","",$modul_select)."_id";
if (($ewCurSec & ewAllowadd) <> ewAllowadd) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
	jumptopage($base_modul);
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
			$x_whose_id = @$row[$whose_id]; 
			$x_permission_id = @$row["permission_id"]; 
			$x_allowview = @$row["allowview"]; 
			$x_allowadd = @$row["allowadd"]; 
			$x_allowedit = @$row["allowedit"]; 
			$x_allowdelete = @$row["allowdelete"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_id = @$_POST["x_id"];
		$x_whose_id = @$_POST["x_".$whose_id];
		$x_permission_id = @$_POST["x_permission_id"];
		$x_allowview = BooleanToInt(@$_POST["x_allowview"]);
		$x_allowadd = BooleanToInt(@$_POST["x_allowadd"]);
		$x_allowedit = BooleanToInt(@$_POST["x_allowedit"]);
		$x_allowdelete = BooleanToInt(@$_POST["x_allowdelete"]);
		$x_allowadmin = 0;
		$x_ewcursec = 0;
		if ($x_allowadd == 1) $x_ewcursec += 1;
		if ($x_allowdelete == 1) $x_ewcursec += 2;
		if ($x_allowedit == 1) $x_ewcursec += 4;
		if ($x_allowview == 1) $x_ewcursec += 8;
		if ($x_allowadmin == 1) $x_ewcursec += 16;
		sharefrompost();
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select . " WHERE ".$whose_id."='" . $x_whose_id . "'";
		$strsql .= " AND permission_id='" . $x_permission_id . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_permission_id";
			}
		mysqli_free_result($rs);
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// whose_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_whose_id) : $x_whose_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList[$whose_id] = $theValue;

			// permission_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_permission_id) : $x_permission_id;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["permission_id"] = $theValue;

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

			// alloweadmin
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_allowadmin) : $x_allowadmin;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["allowadmin"] = $theValue;

			// ewcursec
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ewcursec) : $x_ewcursec;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["ewcursec"] = $theValue;

			// active
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["active"] = $theValue;

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
	if (EW_this.x_group_id && !EW_hasValue(EW_this.x_group_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"whose_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_group_id";
                return true; 
	        }
	if (EW_this.x_permission_id && !EW_hasValue(EW_this.x_permission_id, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"permission_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_permission_id";
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
$html_page .= "<input type='hidden' name='x_active' value='1'>";
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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"whose_idTitle")." *</span>&nbsp;</td>";
$html_page .= "<td width='600' bgcolor='" . $color6 . "'>";
if (@$_SESSION[$which_system.$modul_select . "_masterkey"] <> "")
	{
	$whose_name = "";
	$x_whose_id = $_SESSION[$which_system.$modul_select . "_masterkey"];
	$o_x_whose_id = $x_whose_id;
	if ($x_whose_id != NULL)
		{
		$sqlwrk = "SELECT * FROM ".$whose_permissions;
		$sqlwrk_where = "";
		$sqlwrk_where .= "id = " . $x_whose_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			if ($modul_select == "users_permissions")
				{
				$x_whose_name = $rowwrk["shortname"];
				}
			else if ($modul_select == "groups_permissions")
				{
				$x_whose_name = $rowwrk["name"];
				}
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= "<span class='phpmaker'>&nbsp;".$x_whose_name."</span>";
	$html_page .= "<input type='hidden' name='x_".$whose_id."' value='".htmlspecialchars(@$o_x_whose_id)."'>";
	}
else
	{
	$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$html_page .= "<td><span class='phpmaker'>";
	if (empty($x_whose_id))
		{
		$x_whose_id = 0;
		} // set default value
	$x_whose_idList = "<select name=\"x_".$whose_id."\"><option value=\"\">----------</option>";
	$cbo_x_whose_id_js = ""; // initialise
	$sqlwrk = "SELECT id, name FROM ".$whose_permissions;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($rswrk))
			{
			$x_whose_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
			if ($datawrk["id"] == @$x_whose_id)
				{
				$x_whose_idList .= " selected";
				}
			$x_whose_idList .= ">" . $datawrk["name"] . "</option>";
			$rowcntwrk++;
			}
		}
	@mysqli_free_result($rswrk);
	$x_whose_idList .= "</select>";
	$html_page .= $x_whose_idList;
	$html_page .= "</span>&nbsp;&nbsp;</td>";
	$html_page .= "<td>";
//	$html_page .= "<a href='dictionarylist.php?whichdb=" . $which_modul . "_topic&header=".$modul_header." téma&cmd=resetall'><img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='Kódszótár'></a>";
	$html_page .= "</td></tr></table></td>";
	}
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"permission_idTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
$x_permission_idList = "<select name=\"x_permission_id\"><option value=\"\">----------</option>";
$cbo_x_permission_id_js = ""; // initialise
$sqlwrk = "SELECT permissions.id,permissions.name,".$modul_select.".".$whose_id;
$sqlwrk .= " FROM permissions LEFT JOIN ".$modul_select;
$sqlwrk .= " ON permissions.id = ".$modul_select.".permission_id";
$sqlwrk .= " AND ".$modul_select.".".$whose_id."=".$x_whose_id;
$sqlwrk .= " WHERE ".$modul_select.".permission_id IS NULL";
//$sqlwrk .= " AND permissions.active <> 0";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_permission_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_permission_id)
			{
			$x_permission_idList .= " selected";
			}
		$x_permission_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_permission_idList .= "</select>";
$html_page .= $x_permission_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
//	$html_page .= "<a href='dictionarylist.php?whichdb=" . $which_modul . "_topic&header=Fórum téma&cmd=resetall'><img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='Kódszótár'></a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";

$html_page .= "<tr align='center'><td colspan='2'><table border=0 width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='" . $actcolor . "'>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"viewTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"addTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"editTitle")."</span></td>";
$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"deleteTitle")."</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr align='center' bgcolor='" . $color6 . "'>";
$html_page .= activateTd("x_allowview");
$html_page .= activateTd("x_allowadd");
$html_page .= activateTd("x_allowedit");
$html_page .= activateTd("x_allowdelete");
$html_page .= "</tr></table></td></tr>";
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_group_id" : document.addform.x_group_id.focus();
		break;
	case "x_name" : document.addform.x_permission_id.focus();
		break;
	default : document.addform.x_permission_id.focus();
		break;
	}
-->
</script>
