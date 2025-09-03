<?php
$strsql_item = "SELECT * FROM ".$modul_select ."_item WHERE `orders_id`=" . $x_id;
$rs_item = mysqli_query($GLOBALS["conn"],$strsql_item) or die(mysqli_error());
$orders_line = intval(@mysqli_num_rows($rs_item));
if ($orders_line != 0)
	{
	$x_description = "<table border=0 cellspacing=1 cellpadding=2>";
	$x_description .= "<tr><td colspan=6 align=center>Megrendelés visszaigazolása&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=center>&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=left>A Formatex Kft.-hez " . substr($x_insert_datetime,0,10) . ". az alábbi megrendelését regisztráltuk:&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=center>&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td>Sorszám&nbsp;</td><td>Cikkszám&nbsp;</td><td>Termék&nbsp;</td><td>&nbsp;Mennyiség&nbsp;</td><td>&nbsp;Egységár&nbsp;</td><td>&nbsp;Összesen&nbsp;</td></tr>" . $separator . $separator;
	$recActual = 0;
	while ($row_item = mysqli_fetch_array($rs_item)) 
		{
		$recActual++;	
		$x_product_id = @$row_item["product_id"];
		$x_amount = @$row_item["amount"];
		$x_price = @$row_item["price"];
		$x_product_id = @$row_item["product_id"];
		$x_status_id = @$row_item["status_id"];
		$x_amount = @$row_item["amount"];
		$x_price = @$row_item["price"];
		$x_active_item = @$row_item["active"];
		$x_productid = "";
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
		$item_sum = $x_amount*$x_price;
		$x_description .= "<tr><td align=right> ";
		$x_description .= $recActual . ".&nbsp;</td>"
		. "<td> " . $x_productid . "&nbsp;</td>" 
		. "<td> " . $x_name . "&nbsp;</td>" 
		. "<td align=right> " . $x_amount . "&nbsp;</td>"
		. "<td align=right> " . $x_price . "&nbsp;</td>";
		if ($x_active_item != 1)
			{
			$x_description .= "<td align=center><b><font color=red> - X - </font></b>";
			}
		else
			{
			$x_description .= "<td align=right> " . $item_sum . " HUF";
			$x_total_amount = $x_total_amount+$x_amount;
			$x_total_price = $x_total_price+$item_sum;
			}
		$x_description .= "</td>"
		. "</tr>" . $separator;
		}
	$x_description .= "<tr><td colspan=6 align=center><hr></td></tr>" . $separator;
	$x_description .= "<tr><td>Összesen:</td><td></td><td></td><td align=right>" . $x_total_amount . "</td><td></td><td align=right>" . $x_total_price . " HUF</td></tr>";
	$x_description .= "<tr><td colspan=6 align=center>&nbsp;</td></tr>" . $separator;
	if (!is_null($x_insert_user_id))
		{
		$sqlwrk = "SELECT * FROM `users`";
		$sqlwrk .= " WHERE `id` = " . $x_insert_user_id;
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk))
			{
			$x_name = $rowwrk["bill_surname"]." ".$rowwrk["bill_forename"];
			$x_address = $rowwrk["bill_zipcode"] . "&nbsp;" 
			. $rowwrk["bill_city"] . "&nbsp;"
			. $rowwrk["bill_address"];
			$x_mail_to = $rowwrk["email"];
			}
		@mysqli_free_result($rswrk);
		}
	$x_description .= "<tr><td colspan=6 align=left>A megrendelõ neve:&nbsp;" . $x_name . "</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=left>Címe:&nbsp;" . $x_address . "</td></tr>" . $separator;
	if ($x_type_id == 1)
		{
		$x_deadline = date('Y.m.d H:i:s<br>',time()+604800);
		$x_description .= "<tr><td colspan=6 align=left>Replica Modellszaküzletben "	. substr($x_deadline,0,10) ."-ig vehetõ át.</td></tr>";
		$x_description .= "<tr><td colspan=6 align=left>Ezen határidõt követõen megrendelését tárgytalannak tekintjük.&nbsp;</td></tr>" . $separator;
		}
	else
		{
		$x_description .= "<tr><td colspan=6 align=left>Ha a termék van raktáron akkor a rendeléstõl számított elsõ csütörtökön postázásra kerül.</td></tr>";
		$x_description .= "<tr><td colspan=6 align=left>Amennyiben a termék nincs raktáron úgy e-mail ban értesítjük errõl.</td></tr>" . $separator;
		}
	$x_description .= "<tr><td colspan=6 align=center>&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=left>Köszönjük megrendelését!&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=center>&nbsp;</td></tr>" . $separator;
	$x_description .= "<tr><td colspan=6 align=left>Formatex Kft.&nbsp;</td></tr>" . $separator;
	$x_description .= "</table>" . $separator;

	// update
	$strsql = "UPDATE " . $modul_select ." SET";
	$strsql .= " total_amount=".$x_total_amount;
	$strsql .= ", total_price=".$x_total_price;
	$strsql .= ", description='".$x_description."'";
	$strsql .= " WHERE id=".$x_id;
	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
	$strsql = "SELECT * FROM `" . $modul_select . "` WHERE `id`=" . $tkey;
	$rs = mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
	if (mysqli_num_rows($rs) == 0 )
		{
		jumptopage("index.php?modul_action=" . $which_back);
		}	

	// get the field contents
	$row = mysqli_fetch_array($rs);
	$key = @$row["id"];
	$x_total_amount = @$row["total_amount"];
	$x_total_price = @$row["total_price"];
	$x_type_id = @$row["type_id"];
	$x_term_date = @$row["term_date"];
	$x_comment = @$row["comment"];
	$x_status_id = @$row["status_id"];
	$x_active = @$row["active"];
	$x_is_read = @$row["is_read"];
	$x_is_read_datetime = @$row["is_read_datetime"];
	$x_is_read_user_id = @$row["is_read_user_id"];
	sharefromtable();
	mysqli_free_result($rs);
	ob_end_clean();
	}
?>