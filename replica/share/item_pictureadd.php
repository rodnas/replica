<?php
$which_back = "list";
sharefieldinit();
if (($ewCurSec & ewAllowadd) <> ewAllowadd) jumptopage("index.php?modul_action=" . $which_back);
// get action
$a = @$_POST["a"];
$x_errortext = @$_POST["errortext"];
$x_fieldfocus = @$_POST["fieldfocus"];
if (empty($a))
	{
	$key = @$_GET["key"];
	if ($key <> "")
		{
		$a = "C"; // copy record
		}
	else
		{
		$a = "I"; // display blank record
		}
	}
switch ($a)
	{
	case "C": // get a record to display
		$tkey = "" . $key . "";
		$strsql = "SELECT * FROM " . $modul_select . " WHERE id=" . $tkey;
		$rs = mysqli_query($GLOBALS["conn"],$strsql);
		if (mysqli_num_rows($rs) == 0)
			{
			jumptopage("index.php?modul_action=" . $which_back);
			}
		else
			{
			$row = mysqli_fetch_array($rs);

			// get the field contents
			$x_topic_id = @$row["topic_id"]; 
			$x_item_id = @$row["item_id"];
			$x_name = @$row["name"]; 
			if ($modul_select == "gallery_picture")
				{
				$x_sender = @$row["sender"]; 
				$x_maker = @$row["maker"]; 
				}
			sharefromtable();
			}
		mysqli_free_result($rs);
		break;
	case "A": // add

		// get the form values
		$x_topic_id = @$_POST["x_topic_id"];
		$x_item_id = @$_POST["x_item_id"];
		$x_pictURL = @$_POST["x_pictURL"];
		$x_name = @$_POST["x_name"];
		if ($modul_select == "gallery_picture")
			{
			$x_sender = @$_POST["x_sender"];
			$x_maker = @$_POST["x_maker"];
			}
		sharefrompost();
		if ($x_errortext == 'NULL' || $x_errortext == "")		
			{
			// add the values into an array

			// topic_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_topic_id) : $x_topic_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`topic_id`"] = $theValue;

			// item_id
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_item_id) : $x_item_id;
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			$fieldList["`item_id`"] = $theValue;

			// name
			$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_name) : $x_name;
			$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
			$fieldList["`name`"] = $theValue;

			if ($modul_select == "gallery_picture")
				{
				// master_id
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_master_id) : $x_master_id;
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				$fieldList["master_id"] = $theValue;

				// sender
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_sender) : $x_sender;
				$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
				$fieldList["sender"] = $theValue;
				}

			sharefieldconv();			

			// insert into database
			$strsql = "INSERT INTO " . $modul_select . " (";
			$strsql .= implode(",", array_keys($fieldList));
			$strsql .= ") VALUES (";
			$strsql .= implode(",", array_values($fieldList));
			$strsql .= ")";
		 	mysqli_query($GLOBALS["conn"],$strsql) or die(mysqli_error());
			$last_id="".mysqli_insert_id()."";
			$x_pictureorig = @$_POST["x_picturesorig"];
			if (@$HTTP_POST_FILES['x_pictureorig']['name']!="")
				{
				$imagetype = @$HTTP_POST_FILES['x_pictureorig']['type'];
				if (($imagetype=="image/pjpeg")	|| ($imagetype=="image/jpeg") || ($imagetype=="image/jpg")
				|| ($imagetype=="image/gif") || ($imagetype=="image/png"))
					{
					$pictnameorig=@$HTTP_POST_FILES['x_pictureorig']['name'];
					if (($imagetype=="image/pjpeg") || ($imagetype=="image/jpeg") || ($imagetype=="image/jpg"))
						{
						$extension = ".jpg";
						}
					if (($imagetype=="image/gif"))
						{
						$extension = ".gif";
						}
					if (($imagetype=="image/png"))
						{
						$extension = ".png";
						}
					$pictnameorig = realpath($modul_image_path). "/". $modul_select."_" . $last_id . "_orig" . $extension;
					$pictnamesmall = realpath($modul_image_path). "/". $modul_select."_" . $last_id . "_small" . $extension;
					$pictnamenormal = realpath($modul_image_path)."/".  $modul_select."_" . $last_id . "_normal" . $extension;
					$pictnamelarge = realpath($modul_image_path)."/".  $modul_select."_" . $last_id . "_large" . $extension;
					$pictnameSAVE = $modul_select."_" . $last_id . "_small" . $extension;
					move_uploaded_file(@$HTTP_POST_FILES['x_pictureorig']['tmp_name'],$pictnameorig);
					chmod($pictnameorig,0644);
					pictureresize($pictnameorig,$pictnamesmall,viewModulParam($modul_select,"pictsmallwidth"),viewModulParam($modul_select,"pictsmallheight"));
					chmod($pictnamesmall,0644);
					pictureresize($pictnameorig,$pictnamenormal,viewModulParam($modul_select,"pictnormalwidth"),viewModulParam($modul_select,"pictnormalheight"));
					chmod($pictnamenormal,0644);
					pictureresize($pictnameorig,$pictnamelarge,viewModulParam($modul_select,"pictlargewidth"),viewModulParam($modul_select,"pictlargeheight"));
					chmod($pictnamelarge,0644);
					unlink($pictnameorig);
					$x_pictURL = $pictnameSAVE;
					}

				// pictURL
				$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_pictURL) : $x_pictURL;
				$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
				$fieldList["`pictURL`"] = $theValue;

				$updateSQL = "UPDATE " . $modul_select . " SET ";
				foreach ($fieldList as $key=>$temp)
					{
					$updateSQL .= "$key = $temp, ";			
					}
				if (substr($updateSQL, -2) == ", ")
					{
					$updateSQL = substr($updateSQL, 0, strlen($updateSQL)-2);
					}
				$updateSQL .= " WHERE id=".$last_id;
			  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());

				$updateSQL = "UPDATE " . str_replace("_picture","_item",$modul_select) . " SET ";
				$updateSQL .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
				$updateSQL .= "modify_datetime = ".$w_actual_datetime;			
				$updateSQL .= " WHERE id= '".$x_topic_id."'";
			  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
				if (@$_SESSION_[$which_system.viewModul($modul_select,"prevmodul") . "_topic_masterkey"] <> "")
					{
					$master_topic = @$_SESSION[$which_system.viewModul($modul_select,"prevmodul"). "topic_masterkey"]; // restore master key from session
					$updateSQL = "UPDATE " . $which_master . "_topic SET ";
					$updateSQL .= "modify_user_id = ".@$_SESSION[$which_system . "status_UserID"]. ",";			
					$updateSQL .= "modify_datetime = ".$w_actual_datetime;			
					$updateSQL .= " WHERE id= '".$master_topic."'";
				  	$rs = mysqli_query($GLOBALS["conn"],$updateSQL) or die(mysqli_error());
					}
				}
			jumptopage("index.php?modul_action=" . $which_back);
			}
	}
include ($share_path . "header1.php");
$html_page = header3();
$html_page .= "<script language=\"JavaScript\" src=\"" . $share_path . "js/ew.js\"></script>";
?>
<script language="JavaScript">
<!-- start Javascript
_editor_url = "<?php echo $share_path ?>/js/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5)
	{
	document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js" language="JavaScript"></scr' + 'ipt>');
	}
else
	{
	document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>');
	}

// end JavaScript -->
</script>
<script language="JavaScript">
<!-- start Javascript
function  EW_checkMyForm(EW_this)
	{
	if (EW_this.x_pictureorig && !EW_hasValue(EW_this.x_pictureorig, "TEXT" ))
		{
		document.addform.errortext.value = "<?php echo viewModulParam($modul_select,"pictURLErrMsg"); ?>";
		document.addform.fieldfocus.value = "x_pictureorig";
                return true; 
	        }
	document.addform.errortext.value = "";
	document.addform.fieldfocus.value = "";
	return true; 
	}

// end JavaScript -->
</script>
<?php
$html_page .= "<form onSubmit=\"return EW_checkMyForm(this);\" enctype=\"multipart/form-data\" method='post' name='addform'>";
$html_page .= "<input type='hidden' name='errortext' value='" . $x_errortext . "'>";
$html_page .= "<input type='hidden' name='fieldfocus' value='" . $x_fieldfocus . "'>";
$html_page .= "<input type='hidden' name='a' value='A'>";
$html_page .= "<input type='hidden' name='x_id' value='" . htmlspecialchars(@$x_id) . "'>";
$html_page .= "<table width='100%' border='0' cellspacing='1' cellpadding='2'>";
if ($x_errortext !== NULL && $x_errortext !== "")
	{
	$html_page .= "<tr align='center'>";
	$html_page .= "<td bgcolor ='#CCCCCC' style='border-style:border-color:red;border-width:thin;'><font color='red' class='phpmaker'><strong>" . $x_errortext . "&nbsp;</strong></font></td>";
	$html_page .= "</tr>";
	}
$html_page .= "<tr align='center'><td valign='top'>";
$html_page .= "<table border='0' cellspacing='1' cellpadding='2' bgcolor='#CCCCCC'>";
$x_item_id = @$_SESSION[$which_system.$modul_select . "_masterkey"]; // restore master key from session
$strmassql = "SELECT ".str_replace("_picture","_item",$modul_select).".*,".str_replace("_picture","_topic",$modul_select).".name AS topicname FROM " . str_replace("_picture","_item",$modul_select);
$strmassql .= " LEFT JOIN ".str_replace("_picture","_topic",$modul_select)." ON " . str_replace("_picture","_topic",$modul_select).".id=".str_replace("_picture","_item",$modul_select).".topic_id";
$strmassql .= " WHERE ";	
$strmassql .= "(".str_replace("_picture","_item",$modul_select).".id = " . $x_item_id  . ")";	
$rsMas = mysqli_query($GLOBALS["conn"],$strmassql);
if (mysqli_num_rows($rsMas) > 0)
	{
	$row = mysqli_fetch_array($rsMas);
	$x_topic_id = @$row["topic_id"];
	$x_topicname = @$row["topicname"];
	$x_itemname = $row["name"];
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"topic_idTitle")."</span></td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'>" . $row["topicname"] . "</span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
	$html_page .= "<td width='400' bgcolor='" . $color6 . "'><span class='phpmaker'>".$x_itemname."</span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
$html_page .= "<input type='hidden' name='x_topic_id' value='".htmlspecialchars(@$x_topic_id)."'>";
$html_page .= "<input type='hidden' name='x_item_id' value='".htmlspecialchars(@$x_item_id)."'>";
$html_page .= "</tr>";
$html_page .= "<tr valign='top'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"pictURLTitle")." *</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'>";
$html_page .= whichpictureview($modul_image_path . "normal/" . str_replace("_small.","_normal.",$x_pictURL),"")."<br>";
//$html_page .= "<span class='phpmaker'><input type='text' name='x_pictURL' size='40' maxlength='100' value='" . htmlspecialchars(@$x_pictURL) . "'></span>&nbsp;";
$html_page .= "<span class='phpmaker'><input type='file' name='x_pictureorig' size='30' maxlength='100' value='" . htmlspecialchars(@$x_pictureorig) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
$html_page .= "<tr valign='top'>";
$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"nameTitle")."</span>&nbsp;</td>";
$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_name' size='70' maxlength='100' value='" . htmlspecialchars(@$x_name) . "'></span>&nbsp;</td>";
$html_page .= "</tr>";
if ($modul_select == "gallery_picture")
	{
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"makerTitle")."</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_maker' size='70' maxlength='60' value='" . htmlspecialchars(@$x_maker) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	$html_page .= "<tr>";
	$html_page .= "<td bgcolor='" . $actcolor . "'><span class='phpmaker'>".viewModulParam($modul_select,"senderTitle")." *</span>&nbsp;</td>";
	$html_page .= "<td bgcolor='" . $color6 . "'><span class='phpmaker'><input type='text' name='x_sender' size='70' maxlength='60' value='" . htmlspecialchars(@$x_sender) . "'></span>&nbsp;</td>";
	$html_page .= "</tr>";
	}
include ($share_path."sharefieldinput.php");
footer("add");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
switch (document.addform.fieldfocus.value)
	{
	case "x_pictureorig" : document.addform.x_pictureorig.focus();
		break;
	default : document.addform.x_pictURL.focus();
		break;
	}
-->
</script>
