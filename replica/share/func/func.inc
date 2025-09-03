<?php
function modul_permission($permission_modul)
	{
	$permission_result = 0;
	$conn = mysqli_connect(HOST, USER, PASS, DB);
	$user_permission_result = -1;
	if (!is_null(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"])) 
		{
		$sqlwrk = "SELECT groups_permissions.ewcursec, groups_permissions.active FROM groups,groups_permissions,permissions";
		$sqlwrk_where = "groups.id=groups_permissions.group_id";
		$sqlwrk_where .= " AND groups.id=".$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"];
		$sqlwrk_where .= " AND permissions.modul='".$permission_modul."'";
		$sqlwrk_where .= " AND groups_permissions.permission_id=permissions.id";
		if ($sqlwrk_where <> "" ) 
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS["conn"],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
			{
			if ($rowwrk["active"])
				{
				$permission_result = $rowwrk["ewcursec"];
				}
			else
				{
				$permission_result = 0;
				}
			}
		@mysqli_free_result($rswrk);
		$sqlwrk = "SELECT users_permissions.ewcursec, users_permissions.active FROM users,users_permissions,permissions";
		$sqlwrk_where = "users.id=users_permissions.user_id";
		$sqlwrk_where .= " AND users.id=".$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"];
		$sqlwrk_where .= " AND permissions.modul='".$permission_modul."'";
		$sqlwrk_where .= " AND users_permissions.permission_id=permissions.id";
		if ($sqlwrk_where <> "" ) 
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS["conn"],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
			{
			if ($rowwrk["active"])
				{
				$user_permission_result = $rowwrk["ewcursec"];
				}
			else
				{
				$user_permission_result = 0;
				}
			}
		@mysqli_free_result($rswrk);
		if ($user_permission_result <> -1) $permission_result = $user_permission_result;
		}
	return 31;
//	return $permission_result;
	}

function actual_permission($permission_modul)
	{
	$permission_result = 0;
	$conn = mysqli_connect(HOST, USER, PASS. DB);
	$user_permission_result = -1;
	if (!is_null($_SESSION[$GLOBALS["which_system"] . "status_UserLevel"])) 
		{
		$sqlwrk = "SELECT groups_permissions.ewcursec, groups_permissions.active FROM groups,groups_permissions,permissions";
		$sqlwrk_where = "groups.id=groups_permissions.group_id";
		$sqlwrk_where .= " AND groups.id=".$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"];
		$sqlwrk_where .= " AND permissions.modul='".$permission_modul."'";
		$sqlwrk_where .= " AND groups_permissions.permission_id=permissions.id";
		if ($sqlwrk_where <> "" ) 
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
			{
			if ($rowwrk["active"])
				{
				$permission_result = $rowwrk["ewcursec"];
				}
			else
				{
				$permission_result = 0;
				}
			}
		@mysqli_free_result($rswrk);
		$sqlwrk = "SELECT users_permissions.ewcursec, users_permissions.active FROM users,users_permissions,permissions";
		$sqlwrk_where = "users.id=users_permissions.user_id";
		$sqlwrk_where .= " AND users.id=".$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"];
		$sqlwrk_where .= " AND permissions.modul='".$permission_modul."'";
		$sqlwrk_where .= " AND users_permissions.permission_id=permissions.id";
		if ($sqlwrk_where <> "" ) 
			{
			$sqlwrk .= " WHERE " . $sqlwrk_where;
			}
		$rswrk = mysqli_query($GLOBALS['conn'],$sqlwrk);
		if ($rswrk && $rowwrk = mysqli_fetch_array($rswrk)) 
			{
			if ($rowwrk["active"])
				{
				$user_permission_result = $rowwrk["ewcursec"];
				}
			else
				{
				$user_permission_result = 0;
				}
			}
		@mysqli_free_result($rswrk);
		if ($user_permission_result <> -1) $permission_result = $user_permission_result;
		}
	return $permission_result;
	}

function pictureresize($inputname,$outputname,$new_w,$new_h)
	{
	$system = explode(".",$inputname);
	$inputtype = $system[count($system)-1];
	$inputtype = strtolower($inputtype);
	if (($inputtype == 'jpg') or ($inputtype == 'jpeg'))
		{
		$src_img = imagecreatefromjpeg($inputname);
		}
	if ($inputtype == 'gif')
		{
		$src_img = imagecreatefromgif($inputname);
		}
	if ($inputtype == 'png')
		{
		$src_img = imagecreatefrompng($inputname);
		}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $new_w || $old_y > $new_h)
		{
		if ($old_x > $old_y)
			{
			$thumb_w=$new_w;
			$thumb_h=$old_y*($new_h/$old_x);
			}
		if ($old_x < $old_y)
			{
			$thumb_w=$old_x*($new_w/$old_y);
			$thumb_h=$new_h;
			}
		if ($old_x == $old_y)
			{
			$thumb_w=$new_w;
			$thumb_h=$new_h;
			}
		}
	else
		{
		$thumb_w = $old_x;
		$thumb_h = $old_y;
		}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ((preg_match("/png/",$system[1])) || (preg_match("/gif/",$system[1])))
		{
		imagepng($dst_img,$outputname);
		}
	else
		{
		imagejpeg($dst_img,$outputname);
		}
	imagedestroy($dst_img);
	imagedestroy($src_img);
	$resized=1;
	return $resized;
	}

// Convert Integer to Boolean
function IntToBoolean($convertInt)
	{
	if ($convertInt == 1)
		return true;
	else
		return false;
	}

// Convert Boolean to Integer
function BooleanToInt($convertBoolean)
	{
	if ($convertBoolean)
		return 1;
	else
		return 0;
	}

function psearchtypeset()
	{
	if (substr($GLOBALS["pSearch"],0,2) == '\"' && 
		substr($GLOBALS["pSearch"],strlen($GLOBALS["pSearch"])-2,strlen($GLOBALS["pSearch"]))=='\"')
		{
		$GLOBALS["pSearchType"] = "";
		$GLOBALS["pSearch"] = substr($GLOBALS["pSearch"],0,strlen($GLOBALS["pSearch"])-2);
		$GLOBALS["pSearch"] = substr($GLOBALS["pSearch"],2,strlen($GLOBALS["pSearch"]));
		}
	else if (substr($GLOBALS["pSearch"],0,2) == "\'" && 
		substr($GLOBALS["pSearch"],strlen($GLOBALS["pSearch"])-2,strlen($GLOBALS["pSearch"]))=="\'")
		{
		$GLOBALS["pSearchType"] = "";
		$GLOBALS["pSearch"] = substr($GLOBALS["pSearch"],0,strlen($GLOBALS["pSearch"])-2);
		$GLOBALS["pSearch"] = substr($GLOBALS["pSearch"],2,strlen($GLOBALS["pSearch"]));
		$GLOBALS["pSearchOriginal"] = str_replace("\'", "\"", $GLOBALS["pSearchOriginal"]);	
		}
	else
		{
		$GLOBALS["pSearchType"] = "OR";
		}
	}

function sharefromtable()
	{
	$GLOBALS["x_id"] = @$GLOBALS["row"]["id"]; 
	$GLOBALS["x_bgcolor"] = @$GLOBALS["row"]["bgcolor"]; 
	$GLOBALS["x_fgcolor"] = @$GLOBALS["row"]["fgcolor"]; 
	$GLOBALS["x_description"] = @$GLOBALS["row"]["description"]; 
	$GLOBALS["x_description"] = str_replace(chr(10), "", $GLOBALS["x_description"] . "");
	$GLOBALS["x_description"] = str_replace("<P>", "", $GLOBALS["x_description"] . "");
	$GLOBALS["x_description"] = str_replace("</P>", "<br>", $GLOBALS["x_description"] . "");
	$GLOBALS["x_lang_id"] = @$GLOBALS["row"]["lang_id"]; 
	$GLOBALS["x_active"] = @$GLOBALS["row"]["active"]; 
	$GLOBALS["x_insert_user_id"] = @$GLOBALS["row"]["insert_user_id"];
	$GLOBALS["x_insert_datetime"] = @$GLOBALS["row"]["insert_datetime"];
	$GLOBALS["x_modify_user_id"] = @$GLOBALS["row"]["modify_user_id"];
	$GLOBALS["x_modify_datetime"] = @$GLOBALS["row"]["modify_datetime"];
	$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
	if (isset($is_newitemcount) &&
		(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3))
		{
		$GLOBALS["x_is_read"] = @$GLOBALS["row"]["is_read"]; 
		}
	}

function sharefrompost()
	{
	$GLOBALS["x_id"] = @$_POST["x_id"];
	$GLOBALS["x_bgcolor"] = @$_POST["x_bgcolor"];
	$GLOBALS["x_fgcolor"] = @$_POST["x_fgcolor"];
	$GLOBALS["x_description"] = @$_POST["x_description"];
	$GLOBALS["x_lang_id"] = @$_POST["x_lang_id"];
	$GLOBALS["x_active"] = BooleanToInt(@$_POST["x_active"]);
	$GLOBALS["x_insert_user_id"] = @$_POST["x_insert_user_id"];
	$GLOBALS["x_insert_datetime"] = @$_POST["x_insert_datetime"];
	$GLOBALS["x_modify_user_id"] = @$_POST["x_modify_user_id"];
	$GLOBALS["x_modify_datetime"] = '"'.@$_POST["x_modify_datetime"].'"';
	}

function jumptopage($which_page)
	{
	mysqli_close($GLOBALS["conn"]);
	ob_end_clean();
	header("Location: ".$which_page);
	}
function sharefieldinit()
	{
	$GLOBALS["x_id"]="";
	$GLOBALS["x_bgcolor"] = ""; 
	$GLOBALS["x_fgcolor"] = ""; 
	$GLOBALS["x_description"] = ""; 
	$GLOBALS["x_comment"] = ""; 
	$GLOBALS["x_lang_id"] = ""; 
	$GLOBALS["x_active"] = ""; 
	$GLOBALS["x_insert_user_id"] = "";
	$GLOBALS["x_insert_datetime"] = "";
	$GLOBALS["x_modify_user_id"] = "";
	$GLOBALS["x_modify_datetime"] = "";
	$GLOBALS["x_visitcounter"] = "";
	$GLOBALS["x_lastvisit"] = "";
	}

function sharefieldconv()
	{
	$GLOBALS["w_actual_datetime"] = '"'.db_actual_datetime().'"';

	// bgcolor
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_bgcolor"]) : $GLOBALS["x_bgcolor"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$GLOBALS["fieldList"]["bgcolor"] = $theValue;

	// fgcolor
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_fgcolor"]) : $GLOBALS["x_fgcolor"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$GLOBALS["fieldList"]["fgcolor"] = $theValue;

	// description
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_description"]) : $GLOBALS["x_description"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$GLOBALS["fieldList"]["description"] = $theValue;

	// lang_id
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_lang_id"]) : $GLOBALS["x_lang_id"];
	$theValue = ($theValue != "") ? intval($theValue) : "NULL";
	$GLOBALS["fieldList"]["lang_id"] = $theValue;

	if ($GLOBALS["modul_action"] == "add")
		{
		$GLOBALS["fieldList"]["active"] = 1;
		}
	else if ($GLOBALS["modul_action"] == "edit")
		{
		// active
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_active"]) : $GLOBALS["x_active"];
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$GLOBALS["fieldList"]["active"] = $theValue;
		}

	if ($GLOBALS["modul_action"] == "add")
		{
		// insert_user_id
		$GLOBALS["fieldList"]["insert_user_id"] = @$_SESSION[$GLOBALS["which_system"] . "status_UserID"];

		// insert_datetime
		$GLOBALS["fieldList"]["insert_datetime"] = $GLOBALS["w_actual_datetime"];
		}

	if ($GLOBALS["modul_action"] == "edit")
		{
		// modify_user_id
		$GLOBALS["fieldList"]["modify_user_id"] = @$_SESSION[$GLOBALS["which_system"] . "status_UserID"];

		// modify_datetime
		$GLOBALS["fieldList"]["modify_datetime"] = $GLOBALS["w_actual_datetime"];
		}

	// visitcounter
	if (!empty($GLOBALS["x_visitcounter"]))
		{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_visitcounter"]) : $GLOBALS["x_visitcounter"];
		$theValue = ($theValue != "") ? intval($theValue) : "NULL";
		$GLOBALS["fieldList"]["visitcounter"] = $theValue;

		// lastvisit
		$GLOBALS["fieldList"]["lastvisit"] = $GLOBALS["w_actual_datetime"];
		}

	$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
	if (isset($is_newitemcount) &&
		(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3))
		{
		$GLOBALS["fieldList"]["is_read"] = 1;
		$GLOBALS["fieldList"]["is_read_datetime"] = $GLOBALS["w_actual_datetime"];
		$GLOBALS["fieldList"]["is_read_user_id"] = @$_SESSION[$GLOBALS["which_system"] . "status_UserID"];
		}
	}

function textwrapper($text)
	{
	$wrapped_text = "";
	if (isset($GLOBALS["textwraplen"]))
		{
		$wrapinglen = $GLOBALS["textwraplen"];
		}
	else
		{
		$wrapinglen = 100;
		}
	$text_tomb = explode(" ",$text);
	for ($i=0;$i<count($text_tomb);$i++)
		{
		$wrapped_text .= " ". trim(wordwrap($text_tomb[$i],$wrapinglen,"<br/>\n",1));
		}
	return trim($wrapped_text);
	}

function debug($debugfilename,$debugging)
	{
	if ($debugging)
		{
		if (empty($debugfilename)) $debugfilename = "debug.txt";
		$somecontent.= str_pad(" ".$_SERVER["PHP_SELF"]." ",60,"*",STR_PAD_BOTH)."\n";
		$somecontent.= str_pad(" ".date('Y-m-d H:i:s',time())." ",60,"*",STR_PAD_BOTH)."\n";
		$somecontent.= str_pad(" Sessions ",60,"*",STR_PAD_BOTH)."\n";
		foreach ($_SESSION as $kulcs => $ertek)
			{
			$somecontent.= $kulcs.": ".$ertek."\n";
			}
		$somecontent.= str_pad(" Gets ",60,"*",STR_PAD_BOTH)."\n";
		foreach ($_GET as $kulcs => $ertek)
			{
			$somecontent.= $kulcs.": ".$ertek."\n";
			}
		$somecontent.= str_pad(" Posts ",60,"*",STR_PAD_BOTH)."\n";
		foreach ($_POST as $kulcs => $ertek)
			{
			$somecontent.= $kulcs.": ".$ertek."\n";
			}
		$somecontent.= str_pad(" Globals ",60,"*",STR_PAD_BOTH)."\n";
		foreach ($GLOBALS as $kulcs => $ertek)
			{
			$somecontent.= $kulcs.": ".$ertek."\n";
			}
		$somecontent.= str_pad(" End ",60,"*",STR_PAD_BOTH)."\n";
		// Let's make sure the file exists and is writable first.
		if (is_file($debugfilename))
			{
			if (is_writable($debugfilename))
				{
				if (!$handle = fopen($debugfilename, 'a'))
					{
					echo "Cannot open file ($debugfilename)";
					exit;
					}
				if (fwrite($handle, $somecontent) === FALSE)
					{
					echo "Cannot write to file ($debugfilename)";
					exit;
					}
				fclose($handle);
				}
			else
				{
				echo "The file $debugfilename is not writable";
				}
			}
		else
			{
			if (!$handle = fopen($debugfilename, 'a'))
				{
				echo "Cannot open file ($debugfilename)";
				exit;
				}
			if (fwrite($handle, $somecontent) === FALSE)
				{
				echo "Cannot write to file ($debugfilename)";
				exit;
				}
			fclose($handle);
			}
		}
	} 

function is_reading()
	{
	$is_newitemcount = viewModulParam($GLOBALS["modul_select"],"is_newitemcount");
	if (isset($is_newitemcount) &&
		(@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 2 ||
		@$_SESSION[$GLOBALS["which_system"] . "status_UserLevel"] == 3) &&
		($GLOBALS["x_is_read"] != 1 || is_null($GLOBALS["x_is_read"])))
		{
		$updateSQL = "UPDATE " . $GLOBALS["modul_select"] . " SET ";
		$updateSQL .= "is_read = 1,";			
		$updateSQL .= "is_read_datetime = ".db_actual_datetime().",";
		$updateSQL .= "is_read_user_id = " . @$_SESSION[$GLOBALS["which_system"] . "status_UserID"];
		$updateSQL .= " WHERE id=" .$GLOBALS["tkey"];
	  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
		}
	}
?>
