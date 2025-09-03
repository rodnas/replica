<?php
// Module properties
$which_back = "list&modul_select=basket&cmd=resetall";
if (($ewCurSec & ewAllowadd) <> ewAllowadd) jumptopage("index.php?modul_action=" . $which_back);
// multiple delete records
$key = @$_POST["key"];
$p_amount = @$_POST["x_amount"];
if (count($key) == 0) 
	{
	jumptopage("index.php?modul_action=" . $which_back);
	}
$sqlKey = "(";
foreach ($key as $reckey) 
	{	
	$reckey = trim($reckey);
	// build the SQL
	$sqlKey .= "(" . "`id`=" . "" . $reckey . "" . " AND ";
	if (substr($sqlKey, -5) == " AND ")	
		{
		$sqlKey = substr($sqlKey, 0, strlen($sqlKey)-5);
		} 
	$sqlKey .= ") OR ";
	}
if (substr($sqlKey, -4) == " OR ") 
	{
	$sqlKey = substr($sqlKey, 0, strlen($sqlKey)-4);
	}
$sqlKey .= ") AND insert_user_id = " . @$_SESSION[$which_system . "status_UserID"];
// get action
$a = @$_POST["a"];
if (empty($a))
	{
	$a = "I";	// display
	}
switch ($a)
	{
	case "I": // display
		$strsql = "SELECT * FROM basket WHERE " . $sqlKey;
		$strsql .= " ORDER BY product_id";
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		break;
	case "O": // update
		$w_actual_datetime = db_actual_datetime();
		$x_session_id = session_id();
		$key = @$_POST["key"];
		$strsql = @$_POST["strsql"];
		$sqlKey = @$_POST["sqlKey"];
		$x_mail_to = "";
		$sqlKey= "";
		$recActual=0;	
		$separator = "\n";
		$x_type_id = @$_POST["x_type_id"];
		$x_term_date = @$_POST["x_term_date"];
		$x_comment = @$_POST["x_comment"];
		$x_lang_id = @$_SESSION[$which_system . "status_UserLangID"];
		$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
		$x_insert_datetime = $w_actual_datetime;
		$x_insert_datetime = date('Y.m.d H:i:s<br>',time());
		$work_date = "'" . $x_insert_datetime . "'";
// Insert record to order table
		$x_id = @$_POST["x_id"];
		$total_amount = 0;
		$total_sum = 0;
		$x_status_id = 1;
		$x_description = "****";

		// add the values into an array

		// session_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_session_id) : $x_session_id;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["session_id"] = $theValue;

		// description
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_description) : $x_description;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["description"] = $theValue;

		$fieldList["active"] = 1;

		// status_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_status_id) : $x_status_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$fieldList["status_id"] = 1;

		// total_amount
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_total_amount) : $x_total_amount;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$fieldList["total_amount"] = $theValue;

		// total_price
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_total_price) : $x_total_price;
		$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
		$fieldList["total_price"] = $theValue;

		// type_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_type_id) : $x_type_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$fieldList["type_id"] = $theValue;

		// term_date
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_term_date) : $x_term_date;
		$theValue = ($theValue != "") ? " '" . date($theValue) . "'" : "NULL";
		$fieldList["term_date"] = $theValue;

		// comment
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_comment) : $x_comment;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["comment"] = $theValue;

		// lang_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$fieldList["lang_id"] = $theValue;

		// insert_user_id
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$fieldList["insert_user_id"] = $theValue;

		// insert_datetime
		$fieldList["insert_datetime"] = $w_actual_datetime;

		// insert into database
		$strsql = "INSERT INTO " . $modul_select . " (";
		$strsql .= implode(",", array_keys($fieldList));
		$strsql .= ") VALUES (";
		$strsql .= implode(",", array_values($fieldList));
		$strsql .= ")";
	 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		ob_end_clean();
		$strsql = "SELECT * FROM " . $modul_select . " WHERE `session_id`='" . session_id()."'";
		$strsql .= " AND insert_user_id=".@$_SESSION[$which_system . "status_UserID"];
		$strsql .= " AND insert_datetime=".$w_actual_datetime;
		$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		if (!($row = mysqli_fetch_array($rs))) 
			{
			ob_end_clean();
			}
		else
			{
			$x_orders_id = @$row["id"];
			}
		foreach ($key as $reckey) 
			{	
			$recActual++;	
			// build the SQL
			$reckey = trim($reckey);
			$strsql = "SELECT * FROM basket WHERE `id`=" . $reckey;
			$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
			if (!($row = mysqli_fetch_array($rs))) 
				{
				ob_end_clean();
				}
			else
				{
				$x_product_id = @$row["product_id"];
				$x_amount = @$row["amount"];
				$x_price = @$row["price"];
				$x_insert_user_id = @$_SESSION[$which_system . "status_UserID"];
				$x_status_id = 1;
				$x_lang_id = $_SESSION[$which_system . "status_UserLangID"];

				// add the values into an array

				// orders_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_orders_id) : $x_orders_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`orders_id`"] = $theValue;

				// session_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_session_id) : $x_session_id;
				$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
				$fieldListw["`session_id`"] = $theValue;

				// product_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_product_id) : $x_product_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`product_id`"] = $theValue;

				// status_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_status_id) : $x_status_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`status_id`"] = $theValue;

				// amount
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_amount) : $x_amount;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`amount`"] = $theValue;

				// price
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_price) : $x_price;
				$theValue = ($theValue != "") ? " '" . doubleval($theValue) . "'" : "NULL";
				$fieldListw["`price`"] = $theValue;

				// lang_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_lang_id) : $x_lang_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`lang_id`"] = $theValue;

				// insert_user_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_insert_user_id) : $x_insert_user_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldListw["`insert_user_id`"] = $theValue;

				// insert_datetime
				$fieldListw["`insert_datetime`"] = $w_actual_datetime;

				// insert into database
				$strsql = "INSERT INTO orders_item (";
				$strsql .= implode(",", array_keys($fieldListw));
				$strsql .= ") VALUES (";
				$strsql .= implode(",", array_values($fieldListw));
				$strsql .= ")";
				mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
				ob_end_clean();
				$strsql = "DELETE FROM basket WHERE `id`=" . $reckey;
				$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
				ob_end_clean();

				$strsql = "SELECT * FROM product_item WHERE `id`=" . $x_product_id;
				$rs = mysqli_query($strsql, $GLOBALS['conn']) or die(mysqli_error());
				if (!($row = mysqli_fetch_array($rs)))
					{
					ob_end_clean();
					}
				else
					{
					$x_name = @$row["name"];
					$x_productid = @$row["productid"];
					$item_sum = $x_amount*$x_price;
					$total_amount = $total_amount+$x_amount;
					$total_sum = $total_sum+$item_sum;
					}
				}
			}
		if ($x_type_id == 1)
			{
			$x_deadline = date('Y.m.d H:i:s<br>',time()+604800);
			}
		$x_total_price = $total_sum;
		$x_total_amount = $total_amount;
		$x_status_id = 1;

		// update
		$strsql = "UPDATE " . $modul_select ." SET";
		$strsql .= " total_amount=".$x_total_amount;
		$strsql .= ", total_price=".$x_total_price;
		$strsql .= " WHERE id=".$x_orders_id;
	 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
		ob_end_clean();

/*
		$mail_from = "formatex@mail.datanet.hu";
		$mail_to = "rodnas@uw.hu";
		$mail_subject = "Replica Modellszaküzlet megrendelés";
		$mail_header = "MIME-Version: 1.0\n";
		$mail_header .= "Content-Type: text/html; charset=iso-8859-2\n";
		$mail_header .= "From:$mail_from\n";
		$html_message = "<html><body>" . $x_description . "</body></html>";
		$success_mail = mail($mail_to, $mail_subject, $html_message, $mail_header);
		if ($success_mail)
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
include ($share_path . "header1.php");
$html_page = header2();
$html_page .= "<form method='post'>";
$html_page .= "<input type='hidden' name='a' value='O'>";
$html_page .= "<input type='hidden' name='strsql' value='" . $strsql ."'>";
$html_page .= "<input type='hidden' name='sqlKey' value='" . $sqlKey . "'>";
foreach ($x_amount as $recx_amount)
	{
	$html_page .= "<input type='hidden' name='x_amount[]' value='" . $recx_amount . "'>";
	}
$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
$html_page .= "<tr bgcolor='#CCCCCC'>";
$html_page .= "<td align='center' style='border-style:groove;border-color:".$color2.";border-width:thin;'>";
$html_page .= "<span class='header'><b>";
$html_page .= viewModulParam($modul_select,"header");
$html_page .= "</b></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr valign='top'><td>";
$html_page .= "<table width='100%' border=0 cellspacing='0' cellpadding='0'>";
$html_page .= "<tr height='25' bgcolor='" . $actcolor . "' valign='center'>";
$html_page .= "<td width='70'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"productidTitle")."&nbsp;</span></td>";
$html_page .= "<td width='100'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"maker_idTitle")."</span></td>";
$html_page .= "<td width='280'><span class='phpmaker'>".viewModulParam($modul_select,"productnameTitle")."&nbsp;</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>".viewModulParam($modul_select,"amountTitle")."&nbsp;</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>".viewModulParam($modul_select,"itempriceTitle")."&nbsp;</span></td>";
$html_page .= "<td align='right'><span class='phpmaker'>".viewModulParam($modul_select,"totalpriceTitle")."&nbsp;</span></td>";
$html_page .= "<td width='80' align='center'><span class='phpmaker'>".viewModulParam($modul_select,"insert_datetimeTitle")."&nbsp;</span></td>";
$html_page .= "</tr>";
$totalCount = 0;
$totalSum = 0;
$recCount = 0;
while ($row = mysqli_fetch_array($rs))
	{
	$recCount++;	
	$bgcolor = $color4; // set row color
	if ($recCount % 2 <> 0 )
		{
		$bgcolor=$color5; // display alternate color for rows
		}
	$x_id = @$row["id"];
	$x_product_id = @$row["product_id"];
	$x_status_id = @$row["status_id"];
	$x_amount = @$row["amount"];
	$x_amount = $p_amount[$recCount-1];
	$x_price = @$row["price"];
	$x_lang_id = @$row["lang_id"];
	$x_insert_user_id = @$row["insert_user_id"];
	$x_insert_datetime = @$row["insert_datetime"];
	$totalCount += $x_amount;
	$totalSum += $x_amount * $x_price;
	$html_page .= "<tr height='25' bgcolor='" . $bgcolor . "'>";
	if (!is_null($x_product_id))
		{
		$sqlwrk = "SELECT * FROM product_item";
		$sqlwrk .= " WHERE `id` = " . $x_product_id;
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_productid = $rowwrk["productid"];
			$x_maker_id = $rowwrk["maker_id"];
			$x_name = $rowwrk["name"];
			}
		@mysqli_free_result($rswrk);
		}
	$html_page .= "<input type='hidden' name='key[]' value='" . $x_id . "'>";
	$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_productid . "&nbsp;</span></td>";
		$x_make_name = "";
		if (!is_null($x_maker_id))
			{
			$sqlwrk = "SELECT * FROM product_maker";
			$sqlwrk .= " WHERE `id` = " . $x_maker_id;
			$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
			if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
				{
				$x_maker_name = $rowwrk["name"];
				}
			@mysqli_free_result($rswrk);
			}

		$html_page .= "<td><span class='phpmaker'>&nbsp;" . $x_maker_name . "&nbsp;</span></td>";
	$html_page .= "<td><span class='phpmaker'>" . $x_name . "&nbsp;</span></td>";
	$html_page .= "<td align='right'><span class='phpmaker'>" . $x_amount . "&nbsp;</span></td>";
	$html_page .= "<td align='right'><span class='phpmaker'>" . $x_price . "&nbsp;</span></td>";
	$html_page .= "<td align='right'><span class='phpmaker'>" . $x_amount*$x_price . "&nbsp;</span></td>";
	$html_page .= "<td align='center'><span class='phpmaker'>" . FormatDateTime($x_insert_datetime,9) . "&nbsp;</span></td>";
	$html_page .= "</tr>";
	}
mysqli_free_result($rs);
$html_page .= "<tr><td colspan='8' align='center'>";
$html_page .= "<hr size='4' width='100%' style='border-style:groove;border-color:" . $actcolor . ";border-width:thin;';>";
$html_page .= "</td></tr>";
$html_page .= "<tr>";
$html_page .= "<td align='left'><span class='phpmaker'>&nbsp;".viewModulParam($modul_select,"totalcountTitle").": &nbsp;</span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td align='right'><span class='phpmaker'><b>". $totalCount . "&nbsp;</b></span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "<td align='right'><span class='phpmaker'><b>" . $totalSum . "&nbsp;</b></span></td>";
$html_page .= "<td>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "</table></td></tr>";
$html_page .= "<tr><td align='center'>";
$html_page .= "<hr SIZE='3' noshade>";
$html_page .= "</td></tr>";
$html_page .= "<tr><td align='center'><table border=0 cellspacing='0' cellpadding='0'>";
$html_page .= "<tr height='30' bgcolor='" . $actcolor ."'>";
$html_page .= "<td align='center'>".viewModulParam($modul_select,"type_idTitle")."</td>";
$html_page .= "<td align='center'>".viewModulParam($modul_select,"term_dateTitle")."</td>";
$html_page .= "<td align='center'>".viewModulParam($modul_select,"commentTitle")."</td>";
$html_page .= "<tr height='5' bgcolor='" . $color6 ."'><td colspan='3'></td></tr>";
$html_page .= "</tr>";
$html_page .= "<tr bgcolor='" . $color6 ."'><td align='center' valign='top'>";
$html_page .= "<table border='0' cellspacing='0' cellpadding='0'>";
$html_page .= "<tr><td><span class='phpmaker'>&nbsp;";
$x_type_id ="";
if (empty($x_type_id))
	{
	$x_type_id = 0;
	} // set default value
$x_type_idList = "<select name=\"x_type_id\">";
$cbo_x_type_id_js = ""; // initialise
$sqlwrk = "SELECT `id`, `name` FROM `" . $modul_select . "_type`";
$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
if ($rswrk)
	{
	$rowcntwrk = 0;
	while ($datawrk = mysqli_fetch_array($rswrk))
		{
		$x_type_idList .= "<option value=\"" . htmlspecialchars($datawrk["id"]) . "\"";
		if ($datawrk["id"] == @$x_type_id)
			{
			$x_type_idList .= " selected";
			}
		$x_type_idList .= ">" . $datawrk["name"] . "</option>";
		$rowcntwrk++;
		}
	}
@mysqli_free_result($rswrk);
$x_type_idList .= "</select>";
$html_page .= $x_type_idList;
$html_page .= "</span>&nbsp;&nbsp;</td>";
$html_page .= "</tr></table></td>";
$html_page .= "<td align='center' valign='top'>";
$html_page .= "<select size='1' name='x_term_date'>";
for ($i=1; $i<7; $i++)
	{
	$html_page .= "<option value=\"" . date('Y.m.d<br>',time()+($i*86400)) . "\">" .date('Y.m.d<br>',time()+($i*86400)) . "</option>";
	}
$html_page .= "</select>";
$html_page .= "</td>";
$html_page .= "<td align='center' bgcolor='" . $color6 . "'>&nbsp;&nbsp;<span class='phpmaker'><textarea name='x_comment' cols='51' rows='8'>" . @$x_comment . "</textarea></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr height='5' bgcolor='" . $color6 ."'><td colspan='3'></td></tr>";
$html_page .= "</table>";
$html_page .= "</td></tr>";
$html_page .= $order_text;
$html_page .= "<tr height='10'><td colspan='2' align='center'>";
$html_page .= "<table border=0 width='100%' cellspacing='1' cellpadding='1'><tr>";
$html_page .= "<td width='10'></td>";
$html_page .= "<td width='165'></td>";
$buttonsize = getimagesize(urldecode($image_button . "ok.gif"));
$html_page .= "<td align='center'><input type='button' name='Action' value='&nbsp;' style='width:" . $buttonsize[0]. ";height:" . $buttonsize[1] . ";background-color:transparent;background-image: url(" . $image_button . "ok.gif);background-repeat:no-repeat;background-position:center;border:0' onClick='this.form.action=\"index.php?modul_action=add\";this.form.submit();' title='".viewModulParam($modul_select,"ordersTitle")."'></td>";
$html_page .= "<td width='165' align='right'>";
if (!empty($which_back))
	{
	$html_page .= "<a href='index.php?modul_action=" . $which_back . "'><img src='" . $image_button . "back.gif' border=0 name='back' title='".viewModulParam($modul_select,"add")."'></a>";
	}
$html_page .= "</td>";
$html_page .= "<td width='10'></td>";
$html_page .= "</tr><table>";
$html_page .= "</td></tr>";
$html_page .= "</form>";
$html_page .= "</table>";
footer("");
?>
