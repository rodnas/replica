<?php 
// Module properties
$which_back = @$_GET["which_back"];
sharefieldinit();
if (isset($which_back))
	{
	$modul_header = "Adataim";
	$which_back = "list&modul_select=".$which_back."&cmd=resetall";
	}
if (!isset($which_back))
	{
	$which_back = @$_POST["x_which_back"];
	}
if (!isset($which_back))
	{
	$which_back = @$_POST["x_which_back"];
	}
if (!isset($which_back))
	{
	$which_back = "list";
	}
if (($ewCurSec & ewAllowedit) <> ewAllowedit) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] == 1) jumptopage($base_modul);
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
$x_id = @$_POST["x_id"];
$x_shortname = @$_POST["x_shortname"];
$x_password = @$_POST["x_password"];
$x_password2 = @$_POST["x_password2"];
$x_group_id = @$_POST["x_group_id"];
$x_email = @$_POST["x_email"];
$x_website = @$_POST["x_website"];
$x_surname = @$_POST["x_surname"];
$x_forename = @$_POST["x_forename"];
$x_country = @$_POST["x_country"];
$x_zipcode = @$_POST["x_zipcode"];
$x_city = @$_POST["x_city"];
$x_address = @$_POST["x_address"];
$x_phone = @$_POST["x_phone"];
$x_cellphone = @$_POST["x_cellphone"];
$x_newsletter = @$_POST["x_newsletter"];
$x_carry_surname = @$_POST["x_carry_surname"];
$x_carry_forename = @$_POST["x_carry_forename"];
$x_carry_country = @$_POST["x_carry_country"];
$x_carry_zipcode = @$_POST["x_carry_zipcode"];
$x_carry_city = @$_POST["x_carry_city"];
$x_carry_address = @$_POST["x_carry_address"];
$x_bill_surname = @$_POST["x_bill_surname"];
$x_bill_forename = @$_POST["x_bill_forename"];
$x_bill_country = @$_POST["x_bill_country"];
$x_bill_zipcode = @$_POST["x_bill_zipcode"];
$x_bill_city = @$_POST["x_bill_city"];
$x_bill_address = @$_POST["x_bill_address"];
$x_lang_id = @$_POST["x_lang_id"];
$x_active = BooleanToInt(@$_POST["x_active"]);
$x_insert_user_id = @$_POST["x_insert_user_id"];
$x_insert_datetime = @$_POST["x_insert_datetime"];
$x_modify_user_id = @$_POST["x_modify_user_id"];
$x_modify_datetime = @$_POST["x_modify_datetime"];
$x_visitcounter = @$_POST["x_visitcounter"];
$x_lastvisit = @$_POST["x_lastvisit"];
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
		$x_id = @$row["id"];
		$x_shortname = @$row["shortname"];
		$x_password = @$row["password"];
		$x_password2 = @$row["password"];
		$x_group_id = @$row["group_id"];
		$x_email = @$row["email"];
		$x_website = @$row["website"];
		$x_surname = @$row["surname"];
		$x_forename = @$row["forename"];
		$x_country = @$row["country"];
		$x_zipcode = @$row["zipcode"];
		$x_city = @$row["city"];
		$x_address = @$row["address"];
		$x_phone = @$row["phone"];
		$x_cellphone = @$row["cellphone"];
		$x_newsletter = @$row["newsletter"];
		$x_carry_surname = @$row["carry_surname"];
		$x_carry_forename = @$row["carry_forename"];
		$x_carry_country = @$row["carry_country"];
		$x_carry_zipcode = @$row["carry_zipcode"];
		$x_carry_city = @$row["carry_city"];
		$x_carry_address = @$row["carry_address"];
		$x_bill_surname = @$row["bill_surname"];
		$x_bill_forename = @$row["bill_forename"];
		$x_bill_country = @$row["bill_country"];
		$x_bill_zipcode = @$row["bill_zipcode"];
		$x_bill_city = @$row["bill_city"];
		$x_bill_address = @$row["bill_address"];
		$x_lang_id = @$row["lang_id"];
		$x_active = IntToBoolean(@$row["active"]);
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$x_visitcounter = @$row["visitcounter"];
		$x_lastvisit = @$row["lastvisit"];
		break;
	case "U": // update
		// get the form values
		$x_id = @$_POST["x_id"];
		$x_shortname = @$_POST["x_shortname"];
		$x_password = @$_POST["x_password"];
		$x_group_id = @$_POST["x_group_id"];
		$x_email = @$_POST["x_email"];
		$x_surname = @$_POST["x_surname"];
		$x_forename = @$_POST["x_forename"];
		$x_country = @$_POST["x_country"];
		$x_zipcode = @$_POST["x_zipcode"];
		$x_city = @$_POST["x_city"];
		$x_address = @$_POST["x_address"];
		$x_phone = @$_POST["x_phone"];
		$x_cellphone = @$_POST["x_cellphone"];
		$x_newsletter = @$_POST["x_newsletter"];
		$x_carry_surname = @$_POST["x_carry_surname"];
		$x_carry_forename = @$_POST["x_carry_forename"];
		$x_carry_country = @$_POST["x_carry_country"];
		$x_carry_zipcode = @$_POST["x_carry_zipcode"];
		$x_carry_city = @$_POST["x_carry_city"];
		$x_carry_address = @$_POST["x_carry_address"];
		$x_bill_surname = @$_POST["x_bill_surname"];
		$x_bill_forename = @$_POST["x_bill_forename"];
		$x_bill_country = @$_POST["x_bill_country"];
		$x_bill_zipcode = @$_POST["x_bill_zipcode"];
		$x_bill_city = @$_POST["x_bill_city"];
		$x_bill_address = @$_POST["x_bill_address"];
		$x_website = @$_POST["x_website"];
		$x_lang_id = @$_POST["x_lang_id"];
		$x_active = BooleanToInt(@$_POST["x_active"]);
		$x_insert_user_id = @$_POST["x_insert_user_id"];
		$x_insert_datetime = @$_POST["x_insert_datetime"];
		$x_modify_user_id = @$_POST["x_modify_user_id"];
		$x_modify_datetime = @$_POST["x_modify_datetime"];
		$x_visitcounter = @$_POST["x_visitcounter"];
		$x_lastvisit = @$_POST["x_lastvisit"];
		// Duplicate controll
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id!=".$x_id." AND shortname='" . $x_shortname . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = "Már van ilyen Felhasználó!";
			$x_fieldfocus = "x_shortname";
			}
		mysqli_free_result($rs);
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			$tkey = "" . $key . "";
			// add the values into an array

			// shortname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_shortname) : $x_shortname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`shortname`"] = $theValue;

			// password
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_password) : $x_password;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`password`"] = $theValue;

			// group_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_group_id) : $x_group_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`group_id`"] = $theValue;

			// email
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_email) : $x_email;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`email`"] = $theValue;

			// website
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_website) : $x_website;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`website`"] = $theValue;

			// surname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_surname) : $x_surname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`surname`"] = $theValue;

			// forename
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_forename) : $x_forename;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`forename`"] = $theValue;

			// country
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_country) : $x_country;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`country`"] = $theValue;

			// zipcode
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_zipcode) : $x_zipcode;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`zipcode`"] = $theValue;

			// city
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_city) : $x_city;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`city`"] = $theValue;

			// address
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_address) : $x_address;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`address`"] = $theValue;

			// phone
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_phone) : $x_phone;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`phone`"] = $theValue;

			// cellphone
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_cellphone) : $x_cellphone;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`cellphone`"] = $theValue;

			// newsletter
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_newsletter) : $x_newsletter;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`newsletter`"] = $theValue;

			// carry_surname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_surname) : $x_carry_surname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_surname`"] = $theValue;

			// carry_forename
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_forename) : $x_carry_forename;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_forename`"] = $theValue;

			// carry_country
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_country) : $x_carry_country;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_country`"] = $theValue;

			// carry_zipcode
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_zipcode) : $x_carry_zipcode;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_zipcode`"] = $theValue;

			// carry_city
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_city) : $x_carry_city;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_city`"] = $theValue;

			// carry_address
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_carry_address) : $x_carry_address;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`carry_address`"] = $theValue;

			// bill_surname
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_surname) : $x_bill_surname;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_surname`"] = $theValue;

			// bill_forename
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_forename) : $x_bill_forename;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_forename`"] = $theValue;

			// bill_country
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_country) : $x_bill_country;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_country`"] = $theValue;

			// bill_zipcode
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_zipcode) : $x_bill_zipcode;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_zipcode`"] = $theValue;

			// bill_city
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_city) : $x_bill_city;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_city`"] = $theValue;

			// bill_address
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_bill_address) : $x_bill_address;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`bill_address`"] = $theValue;

			// lang_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`lang_id`"] = $theValue;

			// active
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`active`"] = $theValue;

			// modify_user_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_modify_id) : $x_modify_user_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`modify_user_id`"] = $theValue;

			// modify_datetime
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
			$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
			$fieldList["`modify_datetime`"] = $theValue;

			// visitcounter
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`visitcounter`"] = $theValue;

			// lastvisit
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lastvisit) : $x_lastvisit;
			$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
			$fieldList["`lastvisit`"] = $theValue;

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
			$updateSQL .= " WHERE id=".$x_id;
		  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
			$mail_to = $x_email;
			$mail_subject = "MAFOR adatváltozás";
			$mail_message = "MAFOR\n"
			. "Felhasználó: " . $x_shortname
			. "\nJelszó: " . $x_password;
/*
			if (mail($mail_to, $mail_subject, $mail_message))
				{
				jumptopage($base_modul);
				break;
				}
			else 
				{
				print ("<br><font color='red'>Levél elküdése sikertelen.</font>");
				}
*/
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
function carryfill()
	{
	if (document.editform.x_carry.value==0)
		{
		document.editform.x_carry.value = 1;
		document.editform.x_carry_surname.value = document.editform.x_surname.value;
		document.editform.x_carry_forename.value = document.editform.x_forename.value;
		document.editform.x_carry_country.value = document.editform.x_country.value;
		document.editform.x_carry_zipcode.value = document.editform.x_zipcode.value;
		document.editform.x_carry_city.value = document.editform.x_city.value;
		document.editform.x_carry_address.value = document.editform.x_address.value;
		}
	else
		{
		document.editform.x_carry.value = 0;
		document.editform.x_carry_surname.value = '';
		document.editform.x_carry_forename.value = '';
		document.editform.x_carry_country.value = '';
		document.editform.x_carry_zipcode.value = '';
		document.editform.x_carry_city.value = '';
		document.editform.x_carry_address.value = '';
		}
	}

function billfill()
	{
	if (document.editform.x_bill.value==0)
		{
		document.editform.x_bill.value = 1;
		document.editform.x_bill_surname.value = document.editform.x_carry_surname.value;
		document.editform.x_bill_forename.value = document.editform.x_carry_forename.value;
		document.editform.x_bill_country.value = document.editform.x_carry_country.value;
		document.editform.x_bill_zipcode.value = document.editform.x_carry_zipcode.value;
		document.editform.x_bill_city.value = document.editform.x_carry_city.value;
		document.editform.x_bill_address.value = document.editform.x_carry_address.value;
		}
	else
		{
		document.editform.x_bill.value = 0;
		document.editform.x_bill_surname.value = '';
		document.editform.x_bill_forename.value = '';
		document.editform.x_bill_country.value = '';
		document.editform.x_bill_zipcode.value = '';
		document.editform.x_bill_city.value = '';
		document.editform.x_bill_address.value = '';
		}
	}

function  EW_checkMyForm(EW_this) 
	{
	if (EW_this.x_shortname && !EW_hasValue(EW_this.x_shortname, "TEXT" ))
		{
		document.editform.errortext.value = "Üres Rövidnév!";
		document.editform.fieldfocus.value = "x_shortname";
		return true; 
	        }
	if (EW_this.x_password && !EW_hasValue(EW_this.x_password, "PASSWORD" ))
		{
		document.editform.errortext.value = "Üres Jelszó!";
		document.editform.fieldfocus.value = "x_password";
		return true;
	        }
	if (EW_this.x_password2 && !EW_hasValue(EW_this.x_password2, "PASSWORD" ))
		{
		document.editform.errortext.value = "Üres Jelszó megerosítése!";
		document.editform.fieldfocus.value = "x_password2";
		return true;
	        }
	if (EW_this.x_password.value != EW_this.x_password2.value)
		{
		document.editform.errortext.value = "Hibás Jelszó megerosítés!";
		document.editform.fieldfocus.value = "x_password2";
		return true;
	        }
	if (EW_this.x_email && !EW_hasValue(EW_this.x_email, "TEXT" ))
		{
		document.editform.errortext.value = "Üres E-mail!";
		document.editform.fieldfocus.value = "x_email";
		return true; 
	        }
	if (EW_this.x_email && !EW_checkemail(EW_this.x_email.value))
		{
		document.editform.errortext.value = "Hibás E-mail!";
		document.editform.fieldfocus.value = "x_email";
	        return true; 
	        }
	/*
	if (EW_this.x_lang_id && !EW_hasValue(EW_this.x_lang_id, "SELECT" ))
		{
		document.editform.errortext.value = "Hibás Nyelv!";
		document.editform.fieldfocus.value = "x_lang_id";
	        return true; 
	        }
	*/
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
$html_page .= "<input type='hidden' name='x_shortname' value='" . $x_shortname . "'>";
$html_page .= "<input type='hidden' name='x_modify_user_id' value='" . $x_user_id . "'>";
$html_page .= "<input type='hidden' name='x_modify_datetime' value='" . date('Y.m.d H:i:s<br>',time()) . "'>";
$html_page .= "<input type='hidden' name='x_which_back' value='" . $which_back . "'>";
//$html_page .= "<input type='hidden' name='x_group_id' value='" . $x_group_id . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr align='center'>";
$html_page .= "<td valign='top' align='center'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Felhasználói név *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><b>" . $x_shortname . "</b></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Jelszó *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='password' name='x_password' value='" . @$x_password . "' size=22 maxlength=20></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Jelszó megerosítése *</font>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='password' name='x_password2' value='" . @$x_password2 . "' size=22 maxlength=20></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>E-mail cím *</font>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_email' size='50' maxlength='50' value='" . htmlspecialchars(@$x_email) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Honlap</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_website' size='50' maxlength='50' value='" . htmlspecialchars(@$x_website) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Szint</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><table border='0' cellspacing='0' cellpadding='0'><tr><td>";
$html_page .= "<td><span class='phpmaker'>";
if (empty($x_group_id))
	{
	$x_group_id = 0;
	} // set default value
$x_group_idList = "<select name=\"x_group_id\"><option value=\"\">----------</option>";
$cbo_x_group_id_js = ""; // initialise
$sqlwrk = "SELECT id, name FROM groups WHERE id>=".@$_SESSION[$which_system . "status_UserLevel"];
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_group_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_group_id)
			{
			$x_group_idList .= " selected";
			}
		$x_group_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_group_idList .= "</select>";
$html_page .= $x_group_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "<td>";
//$html_page .= "<a href='dictionarylist.php?whichdb=" . $which_modul . "_topic&header=".$modul_header." téma&cmd=resetall'><img src='" . $image_button . "dictionary.gif' border=0 name='dictionary' Alt='Kódszótár'></a>";
$html_page .= "</td></tr></table></td>";
$html_page .= "</tr>";
if ($ewCurIdx == 1 || $ewCurIdx ==-1) 
	{ // system admin 
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Nyelv</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if (empty($x_lang_id))
		{
		$x_lang_id = 0;
		} // set default value
	$x_lang_idList = "<select name=\"x_lang_id\">";
	$cbo_x_lang_id_js = ""; // initialise
	$sqlwrk = "SELECT `id`, `name` FROM `language`";
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	if ($rswrk)
		{
		$rowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($rswrk))
			{
			$x_lang_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
			if ($datawrk["id"] == @$x_lang_id)
				{
				$x_lang_idList .= " selected";
				}
			$x_lang_idList .= ">" . $datawrk["name"] . "</option>";
			$rowcntwrk++;
			}
		}
	@mysqli_free_result($rswrk);
	$x_lang_idList .= "</select>";
	$html_page .= $x_lang_idList;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
else
	{
	$html_page .= "<input type='hidden' name='x_lang_id' value='" . @$_SESSION[$which_system . "status_UserLangID"] . "'>";
	}
$html_page .= activateTr("x_active","active");
if ($basket == "1")
	{
	$html_page .= "<tr>";
	$html_page .= "<td align='center' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Megrendeléshez az alábbi adatok kitöltése is szükséges!</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_surname) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_address) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telefonszám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_phone' size='22' maxlength='20' value='" . htmlspecialchars(@$x_phone) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Mobiltelefonszám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_cellphone' size='22' maxlength='20' value='" . htmlspecialchars(@$x_cellphone) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Feliratkozás hírlevélre</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
if ($x_newsletter != 0) 
	{
	$html_page .= "<INPUT NAME='x_newsletter' TYPE='checkbox' CHECKED value='1'>";
	}
else
	{
	$html_page .= "<INPUT NAME='x_newsletter' TYPE='checkbox' value='0'>";
	}
$html_page .= "</td>";
$html_page .= "</tr>";
if ($basket == "1")
	{
	$html_page .= "<tr>";
	$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Szállítási cím</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'>";
	$html_page .= "<td colspan='2' bgcolor='" . $color6 . "'><span class='phpmaker'>Megegyezik Felhasználó címével";
	if ($x_carry != 0) 
		{
		$html_page .= "<INPUT NAME='x_carry' TYPE='checkbox' CHECKED value='1' onClick='javascript:carryfill();'>";
		}
	else
		{
		$html_page .= "<INPUT NAME='x_carry' TYPE='checkbox' value='0' onClick='javascript:carryfill();'>";
		}
	$html_page .= "</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_surname) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_carry_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_carry_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_address) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Számlázási cím</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'>";
	$html_page .= "<td colspan='2' bgcolor='" . $color6 . "'><span class='phpmaker'>Megegyezik a szállítási címmel";
	if ($x_bill != 0) 
		{
		$html_page .= "<INPUT NAME='x_bill' TYPE='checkbox' CHECKED value='1' onClick='javascript:billfill();'>";
		}
	else
		{
		$html_page .= "<INPUT NAME='x_bill' TYPE='checkbox' value='0' onClick='javascript:billfill();'>";
		}
	$html_page .= "</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_surname) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_bill_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_bill_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_address) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
footer("edit");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.editform.fieldfocus.value)
	{
	case "x_password" : document.editform.x_password.focus();
		break;
	case "x_password2" : document.editform.x_password2.focus();
		break;
	case "x_email" : document.editform.x_email.focus();
		break;
	default : document.editform.x_password.focus();
	}
-->
</script>
