<?php
// Module properties
sharefieldinit();
$startrec=1;

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

// field "productid"
$x_productid = @$_GET["x_productid"];
$z_productid = @$_GET["z_productid"];
$z_productid = (get_magic_quotes_gpc()) ? stripslashes($z_productid) : $z_productid;
$arrfieldopr = explode(",", $z_productid);
if ($x_productid <> "" && count($arrfieldopr) >= 3)
	{
	$x_productid = (!get_magic_quotes_gpc()) ? addslashes($x_productid) : $x_productid;
	$a_search = $a_search . "`productid` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_productid . $arrfieldopr[2] . " AND ";
	}

// field "barcode"
$x_barcode = @$_GET["x_barcode"];
$z_barcode = @$_GET["z_barcode"];
$z_barcode = (get_magic_quotes_gpc()) ? stripslashes($z_barcode) : $z_barcode;
$arrfieldopr = explode(",", $z_barcode);
if ($x_barcode <> "" && count($arrfieldopr) >= 3)
	{
	$x_barcode = (!get_magic_quotes_gpc()) ? addslashes($x_barcode) : $x_barcode;
	$a_search = $a_search . "`barcode` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_barcode . $arrfieldopr[2] . " AND ";
	}

// field "maker_id"
$x_maker_id = @$_GET["x_maker_id"];
$z_maker_id = @$_GET["z_maker_id"];
$z_maker_id = (get_magic_quotes_gpc()) ? stripslashes($z_maker_id) : $z_maker_id;
$arrfieldopr = explode(",", $z_maker_id);
if ($x_maker_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_maker_id = (!get_magic_quotes_gpc()) ? addslashes($x_maker_id) : $x_maker_id;
	$a_search = $a_search . "`maker_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_maker_id . $arrfieldopr[2] . " AND ";
	}

// field "name"
$x_name = @$_GET["x_name"];
$z_name = @$_GET["z_name"];
$z_name = (get_magic_quotes_gpc()) ? stripslashes($z_name) : $z_name;
$arrfieldopr = explode(",", $z_name);
if ($x_name <> "" && count($arrfieldopr) >= 3)
	{
	$x_name = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
	$a_search = $a_search . "`name` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_name . $arrfieldopr[2] . " AND ";
	}

// field "topic_id"
$x_topic_id = @$_GET["x_topic_id"];
$z_topic_id = @$_GET["z_topic_id"];
$z_topic_id = (get_magic_quotes_gpc()) ? stripslashes($z_topic_id) : $z_topic_id;
$arrfieldopr = explode(",", $z_topic_id);
if ($x_topic_id <> "" && count($arrfieldopr) >= 3)
	{
	$x_topic_id = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
	$a_search = $a_search . "`topic_id` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_topic_id . $arrfieldopr[2] . " AND ";
	}

// field "priceHUF"
$x_priceHUF = @$_GET["x_priceHUF"];
$z_priceHUF = @$_GET["z_priceHUF"];
$z_priceHUF = (get_magic_quotes_gpc()) ? stripslashes($z_priceHUF) : $z_priceHUF;
$arrfieldopr = explode(",", $z_priceHUF);
if ($x_priceHUF <> "" && count($arrfieldopr) >= 3)
	{
	$x_priceHUF = (!get_magic_quotes_gpc()) ? addslashes($x_priceHUF) : $x_priceHUF;
	$a_search = $a_search . "`priceHUF` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_priceHUF . $arrfieldopr[2] . " AND ";
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

$x_novelty = @$_GET["x_novelty"];
$z_novelty = @$_GET["z_novelty"];
$z_novelty = (get_magic_quotes_gpc()) ? stripslashes($z_novelty) : $z_novelty;
$arrfieldopr = explode(",", $z_novelty);
if ($x_novelty <> "" && count($arrfieldopr) >= 3)
	{
	$x_novelty = (!get_magic_quotes_gpc()) ? addslashes($x_novelty) : $x_novelty;
	$a_search = $a_search . "`novelty` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_novelty . $arrfieldopr[2] . " AND ";
	}

// field "sale"
$x_sale = @$_GET["x_sale"];
$z_sale = @$_GET["z_sale"];
$z_sale = (get_magic_quotes_gpc()) ? stripslashes($z_sale) : $z_sale;
$arrfieldopr = explode(",", $z_sale);
if ($x_sale <> "" && count($arrfieldopr) >= 3) {
	$x_sale = (!get_magic_quotes_gpc()) ? addslashes($x_sale) : $x_sale;
	$a_search = $a_search . "`sale` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_sale . $arrfieldopr[2] . " AND ";
}

// field "description"
$x_description = @$_GET["x_description"];
$z_description = @$_GET["z_description"];
$z_description = (get_magic_quotes_gpc()) ? stripslashes($z_description) : $z_description;
$arrfieldopr = explode(",", $z_description);
if ($x_description <> "" && count($arrfieldopr) >= 3)
	{
	$x_description = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
	$a_search = $a_search . "`description` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_description . $arrfieldopr[2] . " AND ";
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
	$_SESSION[$which_system.$modul_select . "x_category"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
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
			$b_search .= "productid LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "barcode LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select.".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= str_replace("_item","_maker",$modul_select) . ".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= str_replace("_item","_topic",$modul_select) . ".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= str_replace("_item","_size",$modul_select) . ".name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "pictURL LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= $modul_select . ".description LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "productid LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "barcode LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select.".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= str_replace("_item","_maker",$modul_select) . ".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= str_replace("_item","_topic",$modul_select) . ".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= str_replace("_item","_size",$modul_select) . ".name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "pictURL LIKE '%" . $pSearch . "%' OR ";
		$b_search .= $modul_select . ".description LIKE '%" . $pSearch . "%' OR ";
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

$x_category = @$_GET["x_category"];
if (!empty($x_category))
	{
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
	$_SESSION[$which_system.$modul_select . "x_category"] = $x_category;
	}
if ($x_category == "basket")
	{
	$searchwhere = ""; //reset search criteria
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	$searchwhere .= $modul_select . ".id=basket.product_id ";
	$searchwhere .= " AND basket.insert_user_id=" . @$_SESSION[$which_system . "status_UserID"];
	$searchwhere .= " AND basket.status_id=1";
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
if ($x_category == "minimax")
	{
	$searchwhere = ""; //reset search criteria
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	$searchwhere .= $modul_select . ".description LIKE '%minimax%'";
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
$x_Page = @$_GET["Page"];
if (isset($x_Page))
	{
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
	$_SESSION[$which_system.$modul_select . "x_category"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = $x_Page;
	$treeSQL = "SELECT * FROM ".str_replace("_item","_topic",$modul_select)." WHERE id=".$x_Page;
	$treers = mysqli_query($GLOBALS["conn"],$treeSQL);
	if ($treers && $treerow = mysqli_fetch_array($treers))
		{
		$x_tree_id = $treerow["tree_id"];
		}
	else
		{
		$x_tree_id = "";
		}
	@mysqli_free_result($treers);
	$searchwhere = ""; //reset search criteria
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	if (!empty($x_tree_id))
		{
		$searchwhere .= str_replace("_item","_topic",$modul_select) . ".tree_id LIKE '".$x_tree_id."%'";
		}
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
// get clear search cmd
if (@$_GET["cmd"] <> "")
	{
	$cmd = $_GET["cmd"];
	if (strtoupper($cmd) == "RESET")
		{
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}
	elseif (strtoupper($cmd) == "RESETALL")
		{		
		$searchwhere = ""; //reset search criteria
		$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
		$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
		$_SESSION[$which_system.$modul_select . "x_category"] = "";
		$_SESSION[$which_system.$modul_select . "x_tree_page"] = 0;
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
$pSearchOriginal = $_SESSION[$which_system.$modul_select . "pSearchOriginal"];
$x_category = @$_SESSION[$which_system.$modul_select . "x_category"];
$x_tree_page = @$_SESSION[$which_system.$modul_select . "x_tree_page"];
builddbwhere();

// default order
$DefaultOrder = "";
$DefaultOrderType = "";

// default filter
$DefaultFilter = "";
$x_start = @$_GET["start"];
$x_pageno = @$_GET["pageno"];
$x_key = @$_GET["key"];
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = str_replace("_item","_topic",$modul_select).".tree_id LIKE '%'";
	}
else
	{
	$DefaultFilter = $modul_select.".active=1 AND ".str_replace("_item","_topic",$modul_select).".tree_id LIKE '%'";
	}
checkorder();
// build SQL
$strsql = "SELECT " . $modul_select . ".*, " . str_replace("_item","_maker",$modul_select) . ".name AS makername, " . str_replace("_item","_topic",$modul_select) . ".name AS topicname, " . str_replace("_item","_topic",$modul_select) . ".tree_id AS tree_id, " . str_replace("_item","_size",$modul_select) . ".name AS sizename";
$strsql .= " FROM " . $modul_select;
if ($x_category=="basket")
	{
	$strsql .= ", basket ";
	}
$strsql .= " LEFT JOIN ".str_replace("_item","_maker",$modul_select). " ON " . $modul_select.".maker_id=".str_replace("_item","_maker",$modul_select).".id";
$strsql .= " LEFT JOIN ".str_replace("_item","_topic",$modul_select) . " ON " . $modul_select.".topic_id=".str_replace("_item","_topic",$modul_select).".id";
$strsql .= " LEFT JOIN ".str_replace("_item","_size",$modul_select) . " ON " . $modul_select.".size_id=".str_replace("_item","_size",$modul_select).".id";
buildsql();
$rs = mysqli_query($GLOBALS["conn"],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));

checkstart();
$a = @$_POST["a"];
if (empty($a))
	{
	$key = @$row["id"];
	}
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= "<input type='hidden' name='x_category' value='". htmlspecialchars($x_category) . "'>";
$noveltySQL = "SELECT COUNT(*) AS noveltycount FROM ".$modul_select." WHERE novelty=1";
$noveltyrs = mysqli_query($GLOBALS["conn"],$noveltySQL);
if ($noveltyrs && $noveltyrow = mysqli_fetch_array($noveltyrs))
	{
	$x_noveltycount = $noveltyrow["noveltycount"];
	}
else
	{
	$x_noveltycount = 0;
	}
@mysqli_free_result($noveltyrs);
$html_page .= "<tr align='left'><td>&nbsp;";
$html_page .= "<a href='index.php?modul_action=list&x_category=novelty&x_novelty=1&z_novelty=%3D%2C%2C' class='leftmenu'";
if ($x_category!="novelty")
	{
	$html_page .= "><b>";
	}
else
	{
	$html_page .= " style='color: red;text-decoration:none;'><b>";
	}
$html_page .= viewModulParam($modul_select,"novelty")." (".$x_noveltycount.")";
$html_page .= "<b></span>";
$html_page .= "</a>";
$html_page .= "</td></tr>";
$saleSQL = "SELECT COUNT(*) AS salecount FROM ".$modul_select." WHERE sale=1";
$salers = mysqli_query($GLOBALS["conn"],$saleSQL);
if ($salers && $salerow = mysqli_fetch_array($salers))
	{
	$x_salecount = $salerow["salecount"];
	}
else
	{
	$x_salecount = 0;
	}
@mysqli_free_result($salers);
$html_page .= "<tr align='left'><td>&nbsp;";
$html_page .= "<a href='index.php?modul_action=list&x_category=sale&x_sale=1&z_sale=%3D%2C%2C' class='leftmenu'";
if ($x_category!="sale")
	{
	$html_page .= "><b>";
	}
else
	{
	$html_page .= " style='color: red;text-decoration:none;'><b>";
	}
$html_page .= viewModulParam($modul_select,"sale")." (".$x_salecount.")";
$html_page .= "<b></span>";
$html_page .= "</a>";
$html_page .= "</td></tr>";
$minimaxSQL = "SELECT COUNT(*) AS minimaxcount FROM ".$modul_select . " WHERE ".$modul_select.".description LIKE '%minimax%'";
$minimaxrs = mysqli_query($GLOBALS["conn"],$minimaxSQL);
if ($minimaxrs && $minimaxrow = mysqli_fetch_array($minimaxrs))
	{
	$x_minimaxcount = $minimaxrow["minimaxcount"];
	}
else
	{
	$x_minimaxcount = 0;
	}
@mysqli_free_result($minimaxrs);
$html_page .= "<tr align='left'><td>&nbsp;";
$html_page .= "<a href='index.php?modul_action=list&x_category=minimax' class='leftmenu'";
if ($x_category!="minimax")
	{
	$html_page .= "><b>";
	}
else
	{
	$html_page .= " style='color: red;text-decoration:none;'><b>";
	}
$html_page .= "Minimax (".$x_minimaxcount.")";
$html_page .= "<b></span>";
$html_page .= "</a>";
$html_page .= "</td></tr>";
if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] > 1)
	{
	if ((actual_permission(viewModul("basket","name")) & ewAllowview) == ewAllowview)
		{
		if ($baskettotal > 0)
			{
			$html_page .= "<tr align='left'><td>&nbsp;";
			$html_page .= "<a href='index.php?modul_action=list&x_category=basket' class='leftmenu'";
			if ($x_category!="basket")
				{
				$html_page .= "><b>";
				}
			else
				{
				$html_page .= " style='color: red;text-decoration:none;'><b>";
				}
			$html_page .= viewModulParam($modul_select,"basket")." (".$basketcount." / ".$baskettotal.")";
			$html_page .= "<b></span>";
			$html_page .= "</a>";
			$html_page .= "</td></tr>";
			}
		}
	}
/*
if ($x_groupsql == "sold>0")
	$x_list_idList .= "<option selected value=\"sold>0\">Toplista</option>";
else
	$x_list_idList .= "<option value=\"sold>0\">Toplista</option>";
	
*/

$html_page .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr align='left'><td>";
$treecountSQL = "SELECT COUNT(*) AS treecounter";
$treecountSQL .= " FROM " .$modul_select;
$treecountSQL .= " LEFT JOIN ".str_replace("_item","_topic",$modul_select) . " ON " . $modul_select.".topic_id=".str_replace("_item","_topic",$modul_select).".id";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$treecountSQL .= " WHERE ".str_replace("_item","_topic",$modul_select).".tree_id LIKE " ;
	}
else
	{
	$treecountSQL .= " WHERE " . $modul_select . ".active=1 AND ".str_replace("_item","_topic",$modul_select).".tree_id LIKE ";
	}
$Page = $x_tree_page;
$treeAdmin = false;
$treeTable = str_replace("_item","_topic",$modul_select);
$html_page .= MakeTree($Page,$name,$treeTable,$treecountSQL,$treeAdmin);
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";

$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form  action='" . $modul_select . "list.php' method='post' name='listform'>";
notLoggedTextView();
$html_page .= "<tr valign='center' height='15'><td>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='".$color2."'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"productidOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='left'>";
	$html_page .= orderchange($modul_select,"barcodeOrderHead");
	$html_page .= "</td>";
	}
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"nameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"makernameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"topicnameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"sizenameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='right'>";
$html_page .= orderchange($modul_select,"priceHUFOrderHead");
$html_page .= "</td>";
if (@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] > 1)
	{
	if ((actual_permission(viewModul("basket","name")) & ewAllowview) == ewAllowview)
		{
		$html_page .= "<td align='center'><span class='phpmaker'>".viewModulParam($modul_select,"ordersTitle")."</span></td>";
		}
	else
		{
		$html_page .= "<td>&nbsp;</td>";
		}
	}
else
	{
	$html_page .= "<td>&nbsp;</td>";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='center'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
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
		$bgcolor = $color4; // row color
		if (($recCount % 2) <> 0)
			{ // display alternate color for rows
			$bgcolor = $color5;
			}

		// load key for record
		$key = @$row["id"];
		$x_productid = @$row["productid"];
		$x_barcode = @$row["barcode"];
		$x_maker_id = @$row["maker_id"];
		$x_makername = @$row["makername"];
		$x_name = @$row["name"];
		$x_topic_id = @$row["topic_id"];
		$x_priceHUF = @$row["priceHUF"];
		$x_pictURL = @$row["pictURL"];
		$x_novelty = @$row["novelty"];
		$x_sold = @$row["sold"];
		$x_sale = @$row["sale"];
		$x_amount = @$row["amount"];
		sharefromtable();
		if (!empty($x_bgcolor))
			$bgcolor=$x_bgcolor;
		$html_page .= "<tr valign='center' bgcolor='" . $bgcolor. "'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;&nbsp;" . $x_productid . "</span></td>";
		if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
			{
			$html_page .= "<td><span class='phpmaker'>&nbsp;&nbsp;" . $x_barcode . "</span></td>";
			}
		$html_page .= "<td align='left'><table>";
		$html_page .= "<tr align='center'><td>";
		if (!is_null($x_pictURL)) 
			{ 
			$html_page .= "<a href='index.php?modul_action=viewfull&key=" . urlencode($x_id) . "'>";
			$html_page .= "<img src='images/public/photo.gif' border='0' name='view' alt='".viewModulParam($modul_select,"viewfullTitle")."'>";
			$html_page .= "</a>";
			} 
		else
			{
			$html_page .= "<img src='images/public/nophoto.gif' border='0' name='view'>";
			}
		$html_page .= "</td>";
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>" . $x_name . "&nbsp;</span>";
		$html_page .= "</td></tr></table></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;&nbsp;" . $row["makername"] ."&nbsp;</span></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;&nbsp;" . $row["topicname"] ."&nbsp;</span></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;&nbsp;" . $row["sizename"] ."&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;&nbsp;" . $row["priceHUF"] ."&nbsp;&nbsp;</span></td>";
		$html_page .= "</td>";
		$html_page .= "<td align='center' width=80><table><tr valign='center'>";
		if ($_SESSION[$which_system . "status_UserLevel"] > 1)
			{
			if ((actual_permission(viewModul("basket","name")) & ewAllowview) == ewAllowview)
				{
				$basketsql = "SELECT * FROM basket WHERE insert_user_id = " . @$_SESSION[$which_system . "status_UserID"] . " AND status_id < 2 AND product_id = " . $x_id . ";";
				$basketrs = mysqli_query($basketsql);
				if ($basketrs && $rowwrk = mysqli_fetch_array($basketrs))
					{
					$x_basket_amount = $rowwrk["amount"];
					}
				$basket_is = intval(@mysqli_num_rows($GLOBALS["conn"],$basketrs));
				$html_page .= "<td>";
				$which_line = $recActual;
				$which_line--;
				if ($basket_is == 0)
					{
					$html_page .= "<input type='text' name='b_amount' size='3' value=''  style='text-align:right;'>&nbsp;";
					$html_page .= "</td><td>";
					$html_page .= "<a href='javascript:basket(" . (urlencode($x_id)). ",document.listform.b_amount[" . $which_line . "].value);";
					$html_page .= "'><img src='" . $image_button . "basketrightempty.gif' border='0' name='basket' alt='".viewModul("basket","title")."'></a>&nbsp;";
					} 
				else 
					{
					$html_page .= "<input type='text' name='b_amount' size='3' value='" . $x_basket_amount . "' style='text-align:right;color:red;'>&nbsp;";
					$html_page .= "</td><td>";
					$html_page .= "<a href='javascript:basket(" . (urlencode($x_id)). ",document.listform.b_amount[" . $which_line . "].value);";
					$html_page .= "'><img src='" . $image_button . "basketrightnotempty.gif' border='0' name='basket' alt='".viewModul("basket","title")."'></a>&nbsp;";
					}
				$html_page .= "</td>";
				}
			}
		$html_page .= "<td>";
/*
		if (empty($x_amount))
			{
			$html_page .= "<img src='" . $image_button . "nostore.gif' border='0' name='onstore' alt='".viewModulParam($modul_select,"nostoreTitle")."'>";
			}
		else
			{
			$html_page .= "<img src='" . $image_button . "onstore.gif' border='0' name='onstore' alt='".viewModulParam($modul_select,"onstoreTitle")."'>";
			}
*/
		$html_page .= "</td>";
		$html_page .= "</tr></table></td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		if (!empty($nextModul))
			{ 
			$x_picture_count = 0;
			$sqlwrk = "SELECT COUNT(*) AS picture_count FROM ".$modul_select ."_picture";
			if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] > 1)
				{
				$sqlwrk_where = "";
				}
			else
				{
				$sqlwrk_where = " active=1 AND ";
				}
			$sqlwrk_where .= "item_id = " . $x_id;
			if ($sqlwrk_where <> "" )
				{
				$sqlwrk .= " WHERE " . $sqlwrk_where;
				}
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_picture_count = $rowwrk["picture_count"];
				}
			@mysqli_free_result($rswrk);
			$html_page .= "<td align='right'><span class='phpmaker'>";
			if ($x_picture_count <> 0)
				{
				$html_page .= $x_picture_count;
				}
			$html_page .= "</span></td>";
			}
		$html_page .= "<td align='right'><table border=0 cellspacing='0' cellpadding='0'><tr>";
		if (!empty($nextModul) && ($x_picture_count > 0) ||
			($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
			$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3))
			{ 
			$html_page .= "<td width='5'></td>";
			$html_page .= "<td align='right'>";
			if ((@$row["id"] != NULL))
				{
				$html_page .= "<a href='index.php?modul_action=list&modul_select=".str_replace("_item","_picture",$modul_select)."&key_m=" . urlencode($x_id) . "&cmd=reset'>";
				}
			else
				{
				$html_page .= "<a href=\"" . "javascript:alert('Invalid Record! Key is null');" . "\">";
				}
			$html_page .= "<img src='" . $image_button . "camera.gif' border='0' name='view' title='".viewModulParam($modul_select,"pictURLTitle")."'></a></td>";
			$html_page .= "<td width='5'></td>";
			}
		if ($_SESSION[$which_system . "status_UserLevel"] > 1)
			{
			$html_page .= "<td valign='center' align='right'>";
			}
		else
			{
			$html_page .= "<td valign='center' align='right' colspan=2>";
			}
		$html_page .= "<table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		$html_page .= submenu();
		$html_page .= "</td></tr></table></td></tr>";
		$html_page .= "</table></td></tr>"; 
		}
	}
$html_page .= "</form>";
$html_page .= "</table></td>";
$html_page .= "</tr>";
$html_page .= "</table>";
$html_page .= "</td>";
$html_page .= advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");

?>
<script language="JavaScript">
function basket(x,y)
	{
alert("hurra");
	if (y.length==0)
		{
		y++;
		}
	else if (parseInt(y)=="NaN")
		{
		y=0;
		}
	else
		{
		y=y;
		}
	window.location = "index.php?modul_select=basket&modul_action=add&key=" + x + "&amount=" + y;
	}
</script>
