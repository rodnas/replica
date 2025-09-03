<?php
if (empty($onlyview))
	{
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_name . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"addressTitle")."&nbsp;</span></td>";
	$partneraddress = $country;
	if (!empty($x_zipcode))
		if (!empty($partneraddress))
			$partneraddress .= "&nbsp;" . $x_zipcode;
		else
			$partneraddress .= $x_zipcode;
	if (!empty($x_city))
		if (!empty($partneraddress))
			$partneraddress .= "&nbsp;" . $x_city;
		else
			$partneraddress .= $x_city;
	if (!empty($x_address))
		if (!empty($partneraddress))
			$partneraddress .= "&nbsp;" . $x_address;
		else
			$partneraddress .= $x_address;
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $partneraddress . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"phoneTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_phone . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"faxTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_fax . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"emailTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_email . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
if (!empty($x_pictURL)) 
	{ 
	$html_page .= "<tr valign='top'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"pictURLTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'>";
	$html_page .= "<img src='" . @$x_pictURL . "' border='0'><br>";
	$html_page .= "</td>";
	$html_page .= "</tr>";
	}
if (empty($onlyview))
	{
	if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
		$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
		{
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"directornameTitle")."&nbsp;</span></td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_directorname . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		$html_page .= "<tr>";
		$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"contactnameTitle")."&nbsp;</span></td>";
		$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $x_contactname . "</span>&nbsp;</td>";
		$html_page .= "</tr>";
		}
	$html_page .= "<tr valign='top'>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"factorTitle")."&nbsp;</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . @$x_factor . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
?>