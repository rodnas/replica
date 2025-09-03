<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowedit) <> ewAllowedit) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
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
$x_orders_id = @$_POST["x_orders_id"];
$x_product_id = @$_POST["x_product_id"];
$x_status_id = @$_POST["x_status_id"];
$x_amount = @$_POST["x_amount"];
$x_price = @$_POST["x_price"];
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
		$x_orders_id = @$row["orders_id"];
		$x_product_id = @$row["product_id"];
		$x_status_id = @$row["status_id"];
		$x_amount = @$row["amount"];
		$x_price = @$row["price"];
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		$tkey = "" . $key . "";

		// get the form values
		$x_orders_id = @$_POST["x_orders_id"];
		$x_product_id = @$_POST["x_product_id"];
		$x_status_id = @$_POST["x_status_id"];
		$x_amount = @$_POST["x_amount"];
		$x_price = @$_POST["x_price"];
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// status_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_status_id) : $x_status_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["status_id"] = $theValue;
			sharefieldconv();			
			if ($x_status_id != 1)
				{
				$fieldList["active"] = 0;
				$x_active = 0;
				}
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
	if (EW_this.x_status_id && !EW_hasValue(EW_this.x_status_id, "SELECT" ))
		{
		document.editform.errortext.value = "<?php echo viewModulParam($modul_select,"status_idErrMsg"); ?>";
		document.editform.fieldfocus.value = "x_status_id";
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
$html_page .= "<input type='hidden' name='x_orders_id' value='" . $x_orders_id . "'>";
$html_page .= "<input type='hidden' name='x_product_id' value='" . $x_product_id . "'>";
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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"usernameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;";
if (!is_null($x_orders_id)) 
	{
	$sqlwrk = "SELECT * FROM orders";
	$sqlwrk_where = "";
	$sqlwrk_where .= "id = " . $x_orders_id;
	if ($sqlwrk_where <> "" ) 
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
		{
		$x_orders_name = $rowwrk["insert_user_id"];
		}
	@mysqli_free_result($rswrk);
	}
if (!is_null($x_orders_name)) 
	{
	$sqlwrk = "SELECT * FROM users ";
	$sqlwrk_where = "";
	$sqlwrk_where .= "id = " . $x_orders_name;
	if ($sqlwrk_where <> "" ) 
		{
		$sqlwrk .= " WHERE " . $sqlwrk_where;
		}
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
		{
		$x_orders_name = $rowwrk["shortname"];
		$x_orders_name .= " (".$rowwrk["bill_surname"]." ".$rowwrk["bill_forename"].")";
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= $x_orders_name;
$html_page .= "</span></td>";
$html_page .= "</tr>";
if (!is_null($x_product_id))
	{
	$sqlwrk = "SELECT * FROM product_item";
	$sqlwrk .= " WHERE id = " . $x_product_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_productid = $rowwrk["productid"];
		$x_maker_id = $rowwrk["maker_id"];
		$x_name = $rowwrk["name"];
		}
	@mysqli_free_result($rswrk);
	}
$html_page .= "<input type='hidden' name='" . $x_id . "' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"productidTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;" . $x_productid . "&nbsp;</span></td>";
$html_page .= "</tr>";
$x_make_name = "";
if (!is_null($x_maker_id))
	{
	$sqlwrk = "SELECT * FROM product_maker";
	$sqlwrk .= " WHERE id = " . $x_maker_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
		{
		$x_maker_name = $rowwrk["name"];
		}
	@mysqli_free_result($rswrk);
	}

$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"maker_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;" . $x_maker_name . "&nbsp;</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"productnameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;" . $x_name . "</span></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"status_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='#F3f2eb'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
$x_status_idList = "<select name=\"x_status_id\"><option value=\"\">----------</option>";
$cbo_x_status_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM `" . $modul_select . "_status";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_status_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_status_id)
			{
			$x_status_idList .= " selected";
			}
		$x_status_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_status_idList .= "</select>";
$html_page .= $x_status_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=".$modul_select . "_status"."&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' title='".viewModulParam($modul_select,"status_idTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
include ($share_path."sharefieldinput.php");
footer("edit");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.editform.fieldfocus.value)
	{
	case "x_status_id" : document.editform.x_status_id.focus();
		break;
	default : document.editform.x_status_id.focus();
		break;
	}
-->
</script>
