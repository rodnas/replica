<?php
// Module properties
$which_back = "list&modul_select=".$modul_select."_topic&cmd=reset";
sharefieldinit();
$noview = true;
$nocopy = true;
$noedit = true;
$noadd = true;

$view_data = true;
// get the keys for master table
if (@$_GET["key_m"] <> "")
	{
	$key_m = $_GET["key_m"]; // load from query string
	$_SESSION[$which_system.$modul_select . "_masterkey"] = $key_m; // save master key to session

	//reset start record counter (new master key)
	$startRec = 1;
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
else
	{
	$key_m = @$_SESSION[$which_system.$modul_select . "_masterkey"]; // restore master key from session
	}
if ($key_m <> "")
	{
	$strmassql = "SELECT " . $modul_select . "_topic.*";
	$strmassql .= " FROM " . $modul_select . "_topic";
	$strmassql .= " WHERE ";	
	$strmassql .= "(".$modul_select."_topic.id = " . $key_m  . ")";	
	$rsMas = mysqli_query($GLOBALS['conn'],$strmassql);
	if (mysqli_num_rows($rsMas) > 0)
		{
		$row = mysqli_fetch_array($rsMas);
		$x_topic_active = @$row["active"];
		}
	}

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

// field "active"
$x_active = @$_GET["x_active"];
$z_active = @$_GET["z_active"];
$z_active = (get_magic_quotes_gpc()) ? stripslashes($z_active) : $z_active;
$arrfieldopr = explode(",", $z_active);
if ($x_active <> "" && count($arrfieldopr) >= 3)
	{
	$x_active = (!get_magic_quotes_gpc()) ? addslashes($x_active) : $x_active;
	$a_search = $a_search . "`active` " . $arrfieldopr[0] . " " . $arrfieldopr[1] . $x_active . $arrfieldopr[2] . " AND ";
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
			$b_search .= "product_item.productid LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_item.barcode LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_item.name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_maker.name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_topic.name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_size.name LIKE '%" . trim($kw) . "%' OR ";
			$b_search .= "product_item.description LIKE '%" . trim($kw) . "%' OR ";
			if (substr($b_search, -4) == " OR ")
				{
				$b_search = substr($b_search, 0, strlen($b_search)-4);
				}
			$b_search .= ") " . $pSearchType . " ";
			}
		}
	else
		{
		$b_search .= "product_item.productid LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_item.barcode LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_item.name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_maker.name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_topic.name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_size.name LIKE '%" . $pSearch . "%' OR ";
		$b_search .= "product_item.description LIKE '%" . $pSearch . "%' OR ";
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
	$searchwhere .= "product_item.id=".$modul_select.".product_id ";
	$searchwhere .= " AND ".$modul_select.".topic_id=".$key_m;
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
if ($x_category == "minimax")
	{
	$searchwhere = ""; //reset search criteria
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	$searchwhere .= "product_item.description LIKE '%minimax%'";
	$_SESSION[$which_system.$modul_select . "_searchwhere"] = $searchwhere;
	}
$x_Page = @$_GET["Page"];
if (isset($x_Page))
	{
	$_SESSION[$which_system.$modul_select . "pSearchOriginal"] = "";
	$_SESSION[$which_system.$modul_select . "x_category"] = "";
	$_SESSION[$which_system.$modul_select . "x_tree_page"] = $x_Page;
	$treeSQL = "SELECT * FROM product_topic WHERE id=".$x_Page;
	$treers = mysqli_query($GLOBALS['conn'],$treeSQL);
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
		$searchwhere .= "product_topic.tree_id LIKE '".$x_tree_id."%'";
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
		$key_m = "";
		$_SESSION[$which_system.$modul_select . "_masterkey"] = $key_m; // clear master key
		$masterdetailwhere = "";
		}	
	$startRec = 1; //reset start record counter (reset command)
	$_SESSION[$which_system.$modul_select . "_REC"] = $startRec;
	}
$pSearchOriginal = $_SESSION[$which_system.$modul_select . "pSearchOriginal"];
$x_category = @$_SESSION[$which_system.$modul_select . "x_category"];
$x_tree_page = @$_SESSION[$which_system.$modul_select . "x_tree_page"];

builddbwhere();
// default order
$DefaultOrder = "insert_datetime";
$DefaultOrderType = "ASC";

// default filter
$x_start = @$_GET["start"];
$x_pageno = @$_GET["pageno"];
$x_key = @$_GET["key"];
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$DefaultFilter = "product_topic.tree_id LIKE '%'";
	}
else
	{
	$DefaultFilter = $modul_select.".active=1 AND product_topic.tree_id LIKE '%'";
	}
if (!$x_topic_active)
	{
	$DefaultFilter .= " AND product_item.id=".$modul_select.".product_id ";
	$DefaultFilter .= " AND ".$modul_select.".topic_id=".$key_m;
	}
checkorder();
// build SQL
$strsql = "SELECT product_item.*,";
$strsql .= " product_maker.name AS makername, product_topic.name AS topicname, product_topic.tree_id AS tree_id, product_size.name AS sizename";
$strsql .= " FROM product_item";
if ($x_category=="basket" || !$x_topic_active)
	{
	$strsql .= ", ".$modul_select." ";
	}
$strsql .= " LEFT JOIN product_maker ON product_item.maker_id=product_maker.id";
$strsql .= " LEFT JOIN product_topic ON product_item.topic_id=product_topic.id";
$strsql .= " LEFT JOIN product_size  ON product_item.size_id=product_size.id";
buildsql();
$rs = mysqli_query($GLOBALS['conn'],$strsql);
$totalRecs = intval(@mysqli_num_rows($rs));
checkstart();
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= searchtop();
if ($key_m == "")
	{
	$html_page .= "<input type='hidden' name='a' value=''>";
	$html_page .= "<tr><td align='center'>";
	$sqlwrk = "SELECT id, name FROM " . $modul_select . "_topic";
	$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
	$x_topic_idList = "<select name=\"x_topic_id\" style='border:none;width:150;background-color:" . $actcolor . ";'>";
	if ($_POST["x_topic_id"] == "ALL")
		$x_topic_idList .= "<option selected value=\"ALL\">";
	else                                       
		$x_topic_idList .= "<option value=\"ALL\">";
	$x_topic_idList .= "---- Téma ----</option>";
	$cbo_x_topic_id_js = ""; // initialise
	if ($rswrk)
		{
		$rowcntwrk = 0;
		while ($datawrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_idList .= "<option value=\"topic_id=" . htmlspecialchars($datawrk["id"]) . "\"";
			if ("topic_id=".$datawrk["id"] == @$x_topic_id)
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
	$html_page .= "</td></tr>";
	}
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<input type='hidden' name='a' value=''>";
$html_page .= "<input type='hidden' name='x_category' value='". htmlspecialchars($x_category) . "'>";
$noveltySQL = "SELECT COUNT(*) AS noveltycount FROM product_item";
if (!$x_topic_active)
	{
	$noveltySQL .= ", ".$modul_select." ";
	}
$noveltySQL .= " WHERE";
if (!$x_topic_active)
	{
	$noveltySQL .= " product_item.id=".$modul_select.".product_id ";
	$noveltySQL .= " AND ".$modul_select.".topic_id=".$key_m ." AND";
	}
$noveltySQL .= " product_item.novelty=1";
$noveltyrs = mysqli_query($GLOBALS['conn'],$noveltySQL);
if ($noveltyrs && $noveltyrow = mysqli_fetch_array($noveltyrs))
	{
	$x_noveltycount = $noveltyrow["noveltycount"];
	}
else
	{
	$x_noveltycount = 0;
	}
@mysqli_free_result($noveltyrs);
$html_page .= "<tr align='left'><td>&nbsp;&nbsp;";
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
$saleSQL = "SELECT COUNT(*) AS salecount FROM product_item";
if (!$x_topic_active)
	{
	$saleSQL .= ", ".$modul_select." ";
	}
$saleSQL .= " WHERE";
if (!$x_topic_active)
	{
	$saleSQL .= " product_item.id=".$modul_select.".product_id ";
	$saleSQL .= " AND ".$modul_select.".topic_id=".$key_m ." AND";
	}
$saleSQL .= " product_item.sale=1";
$salers = mysqli_query($GLOBALS['conn'],$saleSQL);
if ($salers && $salerow = mysqli_fetch_array($salers))
	{
	$x_salecount = $salerow["salecount"];
	}
else
	{
	$x_salecount = 0;
	}
@mysqli_free_result($salers);
$html_page .= "<tr align='left'><td>&nbsp;&nbsp;";
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
$minimaxSQL = "SELECT COUNT(*) AS minimaxcount FROM product_item";
if (!$x_topic_active)
	{
	$minimaxSQL .= ", ".$modul_select." ";
	}
$minimaxSQL .= " WHERE";
if (!$x_topic_active)
	{
	$minimaxSQL .= " product_item.id=".$modul_select.".product_id ";
	$minimaxSQL .= " AND ".$modul_select.".topic_id=".$key_m ." AND";
	}
$minimaxSQL .= " product_item.description LIKE '%minimax%'";
$minimaxrs = mysqli_query($GLOBALS['conn'],$minimaxSQL);
if ($minimaxrs && $minimaxrow = mysqli_fetch_array($minimaxrs))
	{
	$x_minimaxcount = $minimaxrow["minimaxcount"];
	}
else
	{
	$x_minimaxcount = 0;
	}
@mysqli_free_result($minimaxrs);
$html_page .= "<tr align='left'><td>&nbsp;&nbsp;";
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
$basketSQL = "SELECT COUNT(*) AS basketcount FROM ".$modul_select;
$basketSQL .= " LEFT JOIN product_item ON product_item.id=".$modul_select.".product_id";
$basketSQL .= " WHERE topic_id=".$key_m;
$basketrs = mysqli_query($GLOBALS['conn'],$basketSQL);
if ($basketrs && $basketrow = mysqli_fetch_array($basketrs))
	{
	$x_basketcount = $basketrow["basketcount"];
	}
else
	{
	$x_basketcount = 0;
	}
@mysqli_free_result($basketrs);
$html_page .= "<tr align='left'><td>&nbsp;&nbsp;";
$html_page .= "<a href='index.php?modul_action=list&x_category=basket' class='leftmenu'";
if ($x_category!="basket")
	{
	$html_page .= "><b>";
	}
else
	{
	$html_page .= " style='color: red;text-decoration:none;'><b>";
	}
$html_page .= viewModulParam($modul_select,"basket")." (".$x_basketcount.")";
$html_page .= "<b></span>";
$html_page .= "</a>";
$html_page .= "</td></tr>";
/*
if ($x_groupsql == "sold>0")
	$x_list_idList .= "<option selected value=\"sold>0\">Toplista</option>";
else
	$x_list_idList .= "<option value=\"sold>0\">Toplista</option>";
	
*/

$html_page .= "<tr height='5'><td bgcolor='" . $GLOBALS["color3"] . "'></td></tr>";
$html_page .= "<table border=0 width='100%' bgcolor='" . $color1 . "' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr align='left'><td>&nbsp;&nbsp;";
$treecountSQL = "SELECT COUNT(*) AS treecounter";
$treecountSQL .= " FROM product_item";
if (!$x_topic_active)
	{
	$treecountSQL .= ", ".$modul_select." ";
	}
$treecountSQL .= " LEFT JOIN product_topic ON product_item.topic_id=product_topic.id";
$treecountSQL .= " WHERE";
if (!$x_topic_active)
	{
	$treecountSQL .= " product_item.id=".$modul_select.".product_id ";
	$treecountSQL .= " AND ".$modul_select.".topic_id=".$key_m ." AND ";
	}
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$treecountSQL .= " product_topic.tree_id LIKE " ;
	}
else
	{
	$treecountSQL .= " product_item.active=1 AND product_topic.tree_id LIKE ";
	}
$Page = $x_tree_page;
$treeAdmin = false;
$treeTable = "product_topic";
$html_page .= MakeTree($Page,$name,$treeTable,$treecountSQL,$treeAdmin);
$html_page .= searchbottom();
$html_page .= "</td>";
$html_page .= "<td align='center'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$html_page .= "<form method='post' name='listform'>";
notLoggedTextView();
if ($key_m <> "")
	{
	$strmassql = "SELECT " . $modul_select . "_topic.*";
	$strmassql .= " FROM " . $modul_select . "_topic";
	$strmassql .= " WHERE ";	
	$strmassql .= "(".$modul_select."_topic.id = " . $key_m  . ")";	
	$rsMas = mysqli_query($GLOBALS['conn'],$strmassql);
	}
if ($key_m <> "")
	{
	if (mysqli_num_rows($rsMas) > 0)
		{
		$row = mysqli_fetch_array($rsMas);
		$key = @$row["id"];
		$x_id = @$row["id"];
		$x_name = @$row["name"];
		$x_active = @$row["active"];
		if (!$x_topic_active)
			{
			$noadd = true;
			$noedit = true;
			$nodelete = true;
			$nobasket = true;
			}
		$x_lang_id = @$row["lang_id"];
		$x_insert_user_id = @$row["insert_user_id"];
		$x_insert_datetime = @$row["insert_datetime"];
		$x_modify_user_id = @$row["modify_user_id"];
		$x_modify_datetime = @$row["modify_datetime"];
		$x_topic_count = 0;
		$sqlwrk = "SELECT SUM(amount) AS topic_sum, SUM(amount*inprice) AS topic_inprice, SUM(amount*outprice) AS topic_outprice FROM ".str_replace("_topic","",$modul_select);
		if (@$_SESSION[$which_system . "status_UserLevel"] < 3)
			{
			$sqlwrk_where = "";
			}
		else
			{
			$sqlwrk_where = " active=1 AND ";
			}
		$sqlwrk_where .= "topic_id = " . $x_id;
		if ($sqlwrk_where <> "" )
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$x_topic_sum = $rowwrk["topic_sum"];
		$x_topic_inprice = $rowwrk["topic_inprice"];
		$x_topic_outprice = $rowwrk["topic_outprice"];
		$rswrk = mysqli_query($GLOBALS['conn'],$conn,$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_topic_sum = $rowwrk["topic_sum"];
			$x_topic_inprice = $rowwrk["topic_inprice"];
			$x_topic_outprice = $rowwrk["topic_outprice"];
			}
		@mysqli_free_result($rswrk);
		$html_page .= "<tr align='center'><td bgcolor='" . $color1 . "'>";
		$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
		$html_page .= "<tr bgcolor='".$color2."'>";
		$html_page .= "<td><span class='phpmaker'>&nbsp;".viewTitle($modul_select."_topic","name")."&nbsp;</span></td>";
		$html_page .= "<td width='80' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select."_topic","topic_sum")."&nbsp;</span></td>";
		$html_page .= "<td width='120' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select."_topic","topic_inprice")."&nbsp;</span></td>";
		$html_page .= "<td width='120' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select."_topic","topic_outprice")."&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"itemcreatewhen")."&nbsp;</span></td>";
		$html_page .= "</tr>";
		$html_page .= "<tr height='25' bgcolor='#CCCCCC'>";
		$html_page .= "<td align='left'><span class='header'>&nbsp;" . $x_name . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_sum . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_inprice . "&nbsp;</span></td>";
		$html_page .= "<td align='right'><span class='phpmaker'>&nbsp;" . $x_topic_outprice . "&nbsp;</span></td>";
		$html_page .= "<td align='right' width='200'><span class='header'>" . FormatDateTime($x_insert_datetime,8) . "&nbsp;</span></td>";
		$html_page .= "</tr>";
		$html_page .= "</table></td>";
		$html_page .= "</tr>";  
		if (!empty($x_description))
			{
			$html_page .= "<tr bgcolor='#CCCCCC'><td colspan='8'>";
			$html_page .= "<table border=0 width='100%' cellspacing='0' cellpadding='0'>";
			$html_page .= "<tr height='30' bgcolor='" . $bgcolor . "' valign='top' align='left'>";
			$html_page .= "<td width='10'></td>";
			$x_description = str_replace(chr(10), "", @$x_description . "");
			$x_description = str_replace("<P>", "", @$x_description . "");
			$x_description = str_replace("</P>", "<br>", @$x_description . "");
			$html_page .= "<td><span class='phpmaker'>" . str_replace(chr(10), "<br>", @$x_description . "") . "</span></td>";
			$html_page .= "<td width='10'></td>";
			$html_page .= "</tr></table></td>";
			$html_page .= "</tr>";
			}
		}
	}
$html_page .= "<tr valign='center' height='15'><td bgcolor='d8ecd1'>";
$html_page .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr bgcolor='".$color2."'>";
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"productidOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td align='left'>";
	$html_page .= orderchange("product_item","barcodeOrderHead");
	$html_page .= "</td>";
	}
$html_page .= "<td align='left'>";
$html_page .= orderchange($modul_select,"productnameOrderHead");
$html_page .= "</td>";
$html_page .= "<td align='left'>";
$html_page .= orderchange("product_item","makernameOrderHead");
$html_page .= "</td>";
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 2 ||
	$_SESSION[$GLOBALS["which_system"]."status_UserLevel"] == 3)
	{
	$html_page .= "<td><span class='phpmaker'>&nbsp;&nbsp;".viewModulParam($modul_select,"active")."</span></td>";
	}
$html_page .= "<td width='60' align='right'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"amount")."&nbsp;</span></td>";
$html_page .= "<td width='110' align='center'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"inprice")."&nbsp;</span></td>";
$html_page .= "<td width='110' align='center'><span class='phpmaker'>&nbsp;".viewTitle($modul_select,"outprice")."&nbsp;</span></td>";
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
		$x_product_id = @$row["id"];
		$x_name = @$row["name"];
		$x_barcode = @$row["barcode"];
		$x_maker_id = @$row["maker_id"];
		$x_makername = @$row["makername"];
		$x_name = @$row["name"];
		$x_topic_id = @$row["topic_id"];
		$x_priceHUF = @$row["priceHUF"];
		$x_pictURL = @$row["pictURL"];
		$x_novelty = @$row["novelty"];
		$x_amount = @$row["amount"];
		$x_inprice = @$row["inprice"];
		$x_sold = @$row["sold"];
		$x_sale = @$row["sale"];
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
		$html_page .= "<tr align='center'>";
/*
		$html_page .= "<td>";
		if (!is_null($x_pictURL)) 
			{ 
			$html_page .= "<a href='index.php?modul_action=viewfull&key=" . urlencode($x_id) . "'>";
			$html_page .= "<img src='images/public/photo.gif' border='0' name='view' alt='".viewModulParam($modul_select,"viewfull")."'>";
			$html_page .= "</a>";
			} 
		else
			{
			$html_page .= "<img src='images/public/nophoto.gif' border='0' name='view'>";
			}
		$html_page .= "</td>";
*/
		$html_page .= "<td align='left'>";
		$html_page .= "<span class='phpmaker'>" . $x_name . "&nbsp;</span>";
		$html_page .= "</td></tr></table></td>";
		$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;&nbsp;" . $row["makername"] ."&nbsp;</span></td>";
		$html_page .= "</td>";
		$html_page .= activeTd($x_active,$enable["yes"],$enable["no"]);
		$basketsql = "SELECT ".$modul_select.".*,product_item.priceHUF AS productprice FROM ".$modul_select;
		$basketsql .= " LEFT JOIN product_item ON product_item.id=".$modul_select.".product_id";
		$basketsql .= " WHERE ".$modul_select.".topic_id=".$key_m." AND ".$modul_select.".product_id=".$x_product_id;
		$basketrs = mysqli_query($GLOBALS['conn'],$basketsql);
		if ($basketrs && $rowwrk = mysqli_fetch_array($basketrs))
			{
			$x_basket_amount = $rowwrk["amount"];
			$x_basket_inprice = $rowwrk["inprice"];
			$x_basket_outprice = $rowwrk["outprice"];
			}
		else
			{
			$x_basket_amount = "";
			$x_basket_inprice = "";
			$x_basket_outprice = $x_priceHUF;
			}
		$basket_is = intval(@mysqli_num_rows($basketrs));
		$which_line = $recActual;
		$which_line--;
		$x_total_inprice=$x_basket_amount*$x_basket_inprice;
		if ($x_total_inprice==0) $x_total_inprice = "";
		$x_total_outprice=$x_basket_amount*$x_basket_outprice;
		if ($x_total_outprice==0) $x_total_outprice = "";
		if ($x_topic_active)
			{
			$html_page .= "<td align='center'>";
			if ($basket_is == 0)
				{
				$html_page .= "<input type='text' name='b_amount' size='3' value=''  style='text-align:right;'>&nbsp;";
				$html_page .= "</td><td align='center'>";
				$html_page .= "<input type='text' name='b_inprice' size='7' value=''  style='text-align:right;'>&nbsp;";
				$html_page .= "</td><td align='center'>";
				$html_page .= "<input type='text' name='b_outprice' size='7' value='" . $x_basket_outprice . "' style='text-align:right;'>&nbsp;";
				} 
			else 
				{
				$html_page .= "<input type='text' name='b_amount' size='3' value='" . $x_basket_amount . "' style='text-align:right;color:red;'>&nbsp;";
				$html_page .= "</td><td align='center'>";
				$html_page .= "<input type='text' name='b_inprice' size='7' value='" . $x_basket_inprice . "' style='text-align:right;color:red;'>&nbsp;";
				$html_page .= "</td><td align='center'>";
				$html_page .= "<input type='text' name='b_outprice' size='7' value='" . $x_basket_outprice . "' style='text-align:right;color:red;'>&nbsp;";
				}
			}
		else
			{
			$html_page .= "<td align='right'>";
			$html_page .= "<span class='phpmaker'>" . $x_basket_amount . "&nbsp;</span>";
			$html_page .= "</td><td align='center'>";
			$html_page .= "<span class='phpmaker'>" . $x_basket_inprice . " / ".$x_total_inprice."&nbsp;</span>";
			$html_page .= "</td><td align='center'>";
			$html_page .= "<span class='phpmaker'>" . $x_basket_outprice . " / ".$x_total_outprice. "&nbsp;</span>";
			}
		$html_page .= "</td>";
		$html_page .= "<td align='right'><table border=0 cellspacing='0' cellpadding='0'><tr><td>";
		if (!isset($nobasket) && !$nobasket)
			{
			$html_page .= "<a href='javascript:move(" . (urlencode($key_m)).",". (urlencode($x_product_id)). ",document.listform.b_amount[" . $which_line . "].value,document.listform.b_inprice[" . $which_line . "].value,document.listform.b_outprice[" . $which_line . "].value);";
			$html_page .= "'><img src='" . $image_button . "basketrightempty.gif' border='0' name='basket' alt='".viewModul("basket","title")."'></a>&nbsp;";
			}
		$html_page .= "</td>";
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
		$html_page .= "</td></tr></table></td>";
		$html_page .= "</table></td></tr>"; 
		}
	}
$html_page .= "</form>";
$html_page .= "</table></td></tr>";
$html_page .= "</table>";
$html_page .= "</td>";
advert("right",viewModul($modul_select,"rightadvert"));
$html_page .= "</tr></table>";
$html_page .= navigation();
$html_page .= "</form>";
footer("");
?>
<script language="JavaScript">
function move(t,x,y,z,z2)
	{
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
	window.location = "index.php?modul_action=add&topic_id=" + t + "&key=" + x + "&amount=" + y + "&inprice=" + z + "&outprice=" + z2;
	}
</script>
