<?php
// Module properties
sharefieldinit();
$nocopy = true;

// get search criteria for advanced search

// field "id"
$x_id = @$_GET["x_id"];
$z_id = @$_GET["z_id"];
$z_id = (get_magic_quotes_gpc()) ? stripslashes($z_id) : $z_id;
$arrfieldopr = explode(",", $z_id);
if ($x_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_id = (!get_magic_quotes_gpc()) ? addslashes($x_id) : $x_id;
	$a_search = $a_search . "`id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_id . $arrfieldopr[2] . " AND ";
	}

// field "name"
$x_name = @$_GET_["x_name"];
$z_name = @$_GET_["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3)
	{
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
	}

// field "country"
$x_country = @$_GET["x_country"];
$z_country = @$_GET["z_country"];
$z_country = (get_magic_quotes_gpc()) ? stripslashes($z_country) : $z_country;
$arrfieldopr = explode(",", $z_country);
if ($x_country <> "" && count($arrfieldopr) >= 3)
	{
	$x_country = (!get_magic_quotes_gpc()) ? addslashes($x_country) : $x_country;
	$a_search = $a_search . "`country` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_country . $arrfieldopr[2] . " AND ";
	}

// field "zipcode"
$x_zipcode = @$_GET["x_zipcode"];
$z_zipcode = @$_GET["z_zipcode"];
$z_zipcode = (get_magic_quotes_gpc()) ? stripslashes($z_zipcode) : $z_zipcode;
$arrfieldopr = explode(",", $z_zipcode);
if ($x_zipcode <> "" && count($arrfieldopr) >= 3)
	{
	$x_zipcode = (!get_magic_quotes_gpc()) ? addslashes($x_zipcode) : $x_zipcode;
	$a_search = $a_search . "`zipcode` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_zipcode . $arrfieldopr[2] . " AND ";
	}

// field "city"
$x_city = @$_GET["x_city"];
$z_city = @$_GET["z_city"];
$z_city = (get_magic_quotes_gpc()) ? stripslashes($z_city) : $z_city;
$arrfieldopr = explode(",", $z_city);
if ($x_city <> "" && count($arrfieldopr) >= 3)
	{
	$x_city = (!get_magic_quotes_gpc()) ? addslashes($x_city) : $x_city;
	$a_search = $a_search . "`city` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_city . $arrfieldopr[2] . " AND ";
	}

// field "address"
$x_address = @$_GET["x_address"];
$z_address = @$_GET["z_address"];
$z_address = (get_magic_quotes_gpc()) ? stripslashes($z_address) : $z_address;
$arrfieldopr = explode(",", $z_address);
if ($x_address <> "" && count($arrfieldopr) >= 3)
	{
	$x_address = (!get_magic_quotes_gpc()) ? addslashes($x_address) : $x_address;
	$a_search = $a_search . "`address` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_address . $arrfieldopr[2] . " AND ";
	}

// field "phone"
$x_phone = @$_GET["x_phone"];
$z_phone = @$_GET["z_phone"];
$z_phone = (get_magic_quotes_gpc()) ? stripslashes($z_phone) : $z_phone;
$arrfieldopr = explode(",", $z_phone);
if ($x_phone <> "" && count($arrfieldopr) >= 3)
	{
	$x_phone = (!get_magic_quotes_gpc()) ? addslashes($x_phone) : $x_phone;
	$a_search = $a_search . "`phone` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_phone . $arrfieldopr[2] . " AND ";
	}

// field "email"
$x_email = @$_GET["x_email"];
$z_email = @$_GET["z_email"];
$z_email = (get_magic_quotes_gpc()) ? stripslashes($z_email) : $z_email;
$arrfieldopr = explode(",", $z_email);
if ($x_email <> "" && count($arrfieldopr) >= 3)
	{
	$x_email = (!get_magic_quotes_gpc()) ? addslashes($x_email) : $x_email;
	$a_search = $a_search . "`email` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_email . $arrfieldopr[2] . " AND ";
	}

// field "pictURL"
$x_pictURL = @$_GET["x_pictURL"];
$z_pictURL = @$_GET["z_pictURL"];
$z_pictURL = (get_magic_quotes_gpc()) ? stripslashes($z_pictURL) : $z_pictURL;
$arrfieldopr = explode(",", $z_pictURL);
if ($x_pictURL <> "" && count($arrfieldopr) >= 3)
	{
	$x_pictURL = (!get_magic_quotes_gpc()) ? addslashes($x_pictURL) : $x_pictURL;
	$a_search = $a_search . "`pictURL` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_pictURL . $arrfieldopr[2] . " AND ";
	}

// field "lang_id"
$x_lang_id = @$_GET["x_lang_id"];
$z_lang_id = @$_GET["z_lang_id"];
$z_lang_id = (get_magic_quotes_gpc()) ? stripslashes($z_lang_id) : $z_lang_id;
$arrfieldopr = explode(",", $z_lang_id);
if ($x_lang_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_lang_id = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
	$a_search = $a_search . "`lang_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lang_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_user_id"
$x_insert_user_id = @$_GET["x_insert_user_id"];
$z_insert_user_id = @$_GET["z_insert_user_id"];
$z_insert_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_insert_user_id) : $z_insert_user_id;
$arrfieldopr = explode(",", $z_insert_user_id);
if ($x_insert_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
	$a_search = $a_search . "`insert_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_user_id . $arrfieldopr[2] . " AND ";
	}

// field "insert_datetime"
$x_insert_datetime = @$_GET["x_insert_datetime"];
$z_insert_datetime = @$_GET["z_insert_datetime"];
$z_insert_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_insert_datetime) : $z_insert_datetime;
$arrfieldopr = explode(",", $z_insert_datetime);
if ($x_insert_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_insert_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_insert_datetime) : $x_insert_datetime;
	$a_search = $a_search . "`insert_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_insert_datetime . $arrfieldopr[2] . " AND ";
	}

// field "modify_user_id"
$x_modify_user_id = @$_GET["x_modify_user_id"];
$z_modify_user_id = @$_GET["z_modify_user_id"];
$z_modify_user_id = (get_magic_quotes_gpc()) ? stripslashes($z_modify_user_id) : $z_modify_user_id;
$arrfieldopr = explode(",", $z_modify_modify_id);
if ($x_modify_user_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_user_id = (!get_magic_quotes_gpc()) ? addslashes($x_modify_user_id) : $x_modify_user_id;
	$a_search = $a_search . "`modify_user_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_user_id . $arrfieldopr[2] . " AND ";
	}

// field "modify_datetime"
$x_modify_datetime = @$_GET["x_modify_datetime"];
$z_modify_datetime = @$_GET["z_modify_datetime"];
$z_modify_datetime = (get_magic_quotes_gpc()) ? stripslashes($z_modify_datetime) : $z_modify_datetime;
$arrfieldopr = explode(",", $z_modify_datetime);
if ($x_modify_datetime <> "" && count($arrfieldopr) >= 3)
	{
	$x_modify_datetime = (!get_magic_quotes_gpc()) ? addslashes($x_modify_datetime) : $x_modify_datetime;
	$a_search = $a_search . "`modify_datetime` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_modify_datetime . $arrfieldopr[2] . " AND ";
	}

// field "visitcounter"
$x_visitcounter = @$_GET["x_visitcounter"];
$z_visitcounter = @$_GET["z_visitcounter"];
$z_visitcounter = (get_magic_quotes_gpc()) ? stripslashes($z_visitcounter) : $z_visitcounter;
$arrfieldopr = explode(",", $z_visitcounter);
if ($x_visitcounter <> "" && count($arrfieldopr) >= 3)
	{
	$x_visitcounter = (!get_magic_quotes_gpc()) ? addslashes($x_visitcounter) : $x_visitcounter;
	$a_search = $a_search . "`visitcounter` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_visitcounter . $arrfieldopr[2] . " AND ";
	}

// field "lastvisit"
$x_lastvisit = @$_GET["x_lastvisit"];
$z_lastvisit = @$_GET["z_lastvisit"];
$z_lastvisit = (get_magic_quotes_gpc()) ? stripslashes($z_lastvisit) : $z_lastvisit;
$arrfieldopr = explode(",", $z_lastvisit);
if ($x_lastvisit <> "" && count($arrfieldopr) >= 3)
	{
	$x_lastvisit = (!get_magic_quotes_gpc()) ? addslashes($x_lastvisit) : $x_lastvisit;
	$a_search = $a_search . "`lastvisit` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_lastvisit . $arrfieldopr[2] . " AND ";
	}
if (strlen($a_search) > 4)
	{
	$a_search = substr($a_search, 0, strlen($a_search)-4);
	}

// get search criteria for basic search
$pSearch = @$_POST["psearch"];
$pSearchOriginal = $pSearch;
$pSearchType = @$_POST["psearchtype"];
if ($pSearch <> "")
	{
	psearchtypeset(); // 2005.10.15. New version
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = $pSearchOriginal;
	if ($pSearchType <> "")
		{
		while (strpos($pSearch, "  ") > 0)
			{
			$pSearch = str_Replace("  ", " ",$pSearch);
			}
		$arpSearch = explode(" ", trim($pSearch));
		foreach ($arpSearch as $kw)
			{
			$b_search .= "(";
			$b_search .= "`name` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`country` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`zipcode` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`city` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`address` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`phone` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`email` LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "`pictURL` LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "`name` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`country` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`zipcode` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`city` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`address` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`phone` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`email` LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "`pictURL` LIKE '%" . $pSearch . "%' OR ";
		}
	}
if (substr($b_search, -4) == " OR ")
	{
	$b_search = substr($b_search, 0, strlen($b_search)-4);
	}
if (substr($b_search, -5) == " AND ")
	{
	$b_search = substr($b_search, 0, strlen($b_search)-5);
	}

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

// default filter
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "";
	}
else
	{
	$DefaultFilter = "active=1";
	}

checkorder();
// build SQL
$strsql = "SELECT * FROM " . $modul_select;
buildsql();
$rs = mysqli_query($GLOBALS['conn'],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));

checkstart();
include ($share_path . "header1.php");
$html_page .= header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";
$html_page .= "<tr valign='center' height='15'><td bgcolor='" . $color1 . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='" . $color2 . "' align='center'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"addressOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"phoneOrderHead");
$html_page .= "</td>";
$html_page .= "<td width='50' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"emailTitle")."&nbsp;</span></td>";
$html_page .= "<td width='50' align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"websiteTitle")."&nbsp;</span></td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height=2><td></td></tr>";

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
		$bgcolor = $color4; // set row color
		if (($recCount % 2) <> 0)
			{ // display alternate color for rows
			$bgcolor = $color5;
			}

		// load key for record
		$key = @$row["id"];
		$x_name = @$row["name"];
		$x_country = @$row["country"];
		$x_zipcode = @$row["zipcode"];
		$x_city = @$row["city"];
		$x_address = @$row["address"];
		$x_phone = @$row["phone"];
		$x_fax = @$row["fax"];
		$x_email = @$row["email"];
		if (!is_null(@$row["pictURL"])) 
			$x_pictURL = $modul_image_path . @$row["pictURL"]; 
		else 
			$x_pictURL="";
		$x_directorname = @$row["directorname"];
		$x_contactname = @$row["contactname"];
		$x_factor = @$row["factor"];
		sharefromtable();
		$html_page .= "<tr valign='center' align='top' bgcolor='" . $bgcolor. "'><td align='left'><table><tr><td>";
		if ((@$row["id"] != NULL))
			{
			$html_page .= "<a href='index.php?modul_action=view&key=" . urlencode($x_id) . "'>";
			}
		else
			{
			$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
			}
		if (!empty($x_pictURL)) 
			{ 
			$html_page .= "<img src='" . $x_pictURL . "' border='0' name='view' alt='".viewModulParam($modul_select,"view")."'>";
			} 
		else
			{
//			$html_page .= "<img src='images/public/nophoto.gif' border='0' width='60' height='60' name='view' alt='".viewModulParam($modul_select,"view")."'>";
			}
		$html_page .= "</a></td></tr>";
		$html_page .= "<tr align='center'><td><span class='phpmaker'>" . $x_name . "</span>";
		$html_page .= "</td></tr></table></td>";
		$actual_address = @$row["country"] . "&nbsp;" . @$row["zipcode"] . "&nbsp;" . @$row["city"] . "&nbsp;" . @$row["address"];
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $actual_address . "</span></td>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;" . @$row["phone"] . "</span></td>";
		$html_page .= "<td>&nbsp;";
		if (!is_null($x_email))
			{
			$html_page .= "<a href='mailto:" . $x_email . "'><img src='" . $image_button . "email.gif' border='0' alt='". $x_email . "'></a>";
			}
		$html_page .= "</td>";
		$html_page .= "<td>&nbsp;";
		if (!is_null($x_website))
			{
			$html_page .= "<a href='" . $x_website . "' target='new'><img src='" . $image_button . "home.gif' border='0' alt='". $x_website . "'></a>";
			}
		$html_page .= "</td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$html_page .= "<td valign='center' align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
//		$html_page .= "</table></td></tr>";
		}
	}
$html_page .= "</table></td></tr>";
$html_page .= "</table>";
$html_page .= "</td>";
advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
$html_page .= footer("");
?>
