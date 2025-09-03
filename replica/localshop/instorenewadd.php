<?php
//$which_back="list";
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
//		$a = "C"; // copy record
		}
	else
		{
//		$a = "I"; // display blank record
		}
	}
$x_modulfunction = @$_POST["modulfunction"];
$x_is_head = @$_POST["is_head"];
//echo "[".$x_is_head."]<br>";
echo "1[".$x_modulfunction."]<br>";
echo "1[".$a."]<br>";
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
			$x_store_id = @$row["store_id"]; 
			$x_delivery_letter = @$row["delivery_letter"]; 
			$x_partner_id = @$row["partner_id"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_store_id = @$_POST["x_store_id"];
		$x_delivery_letter = @$_POST["x_delivery_letter"]; 
		$x_partner_id = @$_POST["x_partner_id"];
		sharefrompost();
		$x_lang_id = @$_SESSION[$which_system . "status_UserLangID"];
		$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
		$x_insert_datetime = date('Y.m.d H:i:s<br>',time());
//echo @$_SESSION[$which_system . "status_UserLangID"]."x<br>";
//echo $x_lang_id."1<br>";
if ($x_modulfunction==" ") 
	{
echo "2.5[".$x_modulfunction."]<br>";
echo "2.5[".$a."]<br>";
	break;
	}
//$x_modulfunction = " ";
//$a=" ";
echo "2.6[".$x_modulfunction."]<br>";
echo "2.6[".$a."]<br>";

		if (empty($x_is_head))
			{
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
			 	mysqli_query($GLOBALS['conn'], $strsql) or die(mysqli_error());
				$x_topic_id="".mysqli_insert_id()."";
				$x_is_head = 1;
				}
			}
		else
			{
			$x_topic_id = @$_POST["x_topic_id"];
			}
		$x_topic_id = $x_topic_id;
		$x_product_id = @$_POST["x_product_id"];
		$x_amount = @$_POST["x_itemamount"];
		$x_listprice = @$_POST["x_listprice"];
		$x_discount = @$_POST["x_discount"];
		if (!empty($x_discount))
			{
			$x_unitprice = $x_listprice*$x_discount;
			}
		else
			{
			$x_unitprice = $x_listprice;
			}
		$x_nettoprice = $x_amount*$x_unitprice;
		$x_vatkey = @$_POST["x_vatkey"];
		$x_bruttoprice = $x_nettoprice*$x_vatkey;
		$x_vatprice = $x_bruttoprice-$x_nettoprice;
		if (!empty($x_vatkey))
			{
			$x_shopprice = $x_listprice*$x_vatkey;
			}
		else
			{
			$x_shopprice = $x_listprice;
			}
		$x_lang_id = @$_SESSION[$which_system . "status_UserLangID"];
		$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
		$x_insert_datetime = date('Y.m.d H:i:s<br>',time());
//echo $x_lang_id."2<br>";

		// add the values into an array

		// topic_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$itemfieldList["`topic_id`"] = $theValue;

		// product_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_product_id) : $x_product_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$itemfieldList["`product_id`"] = $theValue;

		// amount
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_amount) : $x_amount;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$itemfieldList["`amount`"] = $theValue;

		// listprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_listprice) : $x_listprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`listprice`"] = $theValue;

		// discount
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_discount) : $x_discount;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`discount`"] = $theValue;

		// unitprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_unitprice) : $x_unitprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`unitprice`"] = $theValue;

		// nettoprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nettoprice) : $x_nettoprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`nettoprice`"] = $theValue;

		// vatkey
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_vatkey) : $x_vatkey;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`vatkey`"] = $theValue;

		// vatprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_vatprice) : $x_vatprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`vatprice`"] = $theValue;

		// bruttoprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bruttoprice) : $x_bruttoprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`bruttoprice`"] = $theValue;

		// shopprice
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_shopprice) : $x_shopprice;
		$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
		$itemfieldList["`shopprice`"] = $theValue;

		// lang_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$itemfieldList["`lang_id`"] = $theValue;

		// insert_user_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$itemfieldList["`insert_user_id`"] = $theValue;

		// insert_datetime
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
		$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
		$itemfieldList["`insert_datetime`"] = $theValue;

		// insert into database
		$itemSQL = "INSERT INTO instore (";
		$itemSQL .= implode(",", array_keys($itemfieldList));
		$itemSQL .= ") VALUES (";
		$itemSQL .= implode(",", array_values($itemfieldList));
		$itemSQL .= ")";
		mysqli_query($GLOBALS['conn'],$itemSQL) or die(mysqli_error());
$x_modulfunction = " ";
$a=" ";
echo "2[".$x_modulfunction."]<br>";
echo "2[".$a."]<br>";
//jumptopage("index.php?&key=" . $key);
		break;
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
	if (EW_this.x_partner_id && !EW_hasValue(EW_this.x_store_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"store_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_store_id";
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
$html_page .= "<input type='hidden' name='is_head' value='".$x_is_head."'>";
echo "3[".$x_modulfunction."]<br>";
echo "3[".$a."]<br>";
$html_page .= "<input type='hidden' name='modulfunction' value='".$x_modulfunction."'>";
$html_page .= "<input type='hidden' name='x_id' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<input type='hidden' name='x_topic_id' value='" . htmlspecialchars(@$x_topic_id) . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2' bgcolor='" . $color6 . "'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
if ($modul_select == "selling_topic")
	{
	$x_partner_id = 1;
	$x_store_id = 1;
	}

$html_page .= "<tr align='center'><td valign='top'>";

// store select
$html_page .= "<table border=0 width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr><td>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr bgcolor='" . $color6 . "'>";
$html_page .= "<td bgcolor='" . $actcolor . "'>";
$html_page .= "<span class='phpmaker'>&nbsp;".viewTitle($modul_select,"store_id")." *</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (empty($x_is_head))
	{
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
	}
else
	{
	$html_page .= "<input type='hidden' name='x_store_id' value='".$x_store_id."'>";
	$sqlwrk = "SELECT id, name FROM store_topic WHERE id=".$x_store_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowItem = mysqli_fetch_array($rswrk);
		$x_storename = $rowItem["name"];
		}
	@mysqli_free_result($rswrk);
	$html_page .= $x_storename;
	}
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "</td></tr></table>";
$html_page .= "</td>";
$html_page .= "<td></td>";
$html_page .= "<td></td>";
$html_page .= "</tr>";

// Partner & deliverletter
$html_page .= "<tr><td>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr bgcolor='" . $color6 . "'>";
$html_page .= "<td bgcolor='" . $actcolor . "'>";
$html_page .= "<span class='phpmaker'>&nbsp;".viewTitle($modul_select,"partner_id")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (empty($x_is_head))
	{
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
	}
else
	{
	$html_page .= "<input type='hidden' name='x_partner_id' value='".$x_partner_id."'>";
	$sqlwrk = "SELECT id, name FROM partner WHERE id=".$x_partner_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowItem = mysqli_fetch_array($rswrk);
		$x_partnername = $rowItem["name"];
		}
	@mysqli_free_result($rswrk);
	$html_page .= $x_partnername;
	}
$html_page .= "</span>";
$html_page .= "</td></tr></table></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td align='right'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr bgcolor='" . $color6 . "'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"delivery_letter")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>&nbsp;";
if (empty($x_is_head))
	{
	$html_page .= "<input type='text' name='x_delivery_letter' size='30' maxlength='30' value='" . htmlspecialchars(@$x_delivery_letter) . "'>";
	}
else
	{
	$html_page .= "<input type='hidden' name='x_delivery_letter' value='".$x_delivery_letter."'>";
	$html_page .= $x_delivery_letter;
	}	
$html_page .= "</span>&nbsp;</td>";
$html_page .= "</tr></table></td>";
$html_page .= "</tr>";

// date
/*
$html_page .= "<tr>";
$html_page .= "<td></td>";
$html_page .= "<td></td>";
$html_page .= "<td></td>";
$html_page .= "</tr>";
*/
$html_page .= "</table></td></tr>";

$html_page .= "<tr><td align='center'>";
$html_page .= "<hr SIZE='3' noshade>";
$html_page .= "</td></tr>";

// maker select
$html_page .= "<tr><td>";
$html_page .= "<table border=0 width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr><td>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr bgcolor='" . $color6 . "'>";
$html_page .= "<td bgcolor='" . $actcolor . "'>";
$html_page .= "<span class='phpmaker'>&nbsp;".viewModulParam("product_item","barcodeTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_barcode' size='13' maxlength='13' value='" . htmlspecialchars(@$x_barcode) . "'></span>&nbsp;</td>";
$html_page .= "<td width='30' bgcolor='" . $color6 . "'></td>";
$html_page .= "<td bgcolor='" . $actcolor . "'>";
$html_page .= "<span class='phpmaker'>&nbsp;".viewModulParam("product_item","maker_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (empty($x_product_id))
	{
	$x_product_id = " ";
	}
else
	{
	$sqlwrk = "SELECT id, name, productid, maker_id FROM product_item WHERE productid=".$x_product_id;
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowItem = mysqli_fetch_array($rswrk);
		$x_maker_id = $rowItem["maker_id"];
		}
	@mysqli_free_result($rswrk);
	}
if (empty($x_maker_id))
	{
	$x_store = 0;
	} // set default value
$x_maker_idList = "<select name=\"x_maker_id\"><option value=\"\">----------</option>";
$cbo_x_maker_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM product_maker";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_maker_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_maker_id)
			{
			$x_maker_idList .= " selected";
			}
		$x_maker_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_maker_idList .= "</select>";
$html_page .= $x_maker_idList;
$html_page .= "</span>&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "</td></tr></table>";
$html_page .= "</td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";


// input item
$html_page .= "<tr><td>";
$html_page .= "<table border=0 width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center' bgcolor='" . $actcolor . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"product_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"productNameTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"itemAmountTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"listPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"discountTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"unitPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"nettoPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"VATKeyTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"VATPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"bruttoPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"shopPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"shopSumPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td width='40' bgcolor='" . $color6 . "'></td>";
$html_page .= "</tr>";
$html_page .= "<tr align='center' bgcolor='" . $color6 . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_product_id' size='13' maxlength='13' value='" . htmlspecialchars(@$x_product_id) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;";
if (empty($x_product_id))
	{
	$x_product_id = 0;
	} // set default value
$x_product_idList = "<select name=\"x_product_id\" style='width:200;'><option value=\"\">----------</option>";
$cbo_x_product_id_js = ""; // initialise
$sqlwrk = "SELECT id, name, productid, maker_id FROM product_item";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_product_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_product_id)
			{
			$x_product_idList .= " selected";
			}
		$x_product_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_product_idList .= "</select>";
$html_page .= $x_product_idList;
$html_page .= "</span>";
$html_page .= "</td>";
$html_name .= "</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_itemamount' size='5' maxlength='11' value='" . htmlspecialchars(@$x_itemamount) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_listprice' size='7' maxlength='7' value='" . htmlspecialchars(@$x_listprice) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_discount' size='4' maxlength='4' value='" . htmlspecialchars(@$x_discount) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_vatkey' size='5' maxlength='5' value='" . htmlspecialchars(@$x_vatkey) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;<input type='text' name='x_shopprice' size='7' maxlength='7' value='" . htmlspecialchars(@$x_shopprice) . "'></span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;</span>&nbsp;</td>";
$html_page .= "</tr>";

$html_page .= "<tr><td colspan=12>";
$html_page .= "<table border=0 border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='left' bgcolor='" . $color6 . "'>";
$html_page .= "<td width='10'></td>";
if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
	{
	if (!isset($GLOBALS["noadd"]) || !$GLOBALS["noadd"])
		{
		$buttonsize = getimagesize(urldecode($GLOBALS["image_button"]. viewModulParam($GLOBALS["modul_select"],"saveButton")));
		$html_page .= "<td align='center'>";
		$html_page .= "<input type='submit' name='Action' value='' style='width:" . $buttonsize[0] . ";height:" . $buttonsize[1] . ";background-color:transparent;background-image: url(".$GLOBALS["image_button"]. viewModulParam($GLOBALS["modul_select"],"saveButton").");background-repeat:no-repeat;background-position:center;border:0' title='".viewModulParam($modul_select,"saveTitle")."' onClick=\"buttonText('addItem');\">";
		$html_page .= "</td>";
		}
	}
$html_page .= "<td width='10'></td>";
$html_page .= "<td>";
if (($GLOBALS["ewCurSec"] & ewAllowDelete) == ewAllowDelete) 
	{ 
	if (!isset($GLOBALS["nodelete"]) || !$GLOBALS["nodelete"])
		{
			if ((@$GLOBALS["row"]["id"] != NULL))
				{
//				$submenu .= "<a href='index.php?modul_action=delete&key=" . urlencode($GLOBALS["x_id"]) . $GLOBALS["plus_param"]."'>";
				}
			else
				{
//				$submenu .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"deleteButton")."' border='0' name='delete' title='".viewModulParam($GLOBALS["modul_select"],"deleteTitle")."'>";
//			$html_page .= "</a>";
			$html_page .= "</td>";
			}
		} 
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= "</tr>";

$html_page .= "<tr><td align='center' colspan=14>";
$html_page .= "<hr SIZE='3' noshade>";
$html_page .= "</td></tr>";


//$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
//$html_page .= "<tr align='center'><td valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
/*
$html_page .= "<tr align='center' bgcolor='" . $actcolor . "'>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"product_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"productNameTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"itemAmountTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"listPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"discountTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"unitPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"nettoPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"VATKeyTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"VATPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"bruttoPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"shopPriceTitle")."</span>&nbsp;</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"shopSumPriceTitle")."</span>&nbsp;</td>";
//$html_page .= "<td width='40' bgcolor='" . $color6 . "'></td>";
$html_page .= "<td width='20'></td>";
$html_page .= "</tr>";
*/
//include ($share_path."sharefieldinput.php");

//		$GLOBALS["LastStart"] = intval(($GLOBALS["totalRecs"]-1)/$GLOBALS["displayRecs"])*$GLOBALS["displayRecs"]+1;
$noview = true;
$nocopy = true;
$noedit = true;
$noadd = true;
$displayRecs = viewModulParam($modul_select,"displayRecs");
buildsearch();
savesearch();
// get clear search cmd
if (@$_GET["cmd"] <> "")
	{
	$cmd = $_GET["cmd"];
	if (strtoupper($cmd) == "RESET")
		{
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
builddbwhere();
// default order
$DefaultOrder = "";
$DefaultOrderType = "";
$DefaultFilter = "";
checkorder();

$strsql = "SELECT instore.*, product_item.id as product_item_id, product_item.productid, product_item.name as productname";
$strsql .= " FROM instore ";
$strsql .= " LEFT JOIN product_item ON product_item.id=instore.product_id";
$strsql .= " WHERE instore.topic_id=".$x_topic_id;
buildsql();
//echo $strsql;
$rs = mysqli_query($GLOBALS['conn'],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));
checkstart();

// avoid starting record > total records
if ($startRec > $totalRecs)
	{
	$startRec = $totalRecs;
	}

// set the last record to display
$stopRec = $startRec + $displayRecs - 1;
$recCount = $startRec - 1;

// move to the first record
@mysqli_data_seek($rs, $recCount);
$recActual = 0;
while (($row = @mysqli_fetch_array($rs)) && ($recCount < $stopRec))
	{
	$recCount++;	
	if ($recCount >= $startRec)
		{
		$recActual++;	
		$bgcolor = $color4; // row color
		if (($recCount % 2) <> 0)
			{ // display alternate color for rows
			$bgcolor = $color5;
			}

		// load key for record
		$key = @$row["id"];
		$x_product_id = @$row["productid"];
		$x_productname = @$row["productname"];
		$x_itemamount = @$row["amount"];
		$x_listprice = @$row["listprice"];
		$x_discount = @$row["discount"];
		if (!empty($x_discount))
			{
			$x_unitprice = $x_listprice*$x_discount;
			}
		else
			{
			$x_unitprice = $x_listprice;
			}
		$x_nettoprice = $x_amount*$x_unitprice;
		$x_vatkey = @$row["vatkey"];
		$x_bruttoprice = $x_nettoprice*$x_vatkey;
		$x_vatprice = $x_bruttoprice-$x_nettoprice;
		if (!empty($x_vatkey))
			{
			$x_shopprice = $x_listprice*$x_vatkey;
			}
		else
			{
			$x_shopprice = $x_listprice;
			}
		$x_shopsumprice = $x_amount*$x_shopprice;
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr align='center' valign='center' bgcolor='" . $bgcolor. "'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_product_id."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_productname."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_itemamount."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_listprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_discount."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_unitprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_nettoprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_vatkey."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_vatprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_bruttoprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_shopprice."</span>&nbsp;</td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_shopsumprice."</span>&nbsp;</td>";
		$html_page .= "<td valign='center' align='right'>";
		$html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td><tr>";
//		$html_page .= "</table></td></tr>"; 
		}
	}

$sqlsum = "SELECT SUM(nettoprice) AS nettoprice_sum, SUM(vatprice) AS vatprice_sum, SUM(bruttoprice) AS bruttoprice_sum, SUM(amount*shopprice) AS shopprice_sum   FROM instore ";
$sqlsum .= " WHERE topic_id=".$x_topic_id;
$sumwrk = mysqli_query($GLOBALS['conn'],$sqlsum);
echo $sqlsum;
if ($sumwrk && $rowsumwrk = mysqli_fetch_array($sumwrk))
	{
	$x_nettoprice_sum = $rowsumwrk["nettoprice_sum"];
	$x_vatprice_sum = $rowsumwrk["vatprice_sum"];
	$x_bruttoprice_sum = $rowsumwrk["bruttoprice_sum"];
	$x_shopprice_sum = $rowsumwrk["shopprice_sum"];
	}
@mysqli_free_result($sumwrk);

$html_page .= "<tr><td align='center' colspan=14>";
$html_page .= "<hr SIZE='3' noshade>";
$html_page .= "</td></tr>";

$html_page .= "<tr><td colspan=5 align='left'>";
$html_page .= "<table border=0 border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='left' bgcolor='" . $color6 . "'>";
$html_page .= "<td width='10'></td>";
if (($GLOBALS["ewCurSec"] & ewAllowAdd) == ewAllowAdd)
	{
//	if (!isset($GLOBALS["noadd"]) || !$GLOBALS["noadd"])
//		{
		$html_page .= "<td>";
		$html_page .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"saveButton")."' border=0 name='save' title='".viewModulParam($modul_select,"saveTitle")."'></a></td>";
//		}
	}
$html_page .= "<td width='10'></td>";
$html_page .= "<td>";
//$html_page .= "<td width=" . $subwidthsize . ">";
$html_page .= "<a href='index.php?modul_action=list&kcmd=reset'>";
$html_page .= "<img src='" . $GLOBALS["image_button"] . viewModulParam($GLOBALS["modul_select"],"backButton")."' border='0' name='delete' title='".viewModulParam($GLOBALS["modul_select"],"backTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td>";
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($GLOBALS["modul_select"],"topic_countTitle")."&nbsp;</span></td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_nettoprice_sum."&nbsp;</span></td>";
$html_page .= "<td></td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_vatprice_sum."&nbsp;</span></td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_bruttoprice_sum."&nbsp;</span></td>";
$html_page .= "<td></td>";
$html_page .= "<td><span class='phpmaker'>&nbsp;".$x_shopprice_sum."&nbsp;</span></td>";
$html_page .= "</tr>";


$html_page .= "<tr><td align='center' colspan=14>";
$html_page .= "<hr SIZE='3' noshade>";
$html_page .= "</td></tr>";
//$html_page .= "</table>";
//$html_page .= "</td>";
//$html_page .= "</tr>";

$html_page .= "</form>";
$html_page .= "</table></td></tr>";
$html_page .= "</table>";
$html_page .= "</td>";
advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
//footer("");

footer("");

?>
<SCRIPT LANGUAGE="JavaScript">
switch (document.addform.fieldfocus.value)
	{
	case "x_store_id" : document.addform.x_store_id.focus();
		break;
	case "x_partner_id" : document.addform.x_partner_id.focus();
		break;
	default : document.addform.x_store.id.focus();
		break;
	}

function buttonText(type)
	{
	document.addform.modulfunction.value=type;
	}
</script>
