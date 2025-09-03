<?php
// Module properties
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
$x_country = @$_POST["x_country"];
$x_zipcode = @$_POST["x_zipcode"];
$x_city = @$_POST["x_city"];
$x_address = @$_POST["x_address"];
$x_phone = @$_POST["x_phone"];
$x_fax = @$_POST["x_fax"];
$x_email = @$_POST["x_email"];
$x_taxnumber = @$_POST["x_taxnumber"];
$x_pictURL = @$_POST["x_pictURL"];
$x_directorname = @$_POST["x_directorname"];
$x_contactname = @$_POST["x_contactname"];
$x_factor = @$_POST["x_factor"];
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
		$x_country = @$row["country"];
		$x_zipcode = @$row["zipcode"];
		$x_city = @$row["city"];
		$x_address = @$row["address"];
		$x_phone = @$row["phone"];
		$x_fax = @$row["fax"];
		$x_email = @$row["email"];
		$x_taxnumber = @$row["taxnumber"];
		$x_pictURL = @$row["pictURL"];
		$x_directorname = @$row["directorname"];
		$x_contactname = @$row["contactname"];
		$x_factor = @$row["factor"];
		sharefromtable();
		mysqli_free_result($rs);		
		break;
	case "U": // update
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			$tkey = "" . $key . "";

			// get the form values
			$x_name = @$_POST["x_name"];
			$x_country = @$_POST["x_country"];
			$x_zipcode = @$_POST["x_zipcode"];
			$x_city = @$_POST["x_city"];
			$x_address = @$_POST["x_address"];
			$x_phone = @$_POST["x_phone"];
			$x_fax = @$_POST["x_fax"];
			$x_email = @$_POST["x_email"];
			$x_taxnumber = @$_POST["x_taxnumber"];
			$x_pictURL = @$_POST["x_pictURL"];
			$x_directorname = @$_POST["x_directorname"];
			$x_contactname = @$_POST["x_contactname"];
			$x_factor = @$_POST["x_factor"];
			$x_pictureorig = @$_POST["x_picturesorig"];
			sharefrompost();
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
					$pictnameorig = realpath($modul_image_path) . "/partner_" . $tkey . "_orig" . $extension;
					$pictnamesmall = realpath($modul_image_path) . "/partner_" . $tkey . "_small" . $extension;
					$pictnameSAVE = "partner_" . $tkey . "_small" . $extension;
					move_uploaded_file(@$HTTP_POST_FILES['x_pictureorig']['tmp_name'],$pictnameorig);
					chmod($pictnameorig,0644);
					pictureresize($pictnameorig,$pictnamesmall,120,120);
					chmod($pictnamesmall,0644);
					unlink($pictnameorig);
					$x_pictURL = $pictnameSAVE;
					}
				}

			// add the values into an array

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["name"] = $theValue;

			// country
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_country) : $x_country;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["country"] = $theValue;

			// zipcode
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_zipcode) : $x_zipcode;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["zipcode"] = $theValue;

			// city
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_city) : $x_city;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["city"] = $theValue;

			// address
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_address) : $x_address;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["address"] = $theValue;

			// phone
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_phone) : $x_phone;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["phone"] = $theValue;

			// fax
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_fax) : $x_fax;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["fax"] = $theValue;

			// email
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_email) : $x_email;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["email"] = $theValue;

			// taxnumber
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_taxnumber) : $x_taxnumber;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["taxnumber"] = $theValue;

			// pictURL
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_pictURL) : $x_pictURL;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["pictURL"] = $theValue;

			// directorname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_directorname) : $x_directorname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["directorname"] = $theValue;

			// contactname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_contactname) : $x_contactname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["contactname"] = $theValue;

			// factor
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_factor) : $x_factor;
			$theValue = ($theValue != "") ? floatval($theValue) : "NULL";
			$fieldList["factor"] = $theValue;

			sharefieldconv();			

			// update
			$updateSQL = "UPDATE " . $modul_select. " SET ";
			foreach ($fieldList as $key=>$temp)
				{
				$updateSQL .= "$key = $temp, ";			
				}
			if (substr($updateSQL, -2) == ", ")
				{
				$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
				}
			$updateSQL .= " WHERE id=".$tkey;
		  	$rs = mysqli_query($GLOBALS['conn'],$updateSQL, $GLOBALS['conn']) or die(mysqli_error());
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
	document.addform.errortext.value = "";
	document.addform.fieldfocus.value = "";
	return true;
	}

// end JavaScript -->
</script>
<?
$html_page .= "<form onSubmit=\"return EW_checkMyForm(this);\" enctype=\"multipart/form-data\" method='post' name='editform'>";
$html_page .= "<input type='hidden' name='errortext' value='" . $x_errortext . "'>";
$html_page .= "<input type='hidden' name='fieldfocus' value='" . $x_fieldfocus . "'>";
$html_page .= "<input type='hidden' name='a' value='U'>";
$html_page .= "<input type='hidden' name='x_lang_id' value='" . $x_lang_id . "'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
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
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")." *&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='60' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"countryTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_country' size='70' maxlength='60' value='" . htmlspecialchars(@$x_country) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"zipcodeTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_zipcode' size='10' maxlength='10' value='" . htmlspecialchars(@$x_zipcode) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"cityTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_city' size='50' maxlength='40' value='" . htmlspecialchars(@$x_city) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"addressTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_address' size='70' maxlength='60' value='" . htmlspecialchars(@$x_address) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"phoneTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_phone' size='30' maxlength='20' value='" . htmlspecialchars(@$x_phone) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"faxTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_fax' size='30' maxlength='20' value='" . htmlspecialchars(@$x_fax) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"emailTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_email' size='60' maxlength='50' value='" . htmlspecialchars(@$x_email) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"taxnumberTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_taxnumber' size='60' maxlength='50' value='" . htmlspecialchars(@$x_taxnumber) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr valign='top'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"pictURLTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
if (!is_null($x_pictURL)) 
	{ 
	$html_page .= "<img src='" . $modul_image_path . "/" . @$x_pictURL . "' border='0'><br>";
	} 
$html_page .= "<span class='phpmaker'><input type='text' name='x_pictURL' size='40' maxlength='100' value='" . htmlspecialchars(@$x_pictURL) . "'></span>&nbsp;";
$html_page .= "<span class='phpmaker'><input type='file' name='x_pictureorig' size='30' maxlength='100' value='" . htmlspecialchars(@$x_pictureorig) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"directornameTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_directorname' size='50' maxlength='100' value='" . htmlspecialchars(@$x_directorname) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"contactnameTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_contactname' size='50' maxlength='100' value='" . htmlspecialchars(@$x_contactname) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"factorTitle")."&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_factor' size='6' maxlength='4' value='" . htmlspecialchars(@$x_factor) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
include ($share_path."sharefieldinput.php");
$html_page .= footer("edit");
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
                                                '