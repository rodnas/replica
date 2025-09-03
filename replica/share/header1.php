<?php
$actitem;
$actcolor = $color2;
$key = @$_GET["key"];
if ($key !=0 )
	{
	$actitem0 = $key;
	if ($actitem0 > $displayRecs)
		{
		if ($displayRecs <> 0)
			{
			$pagecounter = $actitem0/$displayRecs;
			}
		settype($pagecounter,"integer");
		$actitem1 = $pagecounter * $displayRecs;
		$actitem = $actitem0 - $actitem1;
		}
	else
		{
		$actitem = $key;
		}
	}
else
	{
	$actitem = 1;
	}
$header1 = "<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-2' />
<!-- meta http-equiv='Content-Type' content='text/html; charset=utf-8' -->
<meta http-equiv='content-language' content='hu'>
<meta name='language' content='hu'>
  <title>".$systemtitle."</title>
	<style type='text/css'>
	<!-- 
	.bodyPage {background-color:#ccc;transparent;margin-top: 0;text-align:center;overflow:scroll;}
	#htmlPage {/*margin:0 auto 0 auto;*/min-width:860px;width:80%;white-space:wrap;overflow:hidden;}
 	INPUT, TEXTAREA, SELECT {font-family: 'Verdena'; font-size: 14px;text-decoration: none;}
	.phpmaker {font-family: 'Verdena'; font-size: 12px;text-decoration: none;}
	.leftmenu {font-family: 'Verdena'; font-size: 12px;color: #000000;text-decoration: none;font-weight: bold;}
	.header {font-family: 'Verdena'; font-size: 14px;text-decoration: none;}
	.footer {font-family: 'Verdena'; font-size: 10px;}
	.topbanner {font-family: 'Verdena'; font-size: 24px;font-weight: bold;}
	.ewTableOrderIndicator {font-family: Webdings;}
	-->
	</style>	
	<script language=\"JavaScript\" src=\"" . $GLOBALS["share_path"] . "js/ew.js\"></script>
	<script language=\"JavaScript\" src=\"" . $GLOBALS["share_path"] . "js/advert.js\"></script>\n
	</head>";
if (!empty($background))
	{
	$header1 .= "<body class='bodyPage' background='" . $image_public . $background . "' leftmargin='0' topmargin='0' marginheight='0' marginwidth='0'>";
	}
else
	{
	$header1 .= "<body class='bodyPage' bgcolor='" . $backgroundcolor . "' leftmargin='0' topmargin='0' marginheight='0' marginwidth='0'>";
	}

$header1 .= "<div id='htmlPage'>";
//$header1 .= "<input type='hidden' name='modul_select' value='" . $modul_select . "'>";
//$header1 .= "<input type='hidden' name='modul_action' value='" . $modul_action . "'>";
$header1 .= "<center>";
if (!empty($maintablebg))
	{
	$header1 .= "<table background='" . $image_public . $maintablebg . "'";
	}
else
	{
	$header1 .= "<table";
	}
if (!empty($windowwidth))
	{
	$header1 .= " width='" . $windowwidth . "'";
	}
else
	{
	$header1 .= " width='100%'";
	}

if (!empty($windowheight))
	{
	$header1 .= " height='" . $windowheight . "'";
	}
else
	{
//	$header1 .= " height='100%'";
	}

$header1 .= " border='0' cellpadding='0' cellspacing='0'>";
$header1 .= advert("top",viewModul($modul_select,"topadvert"));
/*
if ($topadvert == "1")
	{
	$header1 .= "<tr><td align='center'>";
	$header1 .= "<table width='100%' cellspacing='0' cellpadding='0'><tr align='center'>";
	$header1 .= "<td align='left'>";
	$header1 .= "<iframe align='top' width='468' height='60' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no' src='http://www.reklamcsere.hu/banner/view.php?id=3312&s=uv&meret=1&oldal=3446&sites=v&modul=1'></iframe>";
	$header1 .= "</td>";
	$header1 .= "<td align='right'>";
	$header1 .= "<iframe align='top' width='234' height='60' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no' src='http://www.reklamcsere.hu/banner/view.php?id=3312&s=uv&meret=2&oldal=3446&sites=v&modul=1'></iframe>";
	$header1 .= "</td>";
	$header1 .= "</tr></table></td></tr>";
	}
*/
$header1 .= "<tr><td align='center'>";
$header1 .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'><tr>";
if (!empty($logoleft))
	{
//	$header1 .= "<td align='left'><a href='index.php?modul_select=".$home_modul."&modul_action=list&cmd=resetall'><img src='" . $image_public . $logoleft . "' border=0 name='home' title='".viewModulParam($modul_select,"home")."'></a></td>";
	}
if (!empty($topbanner))
	{
//	$header1 .= "<td align='center'><img src='" . $image_public . $topbanner . "' border='0'></td>";
	}
else
	{
//	$header1 .= "<td align='center'><span class='topbanner'>".$topheader."</span></td>";
	}
if (!empty($logoright))
	{
//	$header1 .= "<td align='right'><a href='http://rodnas.fw.hu' target='_blank'><img src='" . $image_public . $logoright . "' border=0 name='home' title='".viewModulParam($modul_select,"developer")."'></a></td>";
	}
$header1 .= "</tr></table></td></tr>";
$header1 .= topmenu();
$header1 .= "<tr valign='center'><td>";
$header1 .= "<table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'>";
$header1 .= "<tr align='center' valign='center'>";
$header1 .= "<td align='left'>";
$header1 .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$header1 .= "<tr valign='center' align='center'>";
$header1 .= "<td align='left' valign='center'>";
$header1 .= "<table width='160' border=0 cellspacing='1' cellpadding='2'>";
$header1 .= "<tr align='center' valign='center'>";
$header1 .= "<td><a href='index.php?action=".$modul["lngen"]["link"]."'>";
$header1 .= "<img src='" . $modul["lngen"]["icon"] . "' border='0' title='".viewModul("lngen","title")."' name='en'>";
$header1 .= "</a></td>";
$header1 .= "<td><a href='index.php?action=".$modul["lngde"]["link"]."'>";
$header1 .= "<img src='" . $modul["lngde"]["icon"] . "' border='0' title='".viewModul("lngde","title")."' name='de'>";
$header1 .= "</a></td>";
$header1 .= "<td><a href='index.php?action=".$modul["lnghu"]["link"]."'>";
$header1 .= "<img src='" . $modul["lnghu"]["icon"] . "' border='0' title='".viewModul("lnghu","title")."' name='hu'>";
$header1 .= "</a></td>";
$header1 .= "<td width='100%'></td>";
$header1 .='</tr>';
$header1 .='</table>';
$header1 .='</td>';
$header1 .= "<td width='100%' align='left' valign='center'>";
if ($_SESSION[$which_system . "status_UserLevel"] < 2)
	{
	include ($share_path . "login_try.php");
	$header1 .= "</td>";
	$header1 .= "<td align='right' valign='center'>";
	$header1 .= "<table border='0' cellspacing='1' cellpadding='2'><tr><td>";
	} 
else 
	{
	$header1 .= "<table border=0 align='left' cellspacing='0' cellpadding='0'>";
	$header1 .= "<tr><td align='left'>";
	$header1 .= "<a href='index.php?modul_select=".viewModul("users","name")."&modul_action=edit&key=" . @$_SESSION[$which_system . "status_UserID"] . "&which_back=".$home_modul."'>";
	$header1 .= "<img src='" . $image_button . "own.gif' border=0 name='own' title='".viewModulParam("users","mydata")."'>";
	$header1 .= "</a></td>";
	$header1 .= "<td><span class='phpmaker'><b>&nbsp;";
	$header1 .= @$_SESSION[$which_system . "status_User"] . "</b></span></td>";
	if ($_SESSION[$which_system . "status_UserLevel"] > 1)
		{
		if ((actual_permission(viewModul("basket","name")) & ewAllowview) == ewAllowview)
			{
//			$conn = mysqli_connect(HOST, USER, PASS);
			//mysqli_select_db(DB);
			$basketDefaultFilter = " WHERE insert_user_id = " . @$_SESSION[$which_system . "status_UserID"] . " AND status_id < 2";
			$basketsql = "SELECT COUNT(*) AS basketcount, SUM(amount) AS amountt FROM basket WHERE insert_user_id = " . @$_SESSION[$which_system . "status_UserID"] . " AND status_id = 1";
			$basketrs = mysqli_query($GLOBALS["conn"],$basketsql);
			$row = mysqli_fetch_array($basketrs);
			$basketcount = @$row["basketcount"];
			$baskettotal = @$row["amountt"];
			if ($baskettotal == 0)
				{
				$header1 .= "<td width='40'><img src='" . $image_button . "basketleftempty.gif' border=0 name='orders' title='".viewModul("basket","title")."'></td>";
				$header1 .= "<td align='center'><span class='phpmaker'>Az Ön kosarában&nbsp;<b>0</b>&nbsp;termék van</span></td>";
				}
			else
				{
				$header1 .= "<td width='40'><a href='index.php?modul_select=".$basket_php."&modul_action=list&cmd=resetall'>";
				$header1 .= "<img src='" . $image_button . "basketleftnotempty.gif' border=0 name='orders' title='".viewModul("basket","title")."'></a></td>";
				$header1 .= "<td align='center'><span class='phpmaker'>Az Ön kosarában&nbsp;<b>" . $basketcount . " / " .$baskettotal."</b>&nbsp;termék van</span></td>";
				}
			}
		}
	$header1 .= "</tr></table></td>";
	$header1 .= "<td align='right' valign='center'>";
	$header1 .= "<table border='0' cellspacing='1' cellpadding='2'><tr><td>";
	if ((actual_permission(viewModul("users","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("users","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModul("users","icon")."' border=0 name='user' title='".viewModul("users","title")."'>";
		$header1 .= "</a></td>";
		}
	if ((actual_permission(viewModul("groups","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("groups","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModul("groups","icon")."' border=0 name='group' title='".viewModul("groups","title")."'>";
		$header1 .= "</a></td>";
		}
	if ((actual_permission(viewModul("permissions","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("permissions","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModul("permissions","icon")."' border=0 name='permission' title='".viewModul("permissions","title")."'>";
		$header1 .= "</a></td>";
		}
/*
	if ((actual_permission(viewModul("language","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("language","name")."&modul_action=listcmd=resetall'>";
		$header1 .= "<img src='" . viewModul("language","icon")."' border=0 name='language' title='".viewModul("language","title")."'>";
		$header1 .= "</a></td>";
		}
*/
	if ((actual_permission(viewModul("config","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModulParam("config","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModulParam("config","icon")."' border=0 name='config' title='".viewModulParam("config","title")."'>";
		$header1 .= "</a></td>";
		}
	if ((actual_permission(viewModul("newsletter","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModulParam("newsletter","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModulParam("newsletter","icon")."' border=0 name='newsletter' title='".viewModulParam("newsletter","title")."'>";
		$header1 .= "</a></td>";
		}
	if ((actual_permission(viewModul("advert_item","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModulParam("advert_item","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModulParam("advert_item","icon")."' border=0 name='advert' title='".viewModulParam("advert_item","title")."'>";
		$header1 .= "</a></td>";
		}
	if ((actual_permission(viewModul("support_item","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("support_item","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModul("support_item","icon")."' border=0 name='support_item' title='".viewModul("support_item","title")."'>";
		$header1 .= "</a></td>";
		}
	if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] > 1)
		{
		if ((actual_permission("orders") & ewAllowview) == ewAllowview)
			{
			$header1 .= "<td><a href='index.php?modul_select=".viewModul("orders","name")."&modul_action=list&cmd=resetall'>";
			$header1 .= "<img src='" . viewModul("orders","icon")."' border=0 name='orders' title='".viewModul("orders","title")."'>";
			$header1 .= "</a></td>";
			}
		}
	if ((actual_permission(viewModul("message_wall","name")) & ewAllowview) == ewAllowview)
		{
		$header1 .= "<td><a href='index.php?modul_select=".viewModul("message_wall","name")."&modul_action=list&cmd=resetall'>";
		$header1 .= "<img src='" . viewModul("message_wall","icon")."' border=0 name='message_wall' title='".viewModul("message_wall","title")."'>";
		$header1 .= "</a></td>";
		}
	}
if (isset($adminmail) && !empty($adminmail))
	{
	$header1 .= "<td><a href='mailto:" . $adminmail . "'><img src='" . $image_button . "email.gif' border=0 name='email' title='".viewModulParam($modul_select,"email")."'></a></td>";
	}

if ((actual_permission(viewModul("help_item","name")) & ewAllowview) == ewAllowview)
	{
	//$header1 .= "<td><a href='index.php?action=".viewModul("help","link")."&cmd=resetall'>";
	$header1 .= "<td><a href='index.php?modul_select=".viewModul("help_item","name")."&modul_action=list&cmd=resetall'>";
	$header1 .= "<img src='" . viewModul("help_item","icon")."' border=0 name='help' title='".viewModul("help_item","title")."'>";
	//$header1 .= "<img src='" . viewModul("advert_item","icon")."' border=0 name='advert' title='".viewModul("advert_item","title")."'>";
	$header1 .= "</a></td>";
	}

if ($_SESSION[$which_system . "status_UserLevel"] != 1)
	{
	$header1 .= "<td><a href='index.php?modul_select=logout'>";
	$header1 .= "<img src='" . $image_button . "logout.gif' border=0 name='logout' title='".viewModulParam($modul_select,"logout")."'>";
	$header1 .= "</a></td>";
	}
$header1 .= "</td></tr></table>";
$header1 .= "</td>";
$header1 .= "</tr>";
$header1 .= "</table>";
$header1 .= "</td>";
$header1 .= "</tr>";
if (!empty($mainmessage))
	{
	$header1 .= $mainmessage;
	}
$header1 .= advert("topline",viewModul($modul_select,"toplineadvert"));
$header1 .= "<tr>";
//	<!-- left column -->
//	<!-- right column -->
$header1 .= "<td valign='top' align='center'>";
$header1 .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$header1 .= "<tr><td align='center' valign='top'>";
echo $header1;
