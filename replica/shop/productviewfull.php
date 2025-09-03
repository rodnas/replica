<?php
// Module properties
$which_back = "list";
if (($ewCurSec & ewAllowview) <> ewAllowview) jumptopage("index.php?modul_action=" . $which_back);
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
if (empty($a))
	{
	$a = "I";	//display with input box
	}
switch ($a)
	{
	case "I": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0 )
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}	
		// get the field contents
		$row = mysqli_fetch_array($rs);
		$x_productid = @$row["productid"];
		$x_barcode = @$row["barcode"];
		$x_maker_id = @$row["maker_id"];
		$x_size_id = @$row["size_id"];
		$x_name = @$row["name"];
		$x_topic_id = @$row["topic_id"];
		$x_priceHUF = @$row["priceHUF"];
		$x_pictURL = $modul_image_path . "/" . @$row["pictURL"];
		$x_novelty = @$row["novelty"];
		$x_sold = @$row["sold"];
		$x_sale = @$row["sale"];
		sharefieldinit();
		sharefromtable();
		mysqli_free_result($rs);
		break;
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<form name='viewform'>";
$html_page .= "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
$html_page .= "<tr>";
$html_page .= "<td valign='top' align='center'>";
$html_page .=  whichpictureview($x_pictURL,"");
$html_page .= "</td>";
$html_page .= itemstatus();
footer("view");
?>
