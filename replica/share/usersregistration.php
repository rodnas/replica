<?php 
// Module properties
$which_back = "list&modul_select=".$home_modul."&cmd=resetall";

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

//$duplicate_yes = "";
// open connection to the database
$conn = mysqli_connect(HOST, USER, PASS);
mysqli_select_db(DB);
switch ($a)
	{
	case "A": // add
		// get the form values
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
		$x_insert_datetime = @$_POST["x_insert_datetime"];
		$x_visitcounter = @$_POST["x_visitcounter"];
		$x_lastvisit = @$_POST["x_lastvisit"];

		// Duplicate controll
		$strsql = "SELECT * FROM ".$modul_select." WHERE shortname='" . $x_shortname . "'";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) != 0) 
			{	
			$x_errortext = "M�r van ilyen felhaszn�l�!";
			$x_fieldfocus = "x_shortname";
			}
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
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

			// insert_datetime
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
			$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
			$fieldList["`insert_datetime`"] = $theValue;

			// visitcounter
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`visitcounter`"] = $theValue;

			// lastvisit
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lastvisit) : $x_lastvisit;
			$theValue = ($theValue != "") ? " '" . ConvertDateToMysqlFormat($theValue) . "'" : "NULL";
			$fieldList["`lastvisit`"] = $theValue;

			// insert into database
			$strsql = "INSERT INTO ".$modul_select." (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
			$mail_to = $x_email;
			$mail_subject = "MAFOR regisztr�ci�";
			$mail_message = "MAFOR\n"
			. "�dv�z�lj�k!\n"
			. "�n regisztr�lta mag�t a honlapunkon!\n"
			. "Felhaszn�l�: " . $x_shortname . "\n"
			. "\nJelsz�: " . $x_password . "";
			jumptopage($base_modul);
/*
			if (mail($mail_to, $mail_subject, $mail_message))
				{
				jumptopage($base_modul);
				break;
				}
			else 
				{
				print ("<br><font color='red'>Lev�l elk�d�se sikertelen.</font>");
				}
*/
			break;
			}
		}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<script language=\"JavaScript\" src=\"" . $js_path . "ew.js\"></script>";
?>
<script language="JavaScript">
<!-- start Javascript
function carryfill()
	{
	if (document.addform.x_carry.value==0)
		{
		document.addform.x_carry.value = 1;
		document.addform.x_carry_surname.value = document.addform.x_surname.value;
		document.addform.x_carry_forename.value = document.addform.x_forename.value;
		document.addform.x_carry_country.value = document.addform.x_country.value;
		document.addform.x_carry_zipcode.value = document.addform.x_zipcode.value;
		document.addform.x_carry_city.value = document.addform.x_city.value;
		document.addform.x_carry_address.value = document.addform.x_address.value;
		}
	else
		{
		document.addform.x_carry.value = 0;
		document.addform.x_carry_surname.value = '';
		document.addform.x_carry_forename.value = '';
		document.addform.x_carry_country.value = '';
		document.addform.x_carry_zipcode.value = '';
		document.addform.x_carry_city.value = '';
		document.addform.x_carry_address.value = '';
		}
	}

function billfill()
	{
	if (document.addform.x_bill.value==0)
		{
		document.addform.x_bill.value = 1;
		document.addform.x_bill_surname.value = document.addform.x_carry_surname.value;
		document.addform.x_bill_forename.value = document.addform.x_carry_forename.value;
		document.addform.x_bill_country.value = document.addform.x_carry_country.value;
		document.addform.x_bill_zipcode.value = document.addform.x_carry_zipcode.value;
		document.addform.x_bill_city.value = document.addform.x_carry_city.value;
		document.addform.x_bill_address.value = document.addform.x_carry_address.value;
		}
	else
		{
		document.addform.x_bill.value = 0;
		document.addform.x_bill_surname.value = '';
		document.addform.x_bill_forename.value = '';
		document.addform.x_bill_country.value = '';
		document.addform.x_bill_zipcode.value = '';
		document.addform.x_bill_city.value = '';
		document.addform.x_bill_address.value = '';
		}
	}

function  EW_checkMyForm(EW_this)
	{
	if (EW_this.x_shortname && !EW_hasValue(EW_this.x_shortname, "TEXT" ))
		{
		document.addform.errortext.value = "�res Felhaszn�l�i n�v!";
		document.addform.fieldfocus.value = "x_shortname";
		return true; 
	        }
	if (EW_this.x_password && !EW_hasValue(EW_this.x_password, "PASSWORD" ))
		{
		document.addform.errortext.value = "�res Jelsz�!";
		document.addform.fieldfocus.value = "x_password";
		return true;
	        }
	if (EW_this.x_password2 && !EW_hasValue(EW_this.x_password2, "PASSWORD" ))
		{
		document.addform.errortext.value = "�res Jelsz� meger�s�t�se!";
		document.addform.fieldfocus.value = "x_password2";
		return true;
	        }
	if (EW_this.x_password.value != EW_this.x_password2.value)
		{
		document.addform.errortext.value = "Hib�s Jelsz� meger�s�t�s!";
		document.addform.fieldfocus.value = "x_password2";
		return true;
	        }
	if (EW_this.x_email && !EW_hasValue(EW_this.x_email, "TEXT" ))
		{
		document.addform.errortext.value = "�res E-mail!";
		document.addform.fieldfocus.value = "x_email";
		return true; 
	        }
	if (EW_this.x_email && !EW_checkemail(EW_this.x_email.value))
		{
		document.addform.errortext.value = "Hib�s E-mail!";
		document.addform.fieldfocus.value = "x_email";
	        return true; 
	        }
	/*
	if (EW_this.x_lang_id && !EW_hasValue(EW_this.x_lang_id, "SELECT" ))
		{
		document.addform.errortext.value = "Hib�s Nyelv!";
		document.addform.fieldfocus.value = "x_lang_id";
	        return true; 
	        }
	*/
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
$html_page .= "<input type='hidden' name='x_insert_datetime' value='" . date('Y.m.d H:i:s<br>',time()) . "'>";
$html_page .= "<input type='hidden' name='x_group_id' value='5'>";
$html_page .= "<input type='hidden' name='x_lang_id' value='" . @$_SESSION[$which_system . "status_UserLangID"] . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr>";
$html_page .= "<td valign='top' align='center'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Felhaszn�l�i n�v *&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_shortname' size='22' maxlength='20' value='" . htmlspecialchars(@$x_shortname) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Jelsz� *&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='password' name='x_password' value='" . @$x_password . "' size=22 maxlength=20></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Jelsz� meger�s�t�se *&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='password' name='x_password2' value='" . @$x_password2 . "' size=22 maxlength=20></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>E-mail c�m *&nbsp;</span></td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_email' size='50' maxlength='50' value='" . htmlspecialchars(@$x_email) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Honlap</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_website' size='50' maxlength='50' value='" . htmlspecialchars(@$x_website) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
if ($basket == "1")
	{
	$html_page .= "<tr>";
	$html_page .= "<td align='center' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Megrendel�shez az al�bbi adatok kit�lt�se is sz�ks�ges!</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Csal�di n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_surname) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ut�n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Orsz�g</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ir�ny�t�sz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telep�l�s</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, h�zsz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_address) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telefonsz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_phone' size='22' maxlength='20' value='" . htmlspecialchars(@$x_phone) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Mobiltelefonsz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_cellphone' size='22' maxlength='20' value='" . htmlspecialchars(@$x_cellphone) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Feliratkoz�s h�rlev�lre</span>&nbsp;</td>";
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
	$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Sz�ll�t�si c�m</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'>";
	$html_page .= "<td colspan='2' bgcolor='" . $color6 . "'><span class='phpmaker'>Megegyezik Felhaszn�l� c�m�vel";
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
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Csal�di n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_surname) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ut�n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Orsz�g</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ir�ny�t�sz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_carry_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telep�l�s</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_carry_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, h�zsz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_carry_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_carry_address) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Sz�ml�z�si c�m</strong></font></td>";
	$html_page .= "</tr>";
	$html_page .= "<tr align='center'>";
	$html_page .= "<td colspan='2' bgcolor='" . $color6 . "'><span class='phpmaker'>Megegyezik a sz�ll�t�si c�mmel";
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
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Csal�di n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_surname' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_surname) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ut�n�v</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_forename' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_forename) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Orsz�g</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_country' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_country) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ir�ny�t�sz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_zipcode' size='6' maxlength='4' value='" . htmlspecialchars(@$x_bill_zipcode) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telep�l�s</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_city' size='40' maxlength='40' value='" . htmlspecialchars(@$x_bill_city) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, h�zsz�m</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_bill_address' size='50' maxlength='60' value='" . htmlspecialchars(@$x_bill_address) ."'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_shortname" : document.addform.x_shortname.focus();
		break;
	case "x_password" : document.addform.x_password.focus();
		break;
	case "x_password2" : document.addform.x_password2.focus();
		break;
	case "x_email" : document.addform.x_email.focus();
		break;
	default : document.addform.x_shortname.focus();
		break;
	}
-->
</script>
