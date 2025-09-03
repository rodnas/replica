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
			$x_productid = @$row["productid"]; 
			$x_barcode = @$row["barcode"]; 
			$x_maker_id = @$row["maker_id"]; 
			$x_name = @$row["name"]; 
			$x_topic_id = @$row["topic_id"]; 
			$x_size_id = @$row["size_id"]; 
			$x_priceHUF = @$row["priceHUF"]; 
			$x_pictURL = @$row["pictURL"]; 
			$x_novelty = @$row["novelty"]; 
			$x_sale = @$row["sale"]; 
			$x_sold = @$row["sold"]; 
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_productid = @$_POST["x_productid"];
		$x_barcode = @$_POST["x_barcode"];
		$x_maker_id = @$_POST["x_maker_id"];
		$x_name = @$_POST["x_name"];
		$x_topic_id = @$_POST["x_topic_id"];
		$x_size_id = @$_POST["x_size_id"];
		if ($x_size_id == "0") $x_size_id = "1";
		$x_priceHUF = @$_POST["x_priceHUF"];
		$x_pictURL = @$_POST["x_pictURL"];
		$x_novelty = BooleanToInt(@$_POST["x_novelty"]);
		$x_sale = BooleanToInt(@$_POST["x_sale"]);
		$x_sold = @$_POST["x_sold"];
		sharefrompost();
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select . " WHERE productid='" . $x_productid . "' AND maker_id='" . $x_maker_id . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = viewModulParam($modul_select,"duplicateErrMsg");
			$x_fieldfocus = "x_productid";
			}
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// productid
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_productid) : $x_productid;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`productid`"] = $theValue;

			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_barcode) : $x_barcode;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`barcode`"] = $theValue;

			// maker_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_maker_id) : $x_maker_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`maker_id`"] = $theValue;

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`name`"] = $theValue;

			// topic_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`topic_id`"] = $theValue;

			// size_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_size_id) : $x_size_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`size_id`"] = $theValue;

			// priceHUF
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_priceHUF) : $x_priceHUF;
			$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
			$fieldList["`priceHUF`"] = $theValue;

			// novelty
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_novelty) : $x_novelty;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`novelty`"] = $theValue;

			// sale
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_sale) : $x_sale;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`sale`"] = $theValue;

			// sold
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_sold) : $x_sold;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`sold`"] = $theValue;

			sharefieldconv();			

			// insert into database
			$strsql = "INSERT INTO " . $modul_select . " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
			$last_id="".mysqli_insert_id()."";
			$x_pictureorig = @$_POST["x_picturesorig"];
			if (@$HTTP_POST_FILES['x_pictureorig']['name']!="")
				{
				$imagetype = @$HTTP_POST_FILES['x_pictureorig']['type'];
				if (($imagetype=="image/pjpeg")	|| ($imagetype=="image/jpeg") || ($imagetype=="image/jpg")
				|| ($imagetype=="image/gif") || ($imagetype=="image/png"))
					{
					$pictnameorig=@$HTTP_POST_FILES['x_pictureorig']['name'];
					if (($imagetype=="image/pjpeg") || ($imagetype=="image/jpeg") || ($imagetype=="image/jpg"))
						{
						$extension = ".jpg";
						}
					if (($imagetype=="image/gif"))
						{
						$extension = ".gif";
						}
					if (($imagetype=="image/png"))
						{
						$extension = ".png";
						}
					$pictnameorig = realpath($modul_image_path) . "/" .$modul_select . "_" . $last_id . "_orig" . $extension;
					$pictnamenormal = realpath($modul_image_path) . "/" .$modul_select. "_" . $last_id . "_normal" . $extension;
					$pictnameSAVE = $modul_select . "_" . $last_id . "_normal" . $extension;
					move_uploaded_file(@$HTTP_POST_FILES['x_pictureorig']['tmp_name'],$pictnameorig);
					chmod($pictnameorig,0644);
					pictureresize($pictnameorig,$pictnamenormal,viewModulParam($modul_select,"pictnormalwidth"),viewModulParam($modul_select,"pictnormalheight"));
					chmod($pictnamenormal,0644);
					unlink($pictnameorig);
					$x_pictURL = $pictnameSAVE;
					}
				// pictURL
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_pictURL) : $x_pictURL;
				$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
				$fieldList["`pictURL`"] = $theValue;

				$updateSQL = "UPDATE " . $modul_select . " SET ";
				foreach ($fieldList as $key=>$temp)
					{
					$updateSQL .= "$key = $temp, ";			
					}
				if (substr($updateSQL, -2) == ", ")
					{
					$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
					}
				$updateSQL .= " WHERE id=".$last_id;
			  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
				}
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
	if (EW_this.x_productid && !EW_hasValue(EW_this.x_productid, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"productidErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_productid";
                return true; 
	        }
	if (EW_this.x_maker_id && !EW_hasValue(EW_this.x_maker_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"maker_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_maker_id";
                return true; 
	        }
	if (EW_this.x_name && !EW_hasValue(EW_this.x_name, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"nameErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_name";
                return true; 
	        }
	if (EW_this.x_topic_id && !EW_hasValue(EW_this.x_topic_id, "SELECT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"topic_idErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_topic_id";
                return true; 
	        }
	if (EW_this.x_priceHUF && !EW_checknumber(EW_this.x_priceHUF.value))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"priceHUFnumErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_priceHUF";
                return true; 
	        }
	if (EW_this.x_priceHUF && !EW_hasValue(EW_this.x_priceHUF, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"priceHUFErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_priceHUF";
                return true; 
	        }
	document.addform.errortext.value = "";
	document.addform.fieldfocus.value = "";
	return true;
	}

// end JavaScript -->
</script>
<?php
$html_page .= "<form onSubmit=\"return EW_checkMyForm(this);\" enctype=\"multipart/form-data\" method='post' name='addform'>";
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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"productidTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_productid' size='30' maxlength='13' value='" . htmlspecialchars(@$x_productid) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"barcodeTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_barcode' size='30' maxlength='13' value='" . htmlspecialchars(@$x_barcode) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"maker_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_maker_id))
	{
	$x_maker_id = 0;
	} // set default value
$x_maker_idList = "<select name=\"x_maker_id\"><option value=\"\">----------</option>";
$cbo_x_maker_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM " . str_replace("_item","_maker",$modul_select) . " ORDER BY name";
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
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=".str_replace("_item","_maker",$modul_select) . "&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='".viewModulParam($modul_select,"maker_idTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='50' maxlength='80' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_topic_id))
	{
	$x_topic_id = 0;
	} // set default value
$x_topic_idList = "<select name=\"x_topic_id\"><option value=\"\">----------</option>";
$cbo_x_topic_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM " . str_replace("_item","_topic",$modul_select);
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
$html_page .= "<a href='index.php?modul_select=".str_replace("_item","_topic",$modul_select) . "&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='".viewModulParam($modul_select,"topic_idTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"size_idTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
$x_size_idList = "<select name=\"x_size_id\"><option value=\"\">----------</option>";
$cbo_x_size_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM `" . str_replace("_item","_size",$modul_select);
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_size_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_size_id)
			{
			$x_size_idList .= " selected";
			}
		$x_size_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_size_idList .= "</select>";
$html_page .= $x_size_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
$html_page .= "<a href='index.php?modul_select=".str_replace("_item","_size",$modul_select)."&modul_action=list&cmd=resetall'>";
$html_page .= "<img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='".viewModulParam($modul_select,"size_idTitle")."'>";
$html_page .= "</a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"priceHUFTitle")."&nbsp;</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
$html_page .= "<input type='text' name='x_priceHUF' size='10' value='" . htmlspecialchars(@$x_priceHUF) . "'>&nbsp;HUF&nbsp;</span>";
$html_page .= "</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"pictURLTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= whichpictureview($modul_image_path . "normal/" . @$x_pictURL,"")."<br>";
$html_page .= "<span class='phpmaker'><input type='file' name='x_pictureorig' size='20' maxlength='100' value='" . htmlspecialchars(@$x_pictureorig) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= activateTr("x_novelty","novelty");
$html_page .= activateTr("x_sale","sale");
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_productid" : document.addform.x_productid.focus();
		break;
	case "x_maker_id" : document.addform.x_maker_id.focus();
		break;
	case "x_name" : document.addform.x_name.focus();
		break;
	case "x_topic_id" : document.addform.x_topic_id.focus();
		break;
	case "x_priceHUF" : document.addform.x_priceHUF.focus();
		break;
	default : document.addform.x_productid.focus();
		break;
	}
-->
</script>
