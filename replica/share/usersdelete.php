<?php
// Module properties
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowdelete) <> ewAllowdelete) jumptopage("index.php?modul_action=" . $which_back);
if (@$_SESSION[$which_system . "status_UserLevel"] != 2 && @$_SESSION[$which_system . "status_UserLevel"] != 3) 
	jumptopage($base_modul);
// single delete record
$key = @$_GET["key"];
if (empty($key))
	{
	$key = @$_POST["key"];
	}
if (empty($key))
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}
$sqlKey = "id=" . "" . $key . "";

// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	// display
	}

switch ($a)
	{
	case "I": // display
		$strsql = "SELECT * FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "D": // delete
		$strsql = "DELETE FROM " . $modul_select . " WHERE " . $sqlKey;
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		$strsql = "DELETE FROM " . $modul_select . "_permissions WHERE user_id=" . "".$key."";
		$rs =	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		jumptopage("index.php?modul_action=" . $which_back);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form method='post' name='deleteform'>";
$html_page .= "<input type='hidden' name='a' value='D'>";
$html_page .= "<input type='hidden' name='key' value='" . $key . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr align='center'>";
$html_page .= "<td valign='top'>";
$html_page .= "<table width='60%' border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
	$bgcolor = $color4; // row color
	if ($recCount % 2 <> 0 )
		{
		$bgcolor=$color5; // alternate row color
		}
	$x_id = @$row["id"];
	$x_user_id = $x_id;
	$x_shortname = @$row["shortname"];
	$x_password = @$row["password"];
	$x_email = @$row["email"];
	$x_group_id = @$row["group_id"];
	$x_lang_id = @$row["lang_id"];
	$x_visitcounter = @$row["visitcounter"];
	$x_lastvisit = @$row["lastvisit"];
	$x_id = @$row["id"];
	$x_user_id = @$row["user_id"];
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
	$x_active = @$row["active"];
	$x_insert_user_id = @$row["insert_user_id"];
	$x_insert_datetime = @$row["insert_datetime"];
	$x_modify_user_id = @$row["modify_user_id"];
	$x_modify_datetime = @$row["modify_datetime"];
	$html_page .= "<tr>";
	$html_page .= "<td width='120' bgcolor='" . $actcolor . "'><span class='phpmaker'>Rövidnév</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_shortname . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>E-mail</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_email . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Honlap</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_website . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Szint</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if ($x_group_id != NULL)
		{
		$sqlwrk = "SELECT id, name FROM groups";
		$sqlwrk_where = "";
		$sqlwrk_where .= "id = " . $x_group_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_group_id = $rowwrk["name"];
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= $x_group_id;
	$html_page .= "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	if (!is_null($x_lang_id))
		{
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Nyelv</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
		$sqlwrk = "SELECT `id`, `name`, `pictURL` FROM `language`";
		$sqlwrk_where = "";
		$sqlwrk_where .= "`id` = " . $x_lang_id;
		if ($sqlwrk_where <> "" ) 
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
			{
			$x_lang_id = $rowwrk["name"];
			}
		if (!is_null($rowwrk["pictURL"])) 
			{ 
			$html_page .= "<img src='" . $rowwrk["pictURL"] . "' border='0'>";
			} 
		else 
			{
			$html_page .= $rowwrk["name"];
			}
		@mysqli_free_result($rswrk);
		$html_page .= "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		}
	$html_page .= activeTr($x_active,"active",$enable["yes"],$enable["no"]);
	if ($basket == "1")
		{
		$html_page .= "<tr>";
		$html_page .= "<td align='center' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Megrendeléshez az alábbi adatok szükségesek!</strong></font></td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_surname . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
		$html_page .= "<td width='400' bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_forename . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_country . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_zipcode . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_city . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_address . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Telefonszám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_phone . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Mobiltelefonszám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_cellphone . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		}
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Feliratkozás hírlevélre</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>";
	if ($x_newsletter != 0) 
		{
		$html_page .= "<img src='images/public/pipa.gif' border='0'>";
		}
	else
		{
		$html_page .= "<img src='images/public/x.gif' border='0'>";
		}
	$html_page .= "</td>";
	$html_page .= "</tr>";
	if ($basket == "1")
		{
		$html_page .= "<tr>";
		$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Szállítási cím</strong></font></td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_surname . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_forename . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_country . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_zipcode . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_city . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_carry_address . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td align='left' colspan='2' bgcolor ='#CCCCCC' style='border-style:solid;groove;border-color:#000066;border-width:thin'><font color='#000066' class='phpmaker'><strong>Számlázási cím</strong></font></td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Családi név</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_surname . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utónév</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_forename . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Ország</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_country . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Irányítószám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_zipcode . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Település</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_city . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>Utca, házszám</span>&nbsp;</td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_bill_address . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		}
	}
footer("delete");
?>
