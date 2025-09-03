<?php

/*
if (version_compare(phpversion(), '5.6.40', '>'))
	{
	echo 'Current PHP version: '.phpversion().'<br>';
	echo 'Does not work!<br>';
	die();
	}
*/
error_reporting(0); // -1 full error view

$sessionID = session_id();
if(empty($sessionID)) {
	session_id('replica');
	session_start();
}
//session_start();

ob_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 

include ("config.cfg");
/*
print_r($databaseServer."<br>");
print_r($databaseUser."<br>");
print_r($databasePassword."<br>");
print_r($databaseSelect."<br>");
*/
// open connection to the database
include ($share_path."lng/share_".$lang_type.".inc");
include ("language/language_".$lang_type.".inc");
include ($share_path."db/db_".$db_type.".inc");
$conn = mysqli_connect($config["configShare"]["databaseServer"], $config["configShare"]["databaseUser"], $config["configShare"]["databasePassword"], $config["configShare"]["databaseSelect"]);

mysqli_query($GLOBALS['conn'],"set names utf8");
include ($share_path."func/func.inc");
include ($share_path."func/func_sql.inc");
include ($share_path."/func/func_scr.inc");
include ($share_path."func/phpmkrfn.inc");
$session_live=$_SESSION[$which_system.'SESSIONID'];
if (!isset($session_live))
	{
	$statfull ="counter/allcounter.txt";
	if  (is_file($statfull))
		{
		if ($faf = fopen( $statfull, "r"))
			{
			flock( $faf, 1);
			while (!feof( $faf ))
				{
				$guestcounter = fgets($faf, 1024);
				}
			flock($faf, 3);
			fclose($faf );
			}
		}
	else
		{
		touch($statfull);
		}
	if ($faf = fopen( $statfull, "w"))
		{
		flock($faf, 2);
		$guestcounter=$guestcounter+1;
		fputs($faf, $guestcounter);
		flock($faf, 3);
		fclose ($faf);
		}
	else
		{
		// Can't open allcounter.txt
		}
	$_SESSION[$which_system."SESSIONID"] = session_id();
	}
//session_unregister($which_system."modul_select");
$modul_select = $_SESSION[$which_system."modul_select"];
if (isset($_POST["modul_select"])) 
	{
	$modul_select=$_POST["modul_select"]; 
	$_SESSION[$which_system."modul_select"] = $modul_select;
	}
else if (isset($_GET["modul_select"])) 
	{
	$modul_select=$_GET["modul_select"]; 
	$_SESSION[$which_system."modul_select"] = $modul_select;
//	session_unregister($which_system."modul_action");
	}
else if (isset($_SESSION[$which_system."modul_select"])) 
	{
	$modul_select=$_SESSION[$which_system."modul_select"]; 
	}
if (isset($_POST["modul_action"])) 
	{
	$modul_action=$_POST["modul_action"]; 
	$_SESSION[$which_system."modul_action"] = $modul_action;
	}
else if (isset($_GET["modul_action"])) 
	{
	$modul_action=$_GET["modul_action"]; 
	$_SESSION[$which_system."modul_action"] = $modul_action;
	}
else if (empty($modul_action))
	{
//	session_unregister($which_system."modul_action");
	$modul_action=$_SESSION[$which_system."modul_action"]; 
	}
if (isset($modul_select))
	{
	if ($modul_select == "login" || $modul_select == "logout")
		{
		@session_unset();
		@session_destroy();
		jumptopage($base_modul);
		}
	}
else
	{
	$modul_select = $home_modul;
	$_SESSION[$which_system."modul_select"] = $modul_select;
	$modul_action="list"; 
	$_SESSION[$which_system."modul_action"] = $modul_action;
	}
$ewCurSec = modul_permission($modul_select);
$modul_image_path = $image_path . $modul[$modul_select]["imgpath"];
if ($modul_action == "list")
	{
	$displayRecs = viewModulParam($modul_select,"displayRecs");
	$recRange = viewModulParam($modul_select,"recRange");
	$dbwhere = "";
	$masterdetailwhere = "";
	$searchwhere = "";
	$a_search = "";
	$b_search = "";
	$whereClause = "";
	$noview = viewModulParam($modul_select,"noview");
	$nocopy = viewModulParam($modul_select,"nocopy");
	$noedit = viewModulParam($modul_select,"noedit");
	$noadd = viewModulParam($modul_select,"noadd");
	}
$language_include = "language/".$modul_select."_".$lang_type.".inc";
if (file_exists($language_include))
	{
	include ($language_include);
	}
$modul_include = $modul[$modul_select]["modul"].$modul_action.".php";

/*
if ($_SESSION[$GLOBALS["which_system"]."status_UserLevel"]==2)
	{

	echo "Modul_select:[".$modul_select."]<br>";
	echo "Modul_action:[".$modul_action."]<br>";
	echo "Modul inclued:[".$modul_include."]<br>";
	echo "Modul image_path:[".$modul_image_path."]<br>";
	echo "Realpath:[".realpath($modul_image_path)."]<br>";

	}
*/
include ($modul_include);
// close connection
@mysqli_free_result($rs);
if (isset($GLOBALS['conn']))
	{
	mysqli_close($GLOBALS['conn']);
	}
?>