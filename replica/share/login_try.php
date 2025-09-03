<?php
$validpwd = False;
if (@$_POST["login_submit"] <> "")
	{
	$x_loginerrortext = @$_POST["loginerrortext"];
	$x_loginfieldfocus = @$_POST["loginfieldfocus"];
	$validpwd = False;
	// setup variables
	$userid = @$_POST["userid"];
	$userid = (get_magic_quotes_gpc()) ? stripslashes($userid) : $userid;	
	$passwd = @$_POST["passwd"];
	$passwd = (get_magic_quotes_gpc()) ? stripslashes($passwd) : $passwd;
	if (!$validpwd)
		{	
 		$rsUser = mysqli_query($GLOBALS["conn"],"SELECT * FROM `users` WHERE `shortname` = '" . $userid . "'") or die(mysqli_error());
//echo "SELECT * FROM `users` WHERE `shortname` = '" . $userid . "'<br>";
//die();
		if ($rowUser = mysqli_fetch_array($rsUser))
			{
print_r('<pre>');
print_r($rowUser);
print_r('<br>');
print_r($rowUser["password"]);
			if (strtoupper($rowUser["password"]) == strtoupper($passwd))
				{
print_r('<br>');
print_r("egyezés");

				if ($rowUser["active"] != 1 || is_null($rowUser["active"]))
					{
					$x_loginerrortext = "Jeleleg le van tiltva!";
					$x_loginfieldfocus = "userid";
					}
				else
					{
					$_SESSION[$which_system . "status_User"] = $rowUser["shortname"];
				 	$_SESSION[$which_system . "status_UserID"] = $rowUser["id"];
				 	$_SESSION[$which_system . "status_UserLevel"] = $rowUser["group_id"];
				 	$_SESSION[$which_system . "status_UserLangID"] = $rowUser["lang_id"];
					$_SESSION[$which_system . "status"] = "login";
					$validpwd = True;
					if ($_SESSION[$which_system . "status_UserLevel"]==2 &&
						$_SESSION[$which_system . "status_UserID"]==1)
						{
						backup_db($databaseServer,$databaseUser,$databasePassword,$databaseSelect);
						}
					jumptopage($base_modul);
					}
				}
			else
				{
				$x_loginerrortext = "Hibás jelszó!";
				$x_loginfieldfocus = "userid";
				}
			}
		else
			{
			$x_loginerrortext = "Hibás rövidnév!";
			$x_loginfieldfocus = "userid";
			}
		mysqli_free_result($rsUser);
		}
//die();
	}
else
	{
	if ($_SESSION[$which_system . "status_User"] != "Guest")
		{
		$rsUser = mysqli_query($GLOBALS["conn"],"SELECT * FROM `users` WHERE `shortname` = 'Guest'") or die(mysqli_error());
echo "SELECT * FROM `users` WHERE `shortname` = 'Guest'<br>";
		if ($rowUser = mysqli_fetch_array($rsUser))
			{
			$_SESSION[$which_system . "status_User"] = $rowUser["shortname"];
		 	$_SESSION[$which_system . "status_UserID"] = $rowUser["id"];
		 	$_SESSION[$which_system . "status_UserLevel"] = $rowUser["group_id"];
		 	$_SESSION[$which_system . "status_UserLangID"] = $rowUser["lang_id"];
			$_SESSION[$which_system . "status"] = "login";
			mysqli_free_result($rsUser);
			$validpwd = True;
			jumptopage($base_modul);
			}	
		}	
	}
if (!$validpwd) 
	{
	$HTTP_SESSION_VARS[$which_system . "status_UserListType"] = 0;
	$header1 .= "<table border='0' cellspacing='0' cellpadding='0' align='left' valign='center'>";
//	$header1 .= "<form action='index.php?action=".$share_path."login.php' method='post' onSubmit=\"return EW_checkMyForm(this);\" name='loginform'>";
	$header1 .= "<form method='post' name='loginform'>";
	$header1 .= "<input type='hidden' name='loginerrortext' value='" . $x_loginerrortext . "'>";
	$header1 .= "<input type='hidden' name='loginfieldfocus' value='" . $x_loginfieldfocus . "'>";
	if ($x_loginerrortext !== NULL && $x_loginerrortext !== "")
		{
		$header1 .= "<tr height='25' align='center'>";
		$header1 .= "<td colspan='8' bgcolor ='#CCCCCC' style='border-style:groove;border-color:red;border-width:thin'><font color='red' class='phpmaker'><strong>" . $x_loginerrortext . "&nbsp;</strong></font></td>";
		$header1 .= "</tr>";
		}
	$header1 .= "<tr valign='center'>";
	$header1 .= "<td align='left'>";
	$header1 .= "<a href='index.php?modul_select=users&modul_action=registration'><img src='" . $image_button . "who.gif' border=0 name='who' title='".viewModulParam($modul_select,"registration")."'></a>";
	$header1 .= "</td>";
	$header1 .= "<td><input type='text' name='userid' size='10' value='" . $userid . "'></td>";
	$header1 .= "<td align='left'><img src='" . $image_public . "password.gif' border='0' title='".viewModulParam($modul_select,"password")."'></td>";
	$header1 .= "<td><input type='password' name='passwd' size='10'></td>";
	$header1 .= "<td align='left'>&nbsp;</td>";
	$header1 .= "<td colspan='2' align='center' valign='center'>";
	$buttonsize = getimagesize(urldecode($image_button . "ok.gif"));
	$header1 .= "<input type='submit' name='login_submit' value='&nbsp;' style='width:".$buttonsize[0].";height:".$buttonsize[1].";background-color:transparent;background-image: url(" . $image_button . "ok.gif);border:0' title='".viewModulParam($modul_select,"login")."'>"; 
	$header1 .= "</td>";
	$header1 .= "</tr>";
	$header1 .= "</form>";
	$header1 .= "</table>";
	}
?>
