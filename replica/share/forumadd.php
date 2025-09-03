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
		$rs = mysqli_query($GLOBALS['conn'],$strsql);
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		else
			{
			$row = mysqli_fetch_array($rs);

			// get the field contents
			$x_topic_id = @$row["topic_id"]; 
			$x_quote = @$row["description"];
			$x_moderated = @$row["moderated"]; 
			$x_automoderated = @$row["automoderated"]; 
			$x_answer_user_id = @$row["insert_user_id"];
			$x_answer_id = @$row["id"];
			if (!is_null(@$row["base_id"]))
				$x_base_id = @$row["base_id"];
			else
				$x_base_id = @$row["id"];
			sharefromtable();
			$x_description = "";
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_topic_id = @$_POST["x_topic_id"];
		$x_quote = @$_POST["x_quote"];
		$x_moderated = @$_POST["x_moderated"];
		$x_automoderated = @$_POST["x_automoderated"];
		$x_answer_user_id = @$_POST["x_answer_user_id"];
		$x_answer_id = @$_POST["x_answer_id"];
		$x_base_id = @$_POST["x_base_id"];
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array
			$w_actual_datetime = db_actual_datetime();

			// topic_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["topic_id"] = $theValue;

			// quote
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_quote) : $x_quote;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["quote"] = $theValue;

			// moderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_moderated) : $x_moderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["moderated"] = $theValue;

			// automoderated
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_automoderated) : $x_automoderated;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["automoderated"] = $theValue;

			// answer_user_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_answer_user_id) : $x_answer_user_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["answer_user_id"] = $theValue;

			// answer_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_answer_id) : $x_answer_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["answer_id"] = $theValue;

			// base_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_base_id) : $x_base_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["base_id"] = $theValue;

			sharefieldconv();			

			// insert into database
			$strsql = "INSERT INTO " . $modul_select . " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS['conn'],$strsql) or die(mysqli_error());
			$updateSQL = "UPDATE " . $modul_select . " SET ";
			$updateSQL .= "answer_id = id, base_id = id";			
			$updateSQL .= " WHERE answer_id IS NULL OR answer_id='0'";
		  	$rs = mysqli_query($GLOBALS['conn'],$updateSQL); // or die(mysqli_error())
			$updateSQL = "UPDATE " . $modul_select . "_topic SET ";
			$updateSQL .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
			$updateSQL .= "modify_datetime = ".$w_actual_datetime;			
			$updateSQL .= " WHERE id= '".$x_topic_id."'";
		  	$rs = mysqli_query($GLOBALS['conn'],$updateSQL) or die(mysqli_error());
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
	if (EW_this.x_topic_id && !EW_hasValue(EW_this.x_topic_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"topic_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_topic_id";
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
$html_page .= "<input type='hidden' name='x_answer_user_id' value='" . htmlspecialchars(@$x_answer_user_id) . "'>";
$html_page .= "<input type='hidden' name='x_answer_id' value='" . htmlspecialchars(@$x_answer_id) . "'>";
$html_page .= "<input type='hidden' name='x_base_id' value='" . htmlspecialchars(@$x_base_id) . "'>";
$html_page .= "<input type='hidden' name='x_quote' value='" . htmlspecialchars(@$x_quote) . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr>";
$html_page .= "<td align='center' valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"insert_user_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='".$color6."'><span class='phpmaker'>&nbsp;<b>";
$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
$x_insert_user_name = "";
if (!is_null($x_insert_user_id)) 
	{
	$sqlwrk = "SELECT * FROM users";
	$sqlwrk_where = "";
	$sqlwrk_where .= "id = " . $x_insert_user_id;
	if ($sqlwrk_where <> "" ) 
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = db_query($sqlwrk,$GLOBALS['conn']);
	if ($rswrk && $rowwrk = db_fetch_array($rswrk)) 
		{
		$x_insert_user_name = $rowwrk["shortname"];
		}
	db_free_result($rswrk);
	}
$html_page .= $x_insert_user_name;
$html_page .= "</b></span></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
if (@$_SESSION[$which_system.$modul_select . "_masterkey"] <> "")
	{
	$x_topic_id = $_SESSION[$which_system.$modul_select . "_masterkey"];
	$o_x_topic_id = $x_topic_id;
	if ($x_topic_id != NULL)
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
	$html_page .= "<span class='phpmaker'>&nbsp;".$x_topic_id."</span>";
	$html_page .= "<input type='hidden' name='x_topic_id' value='".htmlspecialchars(@$o_x_topic_id)."'>";
	}
else
	{
	$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
	$html_page .= "<td><span class='phpmaker'>";
	if (empty($x_topic_id))
		{
		$x_topic_id = 0;
		} // set default value
	$x_topic_idList = "<select name=\"x_topic_id\"><option value=\"\">----------</option>";
	$cbo_x_topic_id_js = ""; // initialise
	$sqlwrk = "SELECT id, name FROM " . $which_modul . "_topic";
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
			if ($datawrk["id"] == @$x_topic_id)
				{
				$x_topic_idList .= " selected";
				}
			$x_topic_idList .= ">" . $datawrk["name"] . "</option>";
			$rowcntwrk++;
			}
		}
	@mysqli_free_result($rswrk);
	$x_topic_idList .= "</select>";
	$html_page .= $x_topic_idList;
	$html_page .= "</span>&nbsp;&nbsp;</td>";
	$html_page .= "<td>";
	$html_page .= "</td></tr></table></td>";
	}
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
	$html_page .= "<span class='phpmaker'><i>".viewModulParam($modul_select,"quoteTitle").":</i><b>&nbsp;".htmlspecialchars($x_answer_user_id)."</b><br><br>" . htmlspecialchars(@$x_quote) . "</span></td>";
	$html_page .= "<td width='10'></td>";
	$html_page .= "</tr></table></td>";
	$html_page .= "</tr>";
	}
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_topic_id" : document.addform.x_topic_id.focus();
		break;
	case "x_description" : document.addform.x_description.focus();
		break;
	default : document.addform.x_topic_id.focus();
		break;
	}
-->
</script>
